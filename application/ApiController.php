<?php
namespace app;
use app\BaseController;
use think\facade\Cache;
use think\facade\Session;

error_reporting(E_ERROR | E_PARSE );


/**
 * API控制器基类
 * Class BaseController
 * @package app\store\controller
 */
class ApiController extends BaseController
{

    /**
     * 后台初始化
     */
    public function initialize()
    {
        global $userInfo;
        $this->checkRequestNum();//验证请求次数
		$this->returnJson = true;//统一返回json
        $userInfo = $this->getLoginUserInfo();//获取登陆会员数据
        $this->userInfo = $userInfo;
		parent::initialize();
    }

    /*------------------------------------------------------ */
    //-- 验证请求次数
    /*------------------------------------------------------ */
    private function checkRequestNum(){
        //记录请求数量，如果10秒，请求超过30次，限制1分钟不允许请求
        $appsessionid = request()->header('appsessionid');
        if (empty($appsessionid)){
            $ajaxDataLog = Session::get('ajaxDataLog');
        }else{
            $ajaxDataLog = Cache::get('ajaxDataLog_'.$appsessionid);
        }
        $time = time();
        if (empty($ajaxDataLog)==false) {
            if ($ajaxDataLog['limit'] == 1 && $ajaxDataLog['time'] > $time - 60){
                return $this->error('请求太频繁，请休息一下再操作.');
            }
            if ($ajaxDataLog['time'] > $time - 10){
                $ajaxDataLog['num']++;
                if ($ajaxDataLog['num'] >= 100){
                    $ajaxDataLog['limit'] = 1;
                }
            }else{
                $ajaxDataLog['limit'] = 0;
                $ajaxDataLog['num'] = 0;
                $ajaxDataLog['time'] = $time;
            }
        }else{
            $ajaxDataLog = ['time'=>$time,'num'=>1,'limit'=>0];
        }
        if (empty($appsessionid)){
            Session::set('ajaxDataLog',$ajaxDataLog);
        }else{
            Cache::set('ajaxDataLog_'.$appsessionid,$ajaxDataLog,1800);
        }
    }
    /*------------------------------------------------------ */
    //-- 验证登录状态
    /*------------------------------------------------------ */
    public function checkLogin(){
        if (empty($this->userInfo) || $this->userInfo['user_id'] < 1){
            $uiType = request()->header('uiType');
            if ($uiType == 'uniapp'){
                return $this->error(['请登陆后再操作.',-400001]);
            }
            return $this->error('请登陆后再操作.');
        }
        if($this->userInfo['is_ban']==1){
            session('userId', null);
            return $this->error('账号已被禁用.');
        }
        return true;
    }
    /*------------------------------------------------------ */
    //-- 验证短信验证码
    /*------------------------------------------------------ */
    public function checkCode($type,$mobile,$code){
        if(strstr($type,'channel_sms')) {
            $sms_type_status = settings($type);
        }else{
            $sms_fun = settings('sms_fun');
            $sms_type_status = $sms_fun[$type];
        }
        if ($sms_type_status == 0) {//未开启，即成为验证成功
            if ($type =='forget_password' || $type =='edit_pay_pwd'){
                return false;//找回密码，必须开启
            }
            return true;
        }
        $codeErrorNum = Cache::get('code_error'.$type.$mobile);
        if ($codeErrorNum >= 5){
            Cache::rm('code_'.$type.$mobile);//错误次数达到清除验证码
        }
        $codeCache = Cache::get('code_'.$type.$mobile);

        if (empty($codeCache)){
            return '验证码已失效.';
        }
        if (empty($code) ||  $code != $codeCache['code']){
            if (empty($codeErrorNum)){
                $codeErrorNum = 0;
            }
            $codeErrorNum++;
            Cache::set('code_error'.$type.$mobile,$codeErrorNum,1800);
            return '验证码错误.';
        }
        Cache::rm('code_error'.$type.$mobile);//验证成功清理错误次数
        return true;
    }
    /*------------------------------------------------------ */
    //-- 验证各类请求次数
    /*------------------------------------------------------ */
    public function checkPostLimit($type){
        $appsessionid = request()->header('appsessionid');
        if (empty($appsessionid)){
            $postLimit = session('checkPostLimit_'.$type);
        }else{
            $postLimit = Cache::get('checkPostLimit_'.$type.$appsessionid);
        }
        $time = time();
        if (empty($postLimit)==false) {
            if ($postLimit['limit'] == 1 && $postLimit['time'] > $time - 1800) {//封停30分钟
                return $this->error('请求次数过多，请休息一下.');
            }
            if ($postLimit['time'] > $time - 60){
                $postLimit['num']++;
                if ($postLimit['num'] >= 10){
                    $postLimit['limit'] = 1;
					$postLimit['time'] = $time;
                }
            }else{
                $postLimit['limit'] = 0;
                $postLimit['num'] = 0;
                $postLimit['time'] = $time;
            }

        }else{
            $postLimit = ['time'=>$time,'num'=>1,'limit'=>0];
        }
        if (empty($appsessionid)){
            session('checkPostLimit_'.$type,$postLimit);
        }else{
            Cache::set('checkPostLimit_'.$type.$appsessionid,$postLimit,1800);
        }
        return true;
    }
}
