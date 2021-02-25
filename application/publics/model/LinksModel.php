<?php

namespace app\publics\model;
use app\BaseModel;

//*------------------------------------------------------ */
//-- 商城link调用
/*------------------------------------------------------ */
class LinksModel extends BaseModel
{
	/*------------------------------------------------------ */
	//-- 链接列表
	/*------------------------------------------------------ */
	public function links(){
		$links =  [
            [
                'name' => '首页',
                'url' => '/'
            ],[
                'name' => '用户中心',
                'url' => '/member/center/index'
            ],[
                'name' => '所有商品',
                'url' =>'/shop/goods/index'
            ],[
                'name' => '购物车',
                'url' =>'/shop/flow/cart'
            ],[
                'name' => '商品分类',
                'url' =>'/shop/index/allsort'
            ],[
                'name' => '我的订单',
                'url' =>'/shop/order/index'
            ],[
                'name' => '我的评价',
                'url' =>'/shop/comment/index'
            ],[
                'name' => '地址管理',
                'url' =>'/member/center/address'
            ],[
                'name' => '我的信息',
                'url' =>'/member/center/userinfo'
            ],[
                'name' => '我的粉丝',
                'url' =>'/member/my_team/index'
            ],[
                'name' => '我的收藏',
                'url' =>'/shop/collect/index'
            ],[
                'name' => '我的二维码',
                'url' =>'/member/center/mycode'
            ],[
                'name' => '我的钱包',
                'url' =>'/member/wallet/index'
            ],[
                'name' => '排位列表',
                'url' =>'/shop/rank/index'
            ]
        ];
		$setting = settings();

        // //判断直播是否存在
        // if ($setting['model_setting']['xcxlive'] == 1) {
        //     $links[] = [
        //         'name' => '直播列表',
        //         'url' =>'/pages/live/roomList/index'
        //     ];
        // }
        // //判断拼团模块是否存在
        // if ($setting['model_setting']['fightgroup'] == 1) {
        //     $links[] = [
        //         'name' => '拼团活动',
        //         'url' =>'/fightgroup/index/index'
        //     ];
        //     $links[] = [
        //         'name' => '我的拼团',
        //         'url' =>'/fightgroup/order/index'
        //     ];
        // }
        // //判断限时优惠模块是否存在
        // if ($setting['model_setting']['favour'] == 1) {
        //     $links[] = [
        //         'name' => '限时优惠',
        //         'url' =>'/favour/index/index'
        //     ];
        // }
        // //判断秒杀模块是否存在
        // if ($setting['model_setting']['second'] == 1) {
        //     $links[] = [
        //         'name' => '秒杀活动',
        //         'url' =>'/second/index/index'
        //     ];
        // }
        return $links;
	}
}
