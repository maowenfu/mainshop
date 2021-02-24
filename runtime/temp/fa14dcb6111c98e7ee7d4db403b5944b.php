<?php /*a:4:{s:59:"F:\WWW\M\application\member\view\sys_admin\users\index.html";i:1613985989;s:53:"F:\WWW\M\application\mainadmin\view\layouts\base.html";i:1613985988;s:58:"F:\WWW\M\application\member\view\sys_admin\users\list.html";i:1614001470;s:53:"F:\WWW\M\application\mainadmin\view\layouts\page.html";i:1613985988;}*/ ?>
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
    <form id="forms" class="talbe-search form-inline "  method="post" action="<?php echo url('getList'); ?>" >
     <div class="page-breadcrumbs">
            <ul class="breadcrumb" >
                <li>
                    <i class="fa fa-ellipsis-v"></i>
                    <strong><?php echo $is_ban==1 ? '封禁' : ''; ?>会员列表</strong>
                </li>                                  
            </ul>
            <select name="time_type"  style="width: 130px;" data-toggle="select2">
                    <option value="">选择时间类型</option>
                    <option value="reg_time" <?php echo $search['time_type']=='reg_time' ? 'selected' : ''; ?>>注册时间</option>
                    <option value="login_time" <?php echo $search['time_type']=='login_time' ? 'selected' : ''; ?>>登陆时间</option>
                    <option value="buy_time" <?php echo $search['time_type']=='buy_time' ? 'selected' : ''; ?>>购买时间</option>
              </select>
            <a class="btn btn-default time_sel" data-toggle="reportrange" data-change="submit">
                    <i class="fa fa-calendar fa-lg"></i>                      
                    <span></span> <b class="caret"></b>
                    <input type="hidden" value="<?php echo htmlentities($start_date); ?> - <?php echo htmlentities($end_date); ?>" id="reportrange" name="reportrange" />
             </a>
             <select name="rode_id"  style="width: 130px;" data-toggle="select2" data-placeholder="按自定义筛选" data-chang="submit">
						<option value="-1">所有会员</option>
                        <option value="all_role" <?php echo $search['roleId']=='all_role' ? 'selected' : ''; ?>>身份会员</option>
						<option value="0">普通粉丝</option>
                        <?php echo $roleOpt; ?>
              </select>
              <select name="level_id"  style="width: 130px;" data-toggle="select2" data-placeholder="按自定义筛选" data-chang="submit">
                        <option value="">所有等级</option>
                       <?php echo $levelOpt; ?>
              </select>
         <input type="hidden" value="0" name="export">
              <input type="text" class="form-control input-large" value="<?php echo htmlentities($search['keyword']); ?>" name="keyword" placeholder="会员ID/帐号/手机号码" data-rule-required="true" />
              <button class="btn btn-sm btn-default-iq" type="submit" title="搜索"><i class="fa fa-search"></i></button>
         <a href="javascript:;" onclick="ExportList()" title="导出" class="btn btn-sm btn-default fr m-t-md m-r"><i class="fa fa-file-excel-o m-r-xs"></i>导出列表</a>
         <a href="<?php echo url('addUser'); ?>" data-toggle="ajaxModal" title="新增会员" class="btn btn-sm btnbtn-default fr  m-t-md m-r"><i class="fa fa-plus m-r-xs"></i>新增会员</a>
        </div>
    </form>
</header>

<section class="scrollable wrapper w-f ">
    <section class="panel panel-default ">
        <div class="table-responsive " id="list_box">
            <table class="table  table-hover  m-b-none">
<thead>
<tr>
	<th width="90" class="th-sortable" data-sort-name="u.user_id">UID</th>
    <th width="120">注册手机</th>
    <th width="100">用户名</th>
    <th width="120">推荐人</th>
    <th width="150">等级/身份</th> 
    <th width="100">帐户余额</th> 
    <th width="130">最近登陆</th>    
    <th width="80">操作</th>
</tr>
</thead>
<tbody>

<?php if(is_array($data['list']) || $data['list'] instanceof \think\Collection || $data['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<tr>
<td><?php echo htmlentities($vo['user_id']); ?></td>
<td><?php echo htmlentities($vo['mobile']); ?></td>
<td><?php echo htmlentities($vo['nick_name']); ?></td>
<td><?php if($vo['pid'] > 0): ?><?php echo htmlentities($vo['pid']); ?> - <?php echo htmlentities(userInfo($vo['pid'])); else: ?>没有上级<?php endif; ?></td>
<td><?php echo htmlentities(userLevel($vo['total_integral'])); ?> / 
<?php if($vo['role_id'] == '0'): ?>
粉丝
<?php else: ?>
<?php echo htmlentities($roleList[$vo['role_id']]['role_name']); ?>
<?php endif; ?>
</td>

<td><?php echo htmlentities($vo['balance_money']); ?></td>
<td><?php echo htmlentities(dateTpl($vo['login_time'])); ?></td>
    <td>
        <a href="<?php echo url('info',array('user_id'=>$vo['user_id'])); ?>" class="m-xs" title="编缉">
            <i class="fa fa-edit"></i>编缉
        </a>
        <a data-toggle="dropdown" href="javascript:void(0);" class="m-xs" title="编缉">
            更多<i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a title="重置密码"  data-confirm="您确定要重置该会员密码，重置为Abc123456" data-toggle="cfmAjax" href="<?php echo url('restPassword',array('user_id'=>$vo['user_id'])); ?>" class="m-xs"><i class="fa fa-rotate-left text-muted"></i> 重置密码</a>
            </li>
            <li>
                <?php if($vo['is_ban'] == '0'): ?>
                <a title="封禁会员"  data-confirm="您确定要封禁该会员，封禁后则会员则无法登陆? " data-toggle="cfmAjax" href="<?php echo url('evelBan',array('user_id'=>$vo['user_id'])); ?>" class="m-xs"><i class="fa fa-lock text-muted"></i> 封禁会员</a>
                <?php else: ?>
                <a title="解禁会员"  data-confirm="您确定要解禁该会员，解禁后则会员则可正常登陆? " data-toggle="cfmAjax" href="<?php echo url('reBan',array('user_id'=>$vo['user_id'])); ?>" class="m-xs"><i class="fa fa-unlock text-muted"></i> 解禁会员</a>
                <?php endif; ?>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo url('shop/sys_admin.order/index',array('user_id'=>$vo['user_id'])); ?>" class="m-xs" title="查看订单"><i class="fa fa-search text-muted"></i> 查看订单</a>
            </li>
            <li>
                <a href="<?php echo url('sys_admin.accountLog/index',array('user_id'=>$vo['user_id'])); ?>" class="m-xs" title="资金变动明细"><i class="fa fa-dollar text-muted"></i> 资金明细</a>
            </li>
            <li>
                <a href="<?php echo url('sys_admin.logOperate/index',array('edit_id'=>$vo['user_id'])); ?>" class="m-xs" title="操作日志"><i class="fa fa-calendar text-muted"></i> 操作日志</a>
            </li>
        </ul>
    </td>
</tr>

<?php endforeach; endif; else: echo "" ;endif; ?> 
</tbody>
</table>
<?php if(empty($data['list']) || (($data['list'] instanceof \think\Collection || $data['list'] instanceof \think\Paginator ) && $data['list']->isEmpty())): ?>
<table width="100%" >
 	<tr><td height="300" colspan="8" align="center" valign="middle" >没有相关数据！</td></tr>
</table>
<?php endif; ?>  
        </div>
    </section>
</section>
<script>
    function ExportList(){
        $('input[name="export"]').val('1');
        $('#forms').submit();
        $('input[name="export"]').val('0');
    }
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