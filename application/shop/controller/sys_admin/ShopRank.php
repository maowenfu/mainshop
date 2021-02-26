<?php

/**
 * @Author: Maowenfu
 * @Date:   2021-02-25 17:27:02
 * @Last Modified by:   maowenfu
 * @Last Modified time: 2021-02-26 16:39:57
 */
namespace app\shop\controller\sys_admin;
use app\AdminController;
use app\shop\model\ShopRankModel;
use app\shop\model\RankErrorModel;
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
    	$topInfo['out_num'] = $this->Model->where([['status','=',2],['user_id','=',$topInfo['user_id']]])->count();
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

        foreach ($data['list'] as $key => $row) {
            $row['out_num'] = $this->Model->where([['status','=',2],['user_id','=',$row['user_id']]])->count();
            $data['list'][$key] = $row;
        }

		$this->assign("search", $search);		
		$this->assign("data", $data);
		if ($runData == false){
			$data['content']= $this->fetch('list')->getContent();
			unset($data['list']);
			return $this->success('','',$data);
		}
        return true;
    }

    /**
     * [errorLog 排位失败日志]
     */
    public function errorLog()
    {
    	$this->assign("start_date", date('Y/m/01',strtotime("-1 months")));
		$this->assign("end_date",date('Y/m/d'));
		$this->getErrorList(true);
        return $this->fetch();
    }

    /*------------------------------------------------------ */
    //-- 获取列表
	//-- $runData boolean 是否返回模板
    /*------------------------------------------------------ */
    public function getErrorList($runData = false) {
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

        $data = $this->getPageList((new RankErrorModel),$where);

        foreach ($data['list'] as $key => $row) {
        	if ($row['rank_id'] > 0) {
        		$row['user_id'] = $this->Model->where('rank_id',$row['rank_id'])->value('user_id');
        	}
        	$data['list'][$key] = $row;
        }

		$this->assign("search", $search);		
		$this->assign("data", $data);
		if ($runData == false){
			$data['content']= $this->fetch('error_log')->getContent();
			unset($data['list']);
			return $this->success('','',$data);
		}
        return true;
    }
}