<?php

namespace app\fightgroup\controller\api;

use app\ApiController;

use app\fightgroup\model\FightGroupModel;
use app\shop\model\GoodsModel;
use app\member\model\UsersModel;

/*------------------------------------------------------ */
//-- 拼团相关API
/*------------------------------------------------------ */

class Goods extends ApiController
{
    /*------------------------------------------------------ */
    //-- 优先执行
    /*------------------------------------------------------ */
    public function initialize()
    {
        parent::initialize();
        $this->Model = new FightGroupModel();
    }
    /*------------------------------------------------------ */
    //-- 获取列表
    /*------------------------------------------------------ */
    public function getList()
    {
        $time = time();
        $where[] = ['status', '=', 1];
        $where[] = ['start_date', '<', $time];
        $where[] = ['end_date', '>', $time];

        $this->sqlOrder = "is_best DESC,sort_order DESC";
        $data = $this->getPageList($this->Model, $where, '*', 10);
        $GoodsModel = new GoodsModel();
        foreach ($data['list'] as $key => $_goods) {
            $goods = $GoodsModel->info($_goods['goods_id']);
            if ($goods['is_on_sale'] == 0) {//下架的商品显示
                continue;
            }

            $_goods['goods_id'] = $goods['goods_id'];
            $_goods['goods_name'] = $goods['goods_name'];
            $_goods['short_name'] = $goods['short_name'];
            $_goods['goods_thumb'] = $goods['goods_thumb'];
            $_goods['is_spec'] = $goods['is_spec'];
            $_goods['exp_price'] = explode('.', $_goods['show_price']);
            $_goods['market_price'] = $goods['market_price'];
            $_goods['shop_price'] = $goods['shop_price'];

            $return['list'][] = $_goods;
        }
        $return['page_count'] = $data['page_count'];
        $return['code'] = 1;
        return $this->ajaxReturn($return);
    }
    /*------------------------------------------------------ */
    //-- 获取首页列表
    /*------------------------------------------------------ */
    public function getBestList()
    {
        $goodsList = $this->Model->getBestList();
        $return['list'] = array_chunk($goodsList, 3);
        $return['code'] = 1;
        return $this->ajaxReturn($return);
    }

    /*------------------------------------------------------ */
    //-- 获取详情
    /*------------------------------------------------------ */
    public function info()
    {
        $fg_id = input('fg_id', '', 'intval');
        if (empty($fg_id)) return $this->error('传参失败.');
        $return['data'] = $this->Model->info($fg_id);
        if (empty($return['data'])) return $this->error('没有找到相关商品.');
        $return['code'] = 1;
        return $this->ajaxReturn($return);
    }
    /*------------------------------------------------------ */
    //-- 获取分享拼团商品二维码
    /*------------------------------------------------------ */
    public function goodsCode($fg_id = 0, $is_zx = false)
    {
        if ($fg_id == 0) {
            $fg_id = input('fg_id', 0, 'intval');
        }
        $file_path = config('config._upload_') . 'goods_qrcode/fg_' . $fg_id . '/';
        $file = $file_path . $this->userInfo['token'] . '.png';
        if (file_exists($file) == false) {
            include EXTEND_PATH . 'phpqrcode/phpqrcode.php';//引入PHP QR库文件
            $QRcode = new \phpqrcode\QRcode();
            $value = config('config.host_path') . url('fightgroup/index/info', ['fg_id' => $fg_id, 'share_token' => $this->userInfo['token']]);
            makeDir($file_path);
            $png = $QRcode::png($value, $file, "L", 10, 1, 2, true);
        }
        $code = config('config.host_path') . '/' . trim($file, '.');
        if ($is_zx == true) {
            return $code;
        }
        $return['file'] = $code;
        $return['code'] = 1;
        return $this->ajaxReturn($return);
    }

    /*------------------------------------------------------ */
    //-- 商品分享页二维码
    /*------------------------------------------------------ */
    public function getShareImg(){
        $MergeImg = new \lib\MergeImg();
        $fg_id = input('fg_id',0,'intval');
        $fgInfo = $this->Model->info($fg_id,false);
        $goods  = $fgInfo['goods'];
        $settings = settings();
        $data['share_goods_bg'] = $settings['share_goods_bg'];
        $data['share_avatar'] = (new UsersModel)->getHeadImg($this->userInfo['headimgurl']);
        $data['share_nick_name'] = $this->userInfo['nick_name'];
        $data['share_qrcode'] = $this->goodsCode($fg_id, true);

        $data['share_goods_name'] = $goods['goods_name'];
        $data['share_goods_price'] = '￥'.$goods['shop_price'];
        $data['share_goods_img'] = '.'.$goods['goods_img'];
        $data['share_goods_xy'] =  $settings['share_goods_xy'];
        $data['share_goods_wh'] =  $settings['share_goods_wh'];
        $data['share_goods_name_xy'] =  $settings['share_goods_name_xy'];
        $data['share_goods_nickname_center'] =  $settings['share_goods_nickname_center'];
        $data['share_goods_name_color'] =  $settings['share_goods_name_color'];
        $data['share_goods_name_size'] =  $settings['share_goods_name_size'];
        $data['share_goods_name_br'] =  $settings['share_goods_name_br'];
        $data['share_goods_price_xy'] =  $settings['share_goods_price_xy'];
        $data['share_goods_price_color'] =  $settings['share_goods_price_color'];
        $data['share_goods_price_size'] =  $settings['share_goods_price_size'];

        $data['share_goods_avatar_xy'] = $settings['share_goods_avatar_xy'];
        $data['share_goods_avatar_width'] = $settings['share_goods_avatar_width'];
        $data['share_goods_avatar_shape'] = $settings['share_goods_avatar_shape'];
        $data['share_goods_nickname_xy'] = $settings['share_goods_nickname_xy'];
        $data['share_goods_nickname_color'] = $settings['share_goods_nickname_color'];
        $data['share_goods_nickname_size'] = $settings['share_goods_nickname_size'];
        $data['share_goods_qrcode_xy'] = $settings['share_goods_qrcode_xy'];
        $data['share_goods_qrcode_width'] = $settings['share_goods_qrcode_width'];
        $res['img'] = $MergeImg->shareGoodsImg($data,-1);
        return $this->success('请求成功.','',$res);
    }
}
