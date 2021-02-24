<?php /*a:4:{s:51:"../template/default/shop\..\..\customize\index.html";i:1613985992;s:39:"../template/default/layouts\bottom.html";i:1613985992;s:39:"../template/default/layouts\weixin.html";i:1613985992;s:48:"../template/default/shop\index\ordermessage.html";i:1613985992;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <title>商城首页</title>
    <link rel="stylesheet" type="text/css" href="/static/customize/js/dist/foxui/css/foxui.min.css?v=0.2">
    <link rel="stylesheet" type="text/css" href="/static/customize/mobile/css/style.css?v=2.0.9">

    <link rel="stylesheet" type="text/css" href="/static/customize/fonts/iconfont.css?v=2017070719">
    <script src="/static/customize/js/jquery/jquery-1.11.1.min.js"></script>
    <?php if($is_wx == '1'): ?>
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.3.2.js"></script>
    <?php endif; ?>
    <script src="/static/customize/js/require.js"></script>
    <script src="/static/customize/mobile/js/myconfig-app.js"></script>
    <script language="javascript">require(['core'],function(modal){modal.init({siteUrl: "<?php echo htmlentities(app('config')->get('config.host_path')); ?>",baseUrl: "./index.php?i=1&c=entry&m=ewei_shopv2&do=mobile&r=ROUTES&mid=2189"})});</script>


    <style>.fui-goods-group.block .fui-goods-item .image {background-image: url("http://rrd.winmobi.cn/attachment/images/1/2018/07/R2M55665qgM23mu4h9309e1b40zmVB.png");}</style>

    <style type="text/css">
        body {
            position: absolute;;
            max-width: 750px;  margin:auto;
        }
        .fui-navbar {
            max-width:750px;
        }
        .fui-navbar,.fui-footer  {
            max-width:750px;
        }
        .fui-page.fui-page-from-center-to-left,
        .fui-page-group.fui-page-from-center-to-left,
        .fui-page.fui-page-from-center-to-right,
        .fui-page-group.fui-page-from-center-to-right,
        .fui-page.fui-page-from-right-to-center,
        .fui-page-group.fui-page-from-right-to-center,
        .fui-page.fui-page-from-left-to-center,
        .fui-page-group.fui-page-from-left-to-center {
            -webkit-animation: pageFromCenterToRight 0ms forwards;
            animation: pageFromCenterToRight 0ms forwards;
        }
    </style>


    <style>.danmu {display: none;opacity: 0;}</style>
</head>

<body ontouchstart>

<div class='fui-page-group '>

    <script>document.title = "<?php echo htmlentities($page['title']); ?>"; </script>
    <link rel="stylesheet" href="/static/customize/js/dist/swiper/swiper.min.css">
    <link href="/static/customize/mobile/css/foxui.diy.css?v=201705261600" rel="stylesheet"type="text/css"/>
    <style type="text/css">
    </style>
    <div class='fui-page  fui-page-current ' style="top: 0; background-color: <?php echo htmlentities($page['background']); ?>;">
        <div class="fui-header">
            <div class="fui-header-left">
            </div>
            <div class="title"><?php echo htmlentities($page['title']); ?></div>
            <div class="fui-header-right"></div>
        </div>
        <?php echo $topfixed; ?>
        <div class="fui-content " id="container" style="background-color: <?php echo htmlentities($page['background']); ?>;margin-top:<?php echo !empty($topfixed) ? '1.1rem;;' : '0px;'; ?>;">
            <?php echo $body; ?>
        <script language="javascript">
            require(['/static/customize/mobile/js/mobile.js'], function(modal){
                modal.init();
            });
        </script>
            <div id="fotter_bottom"></div>
         </div>
    </div>
    <?php if($page['diylayer'] == 1): ?>
        <a class="diy-layer external" style="width: 30px; position: fixed; display: block; overflow: hidden; z-index: 999; top: 200px; right: 8px; text-align: left;" href=""><img src="/static/customize/images/chat.png" style="height: auto; width: 100%; display: block;"></a>
    <?php endif; if($page['diygotop'] == 1): ?>
    <a class="diy-gotop external" style="position: fixed; overflow: hidden; z-index: 999; bottom: 60px; right: 10px; text-align: left;" id="gotop">
        <div style="background: #000000; opacity: 0.5; line-height: 32px; text-align: center; border-radius: 30px; height: 30px; width: 30px;">
            <i class="icon icon-top1" style="color: #ffffff; font-size: 20px;"></i>
        </div>
    </a>
    <?php endif; if($page['followbar'] == 1 && $tipsubscribe == 1): ?>
    <div class="topTips">
        <div class="flexBox">
            <div class="cell_bd"><img src="/static/mobile/default/images/APPLOGO.png" alt=""><span class="fs28 color_w">您当前还未关注微信公众号</span></div>
            <div class="cell_ft"><p class="fs28 fw_b color_r">立即关注</p><img src="/static/mobile/default/images/close_w.png" alt=""></div>
        </div>
    </div>
    <!-- 扫码关注 -->
    <div class="topTipSmodel">
        <div class="modelBG closeModel" ></div>
        <div class="medelCanten">
            <div class="codeBox">
                <img src="<?php echo htmlentities($setting['weixin_qrcode']); ?>" alt="">
                <span class="fs30 color_3 fw_b">长按二维码识别关注</span>
            </div>
            <img src="/static/mobile/default/images/close_wy.png" alt="" class="closeimg closeModel" >
        </div>
    </div>
    <style>
        .topTips {
            width: 100%;
            background: #212121;
            z-index: 99999;
            position: fixed;
            max-width: 750px;
        }
        .topTips .flexBox {
            height: 2.2rem;
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            align-items: center;
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            justify-content: space-between;
            width: 100%;
            padding: 0 0.75rem;
        }
        .topTips .flexBox .cell_bd {
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
        .topTips .flexBox .cell_bd img {
            width: 1.6rem;
            height: 1.6rem;
            margin-right: 0.5rem;
            border-radius: 50%;
        }
        .topTips .flexBox .cell_bd span{
            font-size: 0.65rem;
            color: #FFF;
        }
        .topTips .flexBox .cell_ft {
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
        .topTips .flexBox .cell_ft p {
            width: 3rem;
            height: 1.2rem;
            background: #ffffff;
            border-radius: 0.3rem;
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            align-items: center;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            font-size: 0.6rem;
            color: #ff5555;
        }
        .topTips .flexBox .cell_ft img {
            width: 14PX;
            height: 14PX;
            margin-left: 10PX;
        }
        .topTipSmodel {
            position: fixed;
            top: 0;
            bottom: 0;
            width: 100%;
            z-index: 99999;
            display: none;
        }
        .topTipSmodel .modelBG {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.6);
        }
        .topTipSmodel .medelCanten {
            position: relative;
            margin: 25vh 1rem 0 1rem;
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            align-items: center;
            z-index: 99999;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            flex-direction: column;
        }
        .topTipSmodel .medelCanten .codeBox {
            padding: 0.75rem;
            background: #ffffff;
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            align-items: center;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            flex-direction: column;
        }
        .topTipSmodel .medelCanten .codeBox img {
            width: 10rem;
            height: 10rem;
        }
        .topTipSmodel .medelCanten .codeBox span {
            margin-top: 0.5rem;
        }
        .topTipSmodel .medelCanten .closeimg {
            width: 1.3rem;
            height: 1.3rem;
            margin-top: 0.75rem;
        }

    </style>
    <?php endif; if($page['diymenu'] == 1): ?>
        <style type="text/css">
            #fotter_bottom{padding-bottom:3rem;}
            .bottom-tabbar-wrapper {
                height: 2.5rem;
            }
            .bottom-tabbar {
                background-color: #fff;
                display: -webkit-box;
                display: -webkit-flex;
                display: flex;
                height: 2.5rem;
                -webkit-box-align: center;
                -webkit-align-items: center;
                align-items: center;
                -webkit-justify-content: space-around;
                justify-content: space-around;
                line-height: 1em;
                position: fixed;
                left: 0;
                right: 0;
                bottom: 0;
                box-shadow: 0 -0.02rem 0.08rem 0 rgba(0, 0, 0, 0.1);
                z-index: 9;
            }

            .bottom-tabbar::after {
                display: none;
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                border-top: solid #e9e9e9 1px;
            }

            .bottom-tabbar a {
                text-align: center;
                width: 2.5rem;
                height: 2.5rem;
                display: -webkit-box;
                display: -webkit-flex;
                display: flex;
                -webkit-box-align: center;
                -webkit-align-items: center;
                align-items: center;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -webkit-flex-direction: column;
                flex-direction: column;
                -webkit-box-pack: center;
                -webkit-justify-content: center;
                justify-content: center;
                font-weight: 400;
            }

            .bottom-tabbar a.active .label {
                color: #313131;
                font-weight: bold;
            }

            .bottom-tabbar a.active .icon img {
                display: none;
            }

            .bottom-tabbar a.active .icon .lhimg {
                display: block;
            }

            .bottom-tabbar a .label {
                font-size: 0.6rem;
                color: #666666;
                line-height: 1.4em;
            }

            .bottom-tabbar a .icon {
                width: 1rem;
                height: 1rem;
                display: inline-block;
                margin-bottom: 0;
            }

            .bottom-tabbar a .icon img {
                display: block;
                width: 100%;
                height: 100%;
            }

            .bottom-tabbar a .icon .lhimg {
                display: none;
            }
        </style>
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
    <?php endif; ?>

    <script>
        $(function () {
            $(".fui-content").bind('scroll resize', function () {
                var scrolltop = $(".fui-content").scrollTop();
                if (scrolltop > "300") {
                    $("#gotop").fadeIn(100)
                } else {
                    $("#gotop").fadeOut(100)
                }
            });
            $("#gotop").unbind('click').click(function () {
                $(".fui-content").animate({scrollTop: "0px"}, 1000)
            });
            $('.topTips .cell_ft p').on('click',function(){
                $('.topTipSmodel').show()
            })
            $('.topTips .cell_ft img').on('click',function(){
                $('.topTips').hide()
            })
            $('.closeModel').on('click',function() {
                $('.topTipSmodel').hide()
            })
        });
    </script>
    <script language="javascript">
        require(['init']);

        setTimeout(function () {
            if($(".danmu").length>0){
                $(".danmu").remove();
            }
        }, 500);
    </script>

    <!-- <script language="javascript">
        clearTimeout(window.interval);
        window.interval = setTimeout(function () {
            window.shareData = {"title":"\u8bf7\u8f93\u5165\u9875\u9762\u6807\u9898","imgUrl":"","desc":"","link":"http:\/\/rrd.winmobi.cn\/app\/index.php?i=1&c=entry&m=ewei_shopv2&do=mobile&r=diypage&id=32&mid=2189"};
            jssdkconfig = null || { jsApiList:[] };
            jssdkconfig.debug = false;
            jssdkconfig.jsApiList = ['checkJsApi','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','showOptionMenu', 'hideMenuItems', 'onMenuShareQZone', 'scanQRCode','openLocation'];
            wx.config(jssdkconfig);
            wx.ready(function () {
                wx.showOptionMenu();
                window.shareData.success = "";
                if(window.shareData.success){
                    var success = window.shareData.success;
                    window.shareData.success = function(){
                        eval(success)
                    };
                }
                wx.onMenuShareAppMessage(window.shareData);
                wx.onMenuShareTimeline(window.shareData);
                wx.onMenuShareQQ(window.shareData);
                wx.onMenuShareWeibo(window.shareData);
                wx.onMenuShareQZone(window.shareData);
            });
        },500);
    </script> -->
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
    <div class="wap-qrcode-container">
        <p class="example1"><?php echo htmlentities($page['title']); ?></p>
        <div class="wap-qrcode-image" id="wap-qrcode"></div>
        <p class="example1">微信“扫一扫”浏览</p>
    </div>
    <script language="javascript">
        $(function(){
            setTimeout(function(){
                require(['jquery.qrcode'],function(q){
                    $('#wap-qrcode').html('');
                    $('#wap-qrcode').qrcode("<?php echo htmlentities(app('config')->get('config.host_path')); ?>");
                });
            },500);

        })
    </script>

    <span style="display:none"></span>
<?php if(settings('show_ordermessage_switch') == 1): ?>
<style type="text/css">
	.showmessage{
	    position: absolute;
	    top: 10px;
	    z-index: 9;
	    left: 10px;
	    color: #fff;
	    line-height: 0.5rem;
	    background: #000000a6;
	    border-radius: 12px;
	    padding: 0 8px;
	}

	.msg_show_img{
		width: 20px;
	    height: 20px;
	    border-radius: 50%;
	    display: inline-block;
	}

	.msg_show_div{
		display: inline-block;
	    float: left;
	    height: 20px;
	}

	.msg_show_name{
		line-height: 24px;
    /* margin-top: -14px; */
	    display: inline-block;
	    /* top: 19px; */
	    margin-left: 4px;
	    margin-top: :2px;
	    /* position: absolute; */
	    /* margin-top: -5px; */
	    width: -9%;
	    float: left;
	    margin-top: 0.05rem;
	}
</style>
<div style="display: none;" id="show_ordermessage">
</div>
<script type="text/javascript">
	<!-- 刷新频率必须要比获取真实频率要低 -->
	$(function(){
		var hit = "<?php echo settings('show_ordermessage_hit'); ?>"
		var frequency ="<?php echo settings('show_ordermessage_frequency'); ?>"
		if(frequency == null){
			frequency=10000000000000000;
		}else{
			frequency = frequency*1000
		}
		
		var rfrequency ="<?php echo settings('show_ordermessage_rfrequency'); ?>"

		rfrequency= rfrequency * 1000
		var content = "<?php echo settings('show_ordermessage_content'); ?>"
		var num = height = 0 ;

		height = $('.selectBox').height() +  $('.header').height() + $(document).height()/50 + $('.fui-header').height()

		$('body').append('<div class="showmessage" style="top:'+height+'px"></div>');

		setInterval(function(){
		   a = $('.msg_show:eq(0)')
		  $('.showmessage').html('')

		   var type=a.data('type')

		   rd = Math.ceil(Math.random()*100)
		   if((type == 'not-real' && rd < hit) || (type == 'real')) {
		   	 $('.showmessage').append($('.msg_show:eq(0)').html())
		   	 a.remove()
		   }
		   //要实时查看有没有数据,没有就要加载
		   if(a.length <= 0){
		   	ajaxget('not-real')
		   }

		},frequency)	

		setInterval(function(){
			ajaxget('real')
		},rfrequency)



		function ajaxget(type){
			$.ajax({
		 	url:"<?php echo url('getordermessage'); ?>",
		 	data:{type:type},
		 	success:function(r){
		 		if(r != ''){
		 			for(var i=0 ; i< r.length;i++){
		 				$('#show_ordermessage').prepend(getstr(r[i].headimgurl,r[i].user_name,content,type))
		 			}
		 		}
		 	}
		 })
		}
		function getstr(header_img,nickname,content,type){
			return '<span class="msg_show" data-type="'+type+'"><div class="msg_show_div"><img class="msg_show_img" style="display: inline-block;" src="'+header_img+'"></div><div name="user_name"  class="msg_show_name">'+nickname+' '+content+'</div></span>'
		}
	})

	

</script>
<?php endif; ?>	
   
</body>
</html>

