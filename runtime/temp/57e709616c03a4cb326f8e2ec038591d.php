<?php /*a:9:{s:56:"F:\WWW\M\application\shop\view\sys_admin\goods\info.html";i:1614088809;s:53:"F:\WWW\M\application\mainadmin\view\layouts\base.html";i:1613985988;s:61:"F:\WWW\M\application\shop\view\sys_admin\goods\basicInfo.html";i:1614088840;s:55:"F:\WWW\M\application\shop\view\sys_admin\goods\sku.html";i:1613985989;s:59:"F:\WWW\M\application\mainadmin\view\layouts\web_upload.html";i:1613985988;s:61:"F:\WWW\M\application\shop\view\sys_admin\goods\otherInfo.html";i:1614088917;s:62:"F:\WWW\M\application\shop\view\sys_admin\goods\promotions.html";i:1614084728;s:63:"F:\WWW\M\application\shop\view\sys_admin\goods\commissions.html";i:1614089542;s:53:"F:\WWW\M\application\mainadmin\view\layouts\page.html";i:1613985988;}*/ ?>
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
    
<link href="/static/main/css/stylesheets/page/goods.css?v=1" rel="stylesheet"/>

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
                <strong><?php echo $row['goods_id']>0 ? "编辑商品" : "添加商品"; ?></strong>
            </li>
        </ul>

        <a class="pull-right pointer p-r" data-toggle="back" title="返回"><i class="fa fa-reply"></i></a>
    </div>
</header>
<form class="form-horizontal form-validate form_vbox" method="post" action="<?php echo url('info'); ?>">
    <section class="vbox">
        <section class="scrollable wrapper w-f">

            <section class="panel panel-default">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品名称：</label>
                        <div class="col-sm-7 must">
                            <input type="text" class="input-max" data-rule-maxlength="80" data-rule-required="true"
                                   data-msg-required="商品名称不能为空" name="goods_name" value="<?php echo htmlentities($row['goods_name']); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品简称：</label>
                        <div class="col-sm-5">
                            <input type="text" class="input-max" data-rule-maxlength="60" name="short_name"
                                   value="<?php echo htmlentities($row['short_name']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品分类：</label>
                        <div class="col-sm-3 must">
                            <select name="cid" style="width:100%;" data-toggle="select2" data-notsearch="true" data-placeholder="选择分类">
                                <option value="">选择分类</option>
                                <?php echo $classListOpt; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品品牌：</label>
                        <div class="col-sm-3 ">
                            <select name="brand_id" style="width:100%;" data-toggle="select2" data-notsearch="true" >
                                <option value="">选择品牌</option>
                                <?php echo $brandListOpt; ?>
                            </select>
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品类型</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input name="goods_type" value="1" <?php echo htmlentities(tplckval($row['goods_type'],'<2' ,'checked')); ?>
                                type="radio" >普通商品
                            </label>
                            <label class="radio-inline">
                                <input name="goods_type" value="2" <?php echo htmlentities(tplckval($row['goods_type'],'>1' ,'checked')); ?>
                                type="radio" >排位商品
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">运费计算方式：</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input name="undertake" value="0" <?php echo htmlentities(tplckval($row['freight_template'],'=0' ,'checked',true)); ?>
                                class="js_undertake" type="radio">卖家承担运费
                            </label>
                            <label class="radio-inline">
                                <input name="undertake" value="1" <?php echo $row['freight_template']>0 ||
                                $row['freight_template'] ==-1 ? 'checked' : ''; ?> class="js_undertake
                                js_freight_container_show" type="radio">
                                买家承担运费
                            </label>
                            <label class="js_freight_container"
                                   style="display:<?php echo $row['freight_template']>0 || $row['freight_template'] ==-1 ? '' : 'none'; ?>; position:relative;">
                                <select name="freight_template" data-rule-required="true" aria-required="true"
                                        aria-invalid="true">
                                    <option value="-1" selected>-- 使用默认运费模板 --</option>
                                    <?php if(is_array($ShippingTpl) || $ShippingTpl instanceof \think\Collection || $ShippingTpl instanceof \think\Paginator): $i = 0; $__LIST__ = $ShippingTpl;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sfrow): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo htmlentities($sfrow['sf_id']); ?>" <?php echo $row[
                                    'freight_template']==$sfrow['sf_id'] ? 'selected' : ''; ?>><?php echo htmlentities($sfrow['sf_name']); ?><?php echo $sfrow['is_default']==1 ? '(默认)' : ''; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; if(empty($ShippingTpl) || (($ShippingTpl instanceof \think\Collection || $ShippingTpl instanceof \think\Paginator ) && $ShippingTpl->isEmpty())): ?>
                                    <option value="0" selected>-- 没有运费模板 --</option>
                                    <?php endif; ?>
                                </select>
                            </label>

                        </div>
                    </div>
                    <div class="form-group hide">
                        <label class="col-sm-2 control-label">是否分销商品：</label>
                        <div class="col-sm-10">
                            <!-- <label class="radio-inline">
                                <input name="is_dividend" value="0" <?php echo htmlentities(tplckval($row['is_dividend'],'<1' ,'checked')); ?>
                                type="radio" >不是
                            </label>
                            <label class="radio-inline">
                                <input name="is_dividend" value="1" <?php echo htmlentities(tplckval($row['is_dividend'],'>0' ,'checked')); ?>
                                type="radio" >是
                            </label> -->
                            <label class="radio-inline">
                                <input name="is_dividend" value="1" checked type="radio" >是
                            </label>
                        </div>
                    </div>
                    <div class="form-group hide">
                        <label class="col-sm-2 control-label">是否出售：</label>
                        <div class="col-sm-6">
                            <label class="radio inline">
                                <input type="checkbox" name="is_alone_sale" value="1" <?php echo $row['is_alone_sale']==1 ||
                                $row['goods_id']==0 ? 'checked' : ''; ?>> 打勾表示能作为普通商品销售，否则只能作为配件、赠品或积分兑换.
                            </label>
                        </div>
                    </div>

                    <?php if($row['supplyer_id'] > 0): ?>
                    <div class="line line-dashed line-lg pull-in" style="width:99%;"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品状态：</label>
                        <div class="col-sm-5 m-t-mc">
                            <?php echo htmlentities($goods_status[$row['isputaway']]); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">操作选项：</label>

                        <div class="col-sm-5">
                            <label class="radio-inline">
                                <input type="radio" name="opt" value="0" checked/>不操作
                            </label>
                            <?php if($row['isputaway'] == 10): ?>
                            <label class="radio-inline">
                                <input type="radio" name="opt" value="1"/>允许上架
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="opt" value="11"/>拒绝上架
                            </label>
                            <?php elseif($row['isputaway'] == 1): ?>
                            <label class="radio-inline">
                                <input type="radio" name="opt" value="12"/>下架商品
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">操作备注：</label>
                        <div class="col-sm-8">
                            <textarea name="opt_remark" style=" width:80%; height:100px;"></textarea>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <header>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#basicInfo" data-toggle="tab">基本信息</a></li>
                        <li><a href="#otherInfo" data-toggle="tab">其它信息</a></li>
                        <li class="commissions-box hide"><a href="#commissions" data-toggle="tab">分佣设置</a></li>
                        <!-- <li><a href="#promotions" data-toggle="tab">促销优惠</a></li> -->
                        <!--<li><a href="#attribute" data-toggle="tab">商品属性</a></li>-->
                        <li><a href="#details" data-toggle="tab" class="hide">PC商品详情</a></li>
                        <li><a href="#mDetails" data-toggle="tab">H5详情</a></li>
                        <?php if($row['goods_id'] > '0'): ?>
                        <li><a href="#log" data-toggle="tab">操作日志</a></li>
                        <?php endif; ?>
                    </ul>
                </header>

                <div class="tab-content">
                    <div class="tab-pane active" id="basicInfo">
                        
<div class="form-group">
    <label class="col-sm-2 control-label" >商品图片：</label>
    <div class="col-sm-10">
        <div class="js_upload_container">
            <div class="js_file_upload ">
                <button type="button" class="btn btn-default js_new_upload" data-submitname="GoodsImages" data-count="20" data-uploadpath="<?php echo url('mainAdmin/attachment/goodsUpload'); ?>" data-delpath="<?php echo url('mainAdmin/attachment/removeImg'); ?>" data-data="{ 'gid':'<?php echo htmlentities(intval($row['goods_id'])); ?>' }" style="position: relative; z-index: 1;">商品图片</button>
                <span class="maroon">*</span>
                <span class="help-inline">(建议尺寸：640*640或800*800)默认显示第1张图片，最多20张 (<small>可拖拽图片调整显示顺序 </small>)</span>
            </div>
            <div class="uploadify-queue js_file_upload_queue">
            </div>
             <ul class="ipost-list ui-sortable js_fileList" data-required="true">
<?php if(is_array($goods_imgs) || $goods_imgs instanceof \think\Collection || $goods_imgs instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_imgs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gg): $mod = ($i % 2 );++$i;?>
<li class="imgbox" data-post-id="<?php echo htmlentities($gg['img_id']); ?>" data-path="<?php echo htmlentities($gg['goods_img']); ?>">
<a class="item_new_close item_close" href="javascript:void(0)" data-delpath="<?php echo url('mainAdmin/attachment/removeImg'); ?>"  title="删除" data-path="<?php echo htmlentities($gg['goods_img']); ?>" data-post-id="<?php echo htmlentities($gg['img_id']); ?>"></a>  
<input value="<?php echo htmlentities($gg['img_id']); ?>" name="GoodsImages[id][]" type="hidden"> 
<input value="<?php echo htmlentities($gg['goods_img']); ?>" name="GoodsImages[path][]" type="hidden"> 
<span class="item_box"><img src="<?php echo htmlentities($gg['goods_thumb']); ?>"></span>
</li>
<?php endforeach; endif; else: echo "" ;endif; ?>                                           
             </ul>
        </div>
    </div>
</div>

<div class="line line-dashed line-lg pull-in" ></div>
<div  class="form-group hide" >
    <label class="col-sm-2 control-label">商品规格：</label>
    <div class="col-sm-10">
        <?php if($row['goods_id'] > 0): ?>
         <div ><span class="help-inline"> <?php echo $row['is_spec']==0 ? '统一规格' : '多规格'; ?></span></div>
        <?php endif; ?>
            <div class="f-l <?php echo $row['goods_id']<1 ? '' : 'hide'; ?>">
                <label class="radio-inline">
                    <input type="radio" name="is_spec" value="0" data-toggle="specification-enable" data-enable="false"  <?php echo htmlentities(tplckval($row['is_spec'],'=0','checked',true)); ?>  />统一规格
                </label>
                <label class="radio-inline">
                    <input type="radio" name="is_spec" value="1"  data-toggle="specification-enable" data-enable="true" <?php echo htmlentities(tplckval($row['is_spec'],'=1','checked')); ?>/>
                    多规格</label>
                <span class=" help-inline">*添加商品后不能修改规格</span>
            </div>

            <div class="m-t-md col-sm-8 specificationstable hd">

                选择商品模型
                <?php if($row['goods_id'] < 1): ?>
                <select name="sku_model" id="skuModelId" <?php echo $is_supplyer==true ? 'disabled' : ''; ?> data-toggle="changeSkuModelId">
                <?php echo $skuModelOpt; ?>
                </select>
                <span  style="color:#f30;">* 修改模型，将会删除旧有的sku记录</span>
                <?php else: ?>
                <select disabled id="skuModelId" <?php echo $is_supplyer==true ? 'disabled' : ''; ?> data-toggle="changeSkuModelId">
                    <?php echo $skuModelOpt; ?>
                </select>
                <input type="hidden" name="sku_model" value="<?php echo htmlentities(intval($row['sku_model'])); ?>">
                <?php endif; ?>

            </div>




        <div class="clearfix"></div>
        <div data-toggle="specifications" class="hd <?php echo !empty($is_supplyer) ? 'hide' : ''; ?>"><i class="fa fa-spinner fa-spin"></i></div>

    </div>
</div>
<div class="line line-dashed line-lg pull-in specificationstable hd" style="width:98%;"></div>

<div class="form-group specificationstable hd">
    <label class="col-sm-2 control-label">价格&库存：</label>
    <div class="table-responsive tab-content p-l" style="width:81%;" data-toggle="specificationstable">
        <span class="help-inline p-t ">请选择规格</span>
    </div>
</div>

<div class="nospecifications <?php echo $row['is_spec']==1 ? 'hd' : ''; ?>">
    <?php if($is_supplyer == false): ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">货号：</label>
        <div class="col-sm-4 ">
            <input type="text" class="input-medium" name="goods_sn" value="<?php echo htmlentities($row['goods_sn']); ?>" data-rule-maxlength="20" data-rule-required="true" data-msg-required="商品货号不能为空">
            <span  style="color:#f30;"> *</span>
        </div>
        <div class="help-inline"></div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">条形码：</label>
        <div class="col-sm-2 ">
            <input type="text" class="input-medium" name="bar_code" value="<?php echo htmlentities($row['bar_code']); ?>" data-rule-maxlength="20" >
        </div>
        <div class="help-inline"></div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">重量：</label>
        <div class="col-sm-2">
            <div class="input-group" style="width: 180px;">
                <input type="text" class="input-medium" name="goods_weight" data-rule-min="0"  data-rule-number="true"  value="<?php echo htmlentities($row['goods_weight']); ?>">
                <span class="input-group-addon">g</span>
            </div>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">销售价：</label>
        <div class="col-sm-4">
            <input type="text" class="input-mini" name="shop_price" min="0.01" data-rule-ismoney="true" data-rule-required="true" data-msg-required="销售价不能为空" value="<?php echo htmlentities($row['shop_price']); ?>">
            元<span  style="color:#f30;"> *</span>
        </div>
    </div>
    <div class="form-group hide">
        <label class="col-sm-2 control-label">促销价：</label>
        <div class="col-sm-8">
            <input type="text" class="input-mini" data-rule-ismoney="true" name="promote_price" value="<?php echo htmlentities($row['promote_price']); ?>" >元
            <span class="help-inline">促销期间以此价格进行销售</span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">市场价：</label>
        <div class="col-sm-4">
            <input type="text" class="input-mini" name="market_price" data-rule-ismoney="true" value="<?php echo htmlentities($row['market_price']); ?>">元
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">库存：</label>
        <div class="col-sm-8">
            <?php echo $row['goods_id']>0 ? '当前库存：'.$row['goods_number'].' + ' : ''; ?><input type="text" class="input-mini" name="goods_number" data-rule-number="true" data-rule-required="true" data-msg-required="库存不能为空" value="<?php echo $row['goods_id']>0 ? '0' : ''; ?>">
            <span class="red">*</span>
        </div>
    </div>
    <?php else: ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">货号：</label>
        <div class="col-sm-4 ">
            <div class="help-inline"><?php echo htmlentities($row['goods_sn']); ?></div>
        </div>
        <div class="help-inline"></div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">条形码：</label>
        <div class="col-sm-2 ">
            <div class="help-inline"><?php echo htmlentities($row['bar_code']); ?></div>
        </div>
        <div class="help-inline"></div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">重量：</label>
        <div class="col-sm-2">
            <div class="input-group" style="width:50px;">
                <input type="text" class="input-mini" name="goods_weight" data-rule-min="0"  data-rule-number="true"  value="<?php echo htmlentities($row['goods_weight']); ?>">
                <span class="input-group-addon">g</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">市场价：</label>
        <div class="col-sm-8">
            <div class="help-inline"><?php echo htmlentities(priceFormat($row['market_price'],true)); ?></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">库存：</label>
        <div class="col-sm-8">
           <div class="help-inline"> <?php echo htmlentities($row['goods_number']); ?></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">供货价：</label>
        <div class="col-sm-4">
            <div class="help-inline red"><b><?php echo htmlentities(priceFormat($row['settle_price'],true)); ?></b></div>
            <input type="hidden" name="settle_price" value="<?php echo htmlentities($row['settle_price']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">销售价：</label>
        <div class="col-sm-4">
            <input type="text" class="input-mini" name="shop_price" min="0.01" data-rule-ismoney="true" data-rule-required="true" data-msg-required="销售价不能为空" value="<?php echo htmlentities($row['shop_price']); ?>">
            元<span  style="color:#f30;"> *</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">促销价：</label>
        <div class="col-sm-8">
            <input type="text" class="input-mini" data-rule-ismoney="true" name="promote_price" value="<?php echo htmlentities($row['promote_price']); ?>" >元
            <span class="help-inline">促销期间以此价格进行销售</span>
        </div>
    </div>
    <?php endif; ?>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">排序：</label>
    <div class="col-sm-8">
        <input type="text" class="input-mini" name="sort_order"  data-rule-min="0"  data-rule-number="true" value="<?php echo htmlentities($row['sort_order']); ?>">
        <span class="help-inline">数值越大越靠前</span>
    </div>
</div>


                        
<script type="text/html" id="specifications_template">
<div class="panel panel-default m-t bg-light" data-toggle="specifications">
	<div class="panel-body lt">
		 {{if data.length<1}}
		<span class="help-inline js_nospe_tips">暂无规格数据，请先添加规格</span>
		<div class="line line-dashed line-lg pull-in js_nospe_tips"></div>
		{{/if}}
		{{each data as item index}}
		<div id="js_specifications_{{item.id}}">
            {{if is_supplyer == 0}}
			<p class="js_specifica" data-name="{{item.name}}" data-id="{{item.id}}"><strong>{{item.name}}</strong>
				<a href="javascript:;" class="m-l text-info js_specifica_edit"  data-id="{{item.id}}">编辑</a>
				{{if item.custom}}
					<a href="javascript:;" class="m-l text-info js_specifica_del text-info" data-name="{{item.name}}" data-id="{{item.id}}">删除</a>
				{{/if}}
			</p>
            {{/if}}
			<div id="specvals_{{item.id}}" data-id="{{item.id}}" data-toggle="specvals" class="m-b">
				{{each item.all_val as zitem zindex}}
				<label class="checkbox-inline input-s-sm" id="spe_{{zitem.key}}" onclick="{{if is_supplyer==1}}return false;{{/if}} ">
					<input type="checkbox" value="{{zitem.key}}" title="{{zitem.val}}" {{specifications_checked item.id zitem.key}} /><span class="diy--checkbox diy--radioInput"></span>{{zitem.val}}
				</label>
				{{/each}}
			</div>
		</div>
		<div id="specvals_ed_{{item.id}}" class="hide js_enter_div">
			<div class="form-group">
				<label class="col-sm-1 control-label"><strong>{{item.name}}</strong></label>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">规格值</label>
				<div class="col-sm-5">
					<p class="js_input_outer"><input type="text" data-limit="15" placeholder="输入回车即可直接添加"  class="form-control js_custom_input"/><span class="js_limit"><em>0</em>/<span>15</span></span></p>
				</div>
				<div class="col-sm-2">
					<button type="button" class="btn btn-default js_add_speval" data-id="{{item.id}}">添加</button>
				</div>
			</div>
			<div class="col-sm-11 col-sm-offset-1 error m-t-n-md m-b-xs" id="specvals_error_{{item.id}}">

			</div>
			<div class="form-group" id="specvals_show_{{item.id}}">
				<div class="col-sm-11 col-sm-offset-1">
					{{each item.all_val as zitem zindex}}
						<span class="label label-default bg-light dker specvals-show js_specvals_show {{if  zitem.custom}}js_specvals_result{{/if}}" data-name="{{zitem.val}}">{{zitem.val}}
						{{if zitem.custom}}
							<i class="fa fa-times  m-l-xs js_del_specvals_val_list" data-speid="{{item.id}}"
							data-id="{{zitem.key}}"></i>
						{{/if}}
						</span>
					 {{/each}}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-11 col-sm-offset-1">
					<button type="button" class="btn btn-primary btn-sm js_specvals_val_save" data-id="{{item.id}}">确定</button>
					<button type="button" class="btn btn-default btn-sm js_specvals_val_cancel" data-id="{{item.id}}">取消</button>
				</div>
			</div>
		</div>

		<div class="line line-dashed line-lg pull-in"></div>
		{{/each}}
        {{if is_supplyer == 0}}
		<div class="js_add_spe_div add-attr">
			<div class="col-sm-12">
				<div class="form-group" style="margin-bottom:0px;">
					<label class="p-l2"><a class="js_add_spe_btn" href="javascript:;">添加规格</a></label>
				</div>
			</div>
			<label class="control-label btn-s-lg js_enter_div"></label>
		</div>
        {{/if}}
		<div class="js_add_spe_form hide">

			<div class="form-group">
				<label class="control-label">规格名称</label>
				<div class="col-sm-5">
					<p class="js_input_outer"><input type="text" class="form-control js_add_spe_input js_custom_input"  data-limit="5">
					<span class="js_limit"><em>0</em>/<span>5</span></span>
					</p>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label">规格值</label>
				<div class="col-sm-5">
					<p class="js_input_outer"><input type="text" placeholder="输入回车即可直接添加"  class="form-control js_add_spev_input js_custom_input"  data-limit="15">
					<span class="js_limit"><em>0</em>/<span>15</span></span>
					</p>
				</div>
				<div class="col-sm-2">
					<button type="button" class="btn btn-default js_spe_speval">添加</button>
				</div>
			</div>
			<div class="col-sm-11 col-sm-offset-2 error m-t-n-md m-b-xs js_js_spe_spev_error" >

			</div>
			<div class="form-group">
				<div class="col-sm-11 col-sm-offset-2 js_spe_spev_show">


				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-5 col-sm-offset-1">
					<button type="button" class="btn btn-primary btn-sm js_add_spe_save">确定</button>
					<button type="button" class="btn btn-default btn-sm js_add_spe_cancel">取消</button>
				</div>
			</div>

		</div>
	</div>
</div>
</script>
<script type="text/html" id="specv_tem">
	{{each spevalList as item}}
		<label class="checkbox-inline input-s-sm" id="spe_{{item.key}}">
			<input type="checkbox"  value="{{item.key}}" title="{{item.val}}" /><span class="diy--checkbox diy--radioInput"></span>{{item.val}}
		</label>
	{{/each}}
</script>
<script type="text/html" id="specv_show_tem">
	<span class="label label-default bg-light dker specvals-show js_specvals_show js_specvals_temp" data-name="{{val}}">{{val}}
		<i class="fa fa-times  m-l-xs js_del_specvals_val_list" data-speid="{{speid}}"
		data-id="{{key}}"></i>
	</span>
</script>
<script type="text/html" id="specv_result_tem">
	{{each spevalList as item}}
	<span class="label label-default bg-light dker specvals-show js_specvals_show js_specvals_result" data-name="{{item.val}}">{{item.val}}
		<i class="fa fa-times  m-l-xs js_del_specvals_val_list" data-speid="{{speid}}"
		data-id="{{item.key}}"></i>
	</span>
	{{/each}}
</script>
<script type="text/html" id="spe_result_tem">
	<div id="js_specifications_{{id}}">
		<p class="js_specifica" data-name="{{name}}" data-id="{{id}}"><strong>{{name}}</strong>
			<a href="javascript:;" class="m-l text-info js_specifica_edit" data-id="{{id}}">编辑</a>
			<a href="javascript:;" class="m-l text-info js_specifica_del text-info" data-name="{{name}}" data-id="{{id}}">删除</a>
		</p>
		<div id="specvals_{{id}}" data-id="{{id}}" data-toggle="specvals" class="m-b">
			{{each spevalList as zitem zindex}}
			<label class="checkbox-inline input-s-sm" id="Label1">
				<input type="checkbox" value="{{zitem.key}}" title="{{zitem.val}}" /><span class="diy--checkbox diy--radioInput"></span>{{zitem.val}}
			</label>
			{{/each}}
		</div>
	</div>
	<div id="specvals_ed_{{id}}" class="hide js_enter_div">
		<div class="form-group">
			<label class="col-sm-1 control-label"><strong>{{name}}</strong></label>
		</div>
		<div class="form-group">
			<label class="col-sm-1 control-label">规格值</label>
			<div class="col-sm-5">
				<p class="js_input_outer"><input type="text" data-limit="15" placeholder="输入回车即可直接添加"  class="form-control js_custom_input"/><span class="js_limit"><em>0</em>/<span>15</span></span></p>
			</div>
			<div class="col-sm-2">
				<button type="button" class="btn btn-default js_add_speval" data-id="{{id}}">添加</button>
			</div>
		</div>
		<div class="col-sm-11 col-sm-offset-1 error m-t-n-md m-b-xs" id="specvals_error_{{id}}">

		</div>
		<div class="form-group" id="specvals_show_{{id}}">
			<div class="col-sm-11 col-sm-offset-1">
				{{each spevalList as zitem zindex}}
					<span class="label label-default bg-light dker specvals-show js_specvals_show js_specvals_result" data-name="{{zitem.val}}">{{zitem.val}}
						<i class="fa fa-times  m-l-xs js_del_specvals_val_list" data-speid="{{id}}"
						data-id="{{zitem.key}}"></i>
					</span>
				 {{/each}}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-11 col-sm-offset-1">
				<button type="button" class="btn btn-primary btn-sm js_specvals_val_save" data-id="{{id}}">确定</button>
				<button type="button" class="btn btn-default btn-sm js_specvals_val_cancel" data-id="{{id}}">取消</button>
			</div>
		</div>
	</div>

	<div class="line line-dashed line-lg pull-in"></div>

</script>
<script type="text/html" id="specifications_table_template">
	<table class="table table-bordered bg-light">
		<thead>
			<tr>
				{{each ths as th index}}
				<th class="mn90 ">{{th.name}}
				<input type="hidden"  value="{{th.name}}" name="specifications[name][{{index}}]"/>
					 <input type="hidden"  value="{{th.id}}" name="specifications[id][{{index}}]"/>
				</th>
				{{/each}}
				<th class="mn100">商品图片</th>
				<th class="mn130">商品编码<span class="maroon">*</span></th>
				<th class="mn130">库存<span class="maroon">*</span></th>
				{{if is_supplyer == 1}}
				<th class="mn100">供货价</th>
				{{/if}}
				<th class="mn90">售价<span class="maroon">*</span></th>
				<th class="mn90">促销价</th>
				<th class="mn90">市场价</th>
				<th class="mn80">重量（g）</th>
			</tr>
		</thead>
		<tbody>
			{{each trs as tr index}}
			<tr  class="lt">
				{{each tr.tds as td zindex}}
				{{if td.rowspan > 1 && tr.index % td.rowspan == 0}}
				<td rowspan="{{td.rowspan}}">
					{{td.val}}
				</td>
				{{/if}}
				{{if td.rowspan ==1}}
				<td>
					{{td.val}}
				</td>
				{{/if}}
				<td class="hd">

					<input type="hidden" name="Products[{{index}}][SpecVal][val][{{zindex}}]" value="{{td.val}}" />
					<input type="hidden" name="Products[{{index}}][SpecVal][key][{{zindex}}]" value="{{td.key}}" />
				</td>
				{{/each}}
                {{if is_supplyer == 1}}
				<td style="padding:5px;">
                    <img src="{{tr.ProductImg?tr.ProductImg:'/static/main/img/def_img.jpg'}}" style="width: 100%;">
                    <input type="hidden" class="sku_ids" name="Products[{{index}}][SkuId]" value="{{tr.sku_id}}" />
				</td>
				<td>
                    {{tr.ProductSn}}
                    <input type="hidden" name="Products[{{index}}][ProductSn]" value="{{tr.ProductSn}}" />
				</td>
				<td>
					{{tr.Store}}
				</td>
				<td>
					￥{{tr.SettlePrice}}
                    <input type="hidden" name="Products[{{index}}][SettlePrice]"  value="{{tr.SettlePrice}}">
				</td>
				<td>
					<input type="text" class="form-control" name="Products[{{index}}][Price]" data-id="{{tr.key}}" data-name="Price" value="{{tr.Price}}" data-rule-ismoney="true" data-rule-required="true">
				</td>
				<td>
					<input type="text" class="form-control" name="Products[{{index}}][PromotePrice]" data-id="{{tr.key}}" data-name="PromotePrice" value="{{tr.PromotePrice?tr.PromotePrice:0}}" data-rule-ismoney="true">
				</td>
				<td>
                    {{tr.MarketPrice}}
				</td>

				<td>
                    {{tr.Weight}}
				</td>
                {{else}}
                <td style="padding:5px;">
                    <div class="file-item thumbnail">
                        <div class="upload-file goods_sku" data-sku='{{tr.key}}' style="background-image:url('{{tr.ProductImg?tr.ProductImg:'/static/main/img/def_img.jpg'}}');" data-dimg="/static/main/img/def_img.jpg"></div>
                        <div class="info">点击上传</div>
                        <input type="hidden" class="file_path" name="Products[{{index}}][ProductImg]" data-id="{{tr.key}}" data-name="ProductImg" value="{{tr.ProductImg}}"><input type="hidden" name="Products[{{index}}][SkuId]" value="{{tr.sku_id}}" />
                        <a class="delete_sku_img item_close" href="javascript:void(0)" data-id="{{tr.ProductImgId}}" data-name="ProductImgId" title="删除" ></a>
                    </div>
                </td>
                <td>
                    <input type="text" class="form-control" name="Products[{{index}}][ProductSn]" data-nochangeval="1" data-id="{{tr.key}}" data-name="ProductSn" value="{{tr.ProductSn}}" data-rule-required="true">
                </td>
				<td>
					{{tr.Store > 0 ? tr.Store+'+' :''}}<input type="text" style=" width:50px;" class="sku_stores" name="Products[{{index}}][Store]" data-id="{{tr.key}}" data-name="Store" value="{{tr.sku_id>0?0:''}}" data-rule-number="true" data-rule-required="true">
				</td>
                <td>
                    <input type="text" class="form-control" name="Products[{{index}}][Price]" data-id="{{tr.key}}" data-name="Price" value="{{tr.Price}}" data-rule-ismoney="true" data-rule-required="true">
                </td>
                <td>
                    <input type="text" class="form-control" name="Products[{{index}}][PromotePrice]" data-id="{{tr.key}}" data-name="PromotePrice" value="{{tr.PromotePrice?tr.PromotePrice:0}}" data-rule-ismoney="true">
                </td>
                <td>
                    <input type="text" class="form-control" name="Products[{{index}}][MarketPrice]" data-id="{{tr.key}}" data-name="MarketPrice" value="{{tr.MarketPrice}}" data-rule-ismoney="true">
                </td>

                <td>
                    <input type="text" class="form-control" name="Products[{{index}}][Weight]" data-id="{{tr.key}}" data-name="Weight" value="{{tr.Weight}}" >
                </td>
                {{/if}}
			</tr>
			{{/each}}
		</tbody>
	</table>
	 <span class="help-inline">如果开启促销，但SKU的促销价格为0则视为不参与促销。</span>
</script>

<script src="/static/js/webuploader/webuploader.js"></script>
<link href="/static/main/css/stylesheets/uploadify/uploadify.min.css" rel="stylesheet"/>

<script type="text/javascript">//upload
var ratio = window.devicePixelRatio || 1,
    thumbnailWidth = 100 * ratio,// 优化retina, 在retina下这个值是2
    thumbnailHeight = 100 * ratio,
    uploader = null, uploader_pick = null,uploadering = 0;
function WebUploaderDiy(_pick){
    if (typeof(_pick) == 'undefined'){
        _pick = '.upload-file';
    }
    uploader = WebUploader.create({
        // swf文件路径
        swf: '/static/js/webuploader/Uploader.swf',
        // 文件接收服务端。
        server: '',
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: _pick,
        resize: false,
        auto: false,
        duplicate :true
    });

    uploader.on('fileQueued', function (file) {
        var _this = uploader_pick;
        uploader_pick.find('div.error').remove();
        if (uploadering == 1){
            _alert('有文件正在上传，不能同时操作.');
            return false;
        }
        uploadering = 1;
        if (_this.hasClass('el-upload')){ //单个图片上传
            if (_this.find('.info').length < 1){
                _this.append('<div class="info"></div>');
            }
            _this.find('.info').data('text',_this.find('.info').text());
            _this.find('.info').text('上传0%...');
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $('<div class="error">不能预览</div>').appendTo(uploader_pick);
                    return;
                }
                _this.css("background-image","url("+src+")");
            }, 1, 1 );
            uploader.upload();//执行上传
            return;
        }else if (_this.hasClass('goods_sku')){ //商品SKU上传
            _this.find('.info').data('text',_this.find('.info').text());
            _this.find('.info').text('上传0%...');
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $('<div class="error">不能预览</div>').appendTo(uploader_pick);
                    return;
                }
                _this.find('.goods_sku').css("background-image","url("+src+")");
            }, 1, 1 );
            uploader.upload();//执行上传
            return ;
        }
        _alert('无法识别上传类型',true);
        return false;
    });
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var _this = uploader_pick;
        if (_this.find('.info').length > 0){
            _this.find('.info').text('上传中'+percentage * 100 + '%');
            return false;
        }
        var $li = $( '.uploadify-queue'),
            $percent = $li.find('.uploadify-queue-item');
        if ($li.length < 1 ) return false;
        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<div  class="uploadify-queue-item"><span class="fileName">'+file.name+' </span>	<span class="data"></span><div class="uploadify-progress"><div class="uploadify-progress-bar" style="width: 1%;"><!--Progress Bar--></div></div></div>').appendTo( $li ).find('.progress-bar');
        }

        $li.find('.data').html('上传中'+percentage * 100 + '%');
        $li.find('.uploadify-progress-bar').css( 'width', percentage * 100 + '%' );
        if (percentage == 1){
            $percent.remove();
        }
    });
    uploader.on('uploadSuccess', function (file, data) {
        uploadering = 0;
        if (data.code == 1){
            _alert(data.msg);
            return false;
        }
        var _this =  uploader_pick;
        if (_this.hasClass('el-upload')){ //单个图片上传
            _this.css("background-image","url("+data.src+")");
            _this.find('.fa-plus').addClass('hide');
            _this.find('.webuploader-container-div').addClass('hide');
            _this.find('.webuploader-pick input').val(data.src);
            _this.find('.info').remove();
            var fun = _this.data('fun');
            if (typeof(fun) != 'undefined'){
                return eval(fun+'(data.src)');
            }
        }else if (_this.hasClass('goods_sku')){ //商品SKU上传
            _this.css("background-image","url("+data.src+")");
            _this.parent().find('.info').text($(_this).find('.info').data('text'));
            _this.parent().find('.file_path').val(data.src);
            _this.parent().find('.item_close').data("id",data.image.id);
            _this.parent().find('.info').html('上传成功！');
            if (_this.data('sku')){
                var c = _this.find('.file_path').data("id"),
                    d = _this.find('.file_path').data("name"),
                    ic = _this.find('.item_close').data("name"),
                    f = {};
                f[d] = data.src;
                f[ic] = data.image.id;
                window.goods_data.products[c] = f;
            }
            return false;
        }

    });

    // 文件上传失败，显示上传出错。
    uploader.on('uploadError', function (file) {
        uploadering = 0;
        var _this = uploader_pick;
        if (_this.find('.info').length > 0){
            _this.find('.info').text('上传失败');
            return false;
        }
        var $error = _this.find('div.error');
        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo(uploader_pick);
        }

        $error.text('上传失败');
    });
}
$(function () {
    WebUploaderDiy();
    $(document).on('click',".upload-file input", function () {
        uploader_pick = $(this).parents('.upload-file');
        if (typeof (uploader_pick.data('server')) != 'undefined' ){
            uploader.options.server = uploader_pick.data('server');
        }
    });
    $(document).on('click',".el-upload-delete", function () {
        var _this = $(this).parents('.el-upload');
        _this.find('input').val('');
        _this.css("background-image","");
        _this.find('.fa-plus').removeClass('hide');
        _this.find('.webuploader-container-div').removeClass('hide');
    });
})
</script>
<script type="text/javascript">


window.goods_data = {
	  shelves:true,
      is_supplyer: <?php echo htmlentities(intval($is_supplyer)); ?>,
	  specifications: <?php echo $specifications; ?>,
	  products: <?php echo $products; ?>
}

window.goods_setting = {
	custom_spevalue_path:'<?php echo url("sys_admin.skuCustom/addSkuVal"); ?>',
	custom_spe_path:'<?php echo url("sys_admin.skuCustom/addSku"); ?>',
	custom_spe_del_path:'<?php echo url("sys_admin.skuCustom/delSku"); ?>',
	custom_delspevalue_path:'<?php echo url("sys_admin.skuCustom/delSkuVal"); ?>',
	specifications_path: '<?php echo url("sys_admin.skuCustom/skuByCategory",["supplyer_id"=>$row["supplyer_id"]]); ?>'
}

$(function () {
    $(document).on('click', ".goods_sku input", function () {
        uploader_pick = $(this).parents('.goods_sku');
        if (uploadering == 1) return false;
        uploader.options.server = '<?php echo url("mainAdmin/Attachment/goodsUpload"); ?>';
        uploader.options.formData.sku = uploader_pick.data('sku');
        uploader.options.formData.gid = '<?php echo htmlentities(intval($row['goods_id'])); ?>';
    });

    $(document).on('click', ".delete_sku_img", function () {
        var _this = $(this);
        if (_this.data('id') < 1) return false;
        jq_ajax('<?php echo url("mainAdmin/Attachment/removeImg"); ?>', 'id=' + _this.data('id'), function (res) {
            if (res.code == 0) {
                _alert(res.msg);
                return false;
            }
            var obj = _this.parents('.file-item');
            obj.find('input').val('');
            var dimg = obj.find('.upload-file').data('dimg');
            obj.find('.upload-file').css("background-image", "url(" + dimg + ")");
            obj.find('.info').html('点击上传');

        });


    })

})
</script>


                    </div>
                    <div class="tab-pane" id="details">
                        <div class="col-sm-10">
                        <textarea rows="13" class="hd" data-toggle="kindeditor" data-allo="remain" data-tongji="remain"
                                  data-tongji-target=".js_kindeditor_tongji" data-rule-rangelength="[0,50000]"
                                  allowFileManager name="goods_desc"
                                  style="visibility:hidden;"><?php echo $row['goods_desc']; ?></textarea>
                            <p class="pull-right js_kindeditor_tongji">还可输入{0}字</p>
                        </div>
                    </div>
                    <div class="tab-pane" id="mDetails">
                        <div class="col-sm-10 hide">移动端的图片建议宽度为750像素</div>
                        <div class="col-sm-10">
                        <textarea rows="13" class="hd" data-toggle="kindeditor" data-allo="remain" data-tongji="remain"
                                  data-tongji-target=".js_kindeditor_tongjib" data-rule-rangelength="[0,50000]"
                                  allowFileManager name="m_goods_desc" style="visibility:hidden;"><?php echo $row['m_goods_desc']; ?></textarea>
                            <p class="pull-right js_kindeditor_tongjib">还可输入{0}字</p>
                        </div>
                    </div>
                    <div class="tab-pane" id="otherInfo">
                        

<?php if($row['supplyer_id'] == 0 && $row['store_id'] == 0): ?>
<div class="form-group">
    <label class="col-sm-2 control-label">上架时间：</label>
    <div class="col-sm-10" >
        <label class="radio" style="padding-left:20px; width:200px;">
            <input type="radio" name="isputaway" value="1"  <?php echo htmlentities(tplckval($row['isputaway'],'=1','checked',true)); ?>  />立即上架
        </label>
         <label class="radio" style="padding-left:20px;width:200px;">
            <input type="radio" name="isputaway"   value="0" <?php echo htmlentities(tplckval($row['isputaway'],'=0','checked')); ?> >暂不上架，放入仓库中
        </label>
        <label class="radio" style="padding-left:20px;width:200px;">
                <input type="radio" name="isputaway" value="2" <?php echo htmlentities(tplckval($row['isputaway'],'=2','checked')); ?>/>设定商品上下架时间
         </label>


        <div class="col-sm-1" style="width:70px;padding:0; margin:0;">
            <label style="padding:0;margin:0;">上架时间</label>
        </div>
        <div class="col-sm-3"  style="width:180px;padding:0; margin:0;">
            <div class="input-group"> <input type="text" class="input-max" name="added_time" readonly="readonly" value="<?php echo htmlentities(dateTpl($row['added_time'],'Y-m-d H:i',true)); ?>" data-before="#solddate"   data-toggle="datetimepicker" /><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
        </div>
         <div class="col-sm-1" style="width:70px;margin:0; margin-left:10px;">
            <label style="padding:0;margin:0;">下架时间</label>
        </div>
        <div class="col-sm-3"  style="width:180px;padding:0; margin:0;">
            <div class="input-group"> <input type="text" class="input-max" name="shelf_time" value="<?php echo htmlentities(dateTpl($row['shelf_time'],'Y-m-d H:i',true)); ?>" data-after="#groundingdate" data-offsetday="0"  readonly="readonly" data-toggle="datetimepicker" /><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
        </div>

    </div>
</div>
<?php endif; ?>
<div class="line line-dashed line-lg pull-in"></div>

<div class="form-group">
    <label class="col-sm-2 control-label">加入热销：</label>
    <div class="col-sm-6">
		<!-- <label class="radio inline">
            <input type="checkbox" name="is_best" value="1" <?php echo htmlentities(tplckval($row['is_best'],'=1','checked')); ?>> 推荐（优先首页猜你喜欢显示）
        </label><br />
       <label class="radio inline">
            <input type="checkbox" name="is_new" value="1" <?php echo htmlentities(tplckval($row['is_new'],'=1','checked')); ?>> 新品
        </label><br /> -->
        <label class="radio inline">
            <input type="checkbox" name="is_hot" value="1" <?php echo htmlentities(tplckval($row['is_hot'],'=1','checked')); ?>> 热销（优先首页分类显示）
        </label>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label">商品标签：</label>
    <div class="col-sm-6">
        <label class="radio inline">
            <span><a href="javascript:" class="cancelChecked">取消选择</a></span>
        </label>
        <?php if(is_array($tagList) || $tagList instanceof \think\Collection || $tagList instanceof \think\Paginator): if( count($tagList)==0 ) : echo "" ;else: foreach($tagList as $key=>$vo): ?>
        <label class="radio inline">
            <input type="radio" name="tag_id" value="<?php echo htmlentities($vo['id']); ?>" <?php echo $vo['id']==$row['tag_id'] ? "checked" : ""; ?>> <?php echo htmlentities($vo['title']); ?>
        </label>&nbsp;&nbsp;
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label">虚拟销量：</label>
    <div class="col-sm-5">

        <div class="input-group">
            <input type="text" class="input-mini" name="virtual_sale" data-rule-min="0"  data-rule-number="true"  value="<?php echo intval($row['virtual_sale']); ?>">
             <span class="help-inline">+ <?php echo htmlentities(intval($row['sale_num'])); ?>，前端显示：虚拟销售量 + 真实销量</span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">虚拟收藏：</label>
    <div class="col-sm-5">

        <div class="input-group">
            <input type="text" class="input-mini" name="virtual_collect" data-rule-min="0"  data-rule-number="true"  value="<?php echo intval($row['virtual_collect']); ?>">
             <span class="help-inline">+ <?php echo htmlentities(intval($row['sale_num'])); ?>，前端显示：虚拟收藏量 + 真实收藏量</span>
        </div>
    </div>
</div>



<div class="line line-dashed line-lg pull-in"></div>

<div class="form-group">
    <label class="col-sm-2 control-label">关键字：</label>
    <div class="col-sm-6" >
        <input type="text" class="input-max" data-rule-maxlength="40" name="keywords" value="<?php echo htmlentities($row['keywords']); ?>" >
    </div>
    <span class="help-inline">用空格分隔</span>
</div>
<div class="form-group">
      <label class="col-sm-2 control-label">商品简单描述：</label>
      <div class="col-sm-8">
        <textarea name="description"  style=" width:80%; height:100px;"><?php echo htmlentities($row['description']); ?></textarea>
      </div>
</div>
<script>
    $(function(){
        $('.cancelChecked').on('click', function(event) {
            $("input[name='tag_id']").attr('checked',false);
        });
    })
</script>
                    </div>
                    <div class="tab-pane" id="promotions">
                        <!-- <div class="form-group">
    <label class="col-sm-2 control-label">返还类型：</label>
    <div class="col-sm-8" >
        <label><input type="checkbox" name="buy_brokerage_type[]" value="first_buy"  <?php echo in_array('first_buy',$row['buy_brokerage_type'])?'checked':'';; ?>> 首次购买</label>
        <label><input type="checkbox" name="buy_brokerage_type[]" value="repeat_buy"  <?php echo in_array('repeat_buy',$row['buy_brokerage_type'])?'checked':'';; ?>> 重复购买</label>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">购买返还：</label>
    <div class="col-sm-8" >
        <input type="text" class="input-mini" name="buy_brokerage_amount" data-rule-min="0" data-rule-max="9999" data-rule-number="true" value="<?php echo htmlentities(intval($row['buy_brokerage_amount'])); ?>">元
        <span class="help-inline red">以佣金方式返还，返还金额高于实际售价50%时不生效.</span>
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
<div class="form-group">
    <label class="col-sm-2 control-label">抵扣积分：</label>
    <div class="col-sm-8" >
        <input type="text" class="input-mini" name="use_integral" data-rule-min="0" data-rule-max="9999" data-rule-number="true" value="<?php echo htmlentities(intval($row['use_integral'])); ?>">
        <span class="help-inline">用于积分+现金组合购买，一旦设置用户须有相应积分进行抵扣才能购买,针对购买普通商品（拼团等无效）</span>
    </div>
</div>
<div class="form-group">
      <label class="col-sm-2 control-label">优惠券：</label>
      <div class="col-sm-10">
        <label class="radio-inline">
            <input type="radio" name="use_bond" value="0" <?php echo htmlentities(tplckval($row['use_bond'],'0','checked')); ?> >不能使用
        </label>
        <label class="radio-inline">
            <input type="radio" name="use_bond" value="1" <?php echo htmlentities(tplckval($row['use_bond'],'>0','checked',true)); ?>  /> 可以使用
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">赠送积分：</label>
    <div class="col-sm-10">
        <label class="radio-inline">
            <input type="radio" name="is_give_integral" value="0" <?php echo $row['give_integral']==0 ? 'checked' : ''; ?>  class="js_radio_undertake">1:1赠送（销售价）
        </label>
        <label class="radio-inline">
            <input type="radio" name="is_give_integral" value="-1" <?php echo $row['give_integral']==-1 ? 'checked' : ''; ?>  class="js_radio_undertake">不赠送
        </label>
        <label class="radio-inline">
            <input type="radio" name="is_give_integral" value="1" <?php echo $row['give_integral']>0 ? 'checked' : ''; ?>  class="js_radio_undertake "
            data-class="give_integral_val"/>
            赠送指定积分
        </label>
        <label class="radio_undertake_is_give_integral give_integral_val v-top <?php echo $row['give_integral']>0 ? '' : 'hide'; ?> " style="position:relative;">
            <input class="input-xs input-sm" type="text" data-rule-required="true" min="1" name="give_integral" value="<?php echo $row['give_integral']<0 ? 0 : htmlentities($row['give_integral']); ?>" data-rule-positive="true" />
        </label>
    </div>
</div>
<?php if(!(empty($UsersLevel) || (($UsersLevel instanceof \think\Collection || $UsersLevel instanceof \think\Paginator ) && $UsersLevel->isEmpty()))): ?>
<div class="help-inline red">默认全等级可购买，一旦勾选则只有勾选中的等级才能进行购买</div>
<div class="form-group">
      <label class="col-sm-2 control-label">限制会员购买：</label>
      <div class="col-sm-8" >
      <?php if(is_array($UsersLevel) || $UsersLevel instanceof \think\Collection || $UsersLevel instanceof \think\Paginator): $i = 0; $__LIST__ = $UsersLevel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$urow): $mod = ($i % 2 );++$i;?>
        <li style="list-style:none; float:left; margin:2px;">
        <label><input type="checkbox" name="limit_user_level[]" value="<?php echo htmlentities($urow['level_id']); ?>"  <?=in_array($urow['level_id'],$limit_user_level)?'checked':'';?>> <?php echo htmlentities($urow['level_name']); ?></label></li>
       <?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">会员价格优惠：</label>
    <div class="col-sm-9" >
        <select name="level_price_type" class="level_price_type" >
            <option value="0" <?php echo $row['level_price_type']==0 ? 'selected' : ''; ?>>默认商城售价</option>
            <option value="1" <?php echo $row['level_price_type']==1 ? 'selected' : ''; ?>>会员等级折扣</option>
            <option value="2" <?php echo $row['level_price_type']==2 ? 'selected' : ''; ?>>自定义折扣</option>
            <option value="3" <?php echo $row['level_price_type']==3 ? 'selected' : ''; ?>>指定固定售价(多规格的子商品价格统一售价)</option>
        </select>
    </div>
</div>
<div class="form-group level_price_box <?php echo $row['level_price_type']==0 ? 'hd' : ''; ?>">
    <label class="col-sm-2 control-label">会员价格：</label>
    <div class="col-sm-9" >
        <?php if(is_array($UsersLevel) || $UsersLevel instanceof \think\Collection || $UsersLevel instanceof \think\Paginator): $i = 0; $__LIST__ = $UsersLevel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$urow): $mod = ($i % 2 );++$i;?>
        <li style="list-style:none; float:left; position:relative; margin-right:10px;">
            <?php echo htmlentities($urow['level_name']); ?>：<input type="text" class="input-mini" min="0.1"  name="level_price[<?php echo htmlentities($urow['level_id']); ?>]" data-rule-ismoney="true"  value="<?php echo $row['level_price_type']==1 ? htmlentities($urow['level_pro']) : htmlentities((isset($levelPrice[$urow['level_id']]) && ($levelPrice[$urow['level_id']] !== '')?$levelPrice[$urow['level_id']]:'0')); ?>" <?php echo $row['level_price_type']==1 ? 'disabled' : ''; ?> data-level_pro="<?php echo htmlentities($urow['level_pro']); ?>"><b class="symbol p-l"><?php echo $row['level_price_type']<=2 ? '%' : '元'; ?></b></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
<?php endif; if(!(empty($UsersRole) || (($UsersRole instanceof \think\Collection || $UsersRole instanceof \think\Paginator ) && $UsersRole->isEmpty()))): ?>
<div class="help-inline red">默认全分销身份可购买，一旦勾选则只有勾选中的分销身份才能进行购买</div>
<div class="form-group">
      <label class="col-sm-2 control-label">限制分销身份购买：</label>
      <div class="col-sm-8" >
      <?php if(is_array($UsersRole) || $UsersRole instanceof \think\Collection || $UsersRole instanceof \think\Paginator): $i = 0; $__LIST__ = $UsersRole;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$urow): $mod = ($i % 2 );++$i;?>
        <li style="list-style:none; float:left; margin:2px;">
        <label><input type="checkbox" name="limit_user_role[]" value="<?php echo htmlentities($urow['role_id']); ?>" <?=in_array($urow['role_id'],$limit_user_role)?'checked':'';?>> <?php echo htmlentities($urow['role_name']); ?></label></li>
       <?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">身份价格优惠：</label>
    <div class="col-sm-9" >
        <select name="role_price_type" class="role_price_type">
            <option value="0" <?php echo $row['role_price_type']==0 ? 'selected' : ''; ?>>默认商城售价</option>
            <option value="1" <?php echo $row['role_price_type']==1 ? 'selected' : ''; ?>>自定义折扣</option>
            <option value="2" <?php echo $row['role_price_type']==2 ? 'selected' : ''; ?>>指定固定售价(多规格的子商品价格统一售价)</option>
        </select>
    </div>
</div>
<div class="form-group role_price_box <?php echo $row['role_price_type']==0 ? 'hd' : ''; ?>">
    <label class="col-sm-2 control-label">身份价格：</label>
    <div class="col-sm-9" >
        <?php if(is_array($UsersRole) || $UsersRole instanceof \think\Collection || $UsersRole instanceof \think\Paginator): $i = 0; $__LIST__ = $UsersRole;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$urow): $mod = ($i % 2 );++$i;?>
        <li style="list-style:none; float:left; position:relative; margin-right:10px;">
            <?php echo htmlentities($urow['role_name']); ?>：<input type="text" class="input-mini" min="0.1"  name="role_price[<?php echo htmlentities($urow['role_id']); ?>]" data-rule-ismoney="true" value="<?php echo htmlentities((isset($rolePrice[$urow['role_id']]) && ($rolePrice[$urow['role_id']] !== '')?$rolePrice[$urow['role_id']]:'0')); ?>" ><b class="symbol p-l"><?php echo $row['role_price_type']==1 ? '%' : '元'; ?></b></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
<?php endif; ?>

<div style=" padding-bottom:10px; line-height:20px;">
<div class="help-inline red">设置会员价格或阶梯价格则所有规格商品统一售价</div>
<div class="help-inline">商城价、会员价、阶梯价和促销价不同时享受，按最低价格计算</div>
</div>
<div class="form-group">
      <label class="col-sm-2 control-label">阶梯价格定义：</label>
      <div class="col-sm-9" >
        <select name="volume_price_type" class="volume_price_type">
               <option value="1" <?php echo $row['volume_price_type']<=1 ? 'selected' : ''; ?>>指定固定售价</option>
               <option value="2" <?php echo $row['volume_price_type']==2 ? 'selected' : ''; ?>>指定折扣售价</option>
         </select>
      </div>
</div>
<div class="form-group volume_price_box">
      <label class="col-sm-2 control-label">阶梯价格：</label>
      <div class="col-sm-4" id="volume_box">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <?php if(is_array($VolumePriceList) || $VolumePriceList instanceof \think\Collection || $VolumePriceList instanceof \think\Paginator): $key = 0; $__LIST__ = $VolumePriceList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vpl): $mod = ($key % 2 );++$key;?>
                <tr>
                  <td> <?php if($key == '1'): ?>
                          <a class="fa fa-plus m-xs addVolumePrice" title="增加" href="javascript:;"></a>
                      <?php else: ?>  
                          <a class="fa fa-minus m-xs removeVolumePrice" title="删除" href="javascript:;"></a>
                      <?php endif; ?> </td>
                  <td>优惠数量</td>
                  <td style="position:relative;"><input name="volume_number[]" class="volume_number input-mini" value="<?php echo htmlentities($vpl['number']); ?>" type="text" data-rule-ismoney="true"></td>
                  <td>优惠价格</td>
                  <td style="position:relative;"><input name="volume_price[]" class="volume_price input-mini" value="<?php echo htmlentities($vpl['price']); ?>" type="text"  data-rule-ismoney="true"><?php echo $row['volume_price_type']<=1 ? '元' : '%'; ?></td>
                </tr>
          <?php endforeach; endif; else: echo "" ;endif; if(empty($VolumePriceList) || (($VolumePriceList instanceof \think\Collection || $VolumePriceList instanceof \think\Paginator ) && $VolumePriceList->isEmpty())): ?>
                <tr>
                  <td><a class="fa fa-plus m-xs addVolumePrice" title="增加" href="javascript:;"></a></td>
                  <td>优惠数量</td>
                  <td style="position:relative;"><input name="volume_number[]" class="volume_number input-mini" value="" type="text"  data-rule-ismoney="true"></td>
                  <td>优惠价格</td>
                  <td style="position:relative;"><input name="volume_price[]" class="volume_price input-mini" value="" type="text"  data-rule-ismoney="true"><b class="symbol p-l"><?php echo $row['volume_price_type']<=1 ? '元' : '%'; ?></b></td>
                </tr>
           <?php endif; ?>
        </table>
      </div>
      <span class="help-inline">购买数量达到优惠数量时享受的优惠价格</span>
</div>
<div class="line line-dashed line-lg pull-in"></div>
<div style=" padding-bottom:10px; line-height:20px;">
	<div class="help-inline red">* 只是开启限购，只限制每笔订单最高下单数量，可以重复下单.</div>
	<div class="help-inline red">* 同时开启限购和促销，则在促销期间此商品购买数量不能超过限购的数量（包含促销期间所有正常订单和当前购买数量）.</div>
</div>




<div class="form-group">
    <label class="col-sm-2 control-label">单次限购：</label>
    <div class="col-sm-10">
        <label class="radio-inline">
            <input type="radio" name="is_quota" value="0" <?php echo $row['limit_num']<=0 ? 'checked' : ''; ?>  class="js_quota">不限购
        </label>
        <label class="radio-inline">
            <input type="radio" name="is_quota" value="1" <?php echo $row['limit_num']>0 ? 'checked' : ''; ?>  class="js_quota js_quota_show" />
            限购
        </label>
        <label class="is_quota_container  v-top <?php echo $row['limit_num']>0 ? 'inline' : 'hd'; ?> " style="position:relative;">
            <input class="input-xs input-sm" type="text" data-rule-required="true" name="limit_num" value="<?php echo htmlentities(intval($row['limit_num'])); ?>" data-rule-positive="true" />
        </label>
    </div>
</div>

<div class="form-group">               
      
	<label class="col-sm-2 control-label">开启促销：</label>
    <div class="col-sm-10 m-t-mc">
         <label>
               <input class="checkbox-slider colored-orange rand_amount"  name="is_promote" id="is_promote" type="checkbox" value="1" <?php echo $row['is_promote']==1 ? 'checked' : ''; ?>>
               <span class="text"></span>
         </label>
    </div>
 </div> 

<div class="form-group">          
<label class="col-sm-2 control-label">促销时间：</label>
    <div class="col-sm-3" >
            <span class="fl help-inline">开始时间：</span><div class="input-group"> <input type="text" class="input-max" name="promote_start_date" readonly="readonly" id="promote_start_date" value="<?php echo htmlentities(dateTpl($row['promote_start_date'],'Y-m-d H:i',true)); ?>"  data-toggle="datetimepicker" data-before="#promote_end_date" data-position="top-right" /><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
        </div>
        
        <div class="col-sm-3" >
            <span class="fl help-inline">结束时间：</span><div class="input-group"> <input type="text" class="input-max" name="promote_end_date" value="<?php echo htmlentities(dateTpl($row['promote_end_date'],'Y-m-d H:i',true)); ?>" id="promote_end_date"   readonly="readonly" data-toggle="datetimepicker" data-after="#promote_start_date" data-position="top-right" /><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
        </div>
</div>



<script type="text/javascript">
$('.select_integral_type').change(function(){
	if ($(this).val() == 2){
		$(this).parent().find('input').removeClass('hd');
	}else{
		$(this).parent().find('input').addClass('hd');
	}
})
//会员价格优惠
$('.level_price_type').change(function(){
	$('.level_price_box').find('input').val(0).attr("disabled", false);
	$('.level_price_box').find('input').removeClass('error');
	$('.level_price_box .error').remove();
	if ($(this).val() == 0){
		$('.level_price_box').addClass('hd');
		return false;
	}
	$('.level_price_box').removeClass('hd');
	if ($(this).val() == 1){
		$('.level_price_box').find('input').attr("disabled", true);
		$('.level_price_box').find('input').each(function(){
			$(this).val($(this).data('level_pro'));
		});
	}
	if ($(this).val() == 3){
		$('.level_price_box').find('.symbol').html('元');
	}else{
		$('.level_price_box').find('.symbol').html('%');
	}
})
//身份价格优惠
$('.role_price_type').change(function(){
	$('.role_price_box').find('input').val(0);
	$('.role_price_box').find('input').removeClass('error');
	$('.role_price_box .error').remove();
	if ($(this).val() == 0){
		$('.role_price_box').addClass('hd');
		return false;
	}
	$('.role_price_box').removeClass('hd');
	if ($(this).val() == 1){
		$('.role_price_box').find('.symbol').html('%');
	}else{
		$('.role_price_box').find('.symbol').html('元');		
	}
})
//价格阶梯定义
$('.volume_price_type').change(function(){
	if ($(this).val() == 1){
		$('.volume_price_box').find('.symbol').html('元');
	}else{
		$('.volume_price_box').find('.symbol').html('%');		
	}
	$('.volume_price').val('');
})
$('.addVolumePrice').click(function(){
	var title = '';
	$('.volume_number').each(function(){
		if ($(this).val() == ''){
			title += "请输入优惠数量<br>";
			return false
		}
	});
	$('.volume_price').each(function(){
		if ($(this).val() == ''){
			title += "请输入优惠价格";
			return false;
		}
	})
	if (title) return _alert(title);	
	if ($('.volume_price_type').val() == 1){
		var symbol = '元';
	}else{
		var symbol = '%';	
	}
	$('#volume_box').find('table').append('<tr><td><a class="fa fa-minus m-xs removeVolumePrice" title="删除" href="javascript:;"></a></td>'
          +'<td>优惠数量</td>'
          +'<td style="position:relative;"><input name="volume_number[]" class="volume_number input-mini" value="" type="text"  data-rule-positive="true"></td>'
          +'<td>优惠价格</td>'
          +'<td style="position:relative;"><input name="volume_price[]" class="volume_price input-mini" value="" type="text"  data-rule-positive="true"><b class="symbol p-l">'+symbol+'</b></td>'
        +'</tr>');
});
$("#volume_box").on("click",".removeVolumePrice",function(){
	$(this).parents('tr').remove();
});
</script>
 -->
                    </div>
                    
                    <div class="tab-pane" id="commissions">
                        <div class="form-group">
    <label class="control-label">排位奖项：</label>
    <div class="col-sm-5">
        <table class="table table-hover  table-bordered">
            <thead>
                <tr>
                    <th class="txt_center">公排奖金</th>
                    <th class="txt_center">推广奖金</th>
            </thead>
            <tbody id="d_role_box">
                <tr>
                    <td align="center">
                       获得 <input type="text" name="rank_award[num]" class="input-ssmall" min="-1" value="<?php echo htmlentities($row['rank_award']['num']); ?>">
                        元 滑落两单，其中 <input type="text" name="rank_award[repeat_num]" class="input-ssmall" min="-1" value="<?php echo htmlentities($row['rank_award']['repeat_num']); ?>"> % 用于复投
                    </td>
                    <td align="center">
                        <input type="text" name="rank_award[push_num]" class="input-ssmall" min="-1" value="<?php echo htmlentities($row['rank_award']['push_num']); ?>">
                        元
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="form-group">
    <label class="control-label">分销奖项：</label>
    <div class="col-sm-5">
        <table class="table table-hover  table-bordered">
            <thead>
                <tr>
                    <th class="txt_center">分销身份</th>
                    <th class="txt_center">级差奖励</th>
                    <th class="txt_center">平级奖励</th>
            </thead>
            <tbody id="d_role_box">
                <?php if(is_array($UsersRole) || $UsersRole instanceof \think\Collection || $UsersRole instanceof \think\Paginator): $i = 0; $__LIST__ = $UsersRole;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$urow): $mod = ($i % 2 );++$i;if($urow['role_id'] > 1): ?>
                <tr>
                    <td align="center"><?php echo htmlentities($urow['role_name']); ?>
                        <input name="award[<?php echo htmlentities($urow['role_id']); ?>][role_id]" type="hidden" value="<?php echo htmlentities($urow['role_id']); ?>">
                    </td>
                    <td align="center">
                        
                        <input type="text" name="award[<?php echo htmlentities($urow['role_id']); ?>][num]" class="input-ssmall" min="-1" value="<?php echo htmlentities($row['award'][$urow['role_id']]['num']); ?>"> 元
                    </td>
                    <td align="center">
                        直推人级差奖的 <input type="text" name="award[<?php echo htmlentities($urow['role_id']); ?>][same_num]" class="input-ssmall" min="-1" value="<?php echo htmlentities($row['award'][$urow['role_id']]['same_num']); ?>"> %
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="form-group">
    <label class="control-label">联创分红奖：</label>
    <div class="col-sm-5">
        <?php if(is_array($UsersLevel) || $UsersLevel instanceof \think\Collection || $UsersLevel instanceof \think\Paginator): $i = 0; $__LIST__ = $UsersLevel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level): $mod = ($i % 2 );++$i;?>
        <input name="level_award[<?php echo htmlentities($level['level_id']); ?>][level_id]" type="hidden" value="<?php echo htmlentities($level['level_id']); ?>">
        <input type="text" name="level_award[<?php echo htmlentities($level['level_id']); ?>][num]" class="input-ssmall" min="-1" value="<?php echo htmlentities($row['level_award'][$level['level_id']]['num']); ?>"> 元
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
                    </div>
                    
                    <div class="tab-pane" id="attribute">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品模型：</label>
                            <div class="col-sm-3">
                                <select name="type_model" id="type_model" class="input-max " data-toggle="select2"
                                        onChange="getGoodsAttriBute()">
                                    <option value="0" selected>请选择模型</option>
                                    <?php echo $modelListOpt; ?>
                                </select>
                            </div>
                        </div>
                        <div id="goods_attribute_box">
                        </div>
                        <script type="text/javascript">
                            function getGoodsAttriBute() {
                                var type_model = $("#type_model").val();
                                $('#goods_attribute_box').html('');
                                if (type_model < 1) return false;
                                jq_ajax('<?php echo _url("getAttriBute",array("goods_id"=>$row["goods_id"],"model_id"=>"【type_model】")); ?>', '', function (res) {
                                    if (res.code == 0) {
                                        _alert(res.msg);
                                        return false;
                                    }
                                    $('#goods_attribute_box').html(res.data.content);
                                });
                            }
                            $(function () {
                                getGoodsAttriBute();
                            });
                        </script>

                    </div>
                    <?php if($row['goods_id'] > '0'): ?>
                    <div class="tab-pane" id="log">
                        <table class="table table-bordered ">
                            <thead>
                            <tr>
                                <th width="150">记录时间</th>
                                <th width="150">操作者</th>
                                <th width="100">状态</th>
                                <th>备注</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($goodsLog) || $goodsLog instanceof \think\Collection || $goodsLog instanceof \think\Paginator): $i = 0; $__LIST__ = $goodsLog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$log): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td><?php echo htmlentities(dateTpl($log['log_time'])); ?></td>
                                <td><?php echo $log['opt_source']=='admin' ? '平台-'.adminInfo($log['operator']) : '供应商'; ?></td>
                                <td><?php echo htmlentities($log['status']); ?></td>
                                <td><?php echo htmlentities($log['log_info']); ?></td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>

                </div>
            </section>
        </section>
        <footer class="footer bg-white b-t p-t">
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-1">
                    <input name="goods_id" id="goods_id" type="hidden" value="<?php echo htmlentities(intval($row['goods_id'])); ?>">

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

<script type="text/javascript">
    seajs.use(["dist/plupload/init.js", "dist/goods/init.js"])
    $(function(){
        var goods_type = $("input[name='goods_type']:checked").val();
        if (goods_type == 1) {
            $('.commissions-box').addClass('hide');
        }else{
            $('.commissions-box').removeClass('hide');
        }
        $("input[name='goods_type']").on("change",function(){
            goods_type = $(this).val();
            if (goods_type == 1) {
                $('.commissions-box').addClass('hide');
            }else{
                $('.commissions-box').removeClass('hide');
            }
        })
    })
</script>

</body>
</html>