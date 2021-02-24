<?php /*a:3:{s:61:"F:\WWW\M\application\member\view\sys_admin\setting\index.html";i:1613985989;s:53:"F:\WWW\M\application\mainadmin\view\layouts\base.html";i:1613985988;s:53:"F:\WWW\M\application\mainadmin\view\layouts\page.html";i:1613985988;}*/ ?>
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
            <ul class="breadcrumb" >
                <li>
                    <i class="fa fa-ellipsis-v"></i>
                    <strong>会员设置</strong>
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
                        <li class="active"><a href="#basic" data-toggle="tab">基本设置</a></li>
                        <li><a href="#withdraw" data-toggle="tab">提现设置</a></li>
                        <li><a href="#register" data-toggle="tab">注册协议</a></li>
                    </ul>
                </header>
                <div class="tab-content">
                    <div class="tab-pane active" id="basic">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">注册相关：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="register_status" value="0" <?php echo $setting['register_status']==0 ? 'checked' : ''; ?>
                                    type="radio" >关闭注册
                                </label>
                                <label class="radio-inline">
                                    <input name="register_status" value="1" <?php echo $setting['register_status']==1 ? 'checked' : ''; ?>
                                    type="radio">开放注册
                                </label>
                                <label class="radio-inline">
                                    <input name="register_status" value="2" <?php echo $setting['register_status']==2 ? 'checked' : ''; ?>
                                    type="radio" >微信自动注册（使用微信自动注册，将关闭页面注册）
                                </label>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">注册赠送积分：</label>
                            <div class="controls">
                                <input type="text" value="<?php echo htmlentities($setting['register_integral']); ?>" min=0 size="10"
                                       data-rule-required="true" data-rule-integer="true" name="register_integral">
                                <span class="help-line">会员注册赠送积分</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">注册填写邀请码：</label>
                            <div class="controls">
                                <div>
                                    <label class="radio-inline">
                                        <input name="register_invite_code" value="0" <?php echo $setting['register_invite_code']==0 ? 'checked' : ''; ?>
                                        type="radio" >关闭(注册页不显示邀请码输入框，不影响分享绑定上下级)
                                    </label>
                                </div>
                                <label class="radio-inline">
                                    <input name="register_invite_code" value="1" <?php echo $setting['register_invite_code']==1 ? 'checked' : ''; ?>
                                    type="radio">填写邀请码
                                </label>
                                <label class="radio-inline">
                                    <input name="register_invite_code" value="2" <?php echo $setting['register_invite_code']==2 ? 'checked' : ''; ?>
                                    type="radio">填写会员ID
                                </label>
                                <label class="radio-inline">
                                    <input name="register_invite_code" value="3" <?php echo $setting['register_invite_code']==3 ? 'checked' : ''; ?>
                                    type="radio">填写会员手机号码
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">注册必须邀请：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="register_must_invite" value="0" <?php echo $setting['register_must_invite']==0 ? 'checked' : ''; ?>
                                    type="radio" >不强制
                                </label>
                                <label class="radio-inline">
                                    <input name="register_must_invite" value="1" <?php echo $setting['register_must_invite']==1 ? 'checked' : ''; ?>
                                    type="radio">强制填写
                                </label>
                                <span class="help-inline">注册填写邀请码【关闭】时此项不生效</span>
                            </div>
                        </div>
                        <div class="form-group m-t">
                            <label class="col-sm-2  control-label">绑定关系时间：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="bind_pid_time" value="0" <?php echo $setting['bind_pid_time']==0 ? 'checked' : ''; ?>
                                    type="radio"> 注册
                                </label>
                                <label class="radio-inline">
                                    <input name="bind_pid_time" value="1" <?php echo $setting['bind_pid_time']==1 ? 'checked' : ''; ?>
                                    type="radio"> 订单支付后
                                </label>
                            </div>
                        </div>
                        <div class="form-group m-t">
                            <label class="col-sm-2  control-label">分享绑定规则：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="bind_share_rule" value="0" <?php echo $setting['bind_share_rule']==0 ? 'checked' : ''; ?>
                                    type="radio"> 按最先分享绑定
                                </label>
                                <label class="radio-inline">
                                    <input name="bind_share_rule" value="1" <?php echo $setting['bind_share_rule']==1 ? 'checked' : ''; ?>
                                    type="radio"> 按最后分享绑定
                                </label>
                                <span class="help-inline">此项只支持微信访问，非微信访问按当前分享来源绑定</span>
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in" style="width:99%;"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否开放签到：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="sign_in" value="1" class="js_radio_undertake" data-class="sign_in_box"
                                           <?php echo $setting['sign_in']==1 ? 'checked' : ''; ?> type="radio">开放
                                </label>
                                <label class="radio-inline">
                                    <input name="sign_in" value="0" class="js_radio_undertake" <?php echo $setting['sign_in']==0 ? 'checked' : ''; ?>
                                    type="radio" >关闭
                                </label>
                            </div>
                        </div>
                        <div class="radio_undertake_sign_in sign_in_box <?php echo $setting['sign_in']==1 ? '' : 'hide'; ?>">
                            <div class="form-group ">
                                <label class="col-sm-2 control-label">签到赠送积分：</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo htmlentities($setting['sign_integral']); ?>" class="input-ssmall" min=0
                                           data-rule-required="true" data-rule-integer="true" name="sign_integral">
                                    <span class="help-line"> 签到赠送的积分</span>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label">连续签到额外赠送：</label>
                                <div class="controls">
                                    <a href="javascript:;" title="增加" class="btn btn-default add_sign_constant"><i
                                            class="fa fa-plus"></i> 添加连续签到设置</a>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label"></label>
                                <div class="controls constant_list">
                                    <ul>
                                        <?php if(is_array($setting['sign_constant']) || $setting['sign_constant'] instanceof \think\Collection || $setting['sign_constant'] instanceof \think\Paginator): $i = 0; $__LIST__ = $setting['sign_constant'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$constant): $mod = ($i % 2 );++$i;?>
                                        <li>
                                            连续签收：
                                            <span class="input_relative">
                                            <input type="text" name="sign_constant[<?php echo htmlentities($i); ?>][day]" value="<?php echo htmlentities($constant['day']); ?>"
                                                   class="input-ssmall" min=1 max=31 data-rule-required="true"
                                                   data-rule-integer="true" name="sign_integral">
                                        </span>
                                            天，额外赠送：
                                            <span class="input_relative">
                                    <input type="text" name="sign_constant[<?php echo htmlentities($i); ?>][integral]" value="<?php echo htmlentities($constant['integral']); ?>"
                                           class="input-ssmall" min=1 max=1000 data-rule-required="true"
                                           data-rule-integer="true" name="sign_integral">
                                    </span>
                                            积分
                                            <a href="javascript:;" title="增加"
                                               class="btn btn-default fa fa-times del_sign_consgant"></a>
                                        </li>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="withdraw">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否开启提现：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="withdraw_status" value="1" <?php echo $setting['withdraw_status']==1 ? 'checked' : ''; ?>
                                    type="radio">开启
                                </label>
                                <label class="radio-inline">
                                    <input name="withdraw_status" value="0" <?php echo $setting['withdraw_status']==0 ? 'checked' : ''; ?>
                                    type="radio" >关闭
                                </label>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">开启提现周期：</label>
                            <div class="controls">
                                <input name="withdraw_week_1" value="0" type="hidden">
                                <input name="withdraw_week_2" value="0" type="hidden">
                                <input name="withdraw_week_3" value="0" type="hidden">
                                <input name="withdraw_week_4" value="0" type="hidden">
                                <input name="withdraw_week_5" value="0" type="hidden">
                                <input name="withdraw_week_6" value="0" type="hidden">
                                <input name="withdraw_week_0" value="0" type="hidden">
                                <label class="radio-inline">
                                    <input name="withdraw_week_1" value="1" type="checkbox" <?php echo $setting['withdraw_week_1']==1 ? 'checked' : ''; ?>>星期一
                                </label>
                                <label class="radio-inline">
                                    <input name="withdraw_week_2" value="1" type="checkbox" <?php echo $setting['withdraw_week_2']==1 ? 'checked' : ''; ?>>星期二
                                </label>
                                <label class="radio-inline">
                                    <input name="withdraw_week_3" value="1" type="checkbox" <?php echo $setting['withdraw_week_3']==1 ? 'checked' : ''; ?>>星期三
                                </label>
                                <label class="radio-inline">
                                    <input name="withdraw_week_4" value="1" type="checkbox" <?php echo $setting['withdraw_week_4']==1 ? 'checked' : ''; ?>>星期四
                                </label>
                                <label class="radio-inline">
                                    <input name="withdraw_week_5" value="1" type="checkbox" <?php echo $setting['withdraw_week_5']==1 ? 'checked' : ''; ?>>星期五
                                </label>
                                <label class="radio-inline">
                                    <input name="withdraw_week_6" value="1" type="checkbox" <?php echo $setting['withdraw_week_6']==1 ? 'checked' : ''; ?>>星期六
                                </label>
                                <label class="radio-inline">
                                    <input name="withdraw_week_0" value="1" type="checkbox" <?php echo $setting['withdraw_week_0']==1 ? 'checked' : ''; ?>>星期天
                                </label>
                                <span class="help-line"> </span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">每天开放时间：</label>
                            <div class="controls">
                                <input type="text" value="<?php echo htmlentities($setting['withdraw_day_start']); ?>" min=0  size="10" data-rule-required="true" data-rule-integer="true" name="withdraw_day_start"> 点 -
                                <input type="text" value="<?php echo htmlentities($setting['withdraw_day_stop']); ?>" min=0  size="10" data-rule-required="true" data-rule-integer="true" name="withdraw_day_stop"> 点
                                <span class="help-line"> 24小时制,例如晚上九点请写21</span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">最低提现金额：</label>
                            <div class="controls">
                                <input type="text" value="<?php echo htmlentities($setting['withdraw_min_money']); ?>" min=0 size="10"
                                       data-rule-required="true" data-rule-integer="true" name="withdraw_min_money">
                                <span class="help-line"> 金额必须达到最低提现金额，才能申请提现</span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">最高提现金额：</label>
                            <div class="controls">
                                <input type="text" value="<?php echo htmlentities($setting['withdraw_max_money']); ?>" min=0 size="10"
                                       data-rule-required="true" data-rule-integer="true" name="withdraw_max_money">
                                <span class="help-line"> 单次提现金额不能超过此金额，才能申请提现</span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">提现手续费：</label>
                            <div class="controls">
                                <input type="text" value="<?php echo htmlentities($setting['withdraw_fee']); ?>" min=0 size="10"
                                       data-rule-required="true" data-rule-ismoney="true" name="withdraw_fee">
                                <span class="help-line"> %（注：如填1就是 代表每笔提现，收取提现金额1%的手续费）</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">手续费扣除方式：</label>
                            <div class="controls">
                                <label class="radio-inline">
                                    <input name="fee_type" value="1" <?php echo $setting['fee_type']==1 ? 'checked' : ''; ?>
                                    type="radio">内扣
                                </label>
                                <label class="radio-inline">
                                    <input name="fee_type" value="0" <?php echo $setting['fee_type']==0 ? 'checked' : ''; ?> type="radio"
                                    >外扣
                                </label>
                                <span class="help-line"> %（注：例如手续费8%,外扣:提100扣108余额到账100,内扣提100扣100余额到账92）</span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">最低手续费：</label>
                            <div class="controls">
                                <input type="text" value="<?php echo htmlentities($setting['withdraw_fee_min']); ?>" min=0 size="10"
                                       data-rule-required="true" data-rule-ismoneyy="true" name="withdraw_fee_min">
                                <span class="help-line"> （注：单笔手续费计算出来小于该值时，则取该值）</span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">最高手续费：</label>
                            <div class="controls">
                                <input type="text" value="<?php echo htmlentities($setting['withdraw_fee_max']); ?>" min=0 size="10"
                                       data-rule-required="true" data-rule-ismoney="true" name="withdraw_fee_max">
                                <span class="help-line"> （注：单笔手续费计算出来大于该值时，则取该值,为0时则不限）</span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">每日累计提现次数：</label>
                            <div class="controls">
                                <input type="text" value="<?php echo htmlentities(intval($setting['withdraw_num'])); ?>" min=0 size="10"
                                       data-rule-required="true" data-rule-ismoney="true" name="withdraw_num">
                                <span class="help-line"> （注：单人每日累计提现次数达到该值时，本日将不支持继续提现,为0时则不限）</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="register">
                        <textarea rows="13" class="hd" data-toggle="kindeditor" data-tongji="remain"
                                  data-tongji-target=".js_kindeditor_tongji" data-rule-rangelength="[1,50000]"
                                  data-rule-required="true" data-msg-required="注册协议不能为空" name="register_agreement"
                                  style="visibility:hidden;"><?php echo $setting['register_agreement']; ?></textarea>
                        <p class="pull-right js_kindeditor_tongji">还可输入{0}字</p>
                    </div>
                </div>
            </section>
        </section>
        <footer class="footer bg-white b-t p-t">
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-1">
                    <button type="submit" class="btn btn-primary js_save_submit" data-loading-text="保存中...">保存</button>
                    <button type="button" class="btn btn-default" data-toggle="back">取消</button>
                </div>
            </div>
        </footer>
    </section>
</form>

<script type="text/html" id="constant_list_li">
    <li>
        连续签收：
        <span class="input_relative">
            <input type="text" name="sign_constant[{{i}}][day]" value="" class="input-ssmall" min=1 max=31 data-rule-required="true" data-rule-integer="true" name="sign_integral">
        </span>
        天，额外赠送：
        <span class="input_relative">
             <input type="text" name="sign_constant[{{i}}][integral]" value="" class="input-ssmall" min=1 max=1000 data-rule-required="true" data-rule-integer="true" name="sign_integral">
        </span>
        积分
        <a href="javascript:;" title="增加" class="btn btn-default fa fa-times del_sign_consgant"></a>
    </li>
</script>

<script type="text/javascript">
    var sign_constant_length = $('.constant_list li').length;
    $('.add_sign_constant').click(function () {
        var arr = new Object();
        sign_constant_length++;
        arr.i = sign_constant_length;
        $('.constant_list ul').append(template('constant_list_li',arr));
    })
    $(document).on('click','.del_sign_consgant',function () {
        $(this).parent('li').remove();
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