<?php

/**
 * @Author: Maowenfu
 * @Date:   2021-02-25 17:27:02
 * @Last Modified by:   maowenfu
 * @Last Modified time: 2021-02-25 18:02:08
 */
namespace app\shop\controller\sys_admin;
use app\AdminController;
use app\shop\model\ShopRankModel;
use app\member\model\UsersModel;
/**
 * 排位相关
 * Class Index
 * @package app\store\controller
 */
class ShopRank extends AdminController
{
	/*------------------------------------------------------ */
    //-- 优先执行
    /*------------------------------------------------------ */
    public function initialize()
    {
        parent::initialize();
        $this->Model = new ShopRankModel();
    }

    /*------------------------------------------------------ */
	//-- 主页
	/*------------------------------------------------------ */
    public function index(){	
    	$topInfo = $this->Model->where('status',1)->find();	
		$this->assign("start_date", date('Y/m/01',strtotime("-1 months")));
		$this->assign("end_date",date('Y/m/d'));
		$this->assign("topInfo",$topInfo);
		$this->getList(true);
		return $this->fetch();
	}
   /*------------------------------------------------------ */
    //-- 获取列表
	//-- $runData boolean 是否返回模板
    /*------------------------------------------------------ */
    public function getList($runData = false) {
		$search['keyword'] = input('keyword','','trim');
		$reportrange = input('reportrange');
		$where = [];
		if (empty($reportrange) == false){
			$dtime = explode('-',$reportrange);
			$where[] = ['add_time','between',[strtotime($dtime[0]),strtotime($dtime[1])+86399]];
		}else{
			$where[] = ['add_time','between',[strtotime("-1 months"),time()]];
		}
		if (empty($search['keyword']) == false){
			$UsersModel = new UsersModel();
			$uids = $UsersModel->where(" mobile LIKE '%".$search['keyword']."%' OR user_name LIKE '%".$search['keyword']."%' OR nick_name LIKE '%".$search['keyword']."%' OR user_id = '".$search['keyword']."'")->column('user_id');
			$uids[] = -1;//增加这个为了以上查询为空时，限制本次主查询失效			 
			$where[] = ['user_id','in',$uids];
		}

		$search['status'] = input('status',-1,'intval');
		if ($search['status'] > -1) {
			$where[] = ['status','=',$search['status']];
		}
        $data = $this->getPageList($this->Model,$where);
		$this->assign("search", $search);		
		$this->assign("data", $data);
		if ($runData == false){
			$data['content']= $this->fetch('list')->getContent();
			unset($data['list']);
			return $this->success('','',$data);
		}
        return true;
    }
}