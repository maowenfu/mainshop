<?php

namespace app\member\controller\api;

use app\ApiController;
use think\Db;

use app\member\model\AccountLogModel;
use app\member\model\AccountModel;
use app\member\model\RechargeLogModel;
use app\mainadmin\model\PaymentModel;
use app\distribution\model\DividendModel;
use app\member\model\TransferLogModel;
/*------------------------------------------------------ */
//-- 会员钱包相关
/*------------------------------------------------------ */

class Wallet extends ApiController
{
    /*------------------------------------------------------ */
    //-- 优先执行
    /*------------------------------------------------------ */
    public function initialize()
    {
        parent::initialize();
		$this->checkLogin();//验证登陆
       
    }
   
    /*------------------------------------------------------ */
    //-- 会员充值
    /*------------------------------------------------------ */
    public function recharge()
    {
    	$inArr['pay_code'] = input('pay_code','','trim');
		$inArr['order_amount'] = input('order_amount') * 1;
		if ($inArr['order_amount'] < 1){
			return $this->error('充值金额不能少于1');
		}
        if(empty($inArr['pay_code'])){
            return $this->error('请选择支付方式.');
        }
        $payList = (new PaymentModel)->getRows(true,'pay_code');
		if (empty($payList[$inArr['pay_code']])){
            return $this->error('支付方式不存在.');
        }
		if ($inArr['pay_code'] == 'offline'){
			//处理图片
			$imgfile = input('imgfile');
			if (empty($imgfile)){
				return $this->error('线下打款，须上传打款凭证图片.');
			}
   //          print_r($imgfile);die;
			// $imgs = array();
			// $file_path = config('config._upload_').'recharge/'.date('Ymd').'/';
			// makeDir($file_path);
			// foreach ($imgfile as $file){
			//     $extend = trim(substr($file,11,4),';');
   //              $file_name = $file_path.random_str(12).'.'.$extend;
			//     if ($extend == 'jpeg'){
   //                  $file_name = $file_path.random_str(12).'.jpg';
   //              }
			// 	file_put_contents($file_name,base64_decode(str_replace('data:image/'.$extend.';base64,','',$file)));

			// 	$imgs[] = trim($file_name,'.');								
			// }
			$inArr['imgs'] = join(',',$imgfile);
		}
        $payment = $payList[$inArr['pay_code']];
        $inArr['order_sn'] = 'recharge'.time().rand(10,99);
		$inArr['pay_id'] = $payment['pay_id'];
        $inArr['pay_name'] = $payment['pay_name'];
		$inArr['user_id'] = $this->userInfo['user_id'];
		$inArr['add_time'] = time();
		$RechargeLogModel = new RechargeLogModel();
		$res = $RechargeLogModel->save($inArr);
		if ($res < 1){
			foreach ($imgs as $img){
				@unlink('.'.$img);
			}
			return $this->error('写入数据失败.');	
		}

        return $this->success('提交成功.','',['order_id'=>$RechargeLogModel->order_id]);
    }
    /*------------------------------------------------------ */
    //-- 旅游豆转换
    /*------------------------------------------------------ */
    public function postChange()
    {
        $inArr['amount'] = input('amount') * 1;
        if ($inArr['amount'] <= 0){
            return $this->error('请输入兑换数量.');
        }
        if ($this->userInfo['account']['bean_value'] < $inArr['amount']){
            return $this->error('旅游豆不足，请核实旅游豆兑换数量.');
        }
        Db::startTrans();//启动事务
        $AccountLogModel = new AccountLogModel();
        $changedata['change_desc'] = '旅游豆兑换';
        $changedata['change_type'] = 8;
        $changedata['by_id'] = 0;
        $changedata['balance_money'] = $inArr['amount'];
        $changedata['bean_value'] = $inArr['amount'] * -1;
        $res = $AccountLogModel->change($changedata, $this->userInfo['user_id'], false);
        if ($res !== true) {
            Db::rollback();// 回滚事务
            return $this->error('未知错误，兑换失败.');
        }
        $where = [];
        $where[] = ['dividend_uid','=',$this->userInfo['user_id']];
        $where[] = ['status','=',9];
        $where[] = ['is_hide','=',0];
        $where[] = ['dividend_bean','>',0];
        $res = (new DividendModel)->where($where)->update(['is_hide'=>1]);

        Db::commit();// 提交事务
        return $this->success('兑换成功.');
    }
    /**
     * [transfer 转账]
     * @return [type] [description]
     */
	public function transfer()
    {
        $user_id = input('uid', 0, 'intval');
        if ($user_id <= 0) {
            return $this->error('参数有误.');
        }

        $settings = settings();
        $transfer_status = $settings['transfer_status'];
        if ($transfer_status != 1) {
            return $this->error('转账暂未开启.');
        }

        $min_transfer = $settings['min_transfer'];
        $amount = input('amount', 0, 'intval');
        if ($min_transfer > 0 && $amount < $min_transfer) {
            return $this->error('最低转账金额'.$min_transfer);
        }

        $UsersModel = new \app\member\model\UsersModel();

        $user = $UsersModel->where('user_id',$user_id)->field('user_id,nick_name')->find();
        if (empty($user)) {
            return $this->error('用户不存在，请确认输入ID.');
        }
        if ($user_id == $this->userInfo['user_id']) {
            return $this->error('不能给自己转账.');
        }
        if ($settings['transfer_limit'] == 1) {

            $UsersBindSuperiorModel = new \app\member\model\UsersBindSuperiorModel();
            $where = [];
            $where[] = ['','exp',Db::raw("FIND_IN_SET('".$user_id."',superior)")];
            $where[] = ['user_id','=',$this->userInfo['user_id']];
            $prve = $UsersBindSuperiorModel->where($where)->find();
            // print_r($prve);
            unset($where);
            $where = [];
            $where[] = ['','exp',Db::raw("FIND_IN_SET('".$this->userInfo['user_id']."',superior)")];
            $where[] = ['user_id','=',$user_id];
            $next = $UsersBindSuperiorModel->where($where)->find();
            // var_dump($this->userInfo['user_id']);
            unset($where);
            if (empty($prve) && empty($next)) {
                return $this->error('只能转账给关系链上其他用户.');
            }           
        }

        $this->userInfo['pay_password'] = $UsersModel->where('user_id',$this->userInfo['user_id'])->value('pay_password');

        if (empty($this->userInfo['pay_password'])){
           return $this->error('还没有设置支付密码，请先设置.',url('/member/center/editpaypwd'));
        }
        $pay_password = input('pay_password');
        $pay_password = f_hash($pay_password);
        if ($pay_password != $this->userInfo['pay_password']){
            return $this->error('支付密码错误，请核实.');
        }

        $balance_money = (new AccountModel)->lock(true)->where('user_id',$this->userInfo['user_id'])->value('balance_money');
        if ($amount > $balance_money){
            return $this->error('转账积分不能大于现有金额.');
        }

        $inArr['form_user'] = $this->userInfo['user_id'];
        $inArr['to_user'] = $user['user_id'];
        $inArr['add_time'] = time();
        $inArr['money'] = $amount;
        
        $changedata1['change_desc'] = '余额转出到 ' . $user['nick_name'];
        $changedata1['change_type'] = 8;
        $changedata1['by_id'] = 0;
        $changedata1['balance_money'] = $amount * -1;


        
        $AccountLogModel = new AccountLogModel();
        $TransferLogModel = new TransferLogModel();
        Db::startTrans();//启动事务

        $res = $TransferLogModel->save($inArr);
        if ($res < 1) {
            Db::rollback();// 回滚事务
            return $this->error('转账失败，扣减失败.');
        }
        $res = $AccountLogModel->change($changedata1, $this->userInfo['user_id'], false);
        if ($res !== true) {
            Db::rollback();// 回滚事务
            return $this->error('转账失败，扣减失败.');
        }

        $changedata2['change_desc'] = '收到来自【'.$this->userInfo['nick_name'].'】转账：'.$amount;
        $changedata2['change_type'] = 8;
        $changedata2['by_id'] = 0;
        $changedata2['balance_money'] = $amount;
        $res = $AccountLogModel->change($changedata2, $user['user_id'], false);
        if ($res !== true) {
            Db::rollback();// 回滚事务
            return $this->error('转账失败，收账失败.');
        }
        Db::commit();// 提交事务
        // 发送模板消息
        // $WeiXinMsgTplModel = new \app\weixin\model\WeiXinMsgTplModel();
        // $WeiXinUsersModel = new \app\weixin\model\WeiXinUsersModel();
        // $msg2['send_scene'] = $msg1['send_scene'] = 'transfer_msg';//转账通知
        // $msg2['up_time'] = $msg1['up_time'] = date('Y-m-d H:i:s',time());
        // $msg1['type'] = '转出';
        // $msg2['amount'] = $msg1['amount'] = $amount;
        // $msg1['change_desc'] = $changedata1['change_desc'];
        // $msg1['user_id'] = $this->userInfo['user_id'];
        // $msg1['nick_name'] = $this->userInfo['nick_name'];

        // $wxInfo1 = $WeiXinUsersModel->where('user_id', $this->userInfo['user_id'])->field('wx_openid,wx_nickname')->find();
        // if (empty($wxInfo1) == false) {
        //     $msg1['openid'] = $wxInfo1['wx_openid'];
        //     $msg1['send_nick_name'] = $wxInfo1['wx_nickname'];
        //     $WeiXinMsgTplModel->send($msg1);//模板消息通知
        // }


        // $msg2['type'] = '转入';
        // $msg2['change_desc'] = $changedata2['change_desc'];
        // $msg2['user_id'] = $uid;
        // $msg2['nick_name'] = userInfo($uid);
        // $wxInfo2 = $WeiXinUsersModel->where('user_id', $uid)->field('wx_openid,wx_nickname')->find();

        // if (empty($wxInfo2) == false) {
        //     $msg2['openid'] = $wxInfo2['wx_openid'];
        //     $msg2['send_nick_name'] = $wxInfo2['wx_nickname'];
        //     $WeiXinMsgTplModel->send($msg2);//模板消息通知
        // }

        return $this->success('转账成功.');
    }
}
