<?php

/**
 * @Author: Maowenfu
 * @Date:   2021-02-24 16:06:42
 * @Last Modified by:   maowenfu
 * @Last Modified time: 2021-02-24 18:06:38
 */
namespace app\shop\model;

use think\Db;
use app\BaseModel;
use app\member\model\UsersModel;
use app\shop\model\GoodsModel;
use app\shop\model\CartModel;
use app\distribution\model\DividendModel;
use app\shop\model\OrderModel;
use app\shop\model\OrderGoodsModel;
use app\member\model\AccountLogModel;
use app\weixin\model\WeiXinMsgTplModel;
use app\weixin\model\WeiXinUsersModel;
// 排位表
class ShopRankModel extends BaseModel
{
 	protected $table = 'shop_rank';

    /*------------------------------------------------------ */
    //-- 下单参与排位
    //-- $orderInfo 订单
    /*------------------------------------------------------ */
    public function setRankOrder($orderInfo){
    	$time = time();
    	// 查找正在出局的排位
    	$topInfo = $this->lock(true)->where('status',1)->find();
    	if (empty($topInfo)) {
    		$inArr = [];
    		$inArr['user_id'] = $this->userInfo['user_id'];
    		$inArr['order_id'] = $orderInfo['order_id'];
    		$inArr['u_pid'] = $this->userInfo['pid'];
    		$inArr['status'] = 1;
    		$inArr['add_time'] = $time;
    		$res = $this::create($inArr);
    		if (empty($res)) {
    			return false;
    		}
    		return true;
    	}else{
    		$goods_id = (new OrderGoodsModel)->where('order_id',$orderInfo['order_id'])->value('goods_id');
    		$rank_award = (new GoodsModel)->where('goods_id',$goods_id)->value('rank_award');
    		$rank_award = json_decode($rank_award,true);
    		$inArr = [];
    		$inArr['user_id'] = $this->userInfo['user_id'];
    		$inArr['order_id'] = $orderInfo['order_id'];
    		$inArr['u_pid'] = $this->userInfo['pid'];
    		$inArr['top_id'] = $topInfo['rank_id'];
    		$inArr['pid'] = $this->lock(true)->where('rank_id','>',0)->order('rank_id DESC')->value('rank_id');
    		$inArr['add_time'] = $time;
    		$res = $this::create($inArr);
    		if (empty($res)) {
    			return false;
    		}
    		unset($inArr);
    		// 计算奖励
    		$award_num = $rank_award['num'];
    		$dividend_bean = bcdiv($award_num * $rank_award['repeat_num'] , 100 , 2);
    		$dividend_amount = $award_num - $dividend_bean;

    		$upData = [];
    		$upData['award_num'] = ['INC',1];
    		$upData['award_total'] = ['INC',$award_num];
    		$upData['integral'] = ['INC',$dividend_bean];
    		$upData['balance_money'] = ['INC',$dividend_amount];
    		$upData['update_time'] = $time;
    		$res = $this->where('rank_id',$topInfo['rank_id'])->update($upData);
    		if ($res < 1) {
    			return false;
    		}
    		unset($upData);

    		$userInfo = (new UsersModel)->info($topInfo['user_id']);
    		$res = $this->createLog($orderInfo,$userInfo,$dividend_amount,$dividend_bean,$time);
    		if (true !== $res) {
    			return false;
    		}
    		// 出局处理
    		$info = $this->lock(true)->where('rank_id',$topInfo['rank_id'])->find();
    		if ($info['award_num'] == 2) {
    			# code...
    		}
    		return true;
    	}
    }

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
        $changedata['total_dividend'] = ($row['dividend_amount'] + $row['dividend_bean']);
        $res = (new AccountLogModel)->change($changedata, $userInfo['user_id'], false);
        if ($res !== true) {
            return false;
        }

        return true;
    }
}