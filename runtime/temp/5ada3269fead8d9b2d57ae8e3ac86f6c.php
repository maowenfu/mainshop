<?php /*a:3:{s:56:"F:\WWW\M\application\mainadmin\view\backup_db\clear.html";i:1613985988;s:53:"F:\WWW\M\application\mainadmin\view\layouts\base.html";i:1613985988;s:53:"F:\WWW\M\application\mainadmin\view\layouts\page.html";i:1613985988;}*/ ?>
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
                      <strong>清理数据</strong>
                  </li>                                  
              </ul>
          </div>
  </header>

  <section  id="explanation" class="scrollable wrapper ">
      <section class="panel panel-default padding">

          <form  method="post" id="form" >

          <table class="table table-bordered table-striped ">
              <tr>
                  <td>
                      请小心操作，核实需要清理的数据。
                  </td>
              </tr>
              <tr>
                  <td>
                      <label><input type="checkbox" name="setting[]" value="kdn" > 清理快递鸟配置</label>
                  </td>
              </tr>
              <tr>
                  <td>
                      <label><input type="checkbox" name="setting[]" value="payment" > 清理支付配置</label>
                  </td>
              </tr>
              <tr>
                  <td>
                      <label><input type="checkbox" name="setting[]" value="sms" > 清理短信配置</label>
                  </td>
              </tr>
              <tr>
                  <td>
                      <label><input type="checkbox" name="setting[]" value="weixin" > 清理微信配置</label>
                  </td>
              </tr>
              <tr>
                  <td>
                      <input value="" name="check_code" id="check_code" type="text" placeholder="输入校验码">
                      <button type="button" class="btn btn-primary" id="clearbtn" data-loading-text="执行中...">执行</button>
                      <button type="button" class="btn " data-remote="<?php echo url('notClear'); ?>"
                              data-toggle="ajaxCurl" class="btn btn-default btn-sm" data-msg="确定不执行清理？"data-icon="info" >确定已是最新，去除提示</button>
                  </td>
              </tr>
          </table>

     </form>
</section>

    
    
<script>
	(function($){
		var $form = $("#form"), $clearbtn = $("#clearbtn");
        $clearbtn.click(function(){
			if($("input[name^='setting']:checked").length == 0){
				_alert('请选中要清理的配置');
				return false;
			}
			if ($('#check_code').val() == ''){
                _alert('请输入校验码.');
                return false;
            }
            $clearbtn.addClass("disabled");
            $clearbtn.html("正在执行...");
			$.post(
					"<?php echo url('clear'); ?>",
					$form.serialize(),
					function(res){
                        $clearbtn.removeClass("disabled");
                        _alert(res.msg,true);
                        $clearbtn.html("重新执行");
					},
					"json"
			);
			return false;
		});

	})(jQuery);
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