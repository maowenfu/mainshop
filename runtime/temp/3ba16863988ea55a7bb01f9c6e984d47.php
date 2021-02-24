<?php /*a:3:{s:44:"../template/default/member\wallet\index.html";i:1613985992;s:37:"../template/default/layouts\base.html";i:1613985992;s:39:"../template/default/layouts\weixin.html";i:1613985992;}*/ ?>
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
    
<link rel="stylesheet" href="/static/mobile/default/css/wallet.css" />


</head>
<body >
  <div class="page myWallet">
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
   
<div class="page-bd">
    <!-- 页面内容-->
    <div class="top">
        <div class="money">
            <p class="fs48 num color_w balance_money">0.00</p>
            <a href="<?php echo url('withdraw/index'); ?>" class="fs24 color_w withdrwa_btn ">提现</a>
            <span class="fs26 color_w">积分</span><p class="fs48 num color_w use_integral">0</p>


        </div>
        <span class="fs26 color_w">余额</span>

        <div class="tips">
            <div class="color_w fs26">可提现 ￥<p class="fs30 balance_money">0.00</p></div>
        </div>
    </div>
    <div class="moneyInfo">
        <div>
            <p class="fs40 color_3 num today_income">0.00</p>
            <span class="fs26 color_9">今日收益(元)</span>
        </div>
        <div>
            <p class="fs40 color_3 num month_income">0.00</p>
            <span class="fs26 color_9">本月收益(元)</span>
        </div>
        <div>
            <p class="fs40 color_3 num total_income">0.00</p>
            <span class="fs26 color_9">累计到账(元)</span>
        </div>
    </div>
    <div class="cellBox">
        <a href="<?php echo url('dividendLog'); ?>">
            <div><img src="/static/mobile/default/images/wallet01.png" alt=""><span class="fs30 fw_b color_3">佣金明细</span></div>
            <img src="/static/mobile/default/images/rightIcon.png" alt="" class="rightIcon">
        </a>
        <a href="<?php echo url('mylog',array('type'=>'balance')); ?>">
            <div><img src="/static/mobile/default/images/wallet01.png" alt=""><span class="fs30 fw_b color_3">余额明细</span></div>
            <img src="/static/mobile/default/images/rightIcon.png" alt="" class="rightIcon">
        </a>
        <a href="<?php echo url('mylog',array('type'=>'score')); ?>">
            <div><img src="/static/mobile/default/images/wallet01.png" alt=""><span class="fs30 fw_b color_3">积分明细</span></div>
            <img src="/static/mobile/default/images/rightIcon.png" alt="" class="rightIcon">
        </a>
        <a href="<?php echo url('withdrawLog'); ?>">
            <div><img src="/static/mobile/default/images/wallet01.png" alt=""><span class="fs30 fw_b color_3">提现记录</span></div>
            <img src="/static/mobile/default/images/rightIcon.png" alt="" class="rightIcon">
        </a>
        <a href="<?php echo url('rechargeLog'); ?>">
            <div><img src="/static/mobile/default/images/wallet01.png" alt=""><span class="fs30 fw_b color_3">充值记录</span></div>
            <img src="/static/mobile/default/images/rightIcon.png" alt="" class="rightIcon">
        </a>
        <!-- <a href="<?php echo url('leaderboard'); ?>" class="hide">
            <div><img src="/static/mobile/default/images/wallet02.png" alt=""><span class="fs30 fw_b color_3">排行榜</span></div>
            <img src="/static/mobile/default/images/rightIcon.png" alt="" class="rightIcon">
        </a> -->
    </div>
</div>
<div class="button">
    <a href="<?php echo url('recharge'); ?>" class="fs32 fw_b BGcolor_r color_w">充值</a>
</div>


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
    $('.left-arrow').attr('href','/member/center/index.html');
    $(function () {
        //加载会员数据
        jq_ajax('<?php echo url("member/api.users/getAccount"); ?>','',function (res) {
            if (res.code==0){
                _alert(res.msg);
                return false;
            }
            $('.balance_money').html(res.account.balance_money);
			$('.total_income').html(res.account.total_dividend);
            $('.frozen_amount').html(res.frozen_amount);
            $('.use_integral').html(res.account.use_integral);
            if (res.account.bean_value > 0){
                 $('.withdrwa_btn').removeClass('hide');
             }
			$('.today_income').html(res.today_income);
			$('.month_income').html(res.month_income);
			if (res.withdraw_status == 1){
				$('.withdrwa_btn').removeClass('hide');
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