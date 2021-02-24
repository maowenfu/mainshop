<?php /*a:3:{s:53:"F:\WWW\M\application\mainadmin\view\payment\info.html";i:1613985989;s:53:"F:\WWW\M\application\mainadmin\view\layouts\base.html";i:1613985988;s:53:"F:\WWW\M\application\mainadmin\view\layouts\page.html";i:1613985988;}*/ ?>
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
                <strong><?php echo $row['pay_id']>0 ? '编缉支付' : '添加支付'; ?></strong>
            </li>
        </ul>
        <a class="text-muted pull-right m-r-tm m-t-md pointer" data-toggle="back" title="返回"><i class="fa fa-reply"></i></a>
    </div>
</header>
<form class="form-horizontal form-validate form_vbox" method="post" action="<?php echo url('info'); ?>">
    <section class="vbox">
        <section class="scrollable  wrapper w-f">
            <section class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">支付方式：</label>
                        <div class="col-sm-10">
                            <span class="help-inline"><?php echo htmlentities($row['pay_name']); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">接口类名：</label>
                        <div class="col-sm-10">
                            <span class="help-inline"><?php echo htmlentities($row['pay_code']); ?></span>
                        </div>
                    </div>

                    <?php if(is_array($row['def_config']) || $row['def_config'] instanceof \think\Collection || $row['def_config'] instanceof \think\Paginator): $i = 0; $__LIST__ = $row['def_config'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$prow): $mod = ($i % 2 );++$i;?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo htmlentities($prow['label']); ?>：</label>
                        <div class="col-sm-10">
                            <?php if($prow['type'] == 'file'): ?>
                            <div class="controls ">
                                <img class="thumb_img" name="imagefile" src="<?php echo htmlentities($row['pay_config'][$prow['name']]); ?>"
                                     style="max-height: 100px;"/>
                                <input class="hide" type="text" name="pay_config[<?php echo htmlentities($prow['name']); ?>]"
                                       value="<?php echo htmlentities($row['pay_config'][$prow['name']]); ?>"/>
                                <button class="btn btn-default" type="button" data-toggle="selectimg"
                                        data-config="selectimg">选择图片
                                </button>
                                <div style="color:red;margin-top:0.5rem">(请上传500*500的图片)</div>
                            </div>
                            <?php elseif($prow['type'] == 'select'): ?>
                            <select name="pay_config[<?php echo htmlentities($prow['name']); ?>]">
                                <?php if(is_array($prow['option']) || $prow['option'] instanceof \think\Collection || $prow['option'] instanceof \think\Paginator): $k = 0; $__LIST__ = $prow['option'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($k % 2 );++$k;?>
                                <option value="<?php echo htmlentities($index); ?>" <?php echo $row[
                                'pay_config'][$prow['name']]==$index ? 'selected' : ''; ?>><?php echo htmlentities($val); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <?php elseif($prow['type'] == 'checkbox'): if(is_array($prow['option']) || $prow['option'] instanceof \think\Collection || $prow['option'] instanceof \think\Paginator): $k = 0; $__LIST__ = $prow['option'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($k % 2 );++$k;?>
                            <label><input type="checkbox" name="pay_config[<?php echo htmlentities($prow['name']); ?>][]" <?php echo in_array($val['value'],$row['pay_config']['support'])?'checked':''; ?>
                                value="<?php echo htmlentities($val['value']); ?>"><?php echo htmlentities($val['name']); ?></label>
                            <?php endforeach; endif; else: echo "" ;endif; elseif($prow['type'] == 'textarea'): ?>
                            <textarea name="pay_config[<?php echo htmlentities($prow['name']); ?>]" <?php echo $prow['is_must']==1 ? 'data-rule-required="true"' : ''; ?>
                            style="width:80%; height:130px;"><?php echo htmlentities($row['pay_config'][$prow['name']]); ?></textarea>
                            <?php else: ?>
                            <input type="text" class="input-xlarge" <?php echo $prow['is_must']==1 ? 'data-rule-required="true"' : ''; ?>
                            name="pay_config[<?php echo htmlentities($prow['name']); ?>]" value="<?php echo htmlentities($row['pay_config'][$prow['name']]); ?>"/>
                            <?php endif; if($prow['is_must'] == 1): ?>
                            <span class="maroon">*</span>
                            <?php endif; if(!(empty($prow['tip']) || (($prow['tip'] instanceof \think\Collection || $prow['tip'] instanceof \think\Paginator ) && $prow['tip']->isEmpty()))): ?>
                            <span class="help-inline"><?php echo $prow['tip']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">排序（升序）：</label>
                        <div class="col-sm-10">
                            <input name="sort_order" class="input-mini " value="<?php echo htmlentities($row['sort_order']); ?>" type="text">
                            <span class="help-inline">数值越大排越前</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否启用：</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input name="status" value="1" <?php echo $row['status']==1 ? 'checked' : ''; ?> type="radio">启用
                            </label>
                            <label class="radio-inline" title="买家在下单时将无法使用此支付方式进行付款">
                                <input name="status" value="0" <?php echo $row['status']==0 ? 'checked' : ''; ?> type="radio">不启用
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">用于充值：</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input name="is_recharge" value="1" <?php echo $row['is_recharge']==1 ? 'checked' : ''; ?> type="radio">是
                            </label>
                            <label class="radio-inline">
                                <input name="is_recharge" value="0" <?php echo $row['is_recharge']==0 ? 'checked' : ''; ?>
                                type="radio">不是
                            </label>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <footer class="footer bg-white b-t p-t">
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-1">
                    <input name="pay_id" type="hidden" value="<?php echo htmlentities(intval($row['pay_id'])); ?>">
                    <button type="submit" class="btn btn-primary js_save_submit" data-loading-text="保存中...">保存</button>
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

</body>
</html>