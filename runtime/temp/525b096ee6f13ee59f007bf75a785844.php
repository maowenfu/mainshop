<?php /*a:3:{s:44:"../template/default/member\wallet\mylog.html";i:1613985992;s:37:"../template/default/layouts\base.html";i:1613985992;s:39:"../template/default/layouts\weixin.html";i:1613985992;}*/ ?>
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
    
<link rel="stylesheet" href="/static/mobile/default/css/picker.css"/>
<link rel="stylesheet" href="/static/mobile/default/css/wallet.css"/>


</head>
<body >
  <div class="page balanceDetail">
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
   
<div class="top">
    <div class="dataBox">
        <div class="left">
            <input type="text" class="fs28 fw_b color_3" readonly value="" id="nowValue"/>
            <span class="fs24 color_9">总收入：￥<em class="b_income">0</em> <span style="margin-left: 10px;">总支出：￥<em class="b_expend">0</em></span></span>
        </div>
        <img src="/static/mobile/default/images/detail01.png" alt="">
    </div>
    <div class="title">
        <span class="fs26 color_6">全部记录</span>
        <div><img src="/static/mobile/default/images/goodslist05.png" alt="" data-type="0" class="typeimg"></div>
    </div>
</div>
<div class="page-bd">
    <!-- 页面内容-->
    <div class="list">
        
    </div>
</div>
<div class="model">
    <div class="modelBg"></div>
    <div class="modelbd">
        <label for="s10">
            <span class="fs28 color_3 fw_b">全部记录</span>
            <div class="iconBox">
                <input type="radio" class="check" value="all" name="radiobox" id="s10" checked>
                <i class="icon_checked"></i>
            </div>
        </label>
        <label for="s11">
            <span class="fs28 color_3 fw_b">收入</span>
            <div class="iconBox">
                <input type="radio" class="check" value="income" name="radiobox" id="s11" >
                <i class="icon_checked"></i>
            </div>
        </label>
        <label for="s12">
            <span class="fs28 color_3 fw_b">支出</span>
            <div class="iconBox">
                <input type="radio" class="check" value="expend" name="radiobox" id="s12">
                <i class="icon_checked"></i>
            </div>
        </label>
    </div>
</div>

<script type="text/html" id="logTpl">
{{each list as item index}}
<div class="cell">
	<div class="left">
		<p class="fs28 fw_b color_2">{{item.change_desc}}</p>
		<span class="fs24 color_9">{{item._time}}</span>
	</div>
	<div class="right fs34 num {{item.value > 0 ? 'color_r' : 'color_3' }}">
		{{item.value}}
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

<script src="/static/mobile/default/js/datePicker.js"></script>
<script>
	function getList(){
		var arr = new Object;
		arr.time = $('#nowValue').val();
		arr.type = '<?php echo htmlentities((isset($type) && ($type !== '')?$type:balance)); ?>';
        arr.flag = $("input[name='radiobox']:checked").val();
		jq_ajax('<?php echo url("member/api.Users/getAccountLog"); ?>',arr,function(res){
            if (res.code == 0){
                _alert(res.msg);
                return false;
            }
            if (typeof(res.list) == 'undefined'){
                $('.list').html('<div style="text-align:center; line-height: 100px;">暂无没有相关数据.</div>');
            }else{
                $('.list').html(template('logTpl', res));
            }
			$('#nowValue').val(res.time);
			$('.b_expend').html(res.expend);
			$('.b_income').html(res.income);
		});
	}
    $(function(){		
		getList();
        $('.dataBox img').on('click',function(){
            $('.model').hide()
            $('.typeimg').attr('data-type','0')
            $('.typeimg').css('transform','rotate(0deg)')
            demoClick()
        })
        //开启数据筛选
        $('.title div').on('click',function(){
            var imgBox=$('.typeimg')
            if (imgBox.attr('data-type')=='1') {
                $('.model').hide();
                imgBox.attr('data-type','0');
                imgBox.css('transform','rotate(0deg)');
            }else{
                $('.model').show();
                imgBox.attr('data-type','1');
                imgBox.css('transform','rotate(180deg)');
            }
        })
        $('.modelBg').on('click',function(){
            $('.model').hide()
        })

        $('.modelbd label').on('click',function(){
            if ($(this).find('input').is(':checked')) {
                var val=$(this).find('span').text()
                $('.title span').text(val)
				getList();
				$('.model').hide();
				var imgBox=$('.typeimg')
				imgBox.attr('data-type',0);
				imgBox.css('transform','rotate(0deg)');
            }
        })
    })

    // 日期选择器
    function demoClick() {
        var nowValue = document.getElementById('nowValue');
        var reg = new RegExp("年|月","g");
        var nowval=nowValue.value.replace(reg,"-").substring(0,7);
        new DatePicker({
            "type": "1",//0年, 1年月, 2月日, 3年月日
            "title": '请选择年月',//标题(可选)
            "maxYear": "2030",//最大年份（可选）
            "minYear": "2010",//最小年份（可选）
            "separator": "-",//分割符(可选)
            "defaultValue": nowval,//默认值（可选）
            "callBack": function (val) {
                //回调函数（val为选中的日期）
                var arr=val.split('-');
                val=arr[0]+'年'+arr[1]+'月'
                nowValue.value = val;
				getList();
            }
        });
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