<?php /*a:3:{s:49:"../template/default/member\passport\register.html";i:1614001826;s:37:"../template/default/layouts\base.html";i:1613985992;s:39:"../template/default/layouts\weixin.html";i:1613985992;}*/ ?>
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
    
<link rel="stylesheet" href="/static/mobile/default/css/login.css"/>


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
   
<div class="page-bd">
    <!-- 页面内容-->
    <div class="top">
        <?php if($sign_logo): ?>
        <img src="<?php echo htmlentities($sign_logo); ?>" alt="">
        <?php else: ?>
        <img src="/static/mobile/default/images/APPLOGO.png" alt="">
        <?php endif; ?>
        <span class="fs34 color_3 fw_b"><?php echo settings('shop_title'); ?></span>
    </div>
    
    <div class="inputBlock bor_b">
        <img src="/static/mobile/default/images/register05.png" alt="" class="imgIcon">
        <input type="text" class="fs32 fw_b textBox" id="nick_name" placeholder="用户名">
    </div>
    <div class="inputBlock bor_b">
        <img src="/static/mobile/default/images/register02.png" alt="" class="imgIcon">
        <input type="password" class="fs32 fw_b textBox" id="password" placeholder="登陆密码">
        <div class="ereBox">
            <img src="/static/mobile/default/images/login01.png" alt="" data-type="0">
        </div>
    </div>

    <div class="inputBlock bor_b">
        <img src="/static/mobile/default/images/register02.png" alt="" class="imgIcon">
        <input type="password" class="fs32 fw_b textBox" id="password_re" placeholder="确认密码">
        <div class="ereBox">
            <img src="/static/mobile/default/images/login01.png" alt="" data-type="0">
        </div>
    </div>


    <div class="inputBlock bor_b">
        <img src="/static/mobile/default/images/register03.png" alt="" class="imgIcon">
        <input type="text" class="fs32 fw_b textBox" id="mobile" placeholder="手机号">
    </div>
    <?php if($sms_fun['register']==1): ?>
    <div class="inputBlock bor_b">
        <img src="/static/mobile/default/images/register04.png" alt="" class="imgIcon">
        <input type="text" class="fs32 fw_b textBox code" id="code" placeholder="验证码">
        <div class="codeBox">
            <span class="color_r fs28 fw_b getCode" onclick="codeButton()">获取验证码</span>
            <span class="color_9 fs28 fw_b time" style="display:none">60s</span>
        </div>
    </div>
    <?php endif; ?>

    <div class="inputBlock bor_b <?php echo $register_invite_code==0 ? 'hide' : ''; ?>">
        <img src="/static/mobile/default/images/register01.png" alt="" class="imgIcon">
        <?php if(empty($share_token) || (($share_token instanceof \think\Collection || $share_token instanceof \think\Paginator ) && $share_token->isEmpty())): ?>
            <input type="text" class="fs32 fw_b textBox" id="invite_code" placeholder="<?php echo htmlentities($lang_register_invite_code[$register_invite_code]); ?>">
        <?php else: ?>
            <input type="text" class="fs32 fw_b textBox" id="invite_code" value="<?php echo htmlentities($share_token); ?>" disabled placeholder="邀请人的<?php echo htmlentities($lang_register_invite_code[$register_invite_code]); ?>">
        <?php endif; ?>
    </div>
    <div class="rulesBox">
        <label for="isAgree">
            <div class="iconBox">
                <input type="checkbox" class="check" name="checkbox1" id="isAgree" value="1">
                <i class="icon_checked"></i>
            </div>
        </label>
        <div class="rules fs26 color_9">我同意<a href="<?php echo url('shop/article/registerAgreement'); ?>" class="color_3">《<?php echo settings('shop_title'); ?>》注册协议</a>
        </div>
    </div>

    <div class="loginbutton fs32 fw_b color_w BGcolor_r register">注册</div>
    <div class="fs30 goregister"><span class="color_9">已有账号，</span><a href="<?php echo url('login'); ?>"
                                                                      class="fw_b color_3">立即登录</a></div>
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

<script>
    var register_invite_code = <?php echo htmlentities(intval($register_invite_code)); ?>;
    var register_must_invite = <?php echo htmlentities(intval($register_must_invite)); ?>;
    $(function () {
        $('.ereBox').on('click', function () {
            var obj = $(this).find('img')
            if (obj.attr('data-type') == '0') {
                obj.attr('src', '/static/mobile/default/images/login02.png')
                obj.attr('data-type', '1')
                $(this).siblings('input').attr('type', 'text')
            } else {
                obj.attr('src', '/static/mobile/default/images/login01.png')
                obj.attr('data-type', '0')
                $(this).siblings('input').attr('type', 'password')
            }
        })
    })
    $('.register').on('click', function () {
        var arr = new Object();
        arr.mobile = $('#mobile').val();
        arr.nick_name = $('#nick_name').val();
        arr.password = $('#password').val();
        arr.password_re = $('#password_re').val();
        arr.invite_code = $('#invite_code').val();
        if (arr.mobile == '') {
            _alert('请输入手机号码.');
            return false;
        }

        if ($('#code').length > 0) {
            arr.code = $('#code').val();

            if (arr.code == '') {
                _alert('请输入验证码..');
                return false;
            }
        }
        if (arr.nick_name == '') {
            _alert('请输入用户用户名.');
            return false;
        }
        if (arr.password == '') {
            _alert('请输入用户密码.');
            return false;
        }
        if (arr.password.length < 8) {
            _alert('用户密码长度不能小于八位.');
            return false;
        }

        if (arr.password != arr.password_re) {
            _alert('两次输入密码不一致.');
            return false;
        }

        if (register_invite_code == 1 && register_must_invite == 1){
            if (arr.invite_code.length < 1) {
                _alert('请填写邀请人信息或邀请码.');
                return false;
            }
        }
        if ($('#isAgree').is(':checked') == false) {
            _alert('请查看后并勾选同意注册协议..');
            return false;
        }
        jq_ajax('<?php echo url("member/api.passport/register"); ?>', arr, function (res) {
            if (res.code == 0) {
                _alert(res.msg);
                return false;
            }
            _alert(res.msg, '<?php echo url("login"); ?>');
        })
    })
    function codeButton() {
        var arr = new Object();
        arr.type = 'register';
        arr.mobile = $('#mobile').val();
        if (arr.mobile == '') {
            _alert('请输入手机号码');
            return false;
        }
        jq_ajax('<?php echo url("publics/api.sms/sendCode"); ?>', arr, function (res) {
            if (res.code == 0) {
                _alert(res.msg);
                return false;
            }
            var timeObj = $('.time')
            var getCodeObj = $('.getCode')
            getCodeObj.hide();
            timeObj.show();
            var time = 60;
            var set = setInterval(function () {
                timeObj.text("" + --time + "s");
                if (time <= 0) {
                    timeObj.hide();
                    getCodeObj.show();
                    clearInterval(set);
                }
            }, 1000);
        })

    }
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