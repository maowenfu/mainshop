<?php /*a:4:{s:64:"F:\WWW\M\application\distribution\view\sys_admin\award\info.html";i:1613985988;s:53:"F:\WWW\M\application\mainadmin\view\layouts\base.html";i:1613985988;s:61:"F:\WWW\M\application\shop\view\sys_admin\goods\sel_goods.html";i:1613985989;s:53:"F:\WWW\M\application\mainadmin\view\layouts\page.html";i:1613985988;}*/ ?>
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
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-ellipsis-v"></i>
                    <strong><?php echo $row['award_id']>0 ? '编辑' : '添加'; ?>奖项</strong>
                </li>                                  
            </ul>
           <a class="text-muted pull-right pointer p-r m-t-md" data-toggle="back" title="返回"><i class="fa fa-reply"></i></a>
        </div>
</header>
<form class="form-horizontal form-validate form_vbox" method="post" action="<?php echo url('info'); ?>">
    <section class="vbox">
        <section class="scrollable  wrapper w-f">
            <section class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">奖项名称：</label>
                        <div class="col-sm-6">
                            <input type="text" class="input-large" data-rule-maxlength="20" data-rule-required="true"
                                   name="award_name" value="<?php echo htmlentities($row['award_name']); ?>"><span class="maroon">*</span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">参与分销身份：</label>
                        <div class="col-sm-9">
                            <li style="list-style:none; float:left; margin:2px;">
                                <label><input type="checkbox" name="limit_role[]" data-role_name="粉丝" class="selectRole"
                                              value="0" <?php echo in_array(0,$row['limit_role'])?'checked':''; ?>> 粉丝</label>
                            </li>
                            <?php if(is_array($UsersRole) || $UsersRole instanceof \think\Collection || $UsersRole instanceof \think\Paginator): $i = 0; $__LIST__ = $UsersRole;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$urow): $mod = ($i % 2 );++$i;?>
                            <li style="list-style:none; float:left; margin:2px;">
                                <label><input type="checkbox" name="limit_role[]" data-role_name="<?php echo htmlentities($urow['role_name']); ?>"
                                              class="selectRole"
                                              value="<?php echo htmlentities($urow['role_id']); ?>" <?=in_array($urow['role_id'],$row['limit_role'])?'checked':'';?>
                                    > <?php echo htmlentities($urow['role_name']); ?></label>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" control-label">购买商品：</label>
                        <div class="col-sm-9">
                            <label><input type="radio" name="goods_limit" value="1" class="js_radio_undertake" <?php echo $row['goods_limit']<=1 ? 'checked' : ''; ?>
                                > 购买任意分销商品</label>
                            <label><input type="radio" name="goods_limit" value="2" class="js_radio_undertake"
                                          data-class="buy_goods" <?php echo $row['goods_limit']==2 ? 'checked' : ''; ?>>
                                购买指定分销商品</label>

                            <div class="radio_undertake_goods_limit buy_goods  <?php echo $row['goods_limit']==2 ? '' : 'hide'; ?>"></div>


                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" control-label">奖项类型：</label>
                        <div class="col-sm-9">
                            <label><input type="radio" name="award_type" value="1" class="js_radio_undertake"
                                          data-class="award_setting|ordinary_type" <?php echo $row['award_type']<=1 ? 'checked' : ''; ?>>
                                普通分销</label>
                            <label><input type="radio" name="award_type" value="2" class="js_radio_undertake "
                                          data-class="repeat_limit_val|assigned_manage_tip|award_manage_setting" <?php echo $row['award_type']==2 ? 'checked' : ''; ?>
                                onclick="evelLimitRole()"> 业绩返点奖</label>
                            <label><input type="radio" name="award_type" value="3" class="js_radio_undertake"
                                          data-class="role_award_setting" <?php echo $row['award_type']==3 ? 'checked' : ''; ?>>
                                身份分销</label>
                            <div>
                                <label class="radio_undertake_award_type assigned_manage_tip  <?php echo $row['award_type']==2 ? '' : 'hide'; ?>">
                                    一、根据上级是【粉丝】则拿【粉丝】的奖励，再续续往找上级<br>
                                    二、直属上级身份跟购买会员身份一致，如果设置平级奖则拿平级（不扣减上级奖励），不设置则拿对应身份奖励，直接跳过设置-1<br>
                                    三、最高奖励数量为最高级别的奖励设置的数量，每级递减.<br>
                                    四、算法：低级身份10元，次级身份20元，高级身份30元<br>
                                    1、低级身份分佣10元，则次级身份佣金也是10元<br>
                                    2、直属上级为次级身份则直接拿20元<br>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group radio_undertake_award_type ordinary_type <?php echo $row['award_type']==1 ? '' : 'hide'; ?>">
                        <label class=" control-label">普通分销模式：</label>
                        <div class="col-sm-9">
                            <label><input type="radio" name="ordinary_type" value="0" <?php echo $row['ordinary_type']==0 ? 'checked' : ''; ?>>
                                逐级计算（一级奖项对应第一级上级会员，不满足条件奖项不分配，逐级判断）</label>
                            <br>
                            <label><input type="radio" name="ordinary_type" value="1" <?php echo $row['ordinary_type']==1 ? 'checked' : ''; ?>>
                                无限级计算（不满足条件，跳过，一直向上找直到奖项分完或没有上级终止）</label>

                        </div>
                    </div>


                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group radio_undertake_award_type award_setting <?php echo $row['award_type']==1 ? '' : 'hide'; ?>">
                        <label class="control-label">奖项设置：</label>
                        <div class="col-sm-8">
                            <table class="table table-hover  table-bordered">
                                <thead>
                                <tr>
                                    <th class="txt_center">级别</th>
                                    <th class="txt_center" width="180">奖励名称</th>
                                    <th class="txt_center">上级奖励</th>
                                    <th class="txt_center" width="70">操作</th>
                                </tr>
                                </thead>
                                <tbody id="d_level_box">


                                </tbody>
                                <tr>
                                    <td colspan="5" align="center">
                                        <button type="button" class="btn btn-default " onClick="addLevel();">增加级别奖励
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="form-group radio_undertake_award_type role_award_setting <?php echo $row['award_type']==3 ? '' : 'hide'; ?>">
                        <label class="control-label">奖项设置：</label>
                        <div class="col-sm-8">
                            <table class="table table-hover  table-bordered ">
                                <thead>
                                <tr>
                                    <th class="txt_center">级别</th>
                                    <th class="txt_center" width="180">奖励名称</th>
                                    <th class="txt_center">奖励</th>
                                    <th class="txt_center" width="70">操作</th>
                                </tr>
                                </thead>
                                <tbody id="d_role_goods_box">


                                </tbody>
                                <tr>
                                    <td colspan="5" align="center">
                                        <button type="button" class="btn btn-default " onClick="addLevel();">增加级别奖励
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="form-group radio_undertake_award_type award_manage_setting <?php echo $row['award_type']==2 ? '' : 'hide'; ?>">
                        <label class="control-label">管理奖项：</label>
                        <div class="col-sm-7">
                            <table class="table table-hover  table-bordered">
                                <thead>
                                <tr>
                                    <th class="txt_center">分销身份</th>
                                    <th class="txt_center">奖励名称</th>
                                    <th class="txt_center">上级奖励</th>
                                    <th class="txt_center">平级奖励</th>
                                </tr>
                                </thead>
                                <tbody id="d_role_box">


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <footer class="footer bg-white b-t p-t">
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-1">
                    <input name="award_id" type="hidden" value="<?php echo htmlentities(intval($row['award_id'])); ?>">
                    <button type="submit" class="btn btn-primary js_save_submit" data-loading-text="保存中...">保存</button>
                    <button type="button" class="btn btn-default" data-toggle="back">取消</button>
                </div>
            </div>
        </footer>
    </section>
</form>
<?php $is_dividend = '1'; ?>
<script type="text/html" id="selGoods_tpl"> 
<div class="m-b">
     <input id="{{select_type}}_keyword" type="text" class="input-medium" placeholder="商品名称/SN" aria-invalid="false">
    
     <button class="btn btn-default fa fa-search" title="搜索" type="button" onclick="searchGoods('{{select_type}}')" ></button>
 
      <select id="{{select_type}}_select" class="m-r" style="width:250px;" data-toggle="select2" >
         <option value="">选择商品</option>
      </select>

    <a href="javascript:;" title="增加" class="btn btn-default  fa fa-plus" onclick="selLinkGoods('{{select_type}}')"></a>
</div>


	<table class="table table-bordered  " style="width:800px;">
        <thead>
            <tr>
                <th width="150">商品SN<?php echo htmlentities($limitBuyNum); ?></th>
                <th>商品名称</th>
                <?php if(!(empty($limitBuyNum) || (($limitBuyNum instanceof \think\Collection || $limitBuyNum instanceof \think\Paginator ) && $limitBuyNum->isEmpty()))): ?>
                <th width="120">购买数量</th>
                <?php endif; ?>
                <th width="70">操作</th>
            </tr>
        </thead>
        <tbody id="{{select_type}}_box">
		{{each goodsList as item index}}
         <tr id="{{select_type}}_tr_{{item.goods_id}}">
             <td><input name="{{select_type}}_id[]" type="hidden" value="{{item.goods_id}}" />{{item.goods_sn}}</td>
             <td>{{item.goods_name}}</td>
             <?php if(!(empty($limitBuyNum) || (($limitBuyNum instanceof \think\Collection || $limitBuyNum instanceof \think\Paginator ) && $limitBuyNum->isEmpty()))): ?>
             <td><input name="{{select_type}}_limit_num[]" class="input-max" value="{{item.limit_num}}"></td>
             <?php endif; ?>
             <td><a href="javascript:;" title="删除" class="fa fa-remove m-xs" onclick="delLinkGoods('{{select_type}}',{{item.goods_id}})" ></a></td>
         </tr>
		 {{/each}}
        </tbody>
    </table>
</div>   
</script>
<script type="text/javascript">
function searchGoods(select_type){
	var arr = new Object();
	arr.keyword = $('#'+select_type+'_keyword').val();
	arr.min_search = 1;
	arr.is_dividend = <?php echo htmlentities(intval($is_dividend)); ?>;
	$('#'+select_type+'_select').html('<option value="">选择商品</option>');
	var res = jq_ajax('<?php echo url("shop/sys_admin.goods/pubSearch"); ?>',arr);
	$.each(res.list, function(i,value){
		$('#'+select_type+'_select').append('<option value="'+value.goods_id+'" data-goods_sn="'+value.goods_sn+'">'+value.goods_name+'</option>');
	})
}
function selLinkGoods(select_type){
	var goods_id = $('#'+select_type+'_select').val();
	if (goods_id < 1) return false;
	var isrep = false;
	$('#'+select_type+'_box').find('input').each(function(){
		if (goods_id == $(this).val()) return isrep = true;
	})
	if (isrep == true) return _alert('列表中已存在相关商品');
	var goods_name = $('#'+select_type+'_select').find("option:selected").text();
	var goods_sn = $('#'+select_type+'_select').find("option:selected").data('goods_sn');
	$('#'+select_type+'_box').append('<tr id="'+select_type+'_tr_'+goods_id+'"><td><input name="'+select_type+'_id[]" type="hidden" value="'+goods_id+'" />'
						+goods_sn+'</td><td>'+goods_name+'</td>'
                    <?php if(!(empty($limitBuyNum) || (($limitBuyNum instanceof \think\Collection || $limitBuyNum instanceof \think\Paginator ) && $limitBuyNum->isEmpty()))): ?>
                        +'<td><input name="'+select_type+'_limit_num[]" class="input-max" value="1"></td>'
                    <?php endif; ?>
						+'<td><a href="javascript:;" title="删除" class="fa fa-remove m-xs" onclick="delLinkGoods(\''+select_type+'\','+goods_id+')" ></a>'
						+'</td></tr>');
}
function delLinkGoods(select_type,goods_id){
	$('#'+select_type+'_tr_'+goods_id).remove();
}
</script>

<script type="text/html" id="d_level_tr">
<tr class="d_level_tr">
	<td align="center">{{val}}<input name="award_value[{{key}}][level]" type="hidden" value="{{key}}" /></td>
	<td ><input type="text" name="award_value[{{key}}][name]" class="input-max" data-rule-required="true" value="{{name}}"></td>
	<td style="text-align: right;">
            <input type="text" name="award_value[{{key}}][num]" class="input-ssmall" min="0.01" data-rule-ismoney="true"  value="{{num}}">
            <select name="award_value[{{key}}][num_type]"><option value="money" {{num_type=='money'?'selected':''}}>固定金额</option><option value="per" {{num_type=='per'?'selected':''}}>%百分比</option></select>
    </td>
    <td align="center"><a href="javascript:;" title="删除" onClick="delLevel({{key}});"><i class="fa fa-trash-o text-muted"></i></a></td>
</tr>
</script>
<script type="text/html" id="d_role_goods_tr">
    <tr class="d_role_goods_tr">
        <td align="center">{{val}}<input name="award_value[{{key}}][level]" type="hidden" value="{{key}}" /></td>
        <td ><input type="text" name="award_value[{{key}}][name]" class="input-max" data-rule-required="true" value="{{name}}"></td>
        <td style="text-align: right;">
            {{each roleList as role index}}
            <p>
                {{role.role_name}}：
                <input type="text" name="award_value[{{key}}][num][{{role.role_id}}]" class="input-ssmall" min="0" data-rule-ismoney="true"  value="{{num[role.role_id]}}">
                <select name="award_value[{{key}}][num_type][{{role.role_id}}]"><option value="money" {{num_type[role.role_id]=='money'?'selected':''}}>固定金额</option><option value="per" {{num_type[role.role_id]=='per'?'selected':''}}>%百分比</option></select>
            </p>
            {{/each}}
        </td>
        <td align="center"><a href="javascript:;" title="删除" onClick="delLevel({{key}});"><i class="fa fa-trash-o text-muted"></i></a></td>
    </tr>
</script>
<script type="text/html" id="d_role_tr">
<tr >
	<td align="center">{{role_name}}<input name="role_award_value[{{role_id}}][role_id]" type="hidden" value="{{role_id}}" /></td>
	<td ><input type="text" name="role_award_value[{{role_id}}][name]" class="input-max" data-rule-required="true" value="{{name}}"></td>
	<td ><input type="text" name="role_award_value[{{role_id}}][num]" class="input-ssmall" min="0.01" data-rule-ismoney="true"   value="{{num}}"><select name="role_award_value[{{role_id}}][num_type]"><option value="money" {{num_type=='money'?'selected':''}}>固定金额</option><option value="per" {{num_type=='per'?'selected':''}}>%百分比</option></select></td>
    <td ><input type="text" name="role_award_value[{{role_id}}][same_num]" class="input-ssmall" min="-1"  value="{{same_num}}"><select name="role_award_value[{{role_id}}][same_num_type]"><option value="money" {{same_num_type=='money'?'selected':''}}>固定金额</option><option value="per" {{num_type=='per'?'selected':''}}>%百分比</option></select></td>

</tr>
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

<script type="text/javascript">
var d_level = <?php echo json_encode($d_level); ?>;

var award_value = <?php echo $row['award_value']; ?>;
var award_type = <?php echo htmlentities(intval($row['award_type'])); ?>;
var data = [];
data.select_type = 'buy_goods';
data.goodsList = <?php echo json_encode($row['buy_goods_list']); ?>;
$(".buy_goods").html(template("selGoods_tpl",data));
data.goodsList = <?php echo json_encode($row['repeat_goods_list']); ?>;
data.select_type = 'repeat_goods';
$(".repeat_goods").html(template("selGoods_tpl",data));


//处理管理奖
function evelLimitRole(){	
	$('#d_role_box').html('');
	$('.selectRole').each(function(i,v){
		if ($(this).prop("checked")) {
			var val = [];
			val.role_name = $(this).data('role_name');
			val.role_id = $(this).val();
			$('#d_role_box').append(template('d_role_tr',val));
		}
	})	
}
//优先加载
if (award_type == 2) {
    var d_userRole = <?php echo json_encode($UsersRole); ?>;
    $.each(award_value,function(i,v){
        v.role_name = d_userRole[i].role_name;
        v.role_id = i;
        $('#d_role_box').append(template('d_role_tr',v));
    })
}else if (award_type == 3){
        $.each(award_value,function(i,v){
            v.val = d_level[i];
            v.key = i;
            var roleList = [];
            $('.selectRole').each(function(i,v){
                var val = [];
                val.role_name = $(this).data('role_name');
                val.role_id = $(this).val();
                roleList.push(val);
            })
            v.roleList = roleList;
            $('#d_role_goods_box').append(template('d_role_goods_tr',v));
        })
}else{
    $.each(award_value,function(i,v){
        v.val = d_level[i];
        v.key = i;

        $('#d_level_box').append(template('d_level_tr',v));
    })
}


$('.selectRole').click(function(){
    evelLimitRole();
})


function addLevel(){
    var _award_type = $("input[name='award_type']:checked").val();
    if (_award_type == 3){
        var length = $('.d_role_goods_tr').length;
        if (length >= 3) return _alert("级别不能超过三级！");
        var _level = new Object;
        _level.key = length+1;
        _level.val = d_level[length+1];
        _level.num = [];
        _level.num_type = [];
        var roleList = [];
        $('.selectRole').each(function(i,v){
            var val = [];
            val.role_name = $(this).data('role_name');
            val.role_id = $(this).val();
            roleList.push(val);
        })
        _level.roleList = roleList;
        $('#d_role_goods_box').append(template('d_role_goods_tr',_level));
    }else{
        var length = $('.d_level_tr').length;
        if (length >= 3) return _alert("级别不能超过三级！");
        var _level = new Object;
        _level.key = length+1;
        _level.val = d_level[length+1];
        $('#d_level_box').append(template('d_level_tr',_level));
    }
}
function delLevel(key){
    var _award_type = $("input[name='award_type']:checked").val();
    if (_award_type == 3) {
        var length = $('.d_role_goods_tr').length;
        if (key < length) return _alert("不允许跨级删除！");
        $('.d_role_goods_tr').eq(key - 1).remove();
    }else{
        var length = $('.d_level_tr').length;
        if (key < length) return _alert("不允许跨级删除！");
        $('.d_level_tr').eq(key - 1).remove();
    }

}
</script>


</body>
</html>