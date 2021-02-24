<?php /*a:3:{s:47:"../template/default/member\wallet\recharge.html";i:1613985992;s:37:"../template/default/layouts\base.html";i:1613985992;s:39:"../template/default/layouts\weixin.html";i:1613985992;}*/ ?>
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
  <div class="page chongzhi">
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
          <div class="inputBlock">
            <div class="tips fs26 fw_b color_9">充值金额(元)</div>
            <input type="text" class="fs52 num textBox" id="order_amount" placeholder="请输入充值金额">
          </div>
          <div class="paytype">
              <div class="title fs34 color_3 fw_b">请选择支付方式</div>
              <div class="cells">


              </div>
              <div class="uploading">
                  <div class="title fs28 fw_b color_3">上传凭证</div>
                  <div class="uploadBox">

                     <div class="Box">
                        <img src="/static/mobile/default/images/addImg.png" alt="" class="imgBox">
                        <input type="file" class="uploadInput" >

                      </div>
                  </div>
                </div>
            </div>

          <div class="button fs32 fw_b color_w BGcolor_r postBtn">确认充值</div>

    </div>
    </div>

<script type="text/html" id="payListTpl">
    {{each data as item index}}
    <div class="cell">
        <div class="cell_hd"><img src="/static/mobile/default/images/{{item.img}}" alt=""></div>
        <div class="cell_bd"><span class="fs30 color_3">{{item.pay_name}}</span></div>
        <div class="cell_ft">
            <label for="pay{{item.pay_id}}">
                <div class="iconBox">
                    <input type="radio" class="check" value="{{item.pay_code}}" name="pay_code" id="pay{{item.pay_id}}" >
                    <i class="icon_checked"></i>
                </div>
            </label>
        </div>
    </div>
    {{/each}}
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
$(function(){
    //加载支付列表中
    jq_ajax('<?php echo url("publics/api.pay/getList",["type"=>"is_recharge"]); ?>','',function(res){
        if (res.code==0){
            _alert(res.msg);
            return false;
        }
        $('.cells').html(template('payListTpl',res));
    });
	$(document).on('click',".check",function(){
        $('.uploading').hide();
	  if ($(this).is(":checked") && $(this).val() == 'offline') {
		  $('.uploading').show()
	  }
	})
})

var isPost = false
var fd = new FormData();
$('.postBtn').click(function(){
    if (isPost == true) return false;
	var order_amount = $('#order_amount').val();
    var pay_code =  $('input:radio[name="pay_code"]:checked').val();
	if (order_amount < 1){
		_alert('充值金额不能少于1');
		return false;
	}
	fd.append("pay_code",pay_code);
	fd.append("order_amount", order_amount);
    isPost = true;
	$.ajax({
		  url: '<?php echo url("member/api.Wallet/recharge"); ?>',
		  type: 'post',
		  processData: false,
		  contentType: false,
		  data: fd,
		  success: function (res) {
             isPost = false;
			 if (res.code == 0){
				  _alert(res.msg);
				  return false;
			  }
			  if (pay_code ==  'offline'){
                  _alert(res.msg,'<?php echo url("member/wallet/index"); ?>');
                  return false;
              }
              window.location.href = '<?php echo _url("publics/payment/getPay",["order_id"=>"【res.data.order_id】","pay_code"=>"【pay_code】"]); ?>';
		  }
	})

})

</script>
<script src="/static/mobile/default/js/uploadsimage.js?v=1"></script>
<script>
    //处理点击改变的调用函数-做IOS兼容
    $(_listenSelector).click(function(){
            var that = $(this);
            _uplocalfunction=function(base64Img){
              if ($('.appendBox').length >= 6){
                _alert('最多允许上传6张图片.');
                return false;
              }
              _imgNum++;
              fd.append("imgfile["+_imgNum+"]", base64Img);
              $(that).parent().before('<div class="Box"><img src="'+base64Img+'" alt="" class="imgBox appendBox"><img src="/static/mobile/default/images/closeImg.png" alt="" data-imgnum="'+_imgNum+'" class="closeImg"></div>');
          }
           
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