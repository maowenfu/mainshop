<?php

/**
 * @Author: Maowenfu
 * @Date:   2021-02-24 16:06:42
 * @Last Modified by:   maowenfu
 * @Last Modified time: 2021-02-26 14:32:47
 */
namespace app\shop\model;

use think\Db;
use app\BaseModel;
use app\member\model\UsersModel;
use app\distribution\model\DividendModel;
use app\member\model\AccountLogModel;
use app\weixin\model\WeiXinMsgTplModel;
use app\weixin\model\WeiXinUsersModel;
use app\mainadmin\model\PaymentModel;
// 排位表
class ShopRankModel extends BaseModel
{
 	protected $table = 'shop_rank';
    protected $pk = 'rank_id';

    /*------------------------------------------------------ */
    //-- 下单参与排位
    //-- $orderInfo 订单
    /*------------------------------------------------------ */
    public function setRankOrder($orderInfo){
    	$time = time();
        $UsersModel = new UsersModel();
        $buyUserInfo = $UsersModel->info($orderInfo['user_id']);
    	// 查找正在出局的排位
    	$topInfo = $this->lock(true)->where('status',1)->find();
    	if (empty($topInfo)) {
    		$inArr = [];
    		$inArr['user_id'] = $buyUserInfo['user_id'];
    		$inArr['order_id'] = $orderInfo['order_id'];
    		$inArr['u_pid'] = $buyUserInfo['pid'];
    		$inArr['status'] = 1;
    		$inArr['add_time'] = $time;
    		$res = $this::create($inArr);
    		if (empty($res)) {
                $this->_log(0,'排位数据添加失败',$buyUserInfo['user_id']);
    			return false;
    		}
    		return true;
    	}else{
    		$goods_id = (new OrderGoodsModel)->where('order_id',$orderInfo['order_id'])->value('goods_id');
    		$rank_award = (new GoodsModel)->where('goods_id',$goods_id)->value('rank_award');
    		$rank_award = json_decode($rank_award,true);
    		$inArr = [];
    		$inArr['user_id'] = $buyUserInfo['user_id'];
    		$inArr['order_id'] = $orderInfo['order_id'];
    		$inArr['u_pid'] = $buyUserInfo['pid'];
    		$inArr['top_id'] = $topInfo['rank_id'];
    		$inArr['pid'] = $this->lock(true)->where('rank_id','>',0)->order('rank_id DESC')->value('rank_id');
    		$inArr['add_time'] = $time;
    		$res = $this::create($inArr);
    		if (empty($res)) {
                $this->_log(0,'排位数据添加失败',$buyUserInfo['user_id']);
    			return false;
    		}
    		unset($inArr);
    		// 计算奖励
    		$award_num = $rank_award['num'];
    		// $dividend_bean = bcdiv($award_num * $rank_award['repeat_num'] , 100 , 2);
            $dividend_bean = $rank_award['repeat_num'];  // 固定金额
    		$dividend_amount = $award_num - $dividend_bean;

    		$upData = [];
    		$upData['award_num'] = ['INC',1];
    		$upData['award_total'] = ['INC',$award_num];
    		$upData['integral'] = ['INC',$dividend_bean];
    		$upData['balance_money'] = ['INC',$dividend_amount];
    		$upData['update_time'] = $time;
    		$res = $this->where('rank_id',$topInfo['rank_id'])->update($upData);
    		if ($res < 1) {
                $this->_log($topInfo['rank_id'],'出团排位信息更新失败-1');
    			return false;
    		}
    		unset($upData);

    		$userInfo = $UsersModel->info($topInfo['user_id']);
    		$res = $this->createLog($orderInfo,$userInfo,$dividend_amount,$dividend_bean,$time);
    		if (true !== $res) {
                $this->_log(0,'佣金日志插入失败',$buyUserInfo['user_id']);
    			return false;
    		}
            
    		// 出局处理
    		$info = $this->lock(true)->where('rank_id',$topInfo['rank_id'])->find();
            (new OrderModel)->where('order_id',$orderInfo['order_id'])->update(['dividend_amount'=>['INC',$award_num]]);
    		if ($info['award_num'] == 2) {
                $upData = [];
                $upData['status'] = 2;
                $upData['update_time'] = $upData['out_time'] = $time;
                $res = $this->where('rank_id',$info['rank_id'])->update($upData);
                if ($res < 1) {
                    $this->_log($info['rank_id'],'状态修改失败');
                    return false;
                }
                $res = $this->where('pid',$info['rank_id'])->update(['update_time'=>$time,'status'=>1]);
    			if ($res < 1) {
                    $this->_log($info['rank_id'],'状态修改失败 -1');
                    return false;
                }

                $UsersModel->where('user_id',$info['user_id'])->update(['out_num'=>['INC',1]]);
                $res = $this->repeatInvestment($info);
                if (true != $res) {
                    return false;
                }
    		}
    		return true;
    	}
        return true;
    }
    /**
     * [repeatInvestment 复投]
     * @param  array  $info [description]
     * @return boolean      [处理结果]
     */
    public function repeatInvestment($info = [])
    {
        $OrderModel = new OrderModel();
        $UserAddressModel = new \app\member\model\UserAddressModel();
        // 前一条订单
        $preInfo =  $OrderModel->where('order_id',$info['order_id'])->find();
        if (empty($preInfo)) {
            $this->_log($info['rank_id'],'原订单不存在');
            return false;
        }
        // 用户信息
        $UsersModel = new UsersModel();
        $userInfo = $UsersModel->info($preInfo['user_id']);
        // 收货地址
        $address_id = $preInfo['address_id'];
        if ($address_id < 0) {
            $this->_log($info['rank_id'],'收货地址不存在');
            return false;
        };
        $addressList = $UserAddressModel->getRows($userInfo['user_id']);

        if (empty($addressList)) {
            $this->_log($info['rank_id'],'收货地址不存在');
            return false;
        }
        $address = $addressList[$address_id];
        if (empty($address)) {
            $address = $addressList[0];
        };

        $cartList['buyGoodsNum'] = 1;
        $GoodsModel = new GoodsModel();
        // 自动复投商品
        $gwhere = [];
        $gwhere[] = ['is_delete','=',0];
        $gwhere[] = ['is_alone_sale','=',1];
        $gwhere[] = ['isputaway','=',1];
        $gwhere[] = ['goods_type','=',2];
        $gwhere[] = ['is_repeat','=',1];
        $goods = $GoodsModel->where($gwhere)->find();
        if (empty($goods)) {
            $this->_log($info['rank_id'],'未设置复投商品');
            return false;
        }
        unset($gwhere);
        $goods['goods_number'] = 1;
        $goods['sale_price'] = $goods['shop_price'];
        $goods['prom_type'] = 0;
        $goods['prom_id'] = 0;
        $goods['sku_id'] = 0;
        $goods['sku_val'] = '';
        $goods['sku_name'] = '';
        $goods['is_use_bonus'] = 0;
        $goods['user_id'] = $userInfo['user_id'];
        $cartList['goodsList'][0] = $goods;

        $inArr['give_integral'] = 0;
        $inArr['settle_price'] =  0;
        $inArr['settle_goods_price'] =  0;
        $use_integral = 0;
        $rec_ids = [];
        $allGoodsSn = [];
        $allGoodsId = [];
        $allFavourId = [];
        $cartList['use_bonus_goods_amount'] = 0;//使用了优惠券的商品总额
        $cartList['orderTotal'] = 0;
        $cartList['totalGoodsPrice'] = 0;
        foreach ($cartList['goodsList'] as $key => $grow) {
            $promInfo = [];
            $price = $GoodsModel->evalPrice($grow, $grow['goods_number'], $grow['sku_val'], $grow['prom_type'], $promInfo);//计算需显示的商品价格
            $allGoodsSn[$grow['goods_sn']] = 1;
            $allGoodsId[$grow['goods_id']] = 1;
            $cartList['orderTotal'] += $grow['goods_number'] * $grow['sale_price'];
            $cartList['totalGoodsPrice'] += $grow['goods_number'] * $grow['sale_price'];
        }

        $time = time();
        $inArr['order_status'] = 0;
        $inArr['pay_status'] = 0;
        $inArr['shipping_status'] = 0;
        $_log = '强制复投，生成订单';

        //运费处理
        $shippingFee = $this->_evalShippingFee($address, $cartList);
        $inArr['shipping_fee'] = $shippingFee['shipping_fee'] * 1;
        $inArr['shipping_fee_detail'] = json_encode($shippingFee['supplyerShippingFee']);
        $inArr['settle_price'] = $inArr['settle_goods_price'] + $inArr['shipping_fee'];
        $inArr['order_amount'] = 0;
        $inArr['use_integral'] = $cartList['orderTotal'] + $inArr['shipping_fee'];

        $payment['pay_code'] = 'integral';
        $payment['is_pay'] = 1;
        $payment['pay_name'] = '积分';
        if ($inArr['use_integral'] > $userInfo['account']['use_integral']) {
            $this->_log($info['rank_id'],'积分不足复投失败，你的积分为：'.$userInfo['account']['use_integral']);
            return false;
        }
        $inArr['buyer_message'] = '系统强制复投';
        $inArr['consignee'] = $address['consignee'];
        $inArr['address'] = $address['address'];
        $inArr['merger_name'] = $address['merger_name'];
        $inArr['province'] = $address['province'];
        $inArr['city'] = $address['city'];
        $inArr['district'] = $address['district'];
        $inArr['mobile'] = $address['mobile'];
        $inArr['address_id'] = $address['address_id'];

        $inArr['add_time'] = $time;
        $inArr['user_id'] = $userInfo['user_id'];
        $inArr['dividend_role_id'] = $userInfo['role_id'];
        
        $inArr['order_type'] = 4;
        $inArr['pay_id'] = $payment['pay_id'];
        $inArr['pay_code'] = $payment['pay_code'];
        $inArr['pay_name'] = $payment['pay_name'];

        $inArr['buy_goods_sn'] = join(',', array_keys($allGoodsSn));
        $inArr['buy_goods_id'] = join(',', array_keys($allGoodsId));

        $inArr['ipadderss'] = request()->ip();
        $inArr['is_pay'] = $payment['is_pay'];//是否需要支付,1线上支付，0，不需要支付，
        $inArr['is_success'] = 1;//普通订单默认有效，如果拼团默认为0，须拼团成功才会为1
        //执行商品库存和销量处理，后台设置下单减库存或余额支付时执行
        $shop_reduce_stock = settings('shop_reduce_stock');
        $inArr['is_stock'] = $shop_reduce_stock == 0 ? 1 : 0;
        
        $inArr['order_sn'] = $OrderModel->getOrderSn();
        $res = $OrderModel->save($inArr);
        if ($res < 1) {
            $this->_log($info['rank_id'],'未知原因，订单写入失败');
            return false;
        }

        $order_id = $OrderModel->order_id;

        $inArr['order_id'] = $order_id;
        $res = $OrderModel->_log($inArr,$_log);
        if ($res < 1) {
            $this->_log($info['rank_id'],'未知原因，订单日志写入失败');
            return false;
        }
        //使用积分，下单即扣除
        if ($inArr['use_integral'] > 0){
            $changedata['use_integral'] = $use_integral * -1;
            $changedata['change_desc'] = '购物抵扣积分';
            $changedata['change_type'] = 3;
            $changedata['by_id'] = $order_id;
            $res = (new AccountLogModel)->change($changedata, $userInfo['user_id'], false);
            if ($res !== true) {
                $this->_log($info['rank_id'],'扣减积分失败失败');
                return false;
            }
        }

        //执行扣库存
        if ($inArr['is_stock'] == 1) {
            $res = $GoodsModel->evalGoodsStore($cartList['goodsList']);
            if ($res != true) {
                $this->_log($info['rank_id'],'扣库存失败');
                return false;
            }
        }
        $this->addOrderGoods($order_id, $cartList);//写入商品

        $orderInfo = $OrderModel->find($order_id);
        // 提成处理
        $res = $this->runDistribution($orderInfo);
        if (true !== $res) {
            $this->_log($info['rank_id'],'佣金处理失败.');
                return false;
        }

        $res = $OrderModel->updatePay(['order_id'=>$order_id]);
        if (true !== $res) {
            $this->_log($info['rank_id'],'订单支付失败.');
            return false;
        }
        return true;
    }

    /*------------------------------------------------------ */
    //-- 提成处理&升级处理
    //-- $orderInfo array
    /*------------------------------------------------------ */
    public function runDistribution(&$orderInfo)
    {
        $OrderModel = new OrderModel();
        $upData = $OrderModel->distribution($orderInfo, 'add');
        if (is_array($upData) == false) {//扣库存失败，终止
            return false;
        }
        $upData['is_dividend'] = 1;
        $res = $OrderModel->where('order_id',$orderInfo['order_id'])->update($upData);
        if ($res < 1){
            return false;
        }
        return true;
    }

     /*------------------------------------------------------ */
    //-- 写入订单商品
    //--- 这里可能有bug,如果用户同时执行多次，商品有可能发生错误
    /*------------------------------------------------------ */
    public function addOrderGoods($order_id, $cartList)
    {
        $orderGoods = [];
        $add_time = time();
        foreach ($cartList['goodsList'] as $key => $og) {
            $goods = array(
                'order_id' => $order_id,
                'brand_id' => $og['brand_id'],
                'cid' => $og['cid'],
                'supplyer_id' => $og['supplyer_id'],
                'prom_type' => 0,
                'prom_id' => 0,
                'goods_id' => $og['goods_id'],
                'goods_name'=>$og['goods_name'],
                'sku_id' => 0,
                'sku_val' => '',
                'sku_name' => '',
                'pic' => $og['goods_thumb'],
                'goods_sn' => $og['goods_sn'],
                'goods_number' => $og['goods_number'],
                'market_price' => $og['market_price'],
                'shop_price' => $og['shop_price'],
                'sale_price' => $og['sale_price'],
                'settle_price' => $og['settle_price'],
                'goods_weight' => $og['goods_weight'],
                'discount' => 0,
                'add_time'=>$add_time,
                'user_id' => $og['user_id'],
                'give_integral' => 0,
                'use_integral' => $og['use_integral'],
                'is_dividend' => $og['is_dividend'],
                'buy_brokerage_type' => 0,
                'buy_brokerage_amount' => 0
            );
            $orderGoods[] = $goods;
        }
        $res = (new OrderGoodsModel)->insertAll($orderGoods);
        if ($res < 1) {
            Db::rollback();// 回滚事务
            return $this->error('未知原因，订单商品写入失败.');
        }
        (new OrderModel)->cleanMemcache();
        return $res;
    }


    /**
     * @param $address 收货地址信息
     * @param $cartList 订购商品
     * @return mixed
     */
    private function _evalShippingFee($address,$cartList){
        $shipping_fee_type = settings('shipping_fee_type');
        $CartModel = new CartModel();
        if ($shipping_fee_type == 1){//供应商商品独立计算
            foreach ($cartList['supplyerGoods'] as $supplyer_id=>$sg){
                $_cartList = [];
                $_cartList['buyGoodsNum'] = 0;
                $_cartList['totalGoodsPrice'] = 0;
                $_cartList['buyGoodsWeight'] = 0;
                $_cartList['goodsList'] = [];
                foreach ($cartList['goodsList'] as $cg){
                    if ($cg['supplyer_id'] == $supplyer_id){
                        $_cartList['buyGoodsNum'] += $cg['goods_number'];
                        $_cartList['totalGoodsPrice'] += $cg['sale_price'] * $cg['goods_number'];
                        $_cartList['buyGoodsWeight']  += $cg['goods_weight'] * $cg['goods_number'];
                        $_cartList['goodsList'][] = $cg;
                    }
                }
                $_shippingFee = $CartModel->evalShippingFee($address,$_cartList);
                $_shippingFee = reset($_shippingFee);//现在只返回默认快递
                if (empty($shippingFee)){
                    $shippingFee = $_shippingFee;
                }else{
                    $shippingFee['shipping_fee'] += $_shippingFee['shipping_fee'];
                }
                $shippingFee['supplyerShippingFee'][$supplyer_id] = sprintf("%.2f", $_shippingFee['shipping_fee'] * 1);
            }
            $shippingFee['shipping_fee'] = sprintf("%.2f", $shippingFee['shipping_fee'] * 1);
        }else{
            $shippingFee = $CartModel->evalShippingFee($address,$cartList);
            $shippingFee = reset($shippingFee);//现在只返回默认快递
            $shippingFee['shipping_fee'] = sprintf("%.2f", $shippingFee['shipping_fee'] * 1);
        }
        return $shippingFee;
    }
    // 失败日志
    public function _log($rank_id,$info,$user_id = 0)
    {
        $inArr = [];
        $inArr['log_info'] = $info;
        $inArr['rank_id'] = $rank_id;
        $inArr['user_id'] = $user_id;
        $inArr['add_time'] = time();
        (new RankErrorModel)::create($inArr);
    }

    /**
     * [createLog 佣金记录]
     * @param  array   $orderInfo       [订单信息]
     * @param  array   $userInfo        [用户信息]
     * @param  float   $dividend_amount [分佣金额]
     * @param  float   $dividend_bean   [复投积分]
     * @param  integer $time            [生成时间]
     * @return boolean                  [处理结果]
     */
    public function createLog($orderInfo = [] , $userInfo  = [] , $dividend_amount = 0.00 , $dividend_bean = 0.00 ,$time = 0)
    {
        $inArr = [];
        $inArr['dividend_amount'] = $dividend_amount;//计算总佣金
        $inArr['dividend_bean'] = $dividend_bean;//计算总佣金
        $inArr['order_type'] = 'rank_order';
        $inArr['status'] = 9;
        $inArr['order_id'] = $orderInfo['order_id'];
        $inArr['order_sn'] = $orderInfo['order_sn'];
        $inArr['buy_uid'] = $orderInfo['user_id'];
        $inArr['order_amount'] = $orderInfo['order_amount'];
        $inArr['dividend_uid'] = $userInfo['user_id'];
        $inArr['role_id'] = $userInfo['role_id'];
        $inArr['role_name'] = $userInfo['role']['role_name'];
        $inArr['level'] = 0;
        $inArr['award_id'] = 0;
        $inArr['award_name'] = '排位奖励';
        $inArr['level_award_name'] = '获得'.($dividend_amount + $dividend_bean).'元排位奖励';
        $inArr['add_time'] = $inArr['update_time'] = $time;
        $res = (new DividendModel)::create($inArr);
        if ($res->log_id < 1) return false;
        $changedata['by_id'] = $orderInfo['order_id'];
        $changedata['balance_money'] = $dividend_amount;
        $changedata['use_integral'] = $dividend_bean;
        $changedata['change_desc'] = '排位奖励到账';
        $changedata['total_dividend'] = ($dividend_amount + $dividend_bean);
        $changedata['change_type'] = 4;
        $res = (new AccountLogModel)->change($changedata, $userInfo['user_id'], false);
        if ($res !== true) {
            return false;
        }

        return true;
    }
}