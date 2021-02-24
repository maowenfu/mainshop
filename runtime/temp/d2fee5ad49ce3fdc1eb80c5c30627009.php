<?php /*a:4:{s:44:"../template/default/member\center\index.html";i:1613985992;s:37:"../template/default/layouts\base.html";i:1613985992;s:39:"../template/default/layouts\bottom.html";i:1613985992;s:39:"../template/default/layouts\weixin.html";i:1613985992;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" href="/static/mobile/default/css/layout.css?v=2"/>
    <link rel="icon" type="image/png" href="/static/favicon.ico"/>
    <script src="/static/js/jquery/jquery/2.1.4/jquery.min.js"></script>
    <script src="/static/mobile/default/js/page.js?v=1"></script>
    <title><?php echo htmlentities($title); ?>  - <?php echo htmlentities($setting['shop_title']); ?></title>
      <?php if($is_wx == '1'): ?>
      <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.3.2.js"></script>
      <?php endif; ?>
    
<link rel="stylesheet" href="/static/mobile/default/css/my.css"/>


</head>
<body >
  <div class="page ">
  <?php if(empty($not_top_nav) || (($not_top_nav instanceof \think\Collection || $not_top_nav instanceof \think\Paginator ) && $not_top_nav->isEmpty())): ?>
  		<div class="page-hd">
            <div class="header base-header bor-1px-b">
                <div class="header-left">
                    <a href="javascript:history.go(-1)" class="left-arrow"></a>
                </div>
                <div class="header-title"><?php echo htmlentities($title); ?></div>
                <div class="header-right">
                    <!-- <a href=""></a> -->
                </div>
            </div>
        </div>
   <?php endif; ?>
   
<div class="page-bd my">
    <!-- 页面内容-->
    <div class="top">
        <div class="title fs34 fw_b color_w">个人中心</div>

        <div class="info">
            <a href="<?php echo url('userInfo'); ?>" class="userInfo">
            <img  id="headimgurl" src="<?php echo htmlentities((isset($userInfo['headimgurl']) && ($userInfo['headimgurl'] !== '')?$userInfo['headimgurl']:'/static/mobile/default/images/defheadimg.jpg')); ?>" class="userimg"  alt="">
            </a>
            <a href="<?php echo url('userInfo'); ?>" class="userInfo">
                <div>
                    <p class="fs32 color_w fw_b nick_name"></p><em class="fs22 color_3 fw_b BGcolor_r level_name"></em>
                </div>
                <div>
                    <p class="fs26 color_w fw_b uid">UID：<?php echo htmlentities($userInfo['user_id']); ?></p>
                </div>
                <!--<span class="fs22 color_9">新用户注册送50元优惠券</span>-->
            </a>
            <div class="right">
                <a href="<?php echo url('member/message/index'); ?>" class="un_see_num"><img src="/static/mobile/default/images/myIcon01.png" alt=""></a>
                <a href="<?php echo url('setting'); ?>"><img src="/static/mobile/default/images/myIcon02.png" alt=""></a>
            </div>
        </div>
        <a href="javascript:void(0);" class="banner hide">
            <img src="/static/mobile/default/images/myBanner.png" alt="">
        </a>
    </div>

    <div class="moneyInfo">
        <a href="<?php echo url('wallet/index'); ?>">
            <p class="num fs40 color_0 balance_money">0.00</p><span class="fs26 color_6">余额</span>
        </a>
        <a href="<?php echo url('wallet/index'); ?>">
            <p class="num fs40 color_0 use_integral">0.00</p><span class="fs26 color_6">积分</span>
        </a>
        <a href="<?php echo url('shop/collect/index'); ?>">
            <p class="num fs40 color_0 collect_num">0</p><span class="fs26 color_6">收藏</span>
        </a>
        <a href="<?php echo url('shop/bonus/index'); ?>">
            <p class="num fs40 color_0 bouns_num">0</p><span class="fs26 color_6">优惠券</span>
        </a>
    </div>
    <div class="myOrder">
        <div class="title bor_b">
            <span class="fs28 fw_b">我的订单</span>
            <a href="<?php echo url('shop/order/index'); ?>">
                <p class="fs24">查看全部</p>
                <img src="/static/mobile/default/images/rightIcon.png" alt="">
            </a>
        </div>
        <div class="list">
            <a href="<?php echo url('shop/order/index',['type'=>'waitPay']); ?>"  class="wait_pay_num">
                <img src="/static/mobile/default/images/myIcon03.png" alt="">
                <p class="fs22 color_6">待付款</p>
            </a>
            <a href="<?php echo url('shop/order/index',['type'=>'waitShipping']); ?>"  class="wait_shipping_num">
                <img src="/static/mobile/default/images/myIcon04.png" alt="">
                <p class="fs22 color_6">待发货</p>
            </a>
            <a href="<?php echo url('shop/order/index',['type'=>'waitSign']); ?>"  class="wait_sign_num">
                <img src="/static/mobile/default/images/myIcon05.png" alt="">
                <p class="fs22 color_6">待收货</p>
            </a>
            <a href="<?php echo url('shop/order/index',['type'=>'sign']); ?>"  class="">
                <img src="/static/mobile/default/images/myIcon06.png" alt="">
                <p class="fs22 color_6">已完成</p>
            </a>
            <a href="<?php echo url('shop/after_sale/index'); ?>" class="after_sale_num">
                <img src="/static/mobile/default/images/myIcon07.png" alt="">
                <p class="fs22 color_6">退换货</p>
            </a>
        </div>
    </div>
    <?php if(!(empty($navMenuList) || (($navMenuList instanceof \think\Collection || $navMenuList instanceof \think\Paginator ) && $navMenuList->isEmpty()))): ?>
    <!-- 网格型 -->
    <?php if($user_center_nav_tpl == 0): ?>
    <div class="girdBox">
        <div class="title bor_b">
            <span class="fs28 fw_b">我的工具</span>
        </div>
        <div>
            <?php if(is_array($navMenuList) || $navMenuList instanceof \think\Collection || $navMenuList instanceof \think\Paginator): $i = 0; $__LIST__ = $navMenuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
            <a href="<?php echo htmlentities((isset($nav['url']) && ($nav['url'] !== '')?$nav['url']:'javascript:void();')); ?>">
                <img src="<?php echo htmlentities($nav['imgurl']); ?>" alt="">
                <span class="fs24 fw_b color_3"><?php echo htmlentities($nav['title']); ?></span>
            </a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <?php elseif($user_center_nav_tpl == 1): ?>
    <!-- 列表型 -->
    <div class=" tab">
        <?php if(is_array($navMenuList) || $navMenuList instanceof \think\Collection || $navMenuList instanceof \think\Paginator): $i = 0; $__LIST__ = $navMenuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
        <a href="<?php echo htmlentities((isset($nav['url']) && ($nav['url'] !== '')?$nav['url']:'javascript:void();')); ?>" class="bor_b">
            <img src="<?php echo htmlentities($nav['imgurl']); ?>" alt="" class="icon">
            <span class="fs24 fw_b color_3"><?php echo htmlentities($nav['title']); ?></span>
            <img src="/static/mobile/default/images/rightIcon.png" alt="" class="right">
        </a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>
<div class="copyright">
    <?php if(!(empty(settings('copyright')) || ((settings('copyright') instanceof \think\Collection || settings('copyright') instanceof \think\Paginator ) && settings('copyright')->isEmpty()))): ?>
        Copyright © <?php echo settings('copyright'); ?><br>
    <?php endif; if(!(empty(settings('ipc_no')) || ((settings('ipc_no') instanceof \think\Collection || settings('ipc_no') instanceof \think\Paginator ) && settings('ipc_no')->isEmpty()))): ?>
        <?php echo settings('ipc_no'); ?>
    <?php endif; ?>
</div>
<div class="bottom-tabbar-wrapper">
  <div class="bottom-tabbar">
      <?php if(is_array($navFootList) || $navFootList instanceof \think\Collection || $navFootList instanceof \think\Paginator): $i = 0; $__LIST__ = $navFootList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
      <a href="<?php echo htmlentities($nav['url']); ?>" class="bottom-tabbar__item">
        <span class="icon">
            <img src="<?php echo htmlentities($nav['imgurl']); ?>"/>
            <img class="lhimg" src="<?php echo htmlentities($nav['imgurl_s']); ?>"/>
        </span>
          <p class="label"><?php echo htmlentities($nav['title']); ?></p>
      </a>
      <?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
</div>
<script>
    var index=-1;
    function setSelect(url){
        $('.bottom-tabbar a').each(function (i,val) {
            var thisUrl = $(this).attr('href');
            var sear=new RegExp(thisUrl);
            if(sear.test(url)){
                index=i;
            }
        });
    }
    $(function (){
        var curUrl = window.location.href;
        setSelect(curUrl);
        if(index==-1){
            var referrer = document.referrer;
            setSelect(referrer);
        }
        $('.bottom-tabbar a').eq(index).addClass('active');
    })
</script>

  </div>

<script src="/static/js/art-template.js"></script>
<script src="/static/mobile/default/js/lib/fastclick.js"></script>
<script src="/static/js/jquery/lazyload/jquery.lazyload.js"></script>
<script>
    $(function() {
        FastClick.attach(document.body);
		$("img.lazy").lazyload({effect:"fadeIn",event:"scroll",container:$(".page-bd")});
    });
</script>

<script type="text/javascript">
    $(function () {
        //加载会员数据
        jq_ajax('<?php echo url("member/api.users/getCenterInfo"); ?>', '', function (res) {
            if (res.code == 0) {
                _alert(res.msg);
                return false;
            }
            $('.user_id').html('会员ID：' + res.userInfo.user_id);
            $('.nick_name').html(res.userInfo.nick_name);
            $('.signature').html(res.userInfo.signature);
            if (typeof(res.userInfo.role) != 'undefined') {
                $('.level_name').html(res.userInfo.role.role_name);
            } else {
                $('.level_name').html(res.userInfo.level.level_name);
            }
            $('.balance_money').html(res.userInfo.account.balance_money);
            $('.use_integral').html(res.userInfo.account.use_integral);
            $('.bouns_num').html(res.unusedNum);
            $('.collect_num').html(res.collectNum);
            $('#headimgurl').attr('src', res.userInfo.headimgurl ? res.userInfo.headimgurl : '/static/mobile/default/images/defheadimg.jpg');


            $('.unusedNum').html(res.unusedNum);

            if (res.orderStats.wait_pay_num > 0) {
                $('.wait_pay_num').append('<em>' + res.orderStats.wait_pay_num + '</em>');
            }
            if (res.orderStats.wait_shipping_num > 0) {
                $('.wait_shipping_num').append('<em>' + res.orderStats.wait_shipping_num + '</em>');
            }
            if (res.orderStats.wait_sign_num > 0) {
                $('.wait_sign_num').append('<em>' + res.orderStats.wait_sign_num + '</em>');
            }
            if (res.unSeeNum > 0) {
                $('.un_see_num').append('<em></em>');
            }


        })
    })
</script>

  <div class="alertBox">
      <div class="alertBG"></div>
      <div class="alert">
          <div class="text fs30 color_3 bor_b">

          </div>
          <!-- 单按钮 -->
          <div class="button fs32 fw_b color_r">
              知道了
          </div>
          <!-- 双按钮 -->
          <div class="buttonBox fs32 fw_b">
              <span class="color_9 bor_r cancel">取消</span>
              <span class="color_r confirm">确定</span>
          </div>
      </div>
  </div>
  <script type="text/javascript">
      var is_xcx = <?php echo isXcxWebView(); ?>;
      $(document).on('click', 'a', function () {
          var href = $(this).attr('href');
          if (href.indexOf('/pages') != -1) {
              if (is_xcx == 1) {
                  wx.miniProgram.navigateTo({
                      url: href
                  })
                  return false;
              } else {
                  return false;
              }
          }
      })
  </script>
  <?php if($is_wx == '1'): ?>
  <script type="text/javascript">

    wx.miniProgram.getEnv(function (res) {
        if (res.miniprogram) {
            wx.miniProgram.postMessage({
                data: {
                    share_token: '<?php echo htmlentities($userInfo['token']); ?>',
                    share_title: '<?php echo htmlentities($title); ?>  - <?php echo htmlentities($setting['shop_title']); ?>',
                    share_url:'<?php echo htmlentities($_SERVER["REQUEST_URI"]); ?>'
                }
            });
        }
    })
</script>
<?php if(!(empty($wxShare) || (($wxShare instanceof \think\Collection || $wxShare instanceof \think\Paginator ) && $wxShare->isEmpty()))): ?>
<script type="text/javascript">
    window.shareData = {
        "imgUrl": "<?php echo getUrl($wxShare['img'],'img'); ?>",
        "Link": "<?php echo htmlentities($wxShare['shareUrl']); ?>",
        "tTitle": "<?php echo htmlentities($wxShare['title']); ?>",
        "tContent": '<?php echo htmlentities($wxShare['description']); ?>'
    };

    wx.config({
            debug: false,
            appId: '<?php echo htmlentities($wxShare['appId']); ?>',
            timestamp: <?php echo htmlentities($wxShare['timestamp']); ?>,
        nonceStr: '<?php echo htmlentities($wxShare['nonceStr']); ?>',
        signature: '<?php echo htmlentities($wxShare['signature']); ?>',
        jsApiList: [
        // 所有要调用的 API 都要加到这个列表中
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
    ]
    });
    wx.ready(function () {

        // 分享到朋友圈
        wx.onMenuShareTimeline({
            title: window.shareData.tTitle, 		// 分享标题
            link: window.shareData.Link, 		// 分享链接
            imgUrl: window.shareData.imgUrl, 	// 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
                // alert('分享成功');
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                //alert('取消分享成功');
            }
        });
        // 分享给朋友
        wx.onMenuShareAppMessage({
            title: window.shareData.tTitle, 		// 分享标题
            link: window.shareData.Link, 		// 分享链接
            imgUrl: window.shareData.imgUrl, 	// 分享图标
            desc: window.shareData.tContent, 		// 分享描述
            type: '', 					// 分享类型,music、video或link，不填默认为link
            dataUrl: '', 				// 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
                // alert('分享成功');
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                // alert('取消分享成功');
            }
        });
        // 分享到QQ
        wx.onMenuShareQQ({
            title: window.shareData.tTitle, 		// 分享标题
            link: window.shareData.Link, 		// 分享链接
            imgUrl: window.shareData.imgUrl, 	// 分享图标
            desc: window.shareData.tContent, 		// 分享描述
            success: function () {
                // 用户确认分享后执行的回调函数
                // alert('分享成功');
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                // alert('取消分享成功');
            }
        });
        // 分享到腾讯微博
        wx.onMenuShareWeibo({
            title: window.shareData.tTitle, 		// 分享标题
            link: window.shareData.Link, 		// 分享链接
            imgUrl: window.shareData.imgUrl, 	// 分享图标
            desc: window.shareData.tContent, 		// 分享描述
            success: function () {
                // 用户确认分享后执行的回调函数
                // alert('分享成功');
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                // alert('取消分享成功');
            }
        });
    });
</script>
<?php endif; ?>
  <?php endif; ?>
  </body>
</html>