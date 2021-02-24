<?php /*a:4:{s:63:"F:\WWW\M\application\distribution\view\sys_admin\role\info.html";i:1613999644;s:53:"F:\WWW\M\application\mainadmin\view\layouts\base.html";i:1613985988;s:61:"F:\WWW\M\application\shop\view\sys_admin\goods\sel_goods.html";i:1613985989;s:53:"F:\WWW\M\application\mainadmin\view\layouts\page.html";i:1613985988;}*/ ?>
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
                    <strong><?php echo $row['role_id']>0 ? '编辑' : '添加'; ?>身份</strong>
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
                        <label class="control-label">身份名称：</label>
                        <div class="col-sm-6">
                            <input type="text" class="input-large" data-rule-maxlength="20" data-rule-required="true"
                                   name="role_name" value="<?php echo htmlentities($row['role_name']); ?>"><span class="maroon">*</span>
                        </div>
                    </div>
                    <div class="form-group hide">
                        <label class=" control-label"> 身份排序：</label>
                        <div class="col-sm-6 ">
                            <select name="byLevel">
                                <option value="0">设为【粉丝】上级</option>
                                <?php if(is_array($allroleList) || $allroleList instanceof \think\Collection || $allroleList instanceof \think\Paginator): $i = 0; $__LIST__ = $allroleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo htmlentities($role['level']); ?>" <?php echo $role['level']==$row['level']-1 ? 'selected' : ''; ?>>设为【<?php echo htmlentities($role['name']); ?>】上级</option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" control-label">升级方式：</label>
                        <div class="col-sm-9">
                            <?php if($row['is_auto'] == 1): ?>
                            <label>
                                <input type="radio" name="is_auto" class="js_radio_undertake"
                                          data-class="upleve_setting" value="1" <?php echo $row['is_auto']<=1 ? 'checked' : ''; ?>>
                                <?php if($row['role_id'] == 1): ?> 
                                购买任意排位商品
                                <?php else: ?>        
                                满足条件升级
                                <?php endif; ?>
                            </label>
                            <?php else: ?>
                            <label><input type="radio" name="is_auto" class="js_radio_undertake" value="9" <?php echo $row['is_auto']==9 ? 'checked' : ''; ?>>
                                手动调整</label>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="radio_undertake_is_auto upleve_setting <?php echo $row['is_auto']<=1 ? '' : 'hide'; ?>">

                        <!-- <div class="form-group">
                            <label class="control-label">升级设置：</label>
                            <div class="col-sm-6">
                                <select name="upleve_function" id="upleve_function">

                                    <?php if(is_array($upLevel) || $upLevel instanceof \think\Collection || $upLevel instanceof \think\Paginator): $i = 0; $__LIST__ = $upLevel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo htmlentities($val['function']); ?>" <?php echo $row[
                                    'upleve_function']==$val['function'] ? 'selected' : ''; ?>
                                    data-jsonval='<?php echo htmlentities(json_encode($val['val'])); ?>'
                                    data-explain="<?php echo htmlentities($val['explain']); ?>"><?php echo htmlentities($val['name']); ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                <input name="uplevel_fun_name" id="uplevel_fun_name" type="hidden"
                                       value="<?php echo htmlentities($row['uplevel_fun_name']); ?>"/>
                                <span class="help-inline"></span>
                            </div>
                        </div> -->
                        <!-- <div class="form-group">
                            <label class=" control-label">升级条件：</label>
                            <div class="col-sm-9">
                                <label><input type="radio" name="up_condition" value="1" <?php echo $row['up_condition']<=1 ? 'checked' : ''; ?>>
                                    满足任意一项条件</label>
                                <label><input type="radio" name="up_condition" value="2" <?php echo $row['up_condition']==2 ? 'checked' : ''; ?>>
                                    满足全部条件(除指定商品，如果设置指定商品，购买即升级)</label>
                            </div>
                        </div> -->
                        <?php if($row['role_id'] > 1 && $row['role_id'] < 5): ?>
                        <div class="form-group">
                            <label class=" control-label">升级条件：</label>
                            <div class="col-sm-9">
                                直推：
                                <input type="text" name="function_val[push_num]" class="input-ssmall" data-rule-required="true" value="<?php echo htmlentities($upleve_value['push_num']); ?>" aria-required="true"><span class="help-inline">单</span>，
                                伞下业绩：
                                <input type="text" name="function_val[team_income]" class="input-ssmall" data-rule-required="true" value="<?php echo htmlentities($upleve_value['team_income']); ?>" aria-required="true"><span class="help-inline">单</span>
                                <?php if($row['role_id'] > 2): if(is_array($allroleList) || $allroleList instanceof \think\Collection || $allroleList instanceof \think\Paginator): $i = 0; $__LIST__ = $allroleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;if($role['role_id'] == $row['role_id'] - 1): ?>
                                ，伞下<?php echo htmlentities($role['role_name']); ?>人数：<input type="text" name="function_val[team_role][<?php echo htmlentities($row['role_id']); ?>]" class="input-ssmall" data-rule-required="true" value="<?php echo htmlentities($upleve_value['team_role'][$row['role_id']]); ?>" aria-required="true"> 人
                                <?php endif; ?>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>                              
                        </div>
                        
                        <!-- <div id="upleve_function_box" class="panel-default">

                        </div> -->
                    </div>

                </div>
            </section>
        </section>
        <footer class="footer bg-white b-t p-t">
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-1">
                    <input name="role_id" type="hidden" value="<?php echo htmlentities(intval($row['role_id'])); ?>">
                    <button type="submit" class="btn btn-primary js_save_submit" data-loading-text="保存中...">保存</button>
                    <button type="button" class="btn btn-default" data-toggle="back">取消</button>
                </div>
            </div>
        </footer>
    </section>
</form>
<?php $limitBuyNum = '1'; ?>
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


<script type="text/html" id="upLevel_tpl"> 
<div class="form-group">
	  <label class="control-label">详细说明：</label>
	  <div class="col-sm-8 m-t-mc">{{explain}}</div>
</div>

{{each list as item index}}
{{if item.input == 'sel_role'}}
	<div class="form-group">
       	 <label class=" control-label">{{item.text}}：</label>
		  <div class="col-sm-9" >
              粉丝
              <input type="text" name="function_val[{{item.name}}][0]"  class="input-ssmall" data-rule-required="true" value="{{value[item.name]?value[item.name][0]:0}}"><span class="help-inline">{{item.tip}}</span>
              {{each roleList as role index}}
               {{role.name}}
              <input type="text" name="function_val[{{item.name}}][{{role.role_id}}]"  class="input-ssmall" data-rule-required="true" value="{{value[item.name]?value[item.name][role.role_id]:0}}"><span class="help-inline">{{item.tip}}</span>
              {{/each}}
          </div>
	</div>
{{else if item.input == 'team_role'}}
<div class="form-group">
    <label class=" control-label">{{item.text}}：</label>
    <div class="col-sm-9" >
        粉丝
        <input type="text" name="function_val[{{item.name}}][0]"  class="input-ssmall" data-rule-required="true" value="{{value[item.name]?value[item.name][0]:0}}"><span class="help-inline">{{item.tip}}</span>
        {{each roleList as role index}}
        {{role.name}}
        <input type="text" name="function_val[{{item.name}}][{{role.role_id}}]"  class="input-ssmall" data-rule-required="true" value="{{value[item.name]?value[item.name][role.role_id]:0}}"><span class="help-inline">{{item.tip}}</span>
        {{/each}}
    </div>
</div>
{{else}}
<div class="form-group">
        <label class=" control-label">{{item.text}}：</label>
        <div class="col-sm-9" >			
			{{if item.rule == 'ismoney' || item.rule == 'integer'}}
				<input type="text" name="function_val[{{item.name}}]"  class="input-medium" data-rule-required="true" data-rule-{{item.rule}}="true" value="{{value[item.name]?value[item.name]:'0'}}">
				<span class="help-inline">{{item.tip}}</span>
			{{else if item.input == 'text'}}
			   <input type="text" name="function_val[{{item.name}}]"  class="input-large" data-rule-required="true" value="{{value[item.name]}}"><span class="help-inline">{{item.tip}}</span>

			{{else if item.input == 'radio'}}
				{{each item.selval as selval index}}
			      <label><input type="radio"  name="function_val[{{item.name}}]" value="{{index}}" {{value[item.name]==index?'checked':''}}> {{selval}}</label>
				 {{/each}}
			{{else if item.input == 'sel_goods'}}
				{{include 'selGoods_tpl'}}
				<div class="col-sm-6 col-sm-offset-1 m-t">单次购买指定商品和数量的会员才能进行升级.</div>
			{{/if}}
      </div>
</div>
{{/if}}
{{/each}}

</script>  
 
<script type="text/javascript">
var upleve_value = <?php echo json_encode($row['function']); ?>;
var arr = [];
arr.roleList = <?php echo json_encode($roleList); ?>;


function upleveFunction(){
	$("#upleve_function_box").html('');
	var obj = $('#upleve_function').find('option:selected');		
	var jsonval = obj.data('jsonval');
	if (typeof(jsonval) == 'undefined') return false;
	$('#uplevel_fun_name').val(obj.text());
	var val = obj.val();
	if (typeof(upleve_value[val]) == 'undefined'){
		upleve_value[val] = [];
	}
    arr.list = jsonval;
    arr.explain = obj.data('explain');
    arr.value = upleve_value[val];
    arr.goodsList = upleve_value[val].buy_goods;
    arr.select_type = 'buy_goods';
	$("#upleve_function_box").html(template("upLevel_tpl", arr));
}
$(function(){
	$("#upleve_function").change(function (){
		upleveFunction();
	})
	upleveFunction();
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

</body>
</html>