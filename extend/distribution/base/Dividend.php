<?php
/*------------------------------------------------------ */
//-- 提成处理
//-- Author: iqgmy
/*------------------------------------------------------ */

namespace distribution\base;

use app\BaseModel;
use think\Db;

use app\member\model\UsersModel;
use app\shop\model\OrderModel;
use app\shop\model\OrderGoodsModel;
use app\shop\model\GoodsModel;
use app\distribution\model\DividendAwardModel;
use app\distribution\model\DividendRoleModel;

class Dividend extends BaseModel
{
    public $UsersModel;

    public function __construct($Model)
    {
        parent::__construct();
        $this->UsersModel = new UsersModel();
        $this->Model = $Model;
    }

    /*------------------------------------------------------ */
    //-- 计算提成并记录或更新
    //-- $orderInfo array 订单数据
    //-- $type string 操作类型
    //-- $status int 分佣状态，操作类型为add时，根据传值设置默认状态
    //-- return bool 如果$type为add或订单为身份订单则返回数组
    /*------------------------------------------------------ */
    public function _eval(&$orderInfo, $type = '', $status = 0)
    {
        //身份订单处理
        // if ($orderInfo['d_type'] == 'role_order') {
        //     $status = 3;//待分成
        //     $goodsList = [];
        //     $upData = $this->saveLog($orderInfo, $goodsList, $status);//佣金计算
        //     if (is_array($upData) == false) {
        //         return false;
        //     }
        //     $upData['is_dividend'] = 1;
        //     $this->Model->evalArrival($orderInfo['order_id'], 'role_order');//身份订单直接执行分佣
        //     $res = $this->evalLevelUp($orderInfo);//升级处理
        //     if ($res == false) {
        //         return false;
        //     }
        //     $upData['is_up_role'] = 1;
        //     return $upData;//返回数组
        // }//end
        if ($orderInfo['is_split'] > 0) return true;//需要拆单的不执行
        $upData = [];//更新分佣记录状态
        $OrderModel = new OrderModel();
        $order_operating = '';
        $send_msg = false;
        //先计算佣金
        if ($type == 'add' || $type == 'change') {//写入分佣，普通订单下单时执行
            $goodsList = (new OrderGoodsModel)->where('order_id', $orderInfo['order_id'])->select()->toArray();

            if ($orderInfo['order_type'] == 4) {
                $upData = $this->saveLog($orderInfo, $goodsList, $status);//佣金计算
                // $res = $this->evalLevelUp($orderInfo);//升级处理
                // $ShopRankModel = new \app\shop\model\ShopRankModel();
                // $res = $ShopRankModel->setRankOrder($orderInfo);
            }
            if (is_array($upData) == false) return false;
            if ($status == $OrderModel->config['DD_PAYED']) {
                $res = $this->evalLevelUp($orderInfo);//升级处理
                if ($res == false) return false;
                if ($orderInfo['is_dividend'] == 0) {//第一次生成时才发送模板消息
                    $this->Model->sendMsg('pay', $orderInfo['order_id']);//支付模板消息
                }
            }
            return $upData;//返回数组
        }

        if ($type == 'pay') {//订单支付成功
            if ($orderInfo['order_type'] == 4) {
                $res = $this->evalLevelUp($orderInfo);//升级处理
                if ($res == false) return false;
            }
            $upData['status'] = $OrderModel->config['DD_PAYED'];
            $send_msg = true;
        } elseif ($type == 'cancel') {//订单取消
            // $upData['status'] = $OrderModel->config['DD_CANCELED'];
            $order_operating = '订单取消';
            $send_msg = true;
        } elseif ($type == 'unpayed') {//未付款
            if ($orderInfo['order_status'] == $OrderModel->config['OS_CANCELED']) {
                $upData['status'] = $OrderModel->config['DD_CANCELED'];
            } elseif ($orderInfo['order_status'] == $OrderModel->config['OS_RETURNED']) {
                $upData['status'] = $OrderModel->config['DD_RETURNED'];
            } else {
                $upData['status'] = $OrderModel->config['DD_UNCONFIRMED'];
            }
        } elseif ($type == 'shipping') {//发货
            // $upData['status'] = $OrderModel->config['DD_SHIPPED'];
        } elseif ($type == 'unshipping') {//未发货
            $upData['status'] = $OrderModel->config['DD_PAYED'];
        } elseif ($type == 'sign') {//签收
            // $upData['status'] = $OrderModel->config['DD_SIGN'];
        } elseif ($type == 'unsign') {//撤销签收
            return $this->Model->returnArrival($orderInfo['order_id'], 'unsign', $orderInfo['user_id']);
        } elseif ($type == 'returned') {//退货
            return $this->Model->returnArrival($orderInfo['order_id'], 'returned', $orderInfo['user_id']);
        }

        if (empty($upData) == false) {//更新分佣状态
            $upWhere[] = ['order_id', '=', $orderInfo['order_id']];
            $upWhere[] = ['order_type', '=', 'order'];
            //如果已经返佣了。不能继续修改分佣状态 2020-9-10 11:36:03-xgh
            $upWhere[] = ['status','<>',$OrderModel->config['DD_DIVVIDEND']];
            $count = $this->Model->where($upWhere)->count();
            if ($count < 1) return true;//如果没有佣金记录不执行
            $upData['update_time'] = time();
            $res = $this->Model->where($upWhere)->update($upData);
            if ($res < 1) return false;
        }

        if ($send_msg == true) {
            $this->Model->sendMsg($type, $orderInfo['order_id'], $order_operating);//发送模板消息
        }

        if ($type == 'pay') {//签收,执行佣金到帐
            // $shop_after_sale_limit = settings('shop_after_sale_limit');
            // if ($shop_after_sale_limit == 0) {
                return $this->Model->evalArrival($orderInfo['order_id'], 'order');
            // }
        }
        return true;
    }
    /*------------------------------------------------------ */
    //-- 计算提成并记录或更新
    /*------------------------------------------------------ */
    public function saveLog(&$orderInfo, &$goodsList, $status = 0)
    {
        $returnArr['dividend_amount'] = 0;

        $nowLevel = 0;//当前处理级别
        $buyUserInfo = $this->UsersModel->info($orderInfo['user_id']);//获取购买会员信息

        //获取旧的分佣记录的分佣者的身份
        $userDividendRole = [];
        if ($orderInfo['is_dividend'] > 0){
            $delWhere[] = ['order_id', '=', $orderInfo['order_id']];
            $delWhere[] = ['order_type', '=', $orderInfo['d_type']];
            $userDividendRole = $this->Model->where($delWhere)->column('role_id','dividend_uid');
            $this->Model->where($delWhere)->delete();//清理旧的提成记录，重新计算
        }
        //end

        $parentId = $buyUserInfo['pid'];//获取购买会员直属上级ID
        //普通订单奖项处理
        $roleList = (new DividendRoleModel)->getRows();
        $diffRole = $lastRole = $roleList[$orderInfo['dividend_role_id']]['role_id'];//下单会员下单时身份级别

        //参与分佣商品处理
        $dividend_goods_ids = [];//所有分佣商品id
        $dividend_goods = [];//所有分佣商品
        $dividend_goods_total = 0;//所有分佣商品金额
        $goods_total = 0;// 分佣商品总数
        $assignAwardNum = [];//记录已分出去的管理奖金额
        $GoodsModel = new GoodsModel();
        foreach ($goodsList as $goods) {
            $_goods = $GoodsModel->info($goods['goods_id']);
            if ($_goods['is_dividend'] == 1 && $_goods['goods_type'] == 2){
                $dividend_goods_ids[] = $goods['goods_id'];
                $goods['goods_total'] = priceFormat($goods['sale_price'] * $goods['goods_number']);//商品总价小计
                $dividend_goods_total += $goods['goods_total'];
                $goods_total += $goods['goods_number'];
                $rank_award = json_decode($_goods['rank_award'],true);
                $goods['award'] = json_decode($_goods['award'],true);
                $level_award = json_decode($_goods['level_award'],true);
                $dividend_goods[$goods['goods_id']] = $goods;
                $assignAwardNum['goods'][$goods['goods_id']]['num'] = 0;
                $assignAwardNum['pid'] = $buyUserInfo['pid'];
                $assignAwardNum['goods'][$goods['goods_id']]['same_num'] = 0;
            }
        }//参与分佣商品处理end

        $level_award_name = '';
        // 联创分红奖
        if (empty($level_award) == false) {
            $levelUser = $this->UsersModel->where('level_id','>',0)->field('user_id')->select()->toArray();
            if (empty($levelUser) == false) {
                foreach ($levelUser as $u) {
                    $user = $this->UsersModel->info($u['user_id']);
                    if ($level_award[$user['level_id']]['num'] > 0) {
                        $dividend_amount = bcmul($goods_total,$level_award[$user['level_id']]['num'],2);
                        if ($dividend_amount > 0) {
                            $returnArr['dividend_amount'] += $dividend_amount;

                            $level_award_name = '用户【'.$buyUserInfo['user_id'].' - '.userInfo($buyUserInfo['user_id']).'】产生订单，获得'.$dividend_amount.'元联创分红奖.';

                            $res = $this->createLog($orderInfo,$user,$dividend_amount,'联创分红奖',$level_award_name,$dividend_goods_total,$status);
                            if (true !== $res) {
                                return false;
                            }
                        }
                    }
                }
            }
        }
        if ($parentId < 1) return $returnArr;//没有上级不执行
        // 直推奖处理
        $level_award_name = '';
        if ($rank_award['push_num'] > 0) {
            $parentInfo = $this->UsersModel->info($parentId);
            if (empty($parentInfo) == false) {
                $dividend_amount = bcmul($goods_total,$rank_award['push_num'],2);
                if ($dividend_amount > 0) {
                    $returnArr['dividend_amount'] += $dividend_amount;
                    $level_award_name = '直推用户【'.$buyUserInfo['user_id'].' - '.userInfo($buyUserInfo['user_id']).'】产生订单，获得'.$dividend_amount.'元推广奖金.';
                    $res = $this->createLog($orderInfo,$parentInfo,$dividend_amount,'推广奖金',$level_award_name,$dividend_goods_total,$status);
                    if (true !== $res) {
                        return false;
                    }
                }
            }
            
        }
        
        $level_award_name = '';
        // 级差or平级
        do {
            $nowLevel += 1;
            $userInfo = $this->UsersModel->info($parentId);//获取会员信息
            if (empty($userDividendRole) == false){
                $userInfo['role_id'] = $userDividendRole[$userInfo['user_id']];
                $userInfo['role'] = $roleList[$userInfo['role_id']];
            }
            $parentId = $userInfo['pid'];//优先记录下次循环用户ID
            if ($diffRole > $userInfo['role_id']) continue;
            if ( $buyUserInfo['pid'] == $userInfo['user_id'] && $diffRole >= $userInfo['role_id']) continue;
            $dividend_amount = 0;
            if ($diffRole < $userInfo['role_id']) {
                foreach ($dividend_goods as $goods) {
                    $award = $goods['award'];
                    if (empty($award)) continue;
                    if (empty($award[$userInfo['role_id']])) continue;
                    $val = $award[$userInfo['role_id']];
                    $diffNum = $assignAwardNum['goods'][$goods['goods_id']]['num'];
                    $dividend_amount += $val['num'] - $diffNum;
                    $assignAwardNum['goods'][$goods['goods_id']]['num'] = $val['num'];
                    $assignAwardNum['goods'][$goods['goods_id']]['dividend_amount'] = $dividend_amount;
                    $assignAwardNum['goods'][$goods['goods_id']]['same_num'] = $val['num'];
                }
                $award_name = '级差奖励';
                $level_award_name = '您的下级用户【'.$buyUserInfo['user_id'].' - '.userInfo($buyUserInfo['user_id']).'】产生订单，获得'.$dividend_amount.'元级差奖励.';
                $assignAwardNum['pid'] = $userInfo['pid'];
            }else{
                if ($assignAwardNum['pid'] != $userInfo['user_id']) continue;
                foreach ($assignAwardNum['goods'] as $goods) {
                    $dividend_amount += bcdiv($goods['dividend_amount'] * $goods['same_num'] , 100 , 2);
                }
                $award_name = '平级奖励';
                $level_award_name = '您的下级用户【'.$buyUserInfo['user_id'].' - '.userInfo($buyUserInfo['user_id']).'】产生订单，获得'.$dividend_amount.'元平级奖励.';
            }
            if ($dividend_amount > 0) {
                $res = $this->createLog($orderInfo,$userInfo,$dividend_amount,$award_name,$level_award_name,$dividend_goods_total,$status);
            }
            
            $diffRole = $userInfo['role_id'];
        } while ($parentId > 0);
        return $returnArr;
    }
    /**
     * [createLog 保存分佣记录]
     * @param  array   $orderInfo        [订单信息]
     * @param  array   $userInfo         [用户信息]
     * @param  float   $amount           [奖励金额]
     * @param  string  $award_name       [奖励名称]
     * @param  string  $level_award_name [奖励详情]
     * @param  float   $amount           [分佣金额]
     * @param  integer $status           [处理状态]
     * @param  integer $nowLevel         [当前处理级别]
     * @return boolean                   [处理结果]
     */
    public function createLog($orderInfo = [] , $userInfo  = [] , $dividend_amount = 0.00 , $award_name = '' , $level_award_name  = '' , $amount = 0.00 , $status = 0 , $nowLevel = 0 )
    {
        $inArr = [];
        $inArr['dividend_amount'] = $dividend_amount;//计算总佣金
        $inArr['order_type'] = $orderInfo['d_type'];
        $inArr['status'] = $status;
        $inArr['order_id'] = $orderInfo['order_id'];
        $inArr['order_sn'] = $orderInfo['order_sn'];
        $inArr['buy_uid'] = $orderInfo['user_id'];
        $inArr['order_amount'] = $amount;
        $inArr['dividend_uid'] = $userInfo['user_id'];
        $inArr['role_id'] = $userInfo['role_id'];
        $inArr['role_name'] = $userInfo['role']['role_name'];
        $inArr['level'] = $nowLevel;
        $inArr['award_id'] = 0;
        $inArr['award_name'] = $award_name;
        $inArr['level_award_name'] = $level_award_name;
        $inArr['add_time'] = $inArr['update_time'] = time();
        $res = $this->Model->create($inArr);
        if ($res->log_id < 1) return false;
        return true;
    }
    /*------------------------------------------------------ */
    //-- 执行升级方案
    //-- $orderInfo array 订单信息
    //-- $isup bool 是否更新会员信息
    /*------------------------------------------------------ */
    public function evalLevelUp(&$orderInfo)
    {
        //执行分销身份升级处理
        $roleList = (new DividendRoleModel)->getRows();
        $LogSysModel = new \app\member\model\LogSysModel();
        $oldFun = '';
        $DividendInfo = settings('DividendInfo');
        $_roleList = array_merge([['role_name' => '粉丝', 'role_id' => 0, 'level' => 0]], $roleList);
        $UsersBindSuperiorModel = new \app\member\model\UsersBindSuperiorModel();
        $user_id = $orderInfo['user_id'];
        $goodsList = (new OrderGoodsModel)->where('order_id', $orderInfo['order_id'])->select();
        $OrderModel = new OrderModel();
        do {
            unset($stats);
            $usersInfo = $this->UsersModel->info($user_id);//获取会员信息
            $userRoleLevel = 0;
            if ($usersInfo['role_id'] > 0) {
                $userRoleLevel = $roleList[$usersInfo['role_id']]['role_id'];//获取当前会员身份等级
            }
            
            $stats['teamRoleCount'] = [];
            //汇总团队身份的会员数
            foreach ($_roleList as $role) {
                $where = [];
                $where[] = ['', 'exp', Db::raw("FIND_IN_SET('" . $user_id . "',ub.superior)")];
                $where[] = ['ub.user_id', '<>', $user_id];
                $where[] = ['u.role_id', '=', $role['role_id']];
                $stats['teamRoleCount'][$role['role_id']] = $UsersBindSuperiorModel->alias('ub')->join("users u", 'ub.user_id=u.user_id', 'left')->where($where)->count();
            }
            unset($where);
            // 直推单数
            $where = [];
            $where[] = ['u.pid','=',$user_id];
            $where[] = ['o.order_type','=',4];
            $where[] = ['o.order_status','=',1];
            $stats['subOrder'] = $this->UsersModel
                                ->alias('u')
                                ->join('shop_order_info o','o.user_id = u.user_id')
                                ->where($where)
                                ->count();
            unset($where);
            // 团队单数（包含自己）
            $where = [];
            $where[] = ['', 'exp', Db::raw("FIND_IN_SET('" . $user_id . "',ub.superior)")];
            $where[] = ['o.order_type','=',4];
            $where[] = ['o.order_status','=',1];
            $stats['teamOrder'] = $UsersBindSuperiorModel
                                    ->alias('ub')
                                    ->join('shop_order_info o','o.user_id = ub.user_id')
                                    ->where($where)
                                    ->count();
            unset($where);
            $upRole = [];
            foreach ($roleList as $role) {

                if ($role['role_id'] <= $userRoleLevel) {//当前分销身份低于等于用户现身份，跳过
                    continue;
                }
                if ($role['is_auto'] == 9) {//手动调整,跳过
                    continue;
                }
                if ($role['is_auto'] == 2) {

                    if ($usersInfo['user_id'] == $orderInfo['user_id']) {
                        $upRole = $role;
                        if ($DividendInfo['level_up_type'] == 0) {//逐级升时调用
                            break;//跳出循环进行升级操作
                        }
                    }
                    continue;
                }
                $is_up = false;
                $upLeveValue = $role['upleve_value'];
                // 直推单数
                if ($upLeveValue['push_num'] > 0) {
                    if ($stats['subOrder'] < $upLeveValue['push_num']) continue; // 条件不满足 跳出
                    $is_up = true;
                }

                // 团队单数
                if ($upLeveValue['push_num'] > 0) {
                    if ($stats['teamOrder'] < $upLeveValue['team_income']) continue; // 条件不满足 跳出
                    $is_up = true;
                }

                // 团队单数
                if (empty($upLeveValue['team_role']) == false) {
                    foreach ($upLeveValue['team_role'] as $rid => $nums) {
                        if ($stats['teamRoleCount'][$rid] < $nums) continue; // 条件不满足 跳出
                        $is_up = true;
                    }
                }

                if ($is_up == true) {
                    $upRole = $role;
                }
                if ($DividendInfo['level_up_type'] == 0) {//逐级升时调用
                    break; //跳出循环进行升级操作
                }
            }

            if (empty($upRole) == false) {
                $upData['last_up_role_time'] = time();
                $upData['role_id'] = $upRole['role_id'];
                $res = $this->UsersModel->upInfo($user_id, $upData);
                if ($res < 1) {
                    return false;
                }
                $inData['edit_id'] = $user_id;
                $inData['log_info'] = '';
                if ($user_id == $orderInfo['user_id'] && $upRole['is_auto'] == 2) {
                    $inData['log_info'] = '购买排位商品，';
                }else{
                    $inData['log_info'] = '满足条件升级';
                }
                $inData['log_info'] .= '【' . ($usersInfo['role_id'] == 0 ? '粉丝' : $roleList[$usersInfo['role_id']]['role_name']) . '】升级为【' . $upRole['role_name'] . '】';
                $inData['module'] = request()->path();
                $inData['log_ip'] = request()->ip();
                $inData['log_time'] = time();
                $inData['user_id'] = 0;
                $LogSysModel->create($inData);
            }
            $user_id = $usersInfo['pid'];//继续处理上级id
        } while ($user_id > 0);
        return true;
    }

}
