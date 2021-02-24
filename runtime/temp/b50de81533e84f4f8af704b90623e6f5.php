<?php /*a:3:{s:67:"F:\WWW\M\application\distribution\view\sys_admin\setting\index.html";i:1614001476;s:53:"F:\WWW\M\application\mainadmin\view\layouts\base.html";i:1613985988;s:53:"F:\WWW\M\application\mainadmin\view\layouts\page.html";i:1613985988;}*/ ?>
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
    
<link href="/static/main/css/stylesheets/uploadify/uploadify.min.css" rel="stylesheet"/>
<link href="/static/main/css/stylesheets/page/goods.css?v=1" rel="stylesheet"/>
<link rel="stylesheet" href="/static/js/jquery/jquery_ui/jquery-ui.css">
<script src="/static/js/jquery/jquery_ui/jquery-ui.js"></script>
<style>
    @font-face{

        　　font-family:'msyhbd';
        　　src:url('/static/share/msyhbd.ttc');

    }

    #share_img_box{
        font-family:'msyhbd';
        width:375px;height: 666px; border: 1px solid #000;
        overflow: hidden;
        position: relative;
    }
    #share_bg_img{width: 100%;}
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
        	

<header>
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-ellipsis-v"></i>
                <strong>分销设置</strong>
            </li>
        </ul>
        <div style="float:right; padding-right:10px;">
            <a class="refresh" id="refresh-toggler" href=""><i class="fa fa-refresh"></i></a>
        </div>
    </div>
</header>
<form class="form-horizontal form-validate form_vbox" id="_form" method="post" action="<?php echo url('save'); ?>">
    <section class="vbox">
        <section class="scrollable  wrapper w-f">
            <section class="panel panel-default ">
                <header>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#basic" data-toggle="tab">基本配置</a></li>
                        <!-- <li><a href="#bydividend" data-toggle="tab">分佣说明</a></li>
                        <li><a href="#byrole" data-toggle="tab">身份升级说明</a></li>
                        <li><a href="#byrolegoods" data-toggle="tab">购买身份商品协议</a></li> -->
                        <li><a href="#background" data-toggle="tab">分享海报</a></li>
                    </ul>
                </header>

                <div class="tab-content ">
                    <div class="tab-pane active" id="basic">
                        <div class="form-group m-t">
                            <label class=" control-label">身份升级机制：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="level_up_type" value="0" <?php echo $Dividend['level_up_type']==0 ? 'checked' : ''; ?>
                                    type="radio">
                                    逐级升级
                                </label>
                                <label class="radio-inline">
                                    <input name="level_up_type" value="1" <?php echo $Dividend['level_up_type']==1 ? 'checked' : ''; ?>
                                    type="radio">
                                    可跨级升级（满条件即可）
                                </label>
                            </div>
                        </div>
                        <div class="form-group m-t">
                            <label class=" control-label">是否开启推荐：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="status" value="0" <?php echo $Dividend['status']==0 ? 'checked' : ''; ?> type="radio"
                                    >停用
                                </label>
                                <label class="radio-inline">
                                    <input name="status" value="1" <?php echo $Dividend['status']==1 ? 'checked' : ''; ?> type="radio">启用
                                </label>
                                <span class="help-inline">（停用后，将不执行推荐关系绑定）</span>
                            </div>
                        </div>

                        <div class="form-group m-t">
                            <label class=" control-label">分享权限：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="share_by_role" value="0" <?php echo $Dividend['share_by_role']==0 ? 'checked' : ''; ?>
                                    type="radio"> 无需身份
                                </label>
                                <label class="radio-inline">
                                    <input name="share_by_role" value="1" <?php echo $Dividend['share_by_role']==1 ? 'checked' : ''; ?>
                                    type="radio"> 需分佣身份
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" control-label">佣金到帐时间：</label>
                            <div class="col-sm-8 controls">
                                <strong><?php echo $shop_after_sale_limit==0 ? '订单签收到帐' : htmlentities($shop_after_sale_limit.'天'); ?></strong>
                                <span class="help-inline">（与订单申请售后时间一致，即签收后过了此时间即到帐，如需修改请前往【商城-商城设置】中修改）</span>

                            </div>
                        </div>

                    </div>
                    <div class="tab-pane " id="bydividend">
                        <div class="form-group">
                            <label class="control-label">是否显示：</label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input name="setting[dividend_directions_status]" value="0" class="js_undertake"
                                           type="radio" <?php echo htmlentities(tplckval($setting['dividend_directions_status'],'=0','checked',true)); ?>>隐藏
                                </label>
                                <label class="radio-inline">
                                    <input name="setting[dividend_directions_status]" value="1" class="js_undertake "
                                           type="radio" <?php echo htmlentities(tplckval($setting['dividend_directions_status'],'=1','checked')); ?>>
                                    显示
                                </label>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="form-group publicnote_status">
                            <label class="control-label">分佣说明：</label>
                            <div class="col-sm-9 " style="padding-left:0px;">
                            <textarea rows="8" class="input-max hd" data-toggle="kindeditor" data-config="simple"
                                      data-kdheight="150" data-tongji="remain"
                                      data-tongji-target=".js_kindeditor_tongji" data-rule-rangelength="[0,50000]" d
                                      name="setting[dividend_directions]" style="visibility:hidden;"><?php echo $setting['dividend_directions']; ?></textarea>
                                <p class="pull-right js_kindeditor_tongji">还可输入{0}字</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="byrole">
                        <div class="form-group">
                            <label class=" control-label">是否显示：</label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input name="setting[role_directions_status]" value="0" class="js_undertake"
                                           type="radio" <?php echo htmlentities(tplckval($setting['role_directions_status'],'=0','checked',true)); ?>>隐藏
                                </label>
                                <label class="radio-inline">
                                    <input name="setting[role_directions_status]" value="1" class="js_undertake "
                                           type="radio" <?php echo htmlentities(tplckval($setting['role_directions_status'],'=1','checked')); ?>>
                                    显示
                                </label>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="form-group publicnote_status">
                            <label class="control-label">身份升级说明：</label>
                            <div class="col-sm-9 " style="padding-left:0px;">
                            <textarea rows="8" class="input-max hd" data-toggle="kindeditor" data-config="simple"
                                      data-kdheight="150" data-tongji="remain"
                                      data-tongji-target=".js_kindeditor_tongji" data-rule-rangelength="[0,50000]"
                                      name="setting[role_directions]" style="visibility:hidden;"><?php echo $setting['role_directions']; ?></textarea>
                                <p class="pull-right js_kindeditor_tongji">还可输入{0}字</p>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane " id="byrolegoods">
                        <div class="form-group ">
                            <label class="control-label">协议内容：</label>
                            <div class="col-sm-9 " style="padding-left:0px;">
                            <textarea rows="8" class="input-max hd" data-toggle="kindeditor" data-config="simple"
                                      data-kdheight="150" data-tongji="remain"
                                      data-tongji-target=".js_kindeditor_tongji_b" data-rule-rangelength="[0,50000]"
                                      name="setting[role_goods_directions]" style="visibility:hidden;"><?php echo $setting['role_goods_directions']; ?></textarea>
                                <p class="pull-right js_kindeditor_tongji_b">还可输入{0}字</p>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane " id="background">

                        <div class="form-group">
                            <label class="col-sm-1 control-label">海报背景图片：</label>
                            <div class="col-sm-10">
                                <div class="js_upload_container">
                                    <div class="js_file_upload ">
                                        <button type="button" class="btn btn-default js_new_upload"
                                                data-fun="updateShareBg" data-count="5" data-submitname="ShareBg"
                                                data-uploadpath="<?php echo url('uploadShareBg'); ?>"
                                                data-delpath="<?php echo url('removeImg'); ?>"
                                                style="position: relative; z-index: 1;">上传图片
                                        </button>
                                        <span class="maroon">*</span>
                                        <span class="help-inline"><small>建议尺寸：建议尺寸750*1330px，JPG、PNG格式，图片小于2MB，默认显示第1张图片，最多5张 (可拖拽图片调整显示顺序) </small></span>
                                    </div>
                                    <div class="uploadify-queue js_file_upload_queue">
                                    </div>
                                    <ul class="ipost-list ui-sortable js_fileList share_img_list" data-required="true">
                                        <?php if(is_array($share_bg) || $share_bg instanceof \think\Collection || $share_bg instanceof \think\Paginator): $i = 0; $__LIST__ = $share_bg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shbg): $mod = ($i % 2 );++$i;?>
                                        <li class="imgbox" data-path="<?php echo htmlentities($shbg); ?>">
                                            <a class="item_new_close item_close" href="javascript:void(0)"
                                               data-delpath="<?php echo url('removeImg'); ?>" title="删除"></a>
                                            <span class="item_box"><img src="<?php echo htmlentities($shbg); ?>"></span>
                                            <input type="hidden" name="ShareBg[path][]" value="<?php echo htmlentities($shbg); ?>">
                                        </li>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in " style="width:99%;"></div>
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <div class="form-group hide">
                                    <label class="col-sm-3 control-label">头像位置：</label>
                                    <div class="controls">
                                        <input type="text" name="setting[share_avatar_xy]" class="input-small"
                                               value="<?php echo htmlentities($setting['share_avatar_xy']); ?>" placeholder="格式：x,y"> <span
                                            class="help-line">x：距离左边距离，y：距离顶部距离</span>
                                    </div>
                                </div>
                                <div class="form-group hide">
                                    <label class="col-sm-3 control-label">头像宽度：</label>
                                    <div class="controls">
                                        <input type="text" name="setting[share_avatar_width]" data-rule-digits="true"
                                               data-rule-required="true" class="input-small"
                                               value="<?php echo htmlentities($setting['share_avatar_width']); ?>"> <span class="help-line">(px)像素，只可输入数字</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">头像形状：</label>
                                    <div class="controls">
                                        <div class="controls">
                                            <label class="radio-inline">
                                                <input class="share_avatar_shape" name="setting[share_avatar_shape]"
                                                       value="0" <?php echo $setting['share_avatar_shape']<=0 ? 'checked' : ''; ?>
                                                type="radio">圆形
                                            </label>
                                            <label class="radio-inline">
                                                <input class="share_avatar_shape" name="setting[share_avatar_shape]"
                                                       value="1" <?php echo $setting['share_avatar_shape']==1 ? 'checked' : ''; ?>
                                                type="radio" >方形
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group hide">
                                    <label class="col-sm-3 control-label">呢称位置：</label>
                                    <div class="controls">
                                        <input type="text" name="setting[share_nick_name_xy]" class="input-small"
                                               value="<?php echo htmlentities($setting['share_nick_name_xy']); ?>" placeholder="格式：x,y"> <span
                                            class="help-line">x：距离左边距离，y：距离顶部距离</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">呢称相对居中：</label>
                                    <div class="controls">
                                        <label class="radio-inline">
                                            <input name="setting[share_nick_name_center]" value="0" <?php echo $setting['share_nick_name_center']<=0 ? 'checked' : ''; ?>
                                            type="radio">关闭
                                        </label>
                                        <label class="radio-inline">
                                            <input name="setting[share_nick_name_center]" value="1" <?php echo $setting['share_nick_name_center']==1 ? 'checked' : ''; ?>
                                            type="radio" >开启
                                        </label>
                                        <span class="help-line" style="vertical-align: middle;">x：相对头像居中</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">呢称颜色：</label>
                                    <div class="controls minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left">
                                        <input type="text" name="setting[share_nick_name_color]"
                                               class="form-control colorpicker minicolors-input"
                                               style="padding-left: 30px;" data-control="hue"
                                               value="<?php echo htmlentities($setting['share_nick_name_color']); ?>" size="7">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">呢称字体大小：</label>
                                    <div class="controls">
                                        <input type="text" name="setting[share_nick_name_size]" data-rule-digits="true"
                                               data-rule-required="true" class="input-small"
                                               value="<?php echo htmlentities($setting['share_nick_name_size']); ?>" placeholder=""> <span
                                            class="help-line">(px)像素，只可输入数字</span>
                                    </div>
                                </div>

                                <div class="form-group hide">
                                    <label class="col-sm-3 control-label">二维码位置：</label>
                                    <div class="controls">
                                        <input type="text" name="setting[share_qrcode_xy]" class="input-small"
                                               value="<?php echo htmlentities($setting['share_qrcode_xy']); ?>" placeholder="格式：x,y"> <span
                                            class="help-line">x：距离左边距离，y：距离顶部距离</span>
                                    </div>
                                </div>
                                <div class="form-group hide">
                                    <label class="col-sm-3 control-label">二维码宽度：</label>
                                    <div class="controls">
                                        <input type="text" name="setting[share_qrcode_width]" data-rule-digits="true"
                                               data-rule-required="true" class="input-small"
                                               value="<?php echo htmlentities($setting['share_qrcode_width']); ?>"> <span class="help-line">(px)像素，只可输入数字</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-primary" id="show_share_img">点击预览效果</button>
                                <div id="share_img_box">
                                    <img src="<?php echo htmlentities($share_bg[0]); ?>" id="share_bg_img">
                                    <div class="share_qrcode hide"><img
                                            src="data:image/png;base64,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"
                                            style="width: 100%; height: 100%;"></div>
                                    <div class="share_avatar hide"><span
                                            class="<?php echo $setting['share_avatar_shape']<=0 ? 'circle' : ''; ?>">头像</span></div>
                                    <div class="share_nick_name hide">邀请者用户名</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </section>
        <footer class="footer bg-white b-t p-t">
            <div class="form-group">
                <div class="controls  col-sm-offset-1">
                    <button type="submit" class="btn btn-primary" data-loading-text="保存中...">保存</button>
                </div>
            </div>
        </footer>
    </section>
</form>

<script type="text/javascript">
    function updateShareBg(img){
        $('#share_bg_img').attr("src",img.image.path);
    }

    $(function() {
        $('.share_img_list img').on('click',function () {
            $('#share_bg_img').attr("src",$(this).attr('src'));
        })
        //二维码处理
        $(".share_qrcode").draggable({containment:'#share_img_box',stop: function( event, ui ) {
            //console.log(ui);
            $("input[name='setting[share_qrcode_xy]']").val(ui.position.left+','+ui.position.top);
        }}).resizable({containment:'#share_img_box',stop: function( event, ui ) {
            //console.log(ui);
            $("input[name='setting[share_qrcode_width]']").val(ui.size.width);
            $(".share_qrcode").css({'height':ui.size.width+'px'});
        }})
        var share_qrcode_xy = '<?php echo htmlentities($setting['share_qrcode_xy']); ?>';
        share_qrcode_xy = share_qrcode_xy.split(',');
        $(".share_qrcode").css({
                'left':share_qrcode_xy[0]+'px',
                'top':share_qrcode_xy[1]+'px',
                'width':<?php echo htmlentities($setting['share_qrcode_width']); ?>+'px',
                'height':<?php echo htmlentities($setting['share_qrcode_width']); ?>+'px',
        }).removeClass('hide');

        //头像处理
        $(".share_avatar").draggable({containment:'#share_img_box',stop: function( event, ui ) {
            //console.log(ui);
            $("input[name='setting[share_avatar_xy]']").val(ui.position.left+','+ui.position.top);
        }}).resizable({containment:'#share_img_box',stop: function( event, ui ) {
            //console.log(ui);
            $("input[name='setting[share_avatar_width]']").val(ui.size.width);
            $(".share_avatar").css({'height':ui.size.width+'px'});
        }});
        var share_avatar_xy = '<?php echo htmlentities($setting['share_avatar_xy']); ?>';
        share_avatar_xy = share_avatar_xy.split(',');
        $(".share_avatar").css({
                'left':share_avatar_xy[0]+'px',
                'top':share_avatar_xy[1]+'px',
                'width':<?php echo htmlentities($setting['share_avatar_width']); ?>+'px',
                'height':<?php echo htmlentities($setting['share_avatar_width']); ?>+'px',
        }).removeClass('hide');
        $('.share_avatar_shape').click(function () {
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
            $("input[name='setting[share_nick_name_xy]']").val(ui.position.left+','+ui.position.top);
        }});
        var share_nick_name_xy = '<?php echo htmlentities($setting['share_nick_name_xy']); ?>';
        share_nick_name_xy = share_nick_name_xy.split(',');
        $(".share_nick_name").css({
                'left':share_nick_name_xy[0]+'px',
                'top':share_nick_name_xy[1]+'px',
                'font-size':<?php echo htmlentities($setting['share_nick_name_size']); ?>+'px',
                'color':'<?php echo htmlentities($setting['share_nick_name_color']); ?>',
        }).removeClass('hide');
        //监听文本框
        $("input[name='setting[share_nick_name_color]']").on('input propertychange', function() {
            $(".share_nick_name").css({'color':$(this).val()});

        });
        $("input[name='setting[share_nick_name_size]']").on('input propertychange', function() {
            $(".share_nick_name").css({'font-size':$(this).val()+'px'});

        });

    })
    var arrival_code = Math.ceil(Math.random() * 1000) + 1000;
    $('#sarrival_code_em').html(arrival_code);
    $('#evalArrival').click(function () {
        var _arrival_code = $('#arrival_code').val();
        if (_arrival_code == '') {
            _alert('请输入校验码，后再操作.', true);
            return false;
        }
        if (_arrival_code != arrival_code) {
            _alert('校验码为' + arrival_code + '，请核实输入是否正确.', true);
            return false;
        }
        _confirm('确定执行 - 手动执行结算？', function () {
            jq_ajax('<?php echo url("evalArrival"); ?>', '', function (res) {
                _alert(res.msg, true);
            });
        });
    })
    $('#show_share_img').click(function () {
        var obj = this;
        $(obj).html('预览图生成中..');
        var data = $('#_form').toJson();
        jq_ajax('<?php echo url("mergeShareImg"); ?>',data,function(){
            $(obj).html('点击预览效果');
            window.open("/upload/share_bg/test_share.jpg?"+ Math.random());
        })
    })
</script>


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
    seajs.use(["dist/plupload/init.js", "dist/goods/init.js"])
</script>

</body>
</html>