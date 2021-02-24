<?php /*a:4:{s:44:"../template/default/shop\index\all_sort.html";i:1613985992;s:37:"../template/default/layouts\base.html";i:1613985992;s:39:"../template/default/layouts\bottom.html";i:1613985992;s:39:"../template/default/layouts\weixin.html";i:1613985992;}*/ ?>
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
    
<link rel="stylesheet" href="/static/mobile/default/css/fenlei.css" />


</head>
<body >
  <div class="page fenlei">
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
        <div class="top bor_b">
        <a href="<?php echo url('index/search'); ?>">
            <div class="inputBox"><img src="/static/mobile/default/images/selech01.png" alt=""><form action="<?php echo url('goods/index'); ?>"><input class="fs30 color_3" type="text" placeholder="请输入关键词"></form></div></a>
           <span class="fs30 color_3" onclick="javascript:history.go(-1);">取消</span>
        </div>
        <div class="left bor_R">
          <?php if(!(empty($allSort['best']) || (($allSort['best'] instanceof \think\Collection || $allSort['best'] instanceof \think\Paginator ) && $allSort['best']->isEmpty()))): ?>	
          	<div class="box fs28 color_3 boxActive">推荐</div>
          <?php endif; if(is_array($allSort['rows']) || $allSort['rows'] instanceof \think\Collection || $allSort['rows'] instanceof \think\Paginator): $i = 0; $__LIST__ = $allSort['rows'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$class): $mod = ($i % 2 );++$i;?>
           		<div class="box fs28 color_3 <?php if(empty($allSort['best']) && $i == 1): ?>boxActive<?php endif; ?>"><?php echo !empty($class['m_name']) ? htmlentities($class['m_name']) : htmlentities($class['name']); ?></div>
           <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="right">
         <?php if(!(empty($allSort['best']) || (($allSort['best'] instanceof \think\Collection || $allSort['best'] instanceof \think\Paginator ) && $allSort['best']->isEmpty()))): ?>	
          	<div class="rightBox" style="display:block">
            <?php if(is_array($allSort['best']) || $allSort['best'] instanceof \think\Collection || $allSort['best'] instanceof \think\Paginator): $i = 0; $__LIST__ = $allSort['best'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$best): $mod = ($i % 2 );++$i;?>
              <div class="block">
                  <div class="title"><i></i><span class="fs28 fw_b color_3"><?php echo htmlentities($best['m_name']); ?></span><i></i></div>
                  <div class="list">
                  	<?php if(is_array($best['children']) || $best['children'] instanceof \think\Collection || $best['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $best['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cid): $mod = ($i % 2 );++$i;?>
                      <a href='<?php echo url("goods/index",['cid'=>$cid]); ?>'><img src="<?php echo htmlentities($classList[$cid]['pic']); ?>" alt=""><span class="fs26 color_6">
                      <?php echo !empty($classList[$cid]['m_name']) ? htmlentities($classList[$cid]['m_name']) : htmlentities($classList[$cid]['name']); ?>
                      </span></a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </div>
              </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </div>
          <?php endif; if(is_array($allSort['rows']) || $allSort['rows'] instanceof \think\Collection || $allSort['rows'] instanceof \think\Paginator): $i = 0; $__LIST__ = $allSort['rows'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$class): $mod = ($i % 2 );++$i;?>
              <div class="rightBox" style="<?php if(empty($allSort['best']) && $i == 1): ?>display:block<?php endif; ?>">
            <?php if(empty($class['children']) || (($class['children'] instanceof \think\Collection || $class['children'] instanceof \think\Paginator ) && $class['children']->isEmpty())): ?>
                <div class="block">
                    <div class="title"><i></i><span class="fs28 fw_b color_3"><?php echo !empty($class['m_name']) ? htmlentities($class['m_name']) : htmlentities($class['name']); ?></span><i></i></div>
                    <div class="list">
                        <a href='<?php echo url("goods/index",['cid'=>$class['id']]); ?>'><img src="<?php echo htmlentities($class['pic']); ?>" alt=""><span class="fs26 color_6"><?php echo !empty($class['m_name']) ? htmlentities($class['m_name']) : htmlentities($class['name']); ?></span></a>
                    </div>
                </div>
            <?php else: if(is_array($class['children']) || $class['children'] instanceof \think\Collection || $class['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $class['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cids): $mod = ($i % 2 );++$i;?>
                  <div class="block">
                      <div class="title"><i></i><span class="fs28 fw_b color_3"><?php echo !empty($classList[$key]['m_name']) ? htmlentities($classList[$key]['m_name']) : htmlentities($classList[$key]['name']); ?></span><i></i></div>
                      <div class="list">
                      	<?php if(is_array($cids) || $cids instanceof \think\Collection || $cids instanceof \think\Paginator): $i = 0; $__LIST__ = $cids;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cid): $mod = ($i % 2 );++$i;?>
                        <a href='<?php echo url("goods/index",['cid'=>$cid]); ?>'><img src="<?php echo htmlentities($classList[$cid]['pic']); ?>" alt=""><span class="fs26 color_6"><?php echo !empty($classList[$cid]['m_name']) ? htmlentities($classList[$cid]['m_name']) : htmlentities($classList[$cid]['name']); ?></span></a>
                       <?php endforeach; endif; else: echo "" ;endif; ?>
                      </div>
                  </div>
                 <?php endforeach; endif; else: echo "" ;endif; ?>
            <?php endif; ?>
              </div>
         <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
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


<script>
  $(function(){
        $('.top span').on('click',function(){
          $('.inputBox input').val('');
          $('.inputBox input').focus();
        });
        $('.box').on('click',function(){
          var index=$(this).index();
          $(this).addClass('boxActive');
          $(this).siblings().removeClass('boxActive')
          $('.rightBox').eq(index).show();
          $('.rightBox').eq(index).siblings().hide();
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