<?php /*a:5:{s:40:"../template/default/shop\flow\index.html";i:1613985992;s:37:"../template/default/layouts\base.html";i:1613985992;s:39:"../template/default/layouts\bottom.html";i:1613985992;s:46:"../template/default/shop\flow\bonus_layer.html";i:1613985992;s:39:"../template/default/layouts\weixin.html";i:1613985992;}*/ ?>
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
    
<link rel="stylesheet" href="/static/mobile/default/css/shopCart.css" />


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
<div class="top"><span class="fs32 color_3">当前购物车共<em>0</em>件商品</span><p class="fs28 color_r hide" id="edit-btn"  data-type='0'>编辑</p></div>
    <!-- 空购物车 -->
    <div class="emptyBox">
        <img src="/static/mobile/default/images/emptyCart.png" alt="">
        <div><span class="fs30 color_9">购物车空空如也~</span><a href="/" class="fs30 color_r">去逛逛</a></div>
    </div>
    <!-- 购物车 -->
    <div class="goodslist">
        <a href="javascript:;" class="goCoupons">
            <p class="fs26 color_3">先领券再下单能享受更多优惠哦!</p>
            <div class="goCouponsBtn"><span class="fs26 color_r">领券</span><img src="/static/mobile/default/images/rightIcon.png" alt="" class="threeRight"></div>
        </a>
        <ul>

        </ul>
    </div>
    <!-- 失效商品 -->
    <div class="loseGoods" style="display: none;">
        <div class="title"><span class="fs32 fw_b color_3">失效商品</span><p class="fs28 color_r clearInvalid">清空</p></div>

    </div>

</div>
<div class="paying">
    <div class="totalBox ">
        <div class="left">
            <label for="checkall_a">
                <div class="iconBox">
                    <input type="checkbox" class="check checkall" name="checkbox1" id="checkall_a">
                    <i class="icon_checked"></i>
                </div>
                <span class="fs32 fw_b color-3">全选</span>
            </label>
            <p class="fs28 color_9">小计</p>
            <div class="color_3 fs30 num money"><p class="fw_b fm_p">￥</p><em class="fs52 totel_price_1">00</em><p class="totel_price_2">.00</p></div>
        </div>
        <a href="<?php echo url('checkOut'); ?>" class="right BGcolor_r fs30 color_w"><span class="fw_b">结算</span>(<em id="buyNum">0</em>)</a>
    </div>
</div>
<!-- 编辑 -->
<div class="edit">
    <div class="totalBox">
        <div class="left">
            <label for="checkall_b">
                <div class="iconBox">
                    <input type="checkbox"  class="check checkall" name="checkbox1" id="checkall_b">
                    <i class="icon_checked"></i>
                </div>
                <span class="fs32 fw_b color-3">全选</span>
            </label>
        </div>
        <div class="button fs30 color_w fw_b">
            <span class="BGcolor_3 delSelGoods">删除</span>
            <!-- <span class="BGcolor_r collectGoods">收藏</span> -->
        </div>
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

<script type="text/html" id="goodsLi">
    {{each goodsList as item index}}
    <li>
        <div class="checkbox">
            <label for="s{{item.rec_id}}">
                <div class="iconBox">
                    <input type="checkbox" class="check" id="s{{item.rec_id}}" name="rec_ids[]" value="{{item.rec_id}}" data-rec_id="{{item.rec_id}}" {{item.is_select?'checked':''}}>
                    <i class="icon_checked"></i>
                </div>
            </label>
            <div class="block">
                <a href='<?php echo _url("shop/goods/info",["id"=>"[[item.goods_id]]"]); ?>' >
                    <img src="{{item.pic}}" alt="" class="goodsimg">
                </a>
                <div class="info">
                    <p class="fs28 color_3">{{item.goods_name}}</p>
                    <div class="sign fs28 color_9">{{item.sku_name}}</div>
                    <div class="Money">
                        <div class="left">
                            <div class="color_3 fs24 num">
                                <p class="fw_b fm_p">￥</p><em class="fs36">{{item.exp_price[0]}}</em><i>.{{item.exp_price[1]}} </i> 元
                            </div>
                            
                            {{if item.use_integral > 0}}
                            <p class="fw_b fm_p"> + </p><em class="fs36">{{item.use_integral}}</em>积分
                           {{else if item.prom_type == 1}}
                            <div class="couponsPriceType">优惠价</div>
                            {{else if item.shop_price != item.sale_price}}
                            <span class="fs24 color_9">￥{{item.shop_price}}</span>
                            {{/if}}
                            
                        </div>

                        <div class="number">
                            <img src="/static/mobile/default/images/goodsIcon05.png" onClick="editNum(this,'{{item.rec_id}}','down');" class="minus">
                            <input class="fs30 color_3" type="text" readonly value="{{item.goods_number}}">
                            <img src="/static/mobile/default/images/goodsIcon06.png" onClick="editNum(this,'{{item.rec_id}}','up');" class="add"></div>

                    </div>
                </div>
            </div>
                <div class="swiped BGcolor_3">
                    <div class="delect" data-rec_id="{{item.rec_id}}"><img src="/static/mobile/default/images/delectIcon.png" alt=""></div>
                    <div class="like collectGoods" data-goods_id="{{item.goods_id}}"><img src="/static/mobile/default/images/goodsIcon03{{item.is_collect==1?'_lh':''}}.png" alt="" data-type="{{item.is_collect}}"></div>
                </div>
            </div>
        </a>
    </li>
    {{/each}}
</script>
<script type="text/html" id="loseGoodsLi">
    {{each invalidList as item index}}
    <a href='<?php echo _url("shop/goods/info",["id"=>"[[item.goods_id]]"]); ?>' >
        <div class="box">
            <img src="{{item.pic}}" alt="">
            <div class="info">
                <p class="fs28 color_9">{{item.goods_name}}</p>
                <span class="fs30 color_3">失效</span>
            </div>
        </div>
    </a>
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


<!-- 弹出领取优惠券 -->
<link rel="stylesheet" href="/static/mobile/default/css/coupons.css"/>
<div class="model getCoupons" style="display: none;">
    <div class="modelContent">
        <div class="title fs36 fw_b color_3">请领取优惠券</div>
        <div class="list bonusList">
        </div>
        <div class="closeBtn fs32 fw_b color_w BGcolor_r" onclick="closeModel(this)">关闭</div>
    </div>
</div>
<script type="text/html" id="TabTpl">
    <div class="tabBox">
        <div class="tabBlock ">
            <div class="listBox">
                
                {{each list as item index}}
                <div class="block {{if item.receive_status !=2}}userTicket{{/if}}" data-type_id="{{item.type_id}}">
                    <div class="left">
                        <div class="fs34 fw_b">{{item.type_name}}</div>
                        <p class="fs26">满{{item.min_amount}}元可用</p>
                        <span class="fs24">{{item._use_start_date}}-{{item._use_end_date}}</span>
                    </div>
                    <div class="right">
                        <div class="fs38 money">
                            <p class="fw_b">￥</p><em class="fs60 num">{{item.type_money}}</em>
                        </div>
                        {{if item.receive_status==0}}<button class="fs24 active receive_do">立即领取</button>{{/if}}
                        {{if item.receive_status==1}}<button class="fs24 active use_do">去使用</button>{{/if}}
                        {{if item.receive_status==2}}<button class="fs24 active noNum">已抢光</button>{{/if}}
                    </div>
                </div>
                {{/each}}
                
            </div>
        </div>
    </div>
</script>
<script>
    //请求列表数据
    function getList(page,isagain) {
        $('.bonusList').append('<div class="get_list_tip">加载数据中...</div>');
        $.ajax({
            url:'<?php echo _url("shop/api.bonus/getBonusListReceivable"); ?>',// 跳转到 action
            data:{goods_type:1,goods_id:0},
            type:'post',
            cache:false,
            dataType:'json',
            success:function(res) {
                if(res.code  == 0 ){
                    _alert(res.msg);
                    $('.get_list_tip').html('加载失败，点击重新加载.');
                    return false;
                }
                $('.get_list_tip').remove();
                if (res.list){
                    $('.bonusList').append(template('TabTpl',res));
                    $('.bonusList').append('<div class="loadEnd">—— 没有更多啦，我是有底线的 ——</div>');
                }else{
                    $(".goCoupons").hide();
                }
            },error : function() {
                $('.get_list_tip').html('加载失败，点击重新加载.');
            }
        });
    }
    getList();//执行加载
    $(function () {
        $(".goCouponsBtn").click(function (obj) {
            $('.getCoupons').show();
        })
        /*立即领券*/
        $(".bonusList").on('click','.receive_do',function () {
            var _this = $(this);
            var type_id = _this.parents('.block').data('type_id');
            var arr = new Object();
            arr.id=type_id;
            jq_ajax('<?php echo url("shop/api.bonus/receiveFree"); ?>',arr,function(res){
                if(res.code  == 0 ){
                    _alert(res.msg);
                }else if(res.code==2){
                    _alert('抱歉，优惠券已抢光！');
                    _this.text('已抢光');
                    _this.parents('.block').removeClass('userTicket');
                }else{
                    _this.removeClass('receive_do').addClass('use_do').text('去使用');
                }
            })
        });
        /*前往使用*/
        $(".bonusList").on('click','.use_do',function () {
            var _this = $(this);
            var type_id = _this.parents('.block').data('type_id');
            window.location.href='<?php echo url("shop/bonus/goodsList"); ?>'+'?type_id='+type_id;
        });
    })
</script>

<script>
    //购物车统一请求
    function evalCart(action,arr){
        jq_ajax('<?php echo url("shop/api.flow/'+action+'"); ?>',arr,function(res){
            if (res.code==0){
                if (res.msg != '') _alert(res.msg);
                return false;
            }
            $('.top').find('em').html(res.cartInfo.allGoodsNum);
            $('.totel_price_1').html(res.cartInfo.exp_total[0]);
            $('.totel_price_2').html('.'+res.cartInfo.exp_total[1]);
            $('#buyNum').html(res.cartInfo.buyGoodsNum);
            if (res.cartInfo.goodsList){
                $('#edit-btn').removeClass('hide');
                $('.emptyBox').hide();
                $('.goodslist ul').html(template('goodsLi',res.cartInfo));
                if (res.cartInfo.isAllSel == 1){
                    $('.checkall').prop("checked",true);
                }else{
                    $('.checkall').prop('checked',false);
                }
            }else{
                $('#edit-btn').addClass('hide');
                $('.goodslist ul').html('');
                $('.emptyBox').show();
                $('#checkall_a').attr('checked',false)
            }

            
            $('.loseGoods').find('.box').remove();
            if (res.cartInfo.invalidList){
                $('.loseGoods').show();
                $('.loseGoods').append(template('loseGoodsLi',res.cartInfo));
            }else{
                $('.loseGoods').hide();
            }
            container('.goodslist li');
            return true;
        })
    }
    //修改购物车订购数量
    function editNum(obj,rec_id,type) {
        var num = $(obj).parent().find('input').val();
        if (type == 'up'){
            num++;
        }else {
            num--;
        }
        if (num < 1) return false;
        return evalCart('editNum','rec_id='+rec_id+'&num='+num);
    }
    //删除购物车商品
    $(document).on('click','.delect',function () {
        var rec_id = $(this).data('rec_id');
        return evalCart('delGoods','rec_id='+rec_id);
    })
    //清空购物车失效商品
    $('.clearInvalid').on('click',function () {
        return evalCart('clearInvalid');
    })
    //选择商品
    $('.goodslist').on('click','.check',function () {
        var is_select = 0;
        if ($(this).is(':checked')){
            is_select = 1;
        }
        return evalCart('setSel','rec_id='+$(this).data('rec_id')+'&is_select='+is_select);
    })
    //全选或全不选商品
    $('.checkall').on('click',function () {
        var is_select = 0;
        if ($(this).is(':checked') == true){
            is_select = 1;
        }
        return evalCart('setSel','rec_id=all&is_select='+is_select);
    })
    //删除选择的商品
    $('.delSelGoods').on('click',function () {
        return evalCart('delSelGoods','');
    })
   

    $(function(){
        evalCart('getList');//加载购物车
        $('.top p').on('click',function(){
            if($(this).attr('data-type')==0){
                $(this).text('完成')
                $('.paying').hide();
                $('.edit').show();
                $(this).attr('data-type','1')
            }else{
                $(this).text('编辑')
                $('.edit').hide();
                $('.paying').show();
                $(this).attr('data-type','0')
            }
        })
        $(document).on('click','.like',function(){
            var imgObj = $(this).find('img');
            var status = imgObj.data('type');
            var goods_id = $(this).data('goods_id');
            jq_ajax('<?php echo url("shop/api.goods/collect"); ?>', 'goods_id='+goods_id, function (res) {
                if (res.code == 0) {
                    _alert(res.msg);
                    return false;
                }
                if (status == 0) {
                    imgObj.attr('src', '/static/mobile/default/images/goodsIcon03_lh.png')
                    imgObj.data('type', '1')
                } else {
                    imgObj.attr('src', '/static/mobile/default/images/goodsIcon03.png')
                    imgObj.data('type', '0')
                }
            });

        })
    })
    function closeModel(obj){
        $(obj).parents('.model').hide()
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