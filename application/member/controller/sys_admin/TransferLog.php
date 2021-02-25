<?php

/**
 * @Author: Maowenfu
 * @Date:   2021-02-25 17:03:29
 * @Last Modified by:   maowenfu
 * @Last Modified time: 2021-02-25 17:22:29
 */
namespace app\member\controller\sys_admin;
use think\Db;

use app\AdminController;
use app\member\model\TransferLogModel;
use app\member\model\UsersModel;
//*------------------------------------------------------ */
//-- 提现
/*------------------------------------------------------ */
class TransferLog extends AdminController
{
	 //*------------------------------------------------------ */
	//-- 初始化
	/*------------------------------------------------------ */
   public function initialize(){	
   		parent::initialize();
		$this->Model = new TransferLogModel(); 
    }
	/*------------------------------------------------------ */
	//-- 主页
	/*------------------------------------------------------ */
    public function index(){		
		$this->assign("start_date", date('Y/m/01',strtotime("-1 months")));
		$this->assign("end_date",date('Y/m/d'));
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
			$where[] = ['form_user|to_user','in',$uids];
		}
        $data = $this->getPageList($this->Model,$where);
        foreach ($data['list'] as $key=>$row){
            $row['account_info'] = json_decode($row['account_info'],true);
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
}
