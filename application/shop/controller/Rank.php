<?php

/**
 * @Author: Maowenfu
 * @Date:   2021-02-25 10:20:51
 * @Last Modified by:   maowenfu
 * @Last Modified time: 2021-02-25 12:00:43
 * 排位相关
 */
namespace app\shop\controller;
use app\ClientbaseController;
use app\shop\model\ShopRankModel;
class Rank  extends ClientbaseController{
	/*------------------------------------------------------ */
    //-- 优先执行
    /*------------------------------------------------------ */
    public function initialize(){
        parent::initialize();
        $this->Model = new ShopRankModel();
    }
    public function index()
    {
        $settings = settings();
        $this->assign('careful', json_decode($settings['careful'],true));
    	$this->assign('title', '排位列表');

        $list = $this->Model->where('status','<>',2)->limit(10)->order('add_time ASC')->select()->toArray();
        $numRank = 0;
        $my = $this->Model->where([['status','<>',2],['user_id','=',$this->userInfo['user_id']]])->find();
        if (empty($my)) {
            $numRank = '未参与';
        }else{
            $count = $this->Model->where([['status','<>',2],['rank_id','<=',$my['rank_id']]])->count();
            $numRank = $numRank + $count;
            if ($numRank < 1) {
                $numRank = '未参与';
            }
        }

        $this->assign('numRank', $numRank);
        $this->assign('list', $list);
        return $this->fetch();
    }
}