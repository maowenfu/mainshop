<?php /*a:3:{s:46:"../template/default/shop\article\headline.html";i:1613985992;s:37:"../template/default/layouts\base.html";i:1613985992;s:39:"../template/default/layouts\weixin.html";i:1613985992;}*/ ?>
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
  <div class="page hotspotNews">
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
    <div class="navBox">
        <div class="nav navActive fs32 color_9" data-children="">精选</div>
        <?php if(is_array($catList) || $catList instanceof \think\Collection || $catList instanceof \think\Paginator): if( count($catList)==0 ) : echo "" ;else: foreach($catList as $key=>$vo): ?>
        <div class="nav fs32 color_9" data-id="<?php echo htmlentities($vo['id']); ?>" data-children="<?php echo htmlentities($vo['children']); ?>"><?php echo htmlentities($vo['name']); ?></div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="content">
        <div class="blockList listbox" style="display: block">

        </div>
    </div>
</div>
<!-- 没有消息 -->
<script type="text/html" id="emptyTpl">
    <div class="noCoupons" style="display: block;">
        <img src="/static/mobile/default/images/noCoupons.png" alt="">
        <span class="fs30 color_9">暂无任何数据</span>
    </div>
</script>
<script type="text/html" id="TabTpl">
    {{each list as item index}}
    <a href="<?php echo _url('info',['id'=>'[[item.id]]']); ?>" class="block">
        <img src="{{item.img_url}}" alt="" >
        <div class="info">
            <p class="fs28 fw_b color_3">{{item.title}}</p>
            <span class="fs24 color_9">阅读{{item.click}}</span>
        </div>
    </a>
    {{/each}}
</script>
<script>
    var nowPage = 1, getAgain = false, isLoadend = false;
    $(function () {
        //切换列表
        $('.navBox .nav').on('click', function () {
            var _index = $(this).index()
            $(this).siblings().removeClass('navActive')
            $(this).addClass('navActive')
            console.log(_index);
            isLoadend = false;
            getList(1);
        })

        var loading = false;  //状态标记
        $('.page-bd').scroll(function () {
            if ($(this).children('div').height() - $(this).height() - $(this).scrollTop() < 50 && !loading) {
                loading = true;
                getList(nowPage);
            }
        })
    })

    //请求列表数据
    function getList(page, isagain) {
        if (page == 1) {
            $('.listbox').html('');
        }
        if (isLoadend == true) return false;
        if (isagain == true) {
            if (getAgain == false) return false;
            getAgain = false;
        } else {
            $('.listbox').append('<div class="get_list_tip">加载数据中...</div>');
        }
        isLoadend = true;
        var children = $('.navBox .navActive').data('children');
        console.log(children);
        $.ajax({
            url: '<?php echo _url("shop/api.article/getHeadlineList",["p"=>"【page】"]); ?>',// 跳转到 action
            data: {children:children},
            type: 'post',
            cache: false,
            dataType: 'json',
            success: function (res) {
                isLoadend = false;
                if (res.code == 0) {
                    _alert(res.msg);
                    getAgain = true;
                    $('.get_list_tip').html('加载失败，点击重新加载.');
                    return false;
                }
                nowPage = page;
                nowPage++;
                $('.get_list_tip').remove();
                if (res.list) {
                    $('.listbox').append(template('TabTpl', res));
                    if (res.page_count == page) {
                        $('.listbox').append('<div class="get_list_tip">—— 没有更多啦，我是有底线的 ——</div>');
                        isLoadend = true;
                    }
                } else {
                    $('.listbox').append(template('emptyTpl', res));
                }

            }, error: function () {
                isLoadend = false;
                getAgain = true;
                $('.get_list_tip').html('加载失败，点击重新加载.');
            }
        });
    }
    //重新请求数据
    $(document).on('click', '.get_list_tip', function () {
        getList(nowPage, true);
    })
    getList(nowPage);//执行列表加载
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