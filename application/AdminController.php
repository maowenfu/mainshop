<?php

namespace app;

use think\facade\Cache;
use think\facade\Session;

include_once dirname(__DIR__) . '/application/commonAdmin.php';

/**
 * 后台控制器基类
 * Class BaseController
 * @package app\store\controller
 */
class AdminController extends BaseController
{
    /* @var array $admin 登录信息 */
    protected $admin;


    /* @var string $route 当前菜单组名 */
    protected $menus_group = '';
    /* @var array $allowAllAction 登录验证白名单 */
    protected $allowAllAction = [
        // 登录页面
        'passport/login',
    ];

    /* @var array $notLayoutAction 无需全局layout */
    protected $notLayoutAction = [
        // 登录页面
        'passport/login',
    ];
    public $isCheckPriv = true;
    public $store_id = 0;//当前默认为总后台，门店值默认为0

    public $supplyer_id = 0;//指定供应商
    public $is_supplyer = false;//是否查询供应商相关
    public $initialize_isretrun = true;

    /**
     * @var BaseModel
     */
    public $Model;

    /*------------------------------------------------------ */
    //-- 初始化
    /*------------------------------------------------------ */
    protected function initialize()
    {
        parent::initialize();

        // 当前路由信息
        $this->getRouteinfo();
        if ($this->initialize_isretrun == false) {
            if (defined('AUID') == false) define('AUID', 0);
            return false;
        }
        // 商家登录信息
        $this->admin = Session::get('main_admin');
        // 验证登录
        $this->checkLogin();
        if (defined('AUID') == false) {
            define('AUID', $this->admin['info']['user_id']);
        }
        if ($this->isCheckPriv == true) {
            //自动验证权限
            $this->_priv($this->module, $this->controller, $this->action);
        }
        // 全局layout
        $this->layout();
    }

    /*------------------------------------------------------ */
    //-- 全局layout模板输出址
    /*------------------------------------------------------ */
    private function layout()
    {
        // 验证当前请求是否在白名单,ajax调用也不执行
        if ($this->request->isAjax() == false || !in_array($this->routeUri, $this->notLayoutAction)) {
            if ($this->action == 'info' && $this->request->isPost() == true) return false;//如果是info页提交也不执行
            // 输出到view
            $this->assign([
                '_action' => $this->action,                    //方法名称
                'menus' => $this->menus(),                     // 后台菜单
                'top_menus' => $this->top_menus,             // 后台菜单
                '_module' => $this->module,                   // 模块名称
                'admin' => $this->admin,                       // 登录信息
                'menus_group' => $this->menus_group,
                'baseUrl' => 'mainadmin@layouts/main_base',
            ]);
            //print_r($this->menus_list);exit;
        }
    }
    /*------------------------------------------------------ */
    //-- 权限验证
    /*------------------------------------------------------ */
    protected function _priv($module = '', $controller = '', $action = '', $isAll = true, $isReturn = false)
    {
        static $allPriv;
        static $ext_modules;
        if ($this->isCheckPriv == false) return true;
        $role_action = $this->admin['info']['role_action'];
        if ($role_action == 'all' || $action == 'welcome') {
            if ($isAll == true) return true;
            if ($isReturn == true) return false;
            $this->error('你无操作权限.');
        }
        if (isset($allPriv) == false) {
            $allPriv = (new \app\mainadmin\model\AdminPrivModel)->getRows();
        }
        if (isset($ext_modules) == false) {
            $_ext_modules = config('config.ext_modules');
            foreach ($_ext_modules as $key=>$mrows){
                foreach ($mrows as $mrow){
                    $ext_modules[$mrow] = $key;
                }
            }
        }
        if (empty($ext_modules[$module]) == false){
            $privRows = $allPriv[$ext_modules[$module]];
        }else{
            $privRows = $allPriv[$module];
        }

        $privIds = [];
        $module_controller = str_replace(['_', 'sysadmin.'], '', $module . ':' . $controller . ':');
        foreach ($privRows as $row) {
            foreach ($row['right'] as $right) {
                if (in_array($right, [$module_controller . $action, $module_controller . 'allpriv'])) {
                    $privIds[] = $row['id'];
                }
            }
        }

        $isTrue = empty($privIds) ? true : array_intersect($role_action, $privIds);
        if (empty($isTrue) == false) return true;
        if ($isReturn == true) return false;
        $this->error('你无操作权限.');
    }
    /*------------------------------------------------------ */
    //-- 权限验证，用于判断返回真假
    /*------------------------------------------------------ */
    public function _privIf($module = '', $controller = '', $action = '', $isAll = true)
    {
        return $this->_priv($module, $controller, $action, $isAll, true);
    }
    /*------------------------------------------------------ */
    //-- 获取有权限的菜单
    /*------------------------------------------------------ */
    private function getPrivList()
    {
        $mkey = 'main_menu_priv_list_' . AUID;
       $data = Cache::get($mkey);
        if (empty($data) == false) {
            return $data;
        }

        $rows = (new \app\mainadmin\model\MenuListModel)->where('status', 1)->order('level DESC,sort_order DESC')->select()->toArray();
        //权限过滤
        foreach ($rows as $row) {
            if (empty($row['controller']) == false) {
                if ($this->_privIf($row['group'], $row['controller'], $row['action']) == false) {
                    continue;
                }
            }
            $menus[] = $row;
        }
        $_data = [];
        foreach ($menus as $row) {
            $key = $row['pid'] < 1 ? $row['group'] : $row['id'];
            if ($row['pid'] > 0) {
                if (empty($_data[$row['id']]) == false) {
                    $row['submenu'] = $_data[$row['id']];
                    unset($_data[$row['id']]);
                }
                $_data[$row['pid']][$key] = $row;
            } else {
                $row['submenu'] = $_data[$row['id']];
                if (empty($row['submenu']) == false) {
                    $data['menus'][$key] = $row;
                }
            }
        }
        foreach ($data['menus'] as $group => $menu) {
            $_menu = reset($menu['submenu']);
            for ($i = 0; $i < 5; $i++) {
                if (empty($_menu['controller'])) {
                    $_menu = reset($_menu['submenu']);
                } else {
                    break;
                }
            }
            $data['top_menus'][$group] = ['name' => $menu['name'], 'icon' => $menu['icon'],'module'=>$group, 'group' => $_menu['group'], 'controller' => $_menu['controller'], 'action' => $_menu['action']];
        }
        Cache::set($mkey, $data, 600);
        return $data;
    }


    /**
     * 后台菜单配置
     * @return array
     */
    private function menus()
    {
        $menusData = $this->getPrivList();//获取有权限的菜单
        $this->top_menus = $menusData['top_menus'];
        $_module = $this->module;
        if (empty($menusData['groupList'][$_module]) == false){
            $this->module =$menusData['groupList'][$this->module];
        }
        $ext_modules = config('config.ext_modules');
        foreach ($ext_modules as $key=>$modules){
            if (in_array($this->module,$modules)){
                $this->module = $key;
            }
        }

        $data = $menusData['menus'][$this->module]['submenu'];

        $nowUrl = url($_module.'/'.$this->routeUri);
        // 遍历：一级菜单
        foreach ($data as $fKey => $first) {
            $active = 0;
            if (empty($first['submenu']) == true) {
                if (empty($first['controller'])) {
                    unset($data[$fKey]);
                    continue;
                }
                $first['active'] = 0;
                $first['_url'] = url($first['group'].'/'.$first['controller'].'/'.$first['action']);
                $isOk = false;
                if (empty($first['urls']) == false){
                    $urls = explode(',',$first['urls']);
                    foreach ($urls as $url){
                        if ($nowUrl == url($url)){
                            $isOk = true;
                            break;
                        }
                    }
                }
                if ($isOk == true || $nowUrl == $first['_url']){
                    $first['active'] = 1;
                }
                $data[$fKey] = $first;
                continue;
            }
            // 遍历：二级菜单
            foreach ($first['submenu'] as $sKey => $second) {
                $_active = 0;
                if (empty($second['submenu']) == true) {
                    if (empty($second['controller'])) {
                        unset($first['submenu'][$sKey]);
                        continue;
                    }
                    $second['active'] = 0;
                    $second['_url'] = url($second['group'].'/'.$second['controller'].'/'.$second['action']);
                    $isOk = false;
                    if (empty($second['urls']) == false){
                        $urls = explode(',',$second['urls']);
                        foreach ($urls as $url){
                            if ($nowUrl == url($url)){
                                $isOk = true;
                                break;
                            }
                        }
                    }
                    if ($isOk == true || $nowUrl == $second['_url']){
                        $second['active'] = 1;
                        $active = $_active = 1;
                    }
                    if (empty($first['_url'])){
                        $first['_url'] = $second['_url'];
                    }
                    $first['submenu'][$sKey] = $second;
                    continue;
                }
                // 遍历：三级菜单
                foreach ($second['submenu'] as $tKey => $third) {
                    if (empty($third['controller'])) {
                        unset($first['submenu'][$sKey]['submenu'][$tKey]);
                        continue;
                    }
                    $third['active'] = 0;
                    $third['_url'] = url($third['group'].'/'.$third['controller'].'/'.$third['action']);
                    $isOk = false;
                    if (empty($third['urls']) == false){
                        $urls = explode(',',$third['urls']);
                        foreach ($urls as $url){
                            if ($nowUrl == url($url)){
                                $isOk = true;
                                break;
                            }
                        }
                    }
                    if ($isOk == true || $nowUrl == $third['_url']){
                        $third['active'] = 1;
                        $active = $_active = 1;
                    }
                    $first['submenu'][$sKey]['submenu'][$tKey] = $third;
                }
                $first['submenu'][$sKey]['active'] = $_active;
            }
            $first['active'] = $active;
            $data[$fKey] = $first;
            if ($active == 1){
                $this->menus_group = $fKey;
            }
        }
        return $data;
    }


    /**
     * 验证登录状态
     */
    private function checkLogin()
    {
        // 验证当前请求是否在白名单
        if (in_array($this->routeUri, $this->allowAllAction)) {
            return true;
        }
        // 验证登录状态
        if (empty($this->admin) || (int)$this->admin['is_login'] !== 1) {
            if ($this->request->isAjax()) {
                return $this->error('登陆超时，请重新登陆.');
            }
            $this->redirect($_SERVER['SCRIPT_NAME'] . '/mainadmin/passport/login');
            return false;
        }
        return true;
    }

    //*------------------------------------------------------ */
    //-- 清理字典数据缓存
    /*------------------------------------------------------ */
    public function clearDict()
    {
        \app\mainadmin\model\PubDictModel::cleanMemcache(input('group'));
        echo '执行成功.';
        exit;
    }


    /*------------------------------------------------------ */
    //-- 添加/修改
    /*------------------------------------------------------ */
    public function info()
    {
        $pk = $this->Model->pk;
        if ($this->request->isPost()) {
            if (false === $data = $_POST) {
                $this->error($this->Model->getError());
            }
            if (empty($data[$pk])) {
                $this->_priv($this->module, $this->controller, 'add');
                if (method_exists($this, 'beforeAdd')) {
                    $data = $this->beforeAdd($data);
                }
                unset($data[$pk]);
                $res = $this->Model->allowField(true)->save($data);
                if ($res > 0) {
                    $data[$pk] = $this->Model->$pk;
                    if (method_exists($this->Model, 'cleanMemcache')) $this->Model->cleanMemcache($res);
                    if (method_exists($this, 'afterAdd')) {
                        $result = $this->afterAdd($data);
                        if (is_array($result)) return $this->ajaxReturn($result);
                    }
                    return $this->success('添加成功.', url('index'));
                }
            } else {
                $this->_priv($this->module, $this->controller, 'edit');
                if (method_exists($this, 'beforeEdit')) {
                    $data = $this->beforeEdit($data);
                }
                $res = $this->Model->allowField(true)->save($data, $data[$pk]);
                if ($res > 0) {
                    if (method_exists($this->Model, 'cleanMemcache')) $this->Model->cleanMemcache($data[$pk]);
                    if (method_exists($this, 'afterEdit')) {
                        $result = $this->afterEdit($data);
                        if (is_array($result)) return $this->ajaxReturn($result);
                    }
                    return $this->success('修改成功.', url('index'));
                }
            }
            return $this->error('操作失败.');
        }

        $id = input($pk, 0, 'intval');
        $row = ($id == 0) ? $this->Model->getField() : $this->Model->find($id);

        if ($id > 0 && empty($row) == false) {
            $row = $row->toArray();
        }
        if (method_exists($this, 'asInfo')) {
            $row = $this->asInfo($row);
        }

        $this->assign("row", $row);
        $ishtml = input('ishtml', 0, 'intval');
        if ($this->request->isAjax() && $ishtml == 0) {
            $result['code'] = 1;
            $result['data'] = $this->fetch('info')->getContent();
            return $this->ajaxReturn($result);
        }

        return $this->fetch('info');

    }

    /**
     * ajax修改单个字段值
     */
    public function ajaxEdit()
    {

        $pk = $this->Model->getPk();
        $id = input($pk, 0, 'intval');
        $field = input('field', '', 'trim');
        if ($id == '' || $field == '') return $this->error('缺少必要传参.');
        $data[$field] = input('value', '', 'trim');
        $toggle = input('toggle');
        if ($toggle) {
            $data[$field] = $toggle === 'true' || $toggle === 1 ? 1 : 0;
        }

        if (method_exists($this, 'beforeAjax')) {
            $data = $this->beforeAjax($id, $data);
        }
        $map[$pk] = $id;
        //允许异步修改的字段列表  放模型里面去 TODO
        if (false !== $this->Model->save($data, $map)) {
            if (method_exists($this, 'afterAjax')) {
                $this->afterAjax($id, $data);
            }
        }
        return $this->success();
    }


}
