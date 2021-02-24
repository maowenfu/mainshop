<?php /*a:3:{s:59:"F:\WWW\M\application\shop\view\sys_admin\setting\index.html";i:1613985989;s:53:"F:\WWW\M\application\mainadmin\view\layouts\base.html";i:1613985988;s:53:"F:\WWW\M\application\mainadmin\view\layouts\page.html";i:1613985988;}*/ ?>
<?PHP header("Cache-Control:private"); ?>
<!DOCTYPE html>
<html lang="cn" class="app fadeInUp animated">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <title><?php echo empty($title)?'后台管理系统':$title;?></title>

    <link rel="icon" type="image/png" href="/static/favicon.ico"/>

    <link rel="stylesheet" href="/static/main/css/app.css"/>
    <!--Basic Styles-->
    <link href="/static/main/css/stylesheets/bootstrap.min.css" rel="stylesheet" />
    <link href="/static/main/css/inside.css" rel="stylesheet">
    <link href="/static/awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!--Beyond styles-->
    <link id="beyond-link" href="/static/main/css/stylesheets/beyond.min.css" rel="stylesheet" type="text/css" />
    <link href="/static/main/css/stylesheets/style.min.css" rel="stylesheet" />


    <script type="text/javascript" src="/static/js/jquery/jquery/1.8.3/jquery.min.js"></script>
    <script src="/static/js/inside.js"></script>

    <link rel="stylesheet" href="/static/main/css/public.css"/>
    <link href="/static/main/css/stylesheets/daterangepicker/daterangepicker-bs3.min.css" rel="stylesheet" />
    <script src="/static/main/js/jquery.webui-popover.min.js"></script>
    <link href="/static/main/css/jquery.webui-popover.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
    	var assets_path="/static",
		_version = "1.0.0",
		uploadJ = "<?php echo url('mainAdmin/attachment/editer_upload',array('ckv'=>editerUploadCkv())); ?>",
		fileManagerJ = "<?php echo url('mainAdmin/attachment/editer_manager'); ?>",
		searchUserUrl = "<?php echo url('member/sys_admin.users/pubSearch'); ?>",
		searchGoodsUrl = "<?php echo url('shop/sys_admin.goods/pubSearch'); ?>",
		regionUrl  = "<?php echo url('publics/api.region/getList'); ?>",
		order_by = '<?=empty($data["order_by"])?'':$data["order_by"];?>',
		sort_by = '<?=empty($data["sort_by"])?'':$data["sort_by"];?>',
		page_size = '';

		/**
 * app.js
 */
$(function () {
    /**
     * 点击侧边开关 (一级)
     */
    $('.switch-button').on('click', function () {
        var header = $('.tpl-header'), wrapper = $('.tpl-content-wrapper'), leftSidebar = $('.left-sidebar');
        if (leftSidebar.css('left') !== "0px") {
            header.removeClass('active') && wrapper.removeClass('active') && leftSidebar.css('left', 0);
        } else {
            header.addClass('active') && wrapper.addClass('active') && leftSidebar.css('left', -280);
        }
    });
    /**
     * 侧边栏开关 (二级)
     */
    $('.sidebar-nav-sub-title').click(function () {
        $(this).toggleClass('active');
    });

});
    </script>
    
<link rel="stylesheet" href="/static/js/jquery/jquery_ui/jquery-ui.css">
<script src="/static/js/jquery/jquery_ui/jquery-ui.js"></script>
<style>
    @font-face{

        　　font-family:'msyhbd';
        　　src:url('/static/share/msyhbd.ttc');

    }
    #share_img_box{
        font-family:'msyhbd';
        width:375px;border: 1px solid #000;
        overflow: hidden;
        position: relative;
    }
    #share_bg_img{width: 100%;}

    #share_img_box .share_goods_img,#share_img_box .share_goods_name,#share_img_box .share_goods_price{position: absolute; z-index: auto; user-select: auto;}

    #share_img_box .share_qrcode{ border: 1px dashed #000;position: absolute; z-index: auto; user-select: auto;}
    #share_img_box .share_avatar{position: absolute;cursor:default;  border:1px dashed #000;position: absolute; z-index: auto; user-select: auto;}
    #share_img_box .share_nick_name{position: absolute;cursor:default; border:1px dashed #000;position: absolute;font-weight: bold;z-index: auto; user-select: auto;}
    .circle{border-radius: 50%;}
    #share_img_box .share_avatar span{
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        font-size: 12px;
        background-color: #ddd;
        overflow: hidden;
    }
</style>

</head>


<body  >
<div class="am-g tpl-g">
    <!-- 头部 -->
    <header class="tpl-header">
        <!-- 右侧内容 -->
        <div class="tpl-header-fluid">
            <!-- 侧边切换 -->
            <div class="am-fl tpl-header-button switch-button">
                <i class="fa fa-bars"></i>
            </div>
           <?php if(is_array($top_menus) || $top_menus instanceof \think\Collection || $top_menus instanceof \think\Paginator): $i = 0; $__LIST__ = $top_menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <a class="am-fl tpl-header-fun-button <?php echo $_module==$vo['module'] ? 'top_select' : 'top_no_select'; ?>"  href="<?php echo url($vo['group'].'/'.$vo['controller'].'/'.$vo['action']) ?>"><i class="fa <?php echo htmlentities($vo['icon']); ?>"></i> <?php echo htmlentities($vo['name']); ?></a>

           <?php endforeach; endif; else: echo "" ;endif; ?>


            <!-- 其它功能-->
            <div class="fr tpl-header-navbar">
                <ul>
                    <!-- 欢迎语 -->
                    <li class="am-text-sm tpl-header-navbar-welcome">
                        <a href="javascript:;">欢迎你，<span><?= $admin['info']['user_name'] ?></span>
                        </a>
                    </li>
                    <?php if($admin['info']['role_action']=='all'): ?>
                    <li class="am-text-sm">
                        <a href="<?= url('mainAdmin/index/clearCache') ?>">
                            <i class="fa fa-recycle"></i> 清理缓存
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- 退出 -->
                    <li class="am-text-sm">
                        <a href="<?= url('mainAdmin/passport/logout') ?>">
                            <i class="fa fa-power-off"></i> 退出
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- 侧边导航栏 -->
    <div class="left-sidebar">
        <?php $menus = $menus ?: []; ?>
        <!-- 一级菜单 -->
        <ul class="sidebar-nav">
            <li class="sidebar-nav-heading"><i class="fa fa-home"></i> 管理后台</li>
            <?php foreach ($menus as $key => $item): ?>
                <li class="sidebar-nav-link">
                    <a href="<?=$item['_url']?>"
                       class="<?=$item['active']==1? 'active' : '' ?>">
                            <i class="fa sidebar-nav-link-logo <?php echo htmlentities($item['icon']); ?>" style=""></i> <?php echo htmlentities($item['name']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
            <div style=" position: absolute; bottom: 0px; width:150px;padding: 5px; color: #fff; font-size: 12px; text-align: center;"> Copyright © 2013-2019 All Rights <br>版权所有，盗版必究</div>
        </ul>
        <!-- 子级菜单-->
        <?php
        $second = isset($menus[$menus_group]['submenu']) ? $menus[$menus_group]['submenu'] : [];
        if (!empty($second)) : ?>
            <ul class="left-sidebar-second">
                <li class="sidebar-second-title hide"><?= $menus[$menus_group]['name'] ?></li>
                <li class="sidebar-second-item">
                    <?php foreach ($second as $item) :  if (!isset($item['submenu'])): ?>
                            <!-- 二级菜单-->
                            <a href="<?=$item['_url']?>" class="<?=$item['active']==1?'active':''?>">
                                <?= $item['name']; ?>
                            </a>
                        <?php else: ?>
                            <!-- 三级菜单-->
                            <div class="sidebar-third-item">
                                <a href="javascript:void(0);"
                                   class="sidebar-nav-sub-title <?=$item['active']==1?'active' : '' ?>">
                                    <i class="fa fa-sort"></i>
                                    <?= $item['name']; ?>
                                </a>
                                <ul class="sidebar-third-nav-sub">
                                    <?php foreach ($item['submenu'] as $third) : ?>
                                        <li>
                                            <a class="<?=$third['active']==1?'active':''?>"
                                               href="<?=$third['_url'] ?>">
                                                &nbsp;&nbsp;├─<?= $third['name']; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </li>
            </ul>
        <?php endif; ?>

    </div>

    <!-- 内容区域 start -->
    <div class="tpl-content-wrapper <?= empty($second) ? 'no-sidebar-second' : '' ?>" >
    	<section class="vbox">
        	
<header class="header  b-b clearfix">
     <div class="page-breadcrumbs">
            <ul class="breadcrumb" >
                <li>
                    <i class="fa fa-ellipsis-v"></i>
                    <strong>商城设置</strong>
                </li>                                  
            </ul>
      </div>
</header>
<form class="form-horizontal form-validate form_vbox" id="_form" method="post" action="<?php echo url('save'); ?>">
    <section class="vbox">
        <section class="scrollable  wrapper w-f">
            <section class="panel panel-default">
                <header>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#basic" data-toggle="tab">基本配置</a></li>
                        <li><a href="#return" data-toggle="tab">运费&退货</a></li>
                        <li><a href="#kdnset" data-toggle="tab">快递鸟配置</a></li>
                        <li><a href="#bonus" data-toggle="tab">优惠券设置</a></li>
                        <li><a href="#favour" data-toggle="tab">限时优惠/拼团设置</a></li>
                        <li><a href="#share" data-toggle="tab">商品分享设置</a></li>
                        <li><a href="#show_ordermessage" data-toggle="tab">首页订单信息轮播配置</a></li>
                    </ul>
                </header>
                <div class="tab-content">
                    <div class="tab-pane active" id="basic">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">H5首页设定：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="shop_index_tpl" value="0" <?php echo $setting['shop_index_tpl']==0 ? 'checked' : ''; ?>
                                    type="radio">默认首页
                                </label>
                                <label class="radio-inline">
                                    <input name="shop_index_tpl" value="1" <?php echo $setting['shop_index_tpl']==1 ? 'checked' : ''; ?>
                                    type="radio" >自定义首页
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">小程序首页设定：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="xcx_index_tpl" value="0" <?php echo $setting['xcx_index_tpl']==0 ? 'checked' : ''; ?>
                                    type="radio">默认首页
                                </label>
                                <label class="radio-inline">
                                    <input name="xcx_index_tpl" value="1" <?php echo $setting['xcx_index_tpl']==1 ? 'checked' : ''; ?>
                                    type="radio" >自定义首页
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">个人中心菜单显示类型：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="user_center_nav_tpl" value="0" <?php echo $setting['user_center_nav_tpl']==0 ? 'checked' : ''; ?>
                                    type="radio">网格类型
                                </label>
                                <label class="radio-inline">
                                    <input name="user_center_nav_tpl" value="1" <?php echo $setting['user_center_nav_tpl']==1 ? 'checked' : ''; ?>
                                    type="radio" >列表类型
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">商城Title：</label>
                            <div class="controls">
                                <input type="text" name="shop_title" class="input-large" value="<?php echo htmlentities($setting['shop_title']); ?>">
                                <span class="help-line">首页 - xxxxxxxxxx</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">搜索框文字：</label>
                            <div class="controls">
                                <input type="text" name="shop_index_search_text" class="input-large"
                                       data-rule-required="true" value="<?php echo htmlentities($setting['shop_index_search_text']); ?>"> <span
                                    class="help-line">搜索框默认显示的搜索关键字</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">热门搜索：</label>
                            <div class="controls">
                                <input type="text" name="hot_search" class="input-xxlarge"
                                       value="<?php echo htmlentities($setting['hot_search']); ?>"> <span class="help-line">每个搜索词中间用空格隔开</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">首页头条数量：</label>
                            <div class="controls">
                                <select name="headline_max_num">
                                    <?php $__FOR_START_1800849269__=1;$__FOR_END_1800849269__=31;for($num=$__FOR_START_1800849269__;$num < $__FOR_END_1800849269__;$num+=1){ ?>
                                    <option value="<?php echo htmlentities($num); ?>" <?php echo $setting[
                                    'headline_max_num']==$num ? 'selected' : ''; ?>><?php echo htmlentities($num); ?> 条</option>
                                    <?php } ?>
                                </select> <span class="help-line">首页头条最多可显示的数量</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">开放商品评论：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="shop_goods_comment" value="0" <?php echo $setting['shop_goods_comment']<1 ? 'checked' : ''; ?>
                                    type="radio">关闭
                                </label>
                                <label class="radio-inline">
                                    <input name="shop_goods_comment" value="1" <?php echo $setting['shop_goods_comment']==1 ? 'checked' : ''; ?>
                                    type="radio" >开启
                                </label>
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-sm-2 control-label">开放商品问答：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="shop_goods_answer" value="0" <?php echo $setting['shop_goods_answer']<1 ? 'checked' : ''; ?>
                                    type="radio">关闭
                                </label>
                                <label class="radio-inline">
                                    <input name="shop_goods_answer" value="1" <?php echo $setting['shop_goods_answer']==1 ? 'checked' : ''; ?>
                                    type="radio" >开启
                                </label>
                            </div>
                        </div>

                        <div class="line line-dashed line-lg pull-in" style="width:99%;"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">超时取消：</label>
                            <div class="controls">
                                <select name="shop_order_auto_cancel" style="width:200px;">
                                    <option value="0" <?php echo $setting[
                                    'shop_order_auto_cancel']==0 ? 'selected' : ''; ?>>不执行自动取消</option>
                                    <option value="15" <?php echo $setting[
                                    'shop_order_auto_cancel']==15 ? 'selected' : ''; ?>>15 分钟</option>
                                    <option value="30" <?php echo $setting[
                                    'shop_order_auto_cancel']==30 ? 'selected' : ''; ?>>30 分钟</option>
                                    <?php $__FOR_START_1212664134__=1;$__FOR_END_1212664134__=24;for($time=$__FOR_START_1212664134__;$time < $__FOR_END_1212664134__;$time+=1){ ?>
                                    <option value="<?php echo htmlentities($time * 60); ?>" <?php echo $setting[
                                    'shop_order_auto_cancel']==$time * 60 ? 'selected' : ''; ?>><?php echo htmlentities($time); ?> 小时</option>
                                    <?php } ?>
                                </select> <span class="help-line">下单成功后超过指定时间未支付自动取消订单</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">自动签收：</label>
                            <div class="controls">
                                <select name="shop_auto_sign_limit">
                                    <?php $__FOR_START_2056218119__=1;$__FOR_END_2056218119__=31;for($day=$__FOR_START_2056218119__;$day < $__FOR_END_2056218119__;$day+=1){ ?>
                                    <option value="<?php echo htmlentities($day); ?>" <?php echo $setting[
                                    'shop_auto_sign_limit']==$day ? 'selected' : ''; ?>><?php echo htmlentities($day); ?> 天</option>
                                    <?php } ?>
                                </select> <span class="help-line">发货多少天后订单自动签收</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">快递查询接口：</label>
                            <div class="controls">
                                <select class="input-max" name="shop_shippping_view_fun">
                                    <option value="">选择快递查询接口</option>
                                    <?php if(is_array($shippingFunction) || $shippingFunction instanceof \think\Collection || $shippingFunction instanceof \think\Paginator): $i = 0; $__LIST__ = $shippingFunction;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo htmlentities($val['function']); ?>" <?php echo $setting[
                                    'shop_shippping_view_fun']==$val['function'] ? 'selected' : ''; ?> ><?php echo htmlentities($val['name']); ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">申请售后：</label>
                            <div class="controls">
                                <select name="shop_after_sale_limit" class="input-max">
                                    <option value="0" <?php echo $setting[
                                    'shop_after_sale_limit']==0 ? 'selected' : ''; ?>>不启用售后功能</option>
                                    <?php $__FOR_START_703364070__=1;$__FOR_END_703364070__=31;for($day=$__FOR_START_703364070__;$day < $__FOR_END_703364070__;$day+=1){ ?>
                                    <option value="<?php echo htmlentities($day); ?>" <?php echo $setting[
                                    'shop_after_sale_limit']==$day ? 'selected' : ''; ?>><?php echo htmlentities($day); ?> 天</option>
                                    <?php } ?>
                                </select> <span class="help-line">签收后多少天内可申请售后</span>
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in" style="width:99%;"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">减库存的时机：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="shop_reduce_stock" value="0" <?php echo $setting['shop_reduce_stock']==0 ? 'checked' : ''; ?>
                                    type="radio">下单成功时
                                </label>
                                <label class="radio-inline">
                                    <input name="shop_reduce_stock" value="1" <?php echo $setting['shop_reduce_stock']==1 ? 'checked' : ''; ?>
                                    type="radio" >支付成功时
                                </label>
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in" style="width:99%;"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">取消未发货订单：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="order_unshipped_cancel" value="1" <?php echo $setting['order_unshipped_cancel']>0 ? 'checked' : ''; ?>
                                    type="radio">开启
                                </label>
                                <label class="radio-inline">
                                    <input name="order_unshipped_cancel" value="0" <?php echo $setting['order_unshipped_cancel']==0 ? 'checked' : ''; ?>
                                    type="radio" >关闭
                                </label>
                                <span class="help-inline">订单已支付，未发货，是否允许取消</span>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane " id="return">

                        <?php if($has_supplyer == 1): ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">运费模板：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="shipping_tmp_supplyer" value="0" <?php echo $setting['shipping_tmp_supplyer']==0 ? 'checked' : ''; ?>
                                    type="radio">平台统一设置
                                </label>
                                <label class="radio-inline">
                                    <input name="shipping_tmp_supplyer" value="1" <?php echo $setting['shipping_tmp_supplyer']==1 ? 'checked' : ''; ?>
                                    type="radio" >供应商自行配置
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">运费计算：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="shipping_fee_type" value="0" <?php echo $setting['shipping_fee_type']==0 ? 'checked' : ''; ?>
                                    type="radio">统一计算(拆单，根据商品金额比例分配运费)
                                </label>
                                <br>
                                <label class="radio-inline">
                                    <input name="shipping_fee_type" value="1" <?php echo $setting['shipping_fee_type']==1 ? 'checked' : ''; ?>
                                    type="radio" >按供应商独立计算(供应商可以自行设置运费模板)
                                </label>
                            </div>
                        </div>
                        <?php else: ?>
                        <input name="shipping_fee_type" value="0" type="hidden">
                        <input name="shipping_tmp_supplyer" value="0" type="hidden">
                        <?php endif; ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">运费累加计算：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="shipping_fee_plus" value="0" <?php echo $setting['shipping_fee_plus']==0 ? 'checked' : ''; ?>
                                    type="radio">不累加(按算出最贵的运费模板，按最贵的计算)
                                </label>
                                <br>
                                <label class="radio-inline">
                                    <input name="shipping_fee_plus" value="1" <?php echo $setting['shipping_fee_plus']==1 ? 'checked' : ''; ?>
                                    type="radio" >累加(按运费模板累加计算)
                                </label>
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in" style="width:99%;"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">退货收货人：</label>
                            <div class="controls">
                                <input type="text" name="return_consignee" value="<?php echo htmlentities($setting['return_consignee']); ?>"
                                       class="input-large"> <span class="help-line"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">退货联系电话：</label>
                            <div class="controls">
                                <input type="text" name="return_mobile" value="<?php echo htmlentities($setting['return_mobile']); ?>"
                                       class="input-large"> <span class="help-line"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">退货地址：</label>
                            <div class="controls">
                                <input type="text" name="return_address" value="<?php echo htmlentities($setting['return_address']); ?>"
                                       class="input-xxlarge"> <span class="help-line"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">退货说明：</label>
                            <div class="controls">
                            <textarea rows="4" class="input-xxlarge"
                                      name="return_desc"><?php echo htmlentities($setting['return_desc']); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="kdnset">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">电商ID（快递鸟）：</label>
                            <div class="controls">
                                <input type="text" name="kdn_appid" value="<?php echo htmlentities($setting['kdn_appid']); ?>" style="width: 300px;">
                                <span class="help-line"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">电商加密私钥（快递鸟）：</label>
                            <div class="controls">
                                <input type="text" name="kdn_apikey" value="<?php echo htmlentities($setting['kdn_apikey']); ?>"
                                       style="width: 300px;"> <span class="help-line"></span>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="col-sm-2 control-label">邮政编码：</label>
                            <div class="controls">
                                <input type="text" name="kdn_postcode" value="<?php echo htmlentities($setting['kdn_postcode']); ?>"
                                       style="width: 300px;"> <span class="help-line"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">接口地址（快递鸟）：</label>
                            <div class="controls">
                                <input type="text" name="kdn_apiurl" value="<?php echo htmlentities($setting['kdn_apiurl']); ?>"
                                       style="width: 300px;">
                                <span class="help-line"></span>
                                <select onchange="$('input[name=kdn_apiurl]').val($(this).val());">
                                    <option value="">请选择接口地址</option>
                                    <option value="http://api.kdniao.com/api/Eorderservice">正式地址</option>
                                    <option value="http://testapi.kdniao.com:8081/api/EOrderService">测试地址</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">寄件人名称（快递鸟）：</label>
                            <div class="controls">
                                <input type="text" name="kdn_name" value="<?php echo htmlentities($setting['kdn_name']); ?>"> <span
                                    class="help-line"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">联系电话（快递鸟）：</label>
                            <div class="controls">
                                <input type="text" name="kdn_phone" value="<?php echo htmlentities($setting['kdn_phone']); ?>"> <span
                                    class="help-line"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">地区（快递鸟）：</label>
                            <div class="controls">
                                <input type="text" name="kdn_province" class="input-mini" style="text-align: center"
                                       value="<?php echo htmlentities($setting['kdn_province']); ?>"> <span class="help-line">省</span>
                                <input type="text" name="kdn_city" class="input-mini" style="text-align: center"
                                       value="<?php echo htmlentities($setting['kdn_city']); ?>"> <span class="help-line">市</span>
                                <input type="text" name="kdn_area" class="input-mini" style="text-align: center"
                                       value="<?php echo htmlentities($setting['kdn_area']); ?>"> <span class="help-line">区</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">详情地址（快递鸟）：</label>
                            <div class="controls">
                                <input type="text" name="kdn_address" value="<?php echo htmlentities($setting['kdn_address']); ?>"
                                       style="width: 300px;"> <span class="help-line"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">打印机模式：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="kdn_print_type" value="1" <?php echo $setting['kdn_print_type']==1||empty($setting['kdn_print_type']) ? 'checked' : ''; ?>
                                    type="radio">一联单模式
                                </label>
                                <label class="radio-inline">
                                    <input name="kdn_print_type" value="2" <?php echo $setting['kdn_print_type']==2 ? 'checked' : ''; ?>
                                    type="radio" >二联单模式
                                </label>
                                <span class="help-line">面单模板请在物流管理处设置模板id</span>
                            </div>
                        </div> -->
                    </div>

                    <div class="tab-pane" id="cnset">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">电商ID（菜鸟）：</label>
                            <div class="controls">
                                <input type="text" name="cn_appid" value="<?php echo htmlentities($setting['cn_appid']); ?>" style="width: 300px;">
                                <span class="help-line"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">电商加密私钥（菜鸟）：</label>
                            <div class="controls">
                                <input type="text" name="cn_apikey" value="<?php echo htmlentities($setting['cn_apikey']); ?>" style="width: 300px;">
                                <span class="help-line"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">邮政编码：</label>
                            <div class="controls">
                                <input type="text" name="cn_postcode" value="<?php echo htmlentities($setting['cn_postcode']); ?>"
                                       style="width: 300px;"> <span class="help-line"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">接口地址（菜鸟）：</label>
                            <div class="controls">
                                <input type="text" name="cn_apiurl" value="<?php echo htmlentities($setting['cn_apiurl']); ?>" style="width: 300px;">
                                <span class="help-line"></span>
                                <select onchange="$('input[name=cn_apiurl]').val($(this).val());">
                                    <option value="">请选择接口地址</option>
                                    <option value="http://api.kdniao.com/api/Eorderservice">正式地址</option>
                                    <option value="http://testapi.kdniao.com:8081/api/EOrderService">测试地址</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">寄件人名称（菜鸟）：</label>
                            <div class="controls">
                                <input type="text" name="cn_name" value="<?php echo htmlentities($setting['cn_name']); ?>"> <span
                                    class="help-line"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">联系电话（菜鸟）：</label>
                            <div class="controls">
                                <input type="text" name="cn_phone" value="<?php echo htmlentities($setting['cn_phone']); ?>"> <span
                                    class="help-line"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">地区（菜鸟）：</label>
                            <div class="controls">
                                <input type="text" name="cn_province" class="input-mini" style="text-align: center"
                                       value="<?php echo htmlentities($setting['cn_province']); ?>"> <span class="help-line">省</span>
                                <input type="text" name="cn_city" class="input-mini" style="text-align: center"
                                       value="<?php echo htmlentities($setting['cn_city']); ?>"> <span class="help-line">市</span>
                                <input type="text" name="cn_area" class="input-mini" style="text-align: center"
                                       value="<?php echo htmlentities($setting['cn_area']); ?>"> <span class="help-line">区</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">详情地址（菜鸟）：</label>
                            <div class="controls">
                                <input type="text" name="cn_address" value="<?php echo htmlentities($setting['cn_address']); ?>"
                                       style="width: 300px;"> <span class="help-line"></span>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane " id="bonus">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">开放优惠券：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="shop_used_bonus" value="0" <?php echo $setting['shop_used_bonus']<1 ? 'checked' : ''; ?>
                                    type="radio">关闭
                                </label>
                                <label class="radio-inline">
                                    <input name="shop_used_bonus" value="1" <?php echo $setting['shop_used_bonus']==1 ? 'checked' : ''; ?>
                                    type="radio" >开启
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">注册优惠券背景：</label>
                            <div class="controls col-sm-6">
                                <span class="help-inline">建议图片尺寸：320*320像素</span><br>
                                <img class="thumb_img" src="<?php echo htmlentities($setting['reg_bonus_bg']); ?>" style="max-height: 100px;"/><br>
                                <input class="hide" type="text" name="reg_bonus_bg" value="<?php echo htmlentities($setting['reg_bonus_bg']); ?>"/>
                                <button class="btn btn-default" type="button" data-toggle="selectimg">选择图片</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="favour">
                        <header class="panel-heading bg-light">限时优惠相关</header>
                        <div class="form-group m-t">
                            <label class="col-sm-2 control-label">档期间隔：</label>
                            <div class="controls col-lg-3">
                                <select name="favour_time_cycle" class="input-max">
                                    <option value="1" <?php echo $setting[
                                    'favour_time_cycle']==1 ? 'selected' : ''; ?>>1小时一档</option>
                                    <option value="2" <?php echo $setting[
                                    'favour_time_cycle']==2 ? 'selected' : ''; ?>>2小时一档</option>
                                    <option value="3" <?php echo $setting[
                                    'favour_time_cycle']==3 ? 'selected' : ''; ?>>3小时一档</option>
                                </select><span class="help-line">设置一个档期为几个小时，此设置变动后，需要重新选择活动的档期，所以需谨慎操作</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">每日活动开始时间：</label>
                            <div class="controls col-lg-3">
                                <select name="favour_start_time" class="input-max">
                                    <?php $__FOR_START_53311092__=0;$__FOR_END_53311092__=24;for($time=$__FOR_START_53311092__;$time < $__FOR_END_53311092__;$time+=1){ ?>
                                    <option value="<?php echo htmlentities($time); ?>" <?php echo $setting[
                                    'favour_start_time']==$time ? 'selected' : ''; ?>><?php echo htmlentities($time); ?>:00</option>
                                    <?php } ?>
                                </select> <span class="help-line">*设置每天限时优惠活动的开始时间，此设置变动后，需要重新选择活动的档期，所以需谨慎操作</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">首页显示商品数量：</label>
                            <div class="controls col-lg-3">
                                <select name="favour_show_num" class="input-max">
                                    <option value="0">不限制数量</option>
                                    <?php $__FOR_START_2038489698__=1;$__FOR_END_2038489698__=31;for($num=$__FOR_START_2038489698__;$num < $__FOR_END_2038489698__;$num+=1){ ?>
                                    <option value="<?php echo htmlentities($num); ?>" <?php echo $setting[
                                    'favour_show_num']==$num ? 'selected' : ''; ?>><?php echo htmlentities($num); ?>个</option>
                                    <?php } ?>
                                </select> <span class="help-line"></span>
                            </div>
                        </div>

                        <div class="line line-dashed line-lg pull-in"></div>
                        <header class="panel-heading bg-light">拼团相关</header>
                        <div class="form-group m-t">
                            <label class="col-sm-2 control-label">首页显示商品数量：</label>
                            <div class="controls col-lg-3">
                                <select name="fightgroup_show_num" class="input-max">
                                    <option value="0">不限制数量</option>
                                    <?php $__FOR_START_44374078__=1;$__FOR_END_44374078__=31;for($num=$__FOR_START_44374078__;$num < $__FOR_END_44374078__;$num+=1){ ?>
                                    <option value="<?php echo htmlentities($num); ?>" <?php echo $setting[
                                    'fightgroup_show_num']==$num ? 'selected' : ''; ?>><?php echo htmlentities($num); ?>个</option>
                                    <?php } ?>
                                </select> <span class="help-line"></span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="share">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">海报背景图片：</label>
                                <div class="controls col-sm-6">
                                    <img class="thumb_img" src="<?php echo htmlentities($setting['share_goods_bg']); ?>" style="max-height: 100px;"/>
                                    <input class="hide" type="text" id="share_goods_bg_input" name="share_goods_bg"
                                           value="<?php echo htmlentities($setting['share_goods_bg']); ?>"/>
                                    <button class="btn btn-default" type="button" data-toggle="selectimg"
                                            data-fun="changeShaerGoodsBg">选择图片
                                    </button>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label class="col-sm-1 control-label">商品图片位置：</label>
                                <div class="controls">
                                    <input type="text" name="share_goods_xy" class="input-small"
                                           value="<?php echo htmlentities($setting['share_goods_xy']); ?>" placeholder="格式：x,y"> <span
                                        class="help-line">x：距离左边距离，y：距离顶部距离</span>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label class="col-sm-1 control-label">商品图片宽度：</label>
                                <div class="controls">
                                    <input type="text" name="share_goods_wh" class="input-small"
                                           value="<?php echo htmlentities($setting['share_goods_wh']); ?>" placeholder="格式：w,h"> <span
                                        class="help-line">w：宽度，h：高度(px)像素，只可输入数字</span>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label class="col-sm-1 control-label">商品名称位置：</label>
                                <div class="controls">
                                    <input type="text" name="share_goods_name_xy" class="input-small"
                                           value="<?php echo htmlentities($setting['share_goods_name_xy']); ?>" placeholder="格式：x,y"> <span
                                        class="help-line">x：距离左边距离，y：距离顶部距离</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">商品名称颜色：</label>
                                <div class="controls minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left">
                                    <input type="text" name="share_goods_name_color"
                                           class="form-control colorpicker minicolors-input" style="padding-left: 30px;"
                                           data-control="hue" value="<?php echo htmlentities($setting['share_goods_name_color']); ?>" size="7">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">商品名称字体：</label>
                                <div class="controls">
                                    <input type="text" name="share_goods_name_size" data-rule-digits="true"
                                           data-rule-required="true" class="input-small"
                                           value="<?php echo htmlentities($setting['share_goods_name_size']); ?>" placeholder=""> <span
                                        class="help-line">(px)像素，只可输入数字</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">商品名称换行：</label>
                                <div class="controls">
                                    <input type="text" name="share_goods_name_br" data-rule-digits="true"
                                           data-rule-required="true" data-rule-required="true" class="input-small"
                                           value="<?php echo htmlentities($setting['share_goods_name_br']); ?>" placeholder=""> <span
                                        class="help-line">个字，达到长度即换行，0不换行</span>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label class="col-sm-1 control-label">商品价格位置：</label>
                                <div class="controls">
                                    <input type="text" name="share_goods_price_xy" class="input-small"
                                           value="<?php echo htmlentities($setting['share_goods_price_xy']); ?>" placeholder="格式：x,y"> <span
                                        class="help-line">x：距离左边距离，y：距离顶部距离</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">商品价格颜色：</label>
                                <div class="controls minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left">
                                    <input type="text" name="share_goods_price_color"
                                           class="form-control colorpicker minicolors-input" style="padding-left: 30px;"
                                           data-control="hue" value="<?php echo htmlentities($setting['share_goods_price_color']); ?>" size="7">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">商品价格字体：</label>
                                <div class="controls">
                                    <input type="text" name="share_goods_price_size" data-rule-digits="true"
                                           data-rule-required="true" class="input-small"
                                           value="<?php echo htmlentities($setting['share_goods_price_size']); ?>" placeholder=""> <span
                                        class="help-line">(px)像素，只可输入数字</span>
                                </div>
                            </div>
                            <div class="line line-dashed line-lg pull-in " style="width:99%;"></div>
                            <div class="form-group hide">
                                <label class="col-sm-1 control-label">头像位置：</label>
                                <div class="controls">
                                    <input type="text" name="share_goods_avatar_xy" class="input-small"
                                           value="<?php echo htmlentities($setting['share_goods_avatar_xy']); ?>" placeholder="格式：x,y"> <span
                                        class="help-line">x：距离左边距离，y：距离顶部距离</span>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label class="col-sm-1 control-label">头像宽度：</label>
                                <div class="controls">
                                    <input type="text" name="share_goods_avatar_width" data-rule-digits="true"
                                           data-rule-required="true" class="input-small"
                                           value="<?php echo htmlentities($setting['share_goods_avatar_width']); ?>"> <span class="help-line">(px)像素，只可输入数字</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">头像形状：</label>
                                <div class="controls">
                                    <div class="controls">
                                        <label class="radio-inline">
                                            <input name="share_goods_avatar_shape" class="share_goods_avatar_shape"
                                                   value="0" <?php echo $setting['share_goods_avatar_shape']<=0 ? 'checked' : ''; ?>
                                            type="radio">圆形
                                        </label>
                                        <label class="radio-inline">
                                            <input name="share_goods_avatar_shape" class="share_goods_avatar_shape"
                                                   value="1" <?php echo $setting['share_goods_avatar_shape']==1 ? 'checked' : ''; ?>
                                            type="radio" >方形
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label class="col-sm-1 control-label">呢称位置：</label>
                                <div class="controls">
                                    <input type="text" name="share_goods_nickname_xy" class="input-small"
                                           value="<?php echo htmlentities($setting['share_goods_nickname_xy']); ?>" placeholder="格式：x,y"> <span
                                        class="help-line">x：距离左边距离，y：距离顶部距离</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">呢称相对居中：</label>
                                <div class="controls">
                                    <label class="radio-inline">
                                        <input name="share_goods_nickname_center" value="0" <?php echo $setting['share_goods_nickname_center']<=0 ? 'checked' : ''; ?>
                                        type="radio">关闭
                                    </label>
                                    <label class="radio-inline">
                                        <input name="share_goods_nickname_center" value="1" <?php echo $setting['share_goods_nickname_center']==1 ? 'checked' : ''; ?>
                                        type="radio" >开启
                                    </label>
                                    <span class="help-line" style="vertical-align: middle;">x：相对头像居中</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">呢称颜色：</label>
                                <div class="controls minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left">
                                    <input type="text" name="share_goods_nickname_color"
                                           class="form-control colorpicker minicolors-input" style="padding-left: 30px;"
                                           data-control="hue" value="<?php echo htmlentities($setting['share_goods_nickname_color']); ?>" size="7">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">呢称字体大小：</label>
                                <div class="controls">
                                    <input type="text" name="share_goods_nickname_size" data-rule-digits="true"
                                           data-rule-required="true" class="input-small"
                                           value="<?php echo htmlentities($setting['share_goods_nickname_size']); ?>" placeholder=""> <span
                                        class="help-line">(px)像素，只可输入数字</span>
                                </div>
                            </div>
                            <div class="line line-dashed line-lg pull-in " style="width:99%;"></div>
                            <div class="form-group hide">
                                <label class="col-sm-1 control-label">二维码位置：</label>
                                <div class="controls">
                                    <input type="text" name="share_goods_qrcode_xy" class="input-small"
                                           value="<?php echo htmlentities($setting['share_goods_qrcode_xy']); ?>" placeholder="格式：x,y"> <span
                                        class="help-line">x：距离左边距离，y：距离顶部距离</span>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label class="col-sm-1 control-label">二维码宽度：</label>
                                <div class="controls">
                                    <input type="text" name="share_goods_qrcode_width" data-rule-digits="true"
                                           data-rule-required="true" class="input-small"
                                           value="<?php echo htmlentities($setting['share_goods_qrcode_width']); ?>"> <span class="help-line">(px)像素，只可输入数字</span>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <button type="button" class="btn btn-primary" id="show_share_img">点击预览效果，要保存后才能生效</button>
                            <div id="share_img_box">
                                <img src="<?php echo htmlentities($setting['share_goods_bg']); ?>" id="share_bg_img">
                                <div class="share_goods_img hide"><img src="/static/share/goods.jpg"
                                                                       style="width: 100%; height: 100%;"></div>
                                <div class="share_goods_name hide" style="font-weight: bold;">【屈臣氏】新碧双重保湿水感防晒露80克*2件
                                    隔离防晒伤小金帽
                                </div>
                                <div class="share_goods_price hide" style="font-weight: bold;">￥99.00元</div>
                                <div class="share_qrcode hide"><img
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAABICAMAAABiM0N1AAAAkFBMVEUjIjP4+PeTk5pIRlYfHjD5+fkhIDJ8e4QhITEjIjReXWq9vL++vcGZmZ/8/P0kJDb////39/f////6+vkhIDL8/PsLCh8ZGCsfHjARDyS4uLxFRFLa2tzBwMQtKzzIyMxMS1nS0tUDAhOGhY5RUF44N0asrLLw8PDk5OZaWWZranWTkppjYm2dnKSjoqlzcn3upYuXAAAAEXRSTlP+rPLW1Nbz/q3Zytis1qyTrLFFhJEAAAYQSURBVFjDpViLlps4DHXPNId22rO7YIwhPIx5PwL8/9+tZBswJDTtrmZ6onGUWxBXV1LI398v7cftdvuxOmjy4zL2G/nmXxjPUs9lTRTyWngumpfkAXkZS8h3DUTOZgH5B6CLYB+A4DUMzhaRFagICiI9MHNFhD8FcwD6qoCyOD/91KEGovc6jqtGStlRDRTW59i8XoF4nJxthtQgkNvKJEkfWV2XHlW3FjlPwQsPDVDunU2sQBT+6OIiCpYVqHwKLncglUvqbi/svgK5lHpdFYTc2YHoFqw8zzkCbf8BtYHMFQXFcADagvGDJ6B5cbRJtgNRgafjPE2pTrYCYt2og5exY2cg+gi4tru3A7Em4EEmPMaouwN5Mi5UaBEn3jNQFKLx8AQURkhI6h6BAhUcvAZSbA/JEehEyBUoQj6T3weiaZznfSOFSOj/AnLbpOtET+qstJ7afwFSjz8/EvItkMpf6B+AMMddfiIkJtvH0JdAfRGhBdEBiMEVtWdCerLWwUUtn4DcdG60QZ1bhByWZZmaZhZ7shlt7zp4vrf0qUQoM2bXGhIyeiLkHkxf1JptFlCkCem6ByDbbKBLGdGEFDYhx1/ISCzONnLfJqQQ6UpIPpxj5bAC+SR7MiP+btsBISue+ebxkxfBiKCBfH620Ig/pIshIXlkCElI+BQbbuJ/3ddWQvobIS8MgKILC1CYdkKqK4qLq+iv5Of90oCZVPSPxzCl97uEP9q0uYr9Qf6iDH5e/TLknU1IxcPXwfRGvlgN5Mmhh97/OkY7N/KP6QWu99K5IyFN1lvUFI+5WlyOzo38TNNUYJi8a6dFBzLitgKcKa/yh9RAVJ0AMxk690SdpOm9U0DfYCwwekTCHrjc9pEfPqA6oC/64dKC6RtoD8KGtWKcGaoPgPxwEzZeIZd7kDEDFPLFKlEECrcuooHqKAxmpoCwaClVUsv7HYgegVoLiJ2B9BVxHsSYMmiQUYW3VkFB9MhDdAbTxPdpAocIZGaBMiDrICpmcHSymx5shrwJ/IiEk7nq+weeTFVfDRLFF51GpGJcnbLfnf6T/AU6JyOovdTT6qjUL4XLg6furYSkbILeXaMwjQF0amyZZaQc5jnw8a9ISE9A/WKnfq2QipBs0lJJvREc+DxFPbO7iALCsjsCQTJ8rZARDhGeNxeqZ8AVaQekGtIDQB46kQJiEiqzV3XQ6udDBeZIokKqZEHWxv7RD412qgUvZIbUqBPI0eNT15ppHlY9sb1MWYLC5hgnKJmVS1FD6mZwTNEaa91Xdhj9FI/2tywefXHf2W8DUdtc9aNdfZNU39pi3dr+lqgjHkxwciOf1YXlmP6tHYkxrmLllOAMmOwJhvUHnMgyz6sPLBGk4+kf/L59/KX1+Pm7LvIHhPx1X4MrwqkW8jOrEgFHlwg45eo4kbmiMBvOVq1LjXgM0EWgTYzozMZZ0CktZ/i8GCJSe9BC9YC+ZhwlIzVIuZaRYpWRVdiOvD6OfpXVaVep3YVtldp9qaEbf05LDfLQAb04Sy1bCYk82oDa1Y5AcCAr6AuOcbgCyjnhI5yImJNoAmcHog7sisqEPbBvG+QIjp7csQtJIWUZx3V/B8+BD30cp1puhMleIc6E3PpiWRz0yJqz1cp83kU0Iak3WcOkyihI7R8tNUqzgXWTIaR+wDhjgGYboIiHb5eadc5uRnh1pmbGgZt2OGeXyzKUHQA1+Na7XcQatMxO6ujJXxNStTxvJ+Q10K8JuXP4dlhFYX3kxw3yNIzGKGyq00LG4IqM0ivN3oAWUqNldXrY13A87n2zr/VhlpVqYCYZGcHpFJXh1WJ2Io211lLDNCET9ZUGbIFSJqPiYSITJOQDnxqc5B9v9n61QmTCnuFGOKkTRchAr1lLEKyERHpYxjYZOWzZShdQIQPV8g0hoffzjUf0bAdCAg+NzuBboJAABNOtIiQ6GyHDejobsN7+JmKaxpRBrTbglYuz4MlUOrvjKEKS6y+iTqso8hAff7cSMsnA2RTy9ddm14RkKyF3YVPD6IWFvyu12zB6YYaQrp6Tn4BgPGaq98N4jED/AnkJ0hgo7PTGAAAAAElFTkSuQmCC"
                                        style="width: 100%; height: 100%;"></div>
                                <div class="share_avatar hide"><span
                                        class="<?php echo $setting['share_goods_avatar_shape']<=0 ? 'circle' : ''; ?>">头像</span></div>
                                <div class="share_nick_name hide">邀请者用户名</div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="show_ordermessage">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">开启订单轮播：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="show_ordermessage_switch" value="0" <?php echo $setting['show_ordermessage_switch']<1 ? 'checked' : ''; ?>
                                    type="radio">关闭
                                </label>
                                <label class="radio-inline">
                                    <input name="show_ordermessage_switch" value="1" <?php echo $setting['show_ordermessage_switch']==1 ? 'checked' : ''; ?>
                                    type="radio" >开启
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">显示频率/s：</label>
                            <div class="controls">
                                <input type="text" name="show_ordermessage_frequency"
                                       value="<?php echo htmlentities($setting['show_ordermessage_frequency']); ?>"> <span class="help-line"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">获取真订单频率/s:</label>
                            <div class="controls">
                                <input type="text" name="show_ordermessage_rfrequency"
                                       value="<?php echo htmlentities($setting['show_ordermessage_rfrequency']); ?>"> <span class="help-line"></span>
                            </div>
                            <span class="help-line">秒,真订单获取频率</span>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">假订单命中率:</label>
                            <div class="controls">
                                <input type="text" name="show_ordermessage_hit"
                                       value="<?php echo htmlentities($setting['show_ordermessage_hit']); ?>"> <span class="help-line"></span>
                            </div>
                            <span class="help-line">%,每次频率刷新显示的命中率(0~100)</span>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">订单提示语:</label>
                            <div class="controls">
                                <input type="text" name="show_ordermessage_content"
                                       value="<?php echo htmlentities($setting['show_ordermessage_content']); ?>"> <span class="help-line"></span>
                            </div>
                            <span class="help-line">xxx 刚刚下了一条订单</span>
                        </div>
                        <div class="form-group">
                            注意：<br/>显示频率必须要比获取真实频率要小<br/>显示频率不能低于3秒,小于3秒会自动的转换成3秒<br/>显示频率越长，对系统越为友好
                        </div>
                        <!-- <div class="form-group">
                            <label class="col-sm-2 control-label">注册优惠券背景：</label>
                            <div class="controls col-sm-6">
                                <span class="help-inline">建议图片尺寸：320*320像素</span><br>
                                <img class="thumb_img" src="<?php echo htmlentities($setting['reg_bonus_bg']); ?>" style="max-height: 100px;"/><br>
                                <input class="hide" type="text" name="reg_bonus_bg" value="<?php echo htmlentities($setting['reg_bonus_bg']); ?>"/>
                                <button class="btn btn-default" type="button" data-toggle="selectimg">选择图片</button>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
        </section>
        <footer class="footer bg-white b-t p-t">
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-1">
                    <button type="submit" class="btn btn-primary js_save_submit" data-loading-text="保存中...">保存
                    </button>
                    <button type="button" class="btn btn-default" data-toggle="back">取消</button>
                </div>
            </div>
        </footer>
    </section>
</form>

            <?php if(!(empty($data['page_size']) || (($data['page_size'] instanceof \think\Collection || $data['page_size'] instanceof \think\Paginator ) && $data['page_size']->isEmpty()))): ?>
<footer class="footer bg-white b-t">
    <div class="row text-center-xs ">
        <div class="dropdown-box fl m-l m-t">
                 <a data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle">
                      <span class="dropdown-label"><?php echo htmlentities($data['page_size']); ?></span>
                      <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-select dropdown-select-50">

                      <li class="<?php echo htmlentities(tplckval($data['page_size'],20,'active')); ?>">
                          <a href="javascript:;">
                              <input type="radio" name="pageSize" value="20" <?php echo htmlentities(tplckval($data['page_size'],20,'checked')); ?>/>20</a>
                      </li>
                      <li class="<?php echo htmlentities(tplckval($data['page_size'],50,'active')); ?>">
                          <a href="javascript:;">
                              <input type="radio" name="pageSize" value="50"  <?php echo htmlentities(tplckval($data['page_size'],50,'checked')); ?>/>50</a>
                      </li>
                      <li class="<?php echo htmlentities(tplckval($data['page_size'],100,'active')); ?>">
                          <a href="javascript:;">
                              <input type="radio" name="pageSize" value="100" <?php echo htmlentities(tplckval($data['page_size'],100,'checked')); ?>/>100</a>
                      </li>
                  </ul>
        </div>

        <div class=" hidden-sm fl m-t m-r" style="position: absolute; left: 70px;">
            <div class="text-muted fl" >总共<?php echo htmlentities(intval($data['total_count'])); ?>条,共<?php echo htmlentities(intval($data['page_count'])); ?>页<?php echo !empty($data['otherTotal']) ? htmlentities($data['otherTotal']) : ''; ?></div>
            <div class="footer_other fl m-l" ></div>
        </div>
        <div class="col-md-6  text-right text-center-xs fr ">
            <ul class="pagination pagination-sm m-t-sm m-b-none" data-pages-total="<?php echo htmlentities($data['page_count']); ?>" data-page-current="<?php echo htmlentities($data['page']); ?>"></ul>
        </div>
    </div>
</footer>
<?php endif; ?>
    	</section>
    </div>
    <!-- 内容区域 end -->

</div>
<script src="/static/js/layer/layer.js"></script>
<script src="/static/js/art-template.js"></script>
<script src="/static/main/js/app.js"></script>
<script src="/static/assets/sea.js"></script>
<script src="/static/assets/seajs_config.js"></script>
<script type="text/javascript">
	seajs.use("dist/application/app.js");
</script>

<script src="/static/js/colorpicker/jquery.minicolors.js"></script>
<script type="text/javascript">
    function changeShaerGoodsBg(img){
        $('#share_bg_img').attr("src",img);
    }
    $('#show_share_img').click(function () {
        var obj = this;
        $(obj).html('预览图生成中..');
        var data = $('#_form').toJson();
        jq_ajax('<?php echo url("mergeShareImg"); ?>',data,function(){
            $(obj).html('点击预览效果');
            window.open("/upload/share_bg/test_goods_share.jpg?"+ Math.random());
        })
    })
    $(function() {
        //商品图片处理
        $(".share_goods_img").draggable({containment:'#share_img_box',stop: function( event, ui ) {
            //console.log(ui);
            $("input[name='share_goods_xy']").val(ui.position.left+','+ui.position.top);
        }}).resizable({containment:'#share_img_box',stop: function( event, ui ) {
            //console.log(ui);
            $("input[name='share_goods_wh']").val(ui.size.width+','+ui.size.height);
        }})
        var share_goods_xy = '<?php echo htmlentities($setting['share_goods_xy']); ?>';
        share_goods_xy = share_goods_xy.split(',');
        var share_goods_wh = '<?php echo htmlentities($setting['share_goods_wh']); ?>';
        share_goods_wh = share_goods_wh.split(',');
        $(".share_goods_img").css({
                'left':share_goods_xy[0]+'px',
                'top':share_goods_xy[1]+'px',
                'width':share_goods_wh[0]+'px',
            'height':share_goods_wh[1]+'px',
    }).removeClass('hide');
        //商品名称处理
        $(".share_goods_name").draggable({containment:'#share_img_box',stop: function( event, ui ) {
            //console.log(ui);
            $("input[name='share_goods_name_xy']").val(ui.position.left+','+ui.position.top);
        }});
        var share_goods_name_xy = '<?php echo htmlentities($setting['share_goods_name_xy']); ?>';
        share_goods_name_xy = share_goods_name_xy.split(',');
        $(".share_goods_name").css({
                'left':share_goods_name_xy[0]+'px',
                'top':share_goods_name_xy[1]+'px',
                'font-size':<?php echo htmlentities($setting['share_goods_name_size']); ?>+'px',
            'color':'<?php echo htmlentities($setting['share_goods_name_color']); ?>',
    }).removeClass('hide');
        //监听文本框
        $("input[name='share_goods_name_color").on('input propertychange', function() {
            $(".share_goods_name").css({'color':$(this).val()});

        });
        $("input[name='share_goods_name_size']").on('input propertychange', function() {
            $(".share_goods_name").css({'font-size':$(this).val()+'px'});

        });
        //商品价格处理
        $(".share_goods_price").draggable({containment:'#share_img_box',stop: function( event, ui ) {
            //console.log(ui);
            $("input[name='share_goods_price_xy']").val(ui.position.left+','+ui.position.top);
        }});
        var share_goods_price_xy = '<?php echo htmlentities($setting['share_goods_price_xy']); ?>';
        share_goods_price_xy = share_goods_price_xy.split(',');
        $(".share_goods_price").css({
                'left':share_goods_price_xy[0]+'px',
                'top':share_goods_price_xy[1]+'px',
                'font-size':<?php echo htmlentities($setting['share_goods_price_size']); ?>+'px',
            'color':'<?php echo htmlentities($setting['share_goods_price_color']); ?>',
    }).removeClass('hide');
        //监听文本框
        $("input[name='share_goodsprice_color").on('input propertychange', function() {
            $(".share_goods_price").css({'color':$(this).val()});

        });
        $("input[name='share_goods_price_size']").on('input propertychange', function() {
            $(".share_goods_price").css({'font-size':$(this).val()+'px'});

        });


        //二维码处理
        $(".share_qrcode").draggable({containment:'#share_img_box',stop: function( event, ui ) {
            //console.log(ui);
            $("input[name='share_goods_qrcode_xy']").val(ui.position.left+','+ui.position.top);
        }}).resizable({containment:'#share_img_box',stop: function( event, ui ) {
            //console.log(ui);
            $("input[name='share_goods_qrcode_width']").val(ui.size.width);
            $(".share_qrcode").css({'height':ui.size.width+'px'});
        }})
        var share_goods_qrcode_xy = '<?php echo htmlentities($setting['share_goods_qrcode_xy']); ?>';
        share_goods_qrcode_xy = share_goods_qrcode_xy.split(',');
        $(".share_qrcode").css({
                'left':share_goods_qrcode_xy[0]+'px',
                'top':share_goods_qrcode_xy[1]+'px',
                'width':<?php echo htmlentities($setting['share_goods_qrcode_width']); ?>+'px',
                'height':<?php echo htmlentities($setting['share_goods_qrcode_width']); ?>+'px',
        }).removeClass('hide');
//头像处理
        $(".share_avatar").draggable({containment:'#share_img_box',stop: function( event, ui ) {
            //console.log(ui);
            $("input[name='share_goods_avatar_xy']").val(ui.position.left+','+ui.position.top);
        }}).resizable({containment:'#share_img_box',stop: function( event, ui ) {
            //console.log(ui);
            $("input[name='share_goods_avatar_width").val(ui.size.width);
            $(".share_avatar").css({'height':ui.size.width+'px'});
        }});
        var share_goods_avatar_xy = '<?php echo htmlentities($setting['share_goods_avatar_xy']); ?>';
        share_goods_avatar_xy = share_goods_avatar_xy.split(',');
        $(".share_avatar").css({
                'left':share_goods_avatar_xy[0]+'px',
                'top':share_goods_avatar_xy[1]+'px',
                'width':<?php echo htmlentities($setting['share_goods_avatar_width']); ?>+'px',
            'height':<?php echo htmlentities($setting['share_goods_avatar_width']); ?>+'px',
    }).removeClass('hide');
        $('.share_goods_avatar_shape').click(function () {
            if ($(this).val() == 0){
                if ($(".share_avatar span").hasClass('circle')){
                    return false;
                }
                $(".share_avatar span").addClass('circle');
            }else{
                $(".share_avatar span").removeClass('circle');
            }
        })

        //呢称处理
        $(".share_nick_name").draggable({containment:'#share_img_box',stop: function( event, ui ) {
            //console.log(ui);
            $("input[name='share_goods_nickname_xy").val(ui.position.left+','+ui.position.top);
        }});
        var share_goods_nickname_xy = '<?php echo htmlentities($setting['share_goods_nickname_xy']); ?>';
        share_goods_nickname_xy = share_goods_nickname_xy.split(',');
        $(".share_nick_name").css({
                'left':share_goods_nickname_xy[0]+'px',
                'top':share_goods_nickname_xy[1]+'px',
                'font-size':<?php echo htmlentities($setting['share_goods_nickname_size']); ?>+'px',
            'color':'<?php echo htmlentities($setting['share_goods_nickname_color']); ?>',
    }).removeClass('hide');
        //监听文本框
        $("input[name='share_goods_nickname_color']").on('input propertychange', function() {
            $(".share_nick_name").css({'color':$(this).val()});

        });
        $("input[name='share_goods_nickname_size']").on('input propertychange', function() {
            $(".share_nick_name").css({'font-size':$(this).val()+'px'});

        });
    })





    //--jQuery MiniColors--
    $('.colorpicker').each(function () {
        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            defaultValue: $(this).attr('data-defaultValue') || '',
            inline: $(this).attr('data-inline') === 'true',
            letterCase: $(this).attr('data-letterCase') || 'lowercase',
            opacity: $(this).attr('data-opacity'),
            position: $(this).attr('data-position') || 'bottom left',
            change: function (hex, opacity) {
                if (!hex) return;
                if (opacity) hex += ', ' + opacity;
                try {
                    console.log(hex);
                } catch (e) { }
            },
            theme: 'bootstrap'
        });

    });
</script>

</body>
</html>