<?php /*a:4:{s:57:"F:\WWW\M\application\shop\view\sys_admin\order\index.html";i:1613985989;s:53:"F:\WWW\M\application\mainadmin\view\layouts\base.html";i:1613985988;s:56:"F:\WWW\M\application\shop\view\sys_admin\order\list.html";i:1613985989;s:53:"F:\WWW\M\application\mainadmin\view\layouts\page.html";i:1613985988;}*/ ?>
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
    <form id="forms" class="talbe-search form-inline "  method="post" action="<?php echo url($is_cancel==true?'trashList':'getList'); ?>" >
     <div class="page-breadcrumbs">
            <ul class="breadcrumb" >
                <li>
                    <i class="fa fa-ellipsis-v"></i>
                    <strong><?php echo $is_cancel==true ? '订单回收列表' : '订单列表'; ?></strong>
                </li>                                  
            </ul>
          <?php if($is_cancel != true): ?>  
         <select name="state" class="state_select" style="width: 100px;" data-toggle="select2"  onchange="state_select(this)" data-chang="submit">
             <option value="0" <?php echo $search['state']==0 ? 'selected' : ''; ?> >全部订单</option>
             <option value="1" <?php echo $search['state']==1 ? 'selected' : ''; ?> >待确认</option>
             <option value="2" <?php echo $search['state']==2 ? 'selected' : ''; ?> >待支付</option>
             <option value="3" <?php echo $search['state']==3 ? 'selected' : ''; ?> >待发货</option>
             <option value="4" <?php echo $search['state']==4 ? 'selected' : ''; ?> >已发货</option>
             <option value="5" <?php echo $search['state']==5 ? 'selected' : ''; ?> >已签收</option>
             <option value="6" <?php echo $search['state']==6 ? 'selected' : ''; ?> >已退货</option>
             <option value="7" <?php echo $search['state']==7 ? 'selected' : ''; ?> >待退款</option>
             <option value="8" <?php echo $search['state']==8 ? 'selected' : ''; ?> >已退款</option>
         </select>
        <?php endif; ?>
           <div class="form-group">
                <a class="btn btn-default " data-toggle="reportrange" data-change="submit">
                    <i class="fa fa-calendar fa-lg"></i>
                    <small>下单时间</small>
                    <span></span> <b class="caret"></b>
                    <input type="hidden" value="<?php echo htmlentities($start_date); ?> - <?php echo htmlentities($end_date); ?>" id="reportrange" name="reportrange" />
                </a>
          </div>

         <select name="searchBy" style="width: 100px;" data-toggle="select2" >
             <option value="order_sn" >订单编号</option>
             <option value="consignee" >收货人</option>
             <option value="mobile">联系电话</option>
             <option value="goods_sn">商品SN</option>
             <option value="user_id" >会员ID</option>
         </select>

          <input type="text" class="form-control input-large" value="<?php echo htmlentities($search['keyword']); ?>" name="keyword" placeholder="输入相关内容筛选" data-rule-required="true" />
         <input type="hidden" value="0" name="export">
         <input type="hidden" value="<?php echo htmlentities($favour_id); ?>" name="favour_id">
         <button class="btn btn-sm btn-default-iq" type="submit" title="搜索"><i class="fa fa-search"></i></button>
         <a href="javascript:;" onclick="ExportLog()" title="导出" class="btn btn-sm btn-default fr m-t-md m-r"><i class="fa fa-file-excel-o m-r-xs"></i>导出列表</a>
         <a href="<?php echo url('import'); ?>" title="" class="btn" data-toggle="ajaxModal"><i class="fa fa-cloud-upload"></i>导入发货订单</a>
        <?php if($error_count > 0): ?>
        <a href="javascript:" id="error_export_btn" title="" class="btn"><i class="fa fa-cloud-download"></i>导出失败数据</a>
        <?php endif; ?>
    </div>
</form>
</header>

<section class="scrollable wrapper w-f ">
    <section class="panel panel-default ">
        <div class="table-responsive " id="list_box">
            <table class="table table-hover m-b-none" >
    <!--table-striped-->
<thead>
<tr>
    <th width="200">订单编号</th>
    <th width="120">订单类型</th>
    <th width="180">订单状态</th>
    <th width="100">下单时间</th>
    <th width="150" >实收款</th>
    <th width="150" >支付方式</th>
    <th width="150">收货人</th>
    <!-- <th width="150">打单状态</th> -->
    <th width="150" >购买会员</th>
    <th width="80">操作</th>
</tr>
</thead>
<tbody>
<?php if(is_array($data['list']) || $data['list'] instanceof \think\Collection || $data['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

<tr >
    <td>
        <label>
        <input type="checkbox" name="order_id" value="<?php echo htmlentities($vo['order_id']); ?>" class="m-r"><span class="diy--checkbox diy--radioInput"></span> <span class="m-r"> <?php echo htmlentities($vo['order_sn']); ?></span>
    </label>
        <i class="fa row-details fa-plus-square-o list_tr_open">查看商品</i>
    </td>
    <td >
        <?php echo htmlentities($orderType[$vo['order_type']]); ?>
    </td>
    <td><?php echo $orderLang['os'][$vo['order_status']]; ?>,<?php echo $orderLang['ps'][$vo['pay_status']]; ?>,<?php echo $orderLang['ss'][$vo['shipping_status']]; ?></td>
    <td><?php echo htmlentities(dateTpl($vo['add_time'])); ?></td>
    <td >

            <?php echo htmlentities(priceFormat($vo['order_amount'])); if($vo['ostatus'] == '待付款'): ?>
            <a href="javascript:;" data-remote="<?php echo url('changePrice',array('id'=>$vo['order_id'])); ?>" data-toggle="ajaxModal" class="m-xs" >
                <i class="fa fa-edit text-muted"></i>
            </a>
            <?php endif; ?>
        <br>
        <small class="text-muted">[含运费: <?php echo htmlentities($vo['shipping_fee']); ?>]</small>
    </td>
    <td><?php echo htmlentities($vo['pay_name']); ?></td>
    <td ><?php echo htmlentities($vo['consignee']); ?></td>
    <!-- <td ><?php if($vo['print_state'] == '1'): ?>已打单<?php endif; if($vo['print_state'] == '0'): ?>未打单<?php endif; ?>
    </td> -->
    <td ><?php echo htmlentities($vo['user_id']); ?> - <?php echo htmlentities(userInfo($vo['user_id'])); ?></td>
    <td style="text-align: center;">
        <a href="<?php echo url('info',array('order_id'=>$vo['order_id'])); ?>" title="查看详情">
            <i class="fa fa-search "></i></a>
        <?php if($vo['ostatus'] == '待发货'): ?>
        <a href="javascript:;" data-remote="<?php echo url('shipping',array('id'=>$vo['order_id'])); ?>" data-toggle="ajaxModal" class="m-xs" title="发货">
            <i class="fa fa-truck text-muted"></i>
        </a>
        <?php endif; if($vo['ostatus'] == '已发货'): ?>
        <!-- <a href="<?php echo url('printPage',array('id'=>$vo['order_id'])); ?>" class="m-xs" title="打单" target="_blank">
                <i class="fa fa-print"></i>
        </a> -->
        <?php endif; ?>
    </td>
</tr>
<tr class="hide">
    <td colspan="3"  valign="top">
        <ul class="list-group no-borders" >
            <?php if(is_array($vo['goodsList']) || $vo['goodsList'] instanceof \think\Collection || $vo['goodsList'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['goodsList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$grow): $mod = ($i % 2 );++$i;?>
            <li class="list-group-item ">
                <div class="media">
                    <span class="pull-left thumb-sm">
                        <img src="<?php echo htmlentities($grow['pic']); ?>" ></span>

                    <div class="media-body">
                        <div style="color:#999;"><?php echo htmlentities($grow['goods_name']); ?> <?php echo htmlentities($grow['sku_name']); ?></div>
                        <small class="text-muted">单价： <?php echo htmlentities(priceFormat($grow['sale_price'])); ?><span class="m-l-xs"></span></small>
                        x <?php echo htmlentities($grow['goods_number']); ?>
                    </div>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </td>
    <td colspan="6" valign="top">
        <p>收货人：<?php echo htmlentities($vo['consignee']); ?></p>
        <p>联系电话：<?php echo htmlentities($vo['mobile']); ?></p>
        <p>收货地址：<?php echo htmlentities($vo['merger_name']); ?> <?php echo htmlentities($vo['address']); ?></p>
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
    function state_select(obj){
        if (typeof(obj) == 'undefined'){
            var val = $('.state_select').val();
        }else{
            var val = obj.options[obj.selectedIndex].value;
        }
        if (val == 3){
        //     $('.footer_other').html('<label class="m-r m-t" ><input type="checkbox" class="checkboxAll" data-name="order_id"> 全选 </label> ' +
        //         '<a href="javascript:;" class="btn btn-sm m-t" data-remote="<?php echo url('batchShipping'); ?>" data-toggle="ajaxModal"><i class="fa fa-truck "></i> 勾选订单批量发货</a>');
        // }else if(val == 4){
        //     $('.footer_other').html('<label class="m-r m-t" ><input type="checkbox" class="checkboxAll" data-name="order_id"> 全选 </label> ' +
        //         '<a href="javascript:;" class="btn btn-sm m-t" onclick="PrintOrder()"><i class="fa fa-truck"></i> 勾选订单批量打单</a>');
        // }else{
            $('.footer_other').html('');
        }
    }
    state_select();
    $('#error_export_btn').click(function(){
        $(this).hide();
        window.location.href = "<?php echo url('errorExport'); ?>";
    })
    function ExportLog(){
        $('input[name="export"]').val('1');
        $('#forms').submit();
        $('input[name="export"]').val('0');
    }

    //批量打单
    function PrintOrder() {
        var ids = '';
        $('input[name="order_id"][type="checkbox"]:checked').each(function () {
            ids == '' ? ids += $(this).val() : ids += ',' + $(this).val();
        });
        // var params = {
        //     id: ids
        // };
        var formData = document.createElement("form");
        formData.style.display = "none";
        var opt = document.createElement("textarea");
        opt.name = 'id';
        opt.value = ids;
        formData.appendChild(opt);
        formData.target = "_blank";
        formData.action = '<?php echo url("shop/sys_admin.order/printPage"); ?>';
        formData.method = "POST";
        $(document.body).append(formData);
        formData.submit();
    }
</script>

</body>
</html>