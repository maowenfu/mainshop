<?php
namespace app\publics\controller\api;
use app\ApiController;
use app\shop\model\SlideModel;
use app\shop\model\GoodsModel;
use app\shop\model\NavMenuModel;
/*------------------------------------------------------ */
//-- 公共调用
/*------------------------------------------------------ */
class Index extends ApiController
{
    /*------------------------------------------------------ */
    //-- 获取默认设置
    /*------------------------------------------------------ */
    public function defaultSetting(){
        $rows = (new \app\mainadmin\model\SettingsModel)->where('is_open',1)->select();
        foreach ($rows as $row){
            $data[$row['name']] = isJson($row['data']);
        }
        $return['session_id'] = session_id();
        $return['code'] = 1;
        $return['data'] = $data;
        return $this->ajaxReturn($return);
    }
	/*------------------------------------------------------ */
    //-- 获取全站设置
    /*------------------------------------------------------ */
    public function setting(){
        $key_str = input('key_str', '');
        $data['code'] = 1;
        $data['data'] = settings($key_str);
        return $this->ajaxReturn($data);
    }
    /*------------------------------------------------------ */
    //-- 获取全站设置
    /*------------------------------------------------------ */
    public function getGorupSet(){
        $key_str = input('key_str', '');
        $data['siteName'] = settings('shop_title');
        $data['siteLogo'] = settings('logo');
        if ($key_str == 'login'){
            $data['register_status'] = settings('register_status');
            $data['register_invite_code'] = settings('register_invite_code');
        }
        return $this->ajaxReturn($data);
    }
    /*------------------------------------------------------ */
    //-- 验证码
    /*------------------------------------------------------ */
    public function verify(){
        $session_id = input('session_id','','trim');
        $config =    [
            'fontSize' => 30,// 验证码字体大小
            'length'   => 4,// 验证码位数
            'useNoise' => false,// 关闭验证码杂点
            'codeSet' => '0123456789'
        ];
        $Captcha = new \lib\Captcha($config);
        return $Captcha->entry($session_id);
    }
    /*------------------------------------------------------ */
    //-- 生成自定义随机字符串
    /*------------------------------------------------------ */
    public function getRandstr(){
        $length = input('length',10,'intval');
        $result['str'] = random_str($length);
        $result['code'] = 1;
        return $this->ajaxReturn($result);
    }

    /*------------------------------------------------------ */
    //-- 上传图片
    /*------------------------------------------------------ */
   	public function uploaderimages(){
		if ($_FILES['file']){
			$result = $this->_upload($_FILES['file'],'image/');
			if ($result['error']) {
				$this->error($result['info']);
			}
			$savepath = trim($result['info'][0]['savepath'],'.');
			$file_url = $savepath.$result['info'][0]['savename'];
			$data['code'] = 1;
			$data['msg'] = "上传成功";
			$data['savename'] = $result['info'][0]['savename'];
			$data['src'] = $file_url;
			$data['src_thumb'] = $result['info'][0]['savename'];
			return $this->ajaxReturn($data);
		}
	}

    /*------------------------------------------------------ */
    //-- 获取银行
    /*------------------------------------------------------ */
    public function get_bank(){
        $config = config('config.');
        $result['bank'] = $config['bank'];
        $result['other_bank'] = $config['other_bank'];
        $all_bank = array_merge($config['bank'],$config['other_bank']);
        $temp_key = array_column($all_bank,'code');  //键值
        $arr = array_combine($temp_key,$all_bank) ;
        $result['code_bank'] = $arr;
        $result['code'] = 1;
        return $this->ajaxReturn($result);
    }
    /*------------------------------------------------------ */
    //-- 自定义商城
    /*------------------------------------------------------ */
    public function  get_index_data(){
        $result['is_diy'] = settings('xcx_index_tpl');
        if ($result['is_diy'] == 1){//自定义修装
            $ShopPageTheme = new \app\shop\model\ShopPageTheme();
            $result['diypage'] = $ShopPageTheme->getToWxApp();
        }else{
            $GoodsModel = new GoodsModel();
            $result = [];
            $result['slideList'] = SlideModel::getRows();//获取幻灯片
            $result['navMenuList'] = NavMenuModel::getRows();//获取导航菜单
            foreach ($result['navMenuList'] as $k => &$v) {
                $v['xcxurl'] = miniPathReplace($v['url']);
            }
            $result['classGoods'] = $GoodsModel->getIndexClass();//获取商品橱窗商品
            $result['promoteList'] = $GoodsModel->getIndexPromoteList();//促销商品
            $result['bestGoods'] = $GoodsModel->getIndexBestGoods();//猜你喜欢
        }
        $result['code'] = 1;
        return $this->ajaxReturn($result);
    }
    /*------------------------------------------------------ */
    //-- 公共上传临时图片
    /*------------------------------------------------------ */
    public function upImage(){

        $file = $_FILES['file']['name'];
        $is_file = true;       //true:file对象  false:base64
        if(!$file){
            $file = input('file','','trim');
            $is_file = false;
        }
        $type = input('type','','trim');
        $extend = getFileExtend($file);
        if (in_array($extend[1],['jpg','png']) == false){
            return $this->error('只允许上传jpg、png格式图片.'.$extend[1]);
        }
        $file_path =  config('config._upload_').'snap_file/'.date('m').'/';
        if(!file_exists($file_path)){
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            makeDir($file_path);
        }
        $file_name = $file_path.random_str(15).rand(10,99).'.'.$extend[1];

        $res = $is_file?move_uploaded_file($_FILES['file']['tmp_name'], $file_name):file_put_contents($file_name, $extend[0]);

        if($res == false) {
            return $this->error('上传文件失败.'.$res);
        }
        $data['file'] = trim($file_name,'.');
        $data['type'] = $type;
        return $this->success('上传成功','',$data);
    }

    /*------------------------------------------------------ */
    //-- 删除上传的临时图片
    /*------------------------------------------------------ */
    public function removeImage(){
        $file = input('file','','trim');
        if (strstr($file,'snap_file') == false){
            return $this->error('此接口只能用于删除临时图片.');
        }
        @unlink('.'.$file);
        return $this->success();
    }

}
