<?php /*a:3:{s:54:"F:\WWW\M\application\mainadmin\view\setting\index.html";i:1613985989;s:53:"F:\WWW\M\application\mainadmin\view\layouts\base.html";i:1613985988;s:53:"F:\WWW\M\application\mainadmin\view\layouts\page.html";i:1613985988;}*/ ?>
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
                <strong>基本信息</strong>
            </li>
        </ul>
    </div>
</header>
<form class="form-horizontal form-validate form_vbox" method="post" action="<?php echo url('save'); ?>">
    <section class="vbox">
        <section class="scrollable  wrapper w-f">
            <section class="panel panel-default">
                <header>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#basic" data-toggle="tab">基本配置</a></li>
                        <li><a href="#about_us" data-toggle="tab">关于我们</a></li>
                        <li><a href="#app" data-toggle="tab">APP设置</a></li>
                        <li><a href="#payment" data-toggle="tab">收款方式</a></li>
                    </ul>
                </header>

                <div class="tab-content">
                    <div class="tab-pane active" id="basic">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">网站名称：</label>
                            <div class="controls col-sm-4 ">
                                <input type="text" name="setting[shop_title]" placeholder="请输入商城名称" class="input-max"
                                       data-rule-required="true"
                                       value="<?php echo htmlentities($setting['shop_title']); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">LOGO：</label>
                            <div class="controls col-sm-6">
                                <span class="help-inline">建议图片尺寸：320*320像素</span><br>
                                <img class="thumb_img" src="<?php echo htmlentities($setting['logo']); ?>" style="max-height: 100px;"/><br>
                                <input class="hide" type="text" name="setting[logo]" value="<?php echo htmlentities($setting['logo']); ?>"/>
                                <button class="btn btn-default" type="button" data-toggle="selectimg">选择logo</button>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">版权：</label>
                            <div class="controls col-sm-6">
                                <input type="text" data-rule-maxlength="25" class="input-max" name="setting[copyright]"
                                       value="<?php echo htmlentities($setting['copyright']); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">备案编号：</label>
                            <div class="controls">
                                <input type="text" data-rule-maxlength="25" class="input-max" name="setting[ipc_no]"
                                       value="<?php echo htmlentities($setting['ipc_no']); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">联系电话：</label>
                            <div class="controls ">
                                <input type="text" data-rule-maxlength="15" class="input-max" name="setting[tel]"
                                       value="<?php echo htmlentities($setting['tel']); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">公司地址：</label>
                            <div class="controls col-sm-6 ">
                                <input type="text" class="input-max" name="setting[address]"
                                       value="<?php echo htmlentities($setting['address']); ?>"/>
                            </div>
                        </div>

                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">默认关键字：</label>
                            <div class="controls col-xs-7 ">
                                <input type="text" class="input-max" data-rule-maxlength="200" name="setting[keywords]"
                                       value="<?php echo htmlentities($setting['keywords']); ?>">
                                <span class="help-inline">用空格分隔</span></div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">默认简单描述：</label>
                            <div class="controls col-xs-7">
                                <textarea name="setting[description]" class="input-max" style="height:100px;"><?php echo htmlentities($setting['description']); ?></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane " id="about_us">
                        <div class="form-group">
                            <label class="control-label">是否显示：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="setting[about_us_status]" value="0" class="js_undertake"
                                           type="radio" <?php echo htmlentities(tplckval($setting['about_us_status'],'=0','checked',true)); ?>>隐藏
                                </label>
                                <label class="radio-inline">
                                    <input name="setting[about_us_status]" value="1" class="js_undertake "
                                           type="radio" <?php echo htmlentities(tplckval($setting['about_us_status'],'=1','checked')); ?>>
                                    显示
                                </label>
                                <label class="radio-inline">
                                    <span>(隐藏或者显示在手机端个人中心页面)</span>
                                </label>

                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="form-group publicnote_status">
                            <label class="control-label">关于我们：</label>
                            <div class="col-sm-9 " style="padding-left:0px;">
                            <textarea rows="8" class="input-max hd" data-toggle="kindeditor" data-config="simple"
                                      data-kdheight="150" data-tongji="remain"
                                      data-tongji-target=".js_kindeditor_tongji" data-rule-rangelength="[0,50000]" d
                                      name="setting[about_us]"
                                      style="visibility:hidden;"><?php echo $setting['about_us']; ?></textarea>
                                <p class="pull-right js_kindeditor_tongji">还可输入{0}字</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="app">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">app名称：</label>
                            <div class="controls col-sm-4">
                                <input type="text" data-rule-maxlength="25" class="input-max" name="setting[app_name]"
                                       value="<?php echo htmlentities($setting['app_name']); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">app图标：</label>
                            <div class="controls col-sm-6">
                                <span class="help-inline">建议图片尺寸：100*100像素</span><br>
                                <img class="thumb_img" src="<?php echo htmlentities($setting['app_logo']); ?>" style="max-height: 100px;"/><br>
                                <input class="hide" type="text" name="setting[app_logo]" value="<?php echo htmlentities($setting['app_logo']); ?>"/>
                                <button class="btn btn-default" type="button" data-toggle="selectimg">选择logo</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">背景图片：</label>
                            <div class="controls col-sm-6">
                                <span class="help-inline">建议图片尺寸：380*800像素</span><br>
                                <img class="thumb_img" src="<?php echo htmlentities($setting['app_bg']); ?>" style="max-height: 100px;"/><br>
                                <input class="hide" type="text" name="setting[app_bg]" value="<?php echo htmlentities($setting['app_bg']); ?>"/>
                                <button class="btn btn-default" type="button" data-toggle="selectimg">选择背景</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ios链接：</label>
                            <div class="controls col-sm-4">
                                <input type="text" data-rule-maxlength="25" class="input-max"
                                       name="setting[app_ios_path]" value="<?php echo htmlentities($setting['app_ios_path']); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">安卓链接：</label>
                            <div class="controls col-sm-4">
                                <div class="js_upload_container">
                                    <input type="text" name="setting[app_apk_path]" class="input-max"
                                           value="<?php echo htmlentities($setting['app_apk_path']); ?>"/>
                                    <button type="button" class="btn btn-default js_file_upload"
                                            data-uploadpath="<?php echo url('uploadApp'); ?>"
                                            style="position: relative; z-index: 1;">点击上传app
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">下载页面：</label>
                            <div class="controls col-sm-4 help-inline">
                                <a href="<?php echo _url('publics/download/app',false,true,true); ?>" target="_blank"><?php echo _url('publics/download/app',false,true,true); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="payment">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">微信收款二维码：</label>
                            <div class="controls col-sm-6">
                                <span class="help-inline">建议图片尺寸：150*150像素</span><br>
                                <img class="thumb_imgs" src="<?php echo htmlentities($setting['weixin']); ?>" style="max-height: 100px;"/><br>
                                <input class="hide" type="text" name="setting[weixin]" value="<?php echo htmlentities($setting['weixin']); ?>"/>
                                <button class="btn btn-default" type="button" data-toggle="selectimg">选择微信收款二维码</button>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">支付宝收款二维码：</label>
                            <div class="controls col-sm-6">
                                <span class="help-inline">建议图片尺寸：150*150像素</span><br>
                                <img class="thumb_imgs" src="<?php echo htmlentities($setting['alipaycode']); ?>" style="max-height: 100px;"/><br>
                                <input class="hide" type="text" name="setting[alipaycode]"
                                       value="<?php echo htmlentities($setting['alipaycode']); ?>"/>
                                <button class="btn btn-default" type="button" data-toggle="selectimg">选择支付宝收款二维码
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">持卡人姓名：</label>
                            <div class="controls col-sm-4 ">
                                <input type="text" name="setting[bank_name]" placeholder="持卡人姓名" class="input-max"
                                       data-rule-required="true"
                                       value="<?php echo htmlentities($setting['bank_name']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">银行卡号：</label>
                            <div class="controls col-sm-4 ">
                                <input type="text" name="setting[bank_card]" placeholder="银行卡号" class="input-max"
                                       data-rule-required="true"
                                       value="<?php echo htmlentities($setting['bank_card']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">开户行：</label>
                            <div class="controls col-sm-4 ">
                                <input type="text" name="setting[bank_address]" placeholder="开户行" class="input-max"
                                       data-rule-required="true"
                                       value="<?php echo htmlentities($setting['bank_address']); ?>">
                            </div>
                        </div>
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

<script type="text/javascript">
    seajs.use("dist/plupload/file.js")
</script>

</body>
</html>