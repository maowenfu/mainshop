<?php
namespace app\mainadmin\controller;

use app\AdminController;
use app\mainadmin\model\SettingsModel;
/**
 * 配置
 */
class Lzyl extends AdminController
{
    /*------------------------------------------------------ */
    //-- 优先执行
    /*------------------------------------------------------ */
    public function initialize(){
        parent::initialize();
        $this->Model = new SettingsModel();
    }
    /*------------------------------------------------------ */
    //-- 首页
    /*------------------------------------------------------ */
    public function index(){

        $this->assign("setting", $this->Model->getRows());
        return $this->fetch();
    }
    /*------------------------------------------------------ */
    //-- 保存配置
    /*------------------------------------------------------ */
    public function save(){
        $set = input('post.setting');
        $res = $this->Model->editSave($set);
        if ($res == false) return $this->error();
        return $this->success('设置成功.');
    }

}
