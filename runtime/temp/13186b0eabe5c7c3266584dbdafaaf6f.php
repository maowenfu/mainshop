<?php /*a:10:{s:41:"../template/default/shop\index\index.html";i:1613985992;s:37:"../template/default/layouts\base.html";i:1613985992;s:51:"../template/default/shop\bonus\bonus_tip_layer.html";i:1613985992;s:42:"../template/default/shop\index\favour.html";i:1613985992;s:46:"../template/default/shop\index\fightgroup.html";i:1613985992;s:44:"../template/default/shop\index\category.html";i:1613985992;s:45:"../template/default/shop\index\goods_tag.html";i:1613985992;s:39:"../template/default/layouts\bottom.html";i:1613985992;s:48:"../template/default/shop\index\ordermessage.html";i:1613985992;s:39:"../template/default/layouts\weixin.html";i:1613985992;}*/ ?>
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
    
<link rel="stylesheet" href="/static/mobile/default/js/Swiper-4.0.7/swiper.min.css" />
<link rel="stylesheet" href="/static/mobile/default/css/index.css" />


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
   <?php endif; if($tipsubscribe == '1'): ?>
<div class="topTips">
    <div class="flexBox">
        <div class="cell_bd"><img src="/static/mobile/default/images//APPLOGO.png" alt=""><span class="fs28 color_w">您当前还未关注微信公众号</span></div>
        <div class="cell_ft"><p class="fs28 fw_b color_r">立即关注</p><img src="/static/mobile/default/images/close_w.png" alt=""></div>
    </div>
</div>
<!-- 扫码关注 -->
<div class="model topTipSmodel">
    <div class="modelBG closeModel" ></div>
    <div class="medelCanten">
        <div class="codeBox">
            <img src="<?php echo htmlentities($setting['weixin_qrcode']); ?>" alt="">
            <span class="fs30 color_3 fw_b">长按二维码识别关注</span>
        </div>
        <img src="/static/mobile/default/images/close_wy.png" alt="" class="closeimg closeModel" >
    </div>
</div>
<?php endif; ?>

<!--优惠券提示-->
<link rel="stylesheet" href="/static/mobile/default/css/coupons.css"/>
<div class="model coupons_indexBox" style="display: none;">
    <div class="modelBG" onclick="closeModel()"></div>

    <div class="content">
        <img src="<?php echo htmlentities($reg_bonus_bg); ?>" alt="" class="contentBG">
        <div class="couponsList" id="bonusListBox">
        </div>
        <a href="javascript:see_do();" class="fs32 fw_b color_r">前往查看</a>
        <img src="/static/mobile/default/images/close_wy.png" alt="" class="closeimg" onclick="closeModel()">
    </div>
</div>
<script type="text/html" id="bonusListTpl">
    {{each data as item index}}
    <div class="block" data-bonus_id="{{item.bonus_id}}">
        <div class="left">
            <div class="fs28 fw_b color_3">{{item.type_name}}</div>
            <p class="fs22 color_9">有效期{{item._use_end_date}}</p>
        </div>
        <div class="right">
            <div class="fs30 money color_r">
                <p class="fw_b">￥</p><em class="fs48 num">{{item.type_money}}</em>
            </div>
            <span class="fs22 color_9">满{{item.min_amount}}元可用</span>
        </div>
    </div>
    {{/each}}
</script>
<script>
    // 隐藏优惠券弹窗
    function closeModel() {
        $('.model').hide();
        updateUntipBonus();
    }
    // 前往查看
    function see_do() {
        updateUntipBonus();
        window.location.href = "<?php echo url('shop/bonus/index'); ?>";
    }
    // 更改状态为已提示
    function updateUntipBonus() {
        var bonus_ids = [];
        $('#bonusListBox').find('.block').each(function () {
            var bonus_id = $(this).data('bonus_id');
            bonus_ids.push(bonus_id);
        });
        jq_ajax('<?php echo url("shop/api.bonus/updateUntipBonus"); ?>', {bonus_ids: bonus_ids}, function (res) {
        });
    }
    $(function () {
        jq_ajax('<?php echo url("shop/api.bonus/getUntipBonus"); ?>', '', function (res) {
            if (res.code == 1) {
                $('#bonusListBox').html(template('bonusListTpl', res));
                $('.model').show();
            }
        });
    })
</script>

<div class="page-bd">
        <div class="selectBox">
            <a href="<?php echo url('index/search'); ?>" class="selech">
                <img src="/static/mobile/default/images/index_01.png" alt=""/>
                <span class="fs30 color_9"><?php echo htmlentities($setting['shop_index_search_text']); ?></span>
            </a>
        </div>
        <div class="swiperGird" style="background-color: #fff;">
        <div class="swiper-container swiper1" id="swiper01">
            <div class="swiper-wrapper">
                <?php if(is_array($slideList) || $slideList instanceof \think\Collection || $slideList instanceof \think\Paginator): $i = 0; $__LIST__ = $slideList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$slide): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo htmlentities($slide['url']); ?>" class="swiper-slide" data-bg_color="<?php echo htmlentities($slide['bg_color']); ?>">
                    <img data-src="<?php echo htmlentities($slide['imgurl']); ?>" class="swiper-lazy">
                    <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                </a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="swiper-pagination pagination1"></div>
        </div>
        <!-- 功能入口 -->
        <?php if(!(empty($navMenuList) || (($navMenuList instanceof \think\Collection || $navMenuList instanceof \think\Paginator ) && $navMenuList->isEmpty()))): ?>
        <div class="girdBox">
            <div class="gird">
                <div class='scrllBox <?php if(count($navMenuList) < '5'): ?>fournav<?php endif; ?>'>
                    <?php if(is_array($navMenuList) || $navMenuList instanceof \think\Collection || $navMenuList instanceof \think\Paginator): $i = 0; $__LIST__ = $navMenuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
                    <a href="<?php echo htmlentities($nav['url']); ?>" class="box">
                        <div><img src="<?php echo htmlentities($nav['imgurl']); ?>" alt=""/></div>
                        <span class="fs26 color_3"><?php echo htmlentities($nav['title']); ?></span>
                    </a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- banner位 -->
    <div class="bannerBox">
        <?php if(!(empty($headline) || (($headline instanceof \think\Collection || $headline instanceof \think\Paginator ) && $headline->isEmpty()))): ?>
        <!--头条-->
        <div class="bannerSwiper">
            <img src="/static/mobile/default/images/index_icon09.png" alt="">
            <span class="fs32 fw_b color_3">新闻头条</span>
            <div class="swiper-container swiper2" id="swiper02">
                <div class="swiper-wrapper">
                    <?php if(is_array($headline) || $headline instanceof \think\Collection || $headline instanceof \think\Paginator): $i = 0; $__LIST__ = $headline;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hl): $mod = ($i % 2 );++$i;?>
                    <a href="<?php echo url('shop/article/headline'); ?>" class="swiper-slide"><?php echo htmlentities($hl['title']); ?></a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
        <?php endif; if(is_array($adList) || $adList instanceof \think\Collection || $adList instanceof \think\Paginator): if( count($adList)==0 ) : echo "" ;else: foreach($adList as $key=>$ad): ?>
        <div class="banner-<?php echo htmlentities($ad['ad_type']); ?> imgBox">
            <?php if(is_array($ad['data']) || $ad['data'] instanceof \think\Collection || $ad['data'] instanceof \think\Paginator): if( count($ad['data'])==0 ) : echo "" ;else: foreach($ad['data'] as $sub_ad_key=>$sub_ad): if($sub_ad_key < $ad['ad_type']): ?>
            <a href="<?php echo htmlentities((isset($sub_ad['url']) && ($sub_ad['url'] !== '')?$sub_ad['url']:'javascript:;')); ?>"><img src="<?php echo htmlentities($sub_ad['imgurl']); ?>" alt=""></a>
            <?php endif; ?>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

    <?php if(is_array($plateList) || $plateList instanceof \think\Collection || $plateList instanceof \think\Paginator): if( count($plateList)==0 ) : echo "" ;else: foreach($plateList as $key=>$vo): if($vo['key'] == 'favour'): ?>
        <!-- 限时优惠 -->
        <div class="sale favourBox" style="display: none;">
    <div class="title">
        <div class="left">
            <img src="/static/mobile/default/images/index_icon11.png" alt="">
            <p class="fs32 color_3 fw_b"></p>
        </div>
        <a href="<?php echo _url('/favour/Index/index'); ?>" class="right">
            <span class="fs24 color_9">查看更多</span>
            <img src="/static/mobile/default/images/rightIcon.png" alt="">
        </a>
    </div>
    <div class="salelist">
    </div>
</div>
<script id="favourTpl" type="text/html">
    {{each list as item index}}
    <a href="<?php echo _url('goods/info',['id'=>'[[item.goods_id]]']); ?>" class="box">
        <img src="{{item.cover}}" alt="">
        <span class="fs28 color_3">{{item.goods_name}}</span>
        <div class="color_r fs20 num">
            <p class="fw_b fm_p">￥</p><em class="fs30">{{item.exp_price[0]}}</em><i>.{{item.exp_price[1]}}</i>
        </div>
    </a>
    {{/each}}
    <a href="<?php echo _url('/favour/Index/index'); ?>" class="box moreBox">
        <p class="fs28 color_3">查看</br>更多</p>
        <img src="/static/mobile/default/images/index_icon12.png" alt="">
    </a>
</script>
<script>
    //请求限时优惠首页推荐数据
    function getFavourList(){
        $('.favourBox .salelist').append('<div class="get_list_tip">加载数据中...</div>');
        $.ajax({
            url:'<?php echo _url("favour/api.goods/getBestList"); ?>',// 跳转到 action
            data:{},
            type:'post',
            cache:false,
            dataType:'json',
            success:function(res) {
                if(res.code  == 0 ){
                    _alert(res.msg);
                    $('.get_list_tip').html('加载失败，点击重新加载.');
                    return false;
                }
                $('.favourBox .salelist').find('.get_list_tip').remove();
                if (res.data.list.length>0){
                    $(".favourBox").show();
                    $('.favourBox .salelist').html(template('favourTpl',res.data));
                }else{
                }
            },error : function() {
                $('.favourBox .salelist').html('加载失败，点击重新加载.');
            }
        });
    }
    $(function () {
        getFavourList();
    })
</script>
        <?php elseif($vo['key'] == 'fightgroup'): ?>
        <!-- 拼团 -->
        <div class="group groupBox">
    <div class="title">
        <div class="left">
            <img src="/static/mobile/default/images/index_icon10.png" alt="">
            <p class="fs32 color_3 fw_b"></p>
        </div>
        <a href="<?php echo _url('/fightgroup/Index/index'); ?>" class="right">
            <span class="fs24 color_9">查看更多</span><img src="/static/mobile/default/images/rightIcon.png" alt="">
        </a>
    </div>
    <div class="swiper-container swiper3 " id="swiper03">
        <div class="swiper-wrapper grouplist">
        </div>
        <div class="swiper-pagination pagination3"></div>
    </div>
</div>


<script id="groupTpl" type="text/html">
    {{each list as item index}}
    <div class="swiper-slide">
        {{each item as goods sub_index}}
        <a href="<?php echo _url('/fightgroup/Index/info',['fg_id'=>'[[goods.fg_id]]']); ?>" class="groupBlock">
            <img src="{{goods.goods_thumb}}" alt="">
            <div class="info">
                <div class="name">{{goods.goods_name}}</div>
                <div class="price">
                    <div class="color_3 fs24 num">
                        <p class="fw_b fm_p">￥</p><em class="fs42">{{goods.exp_price[0]}}</em><i>.{{goods.exp_price[1]}}</i></div>
                    <span class="fs24 color_9">￥{{goods.shop_price}}</span>
                </div>
                <div class="fs24 color_r">已拼{{goods.buy_goods_num}}件</div>
            </div>
        </a>
        {{/each}}
    </div>
    {{/each}}
</script>
<script>
    //请求限时优惠首页推荐数据
    function getGroupList() {
        $('.groupBox .grouplist').append('<div class="get_list_tip">加载数据中...</div>');
        $.ajax({
            url: '<?php echo _url("fightgroup/api.goods/getBestList"); ?>',// 跳转到 action
            data: {},
            type: 'post',
            cache: false,
            dataType: 'json',
            success: function (res) {
                if (res.code == 0) {
                    _alert(res.msg);
                    $('.get_list_tip').html('加载失败，点击重新加载.');
                    return false;
                }
                $('.groupBox .grouplist').find('.get_list_tip').remove();
                if (res.list.length > 0) {
                    $(".groupBox").show();
                    $('.groupBox .grouplist').html(template('groupTpl', res));
                    var swiper3 = createSwiper01();
                } else {
                    $(".groupBox").hide();
                }
            }, error: function () {
                $('.groupBox .grouplist').html('加载失败，点击重新加载.');
            }
        });
    }

    $(function () {
        getGroupList();
    })
</script>
        <?php elseif($vo['key'] == 'category'): ?>
        <!-- 分类 -->
        <!-- 分类 -->
<?php if(is_array($classGoods) || $classGoods instanceof \think\Collection || $classGoods instanceof \think\Paginator): $i = 0; $__LIST__ = $classGoods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cg): $mod = ($i % 2 );++$i;if(!(empty($cg['gooodsList']) || (($cg['gooodsList'] instanceof \think\Collection || $cg['gooodsList'] instanceof \think\Paginator ) && $cg['gooodsList']->isEmpty()))): ?>
<div class="trademark">
    <img src="/static/mobile/default/images/loading.svg" data-original="<?php echo htmlentities($cg['cover']); ?>" alt="" class="lazy trademarkBG">
    <div class="googslist">
        <?php if(is_array($cg['gooodsList']) || $cg['gooodsList'] instanceof \think\Collection || $cg['gooodsList'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cg['gooodsList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?>
        <a href="<?php echo url('goods/info',['id'=>$goods['goods_id']]); ?>">
            <img  src="/static/mobile/default/images/loading.svg" data-original="<?php echo htmlentities($goods['goods_thumb']); ?>" class="lazy" alt="">
            <span class="fs26 color_3"><?php echo htmlentities($goods['goods_name']); ?></span>
            <div class="color_r fs20 num"><p class="fw_b fm_p">￥</p><em class="fs30"><?php echo htmlentities($goods['exp_price'][0]); ?></em><p>.<?php echo htmlentities($goods['exp_price'][1]); ?></p></div>
        </a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <a href="<?php echo url('goods/index',['cid'=>$cg['id']]); ?>"  class="moreBox">
            <p class="fs28 color_3">查看</br>更多</p>
            <img src="/static/mobile/default/images/index_icon12.png" alt="">
        </a>
    </div>
</div>

<?php endif; ?>
<?php endforeach; endif; else: echo "" ;endif; elseif($vo['key'] == 'goods_tag'): ?>
        <!-- 商品标签 -->
        <!-- 商品标签 -->
<!-- 两列显示方式 -->
<!--
<div class="list" style="display:none">
    <a href="商品.html">
        <img src="../assets/images/youLike01.png" alt="">
        <span class="fs30 color_3">连帽系腰带鹅绒羽绒服</span>
        <div class="color_r fs22 num">
            <p class="fw_b fm_p">￥</p><em class="fs36">199</em><i>.00</i>
        </div>
    </a>
    <a href="商品.html">
        <img src="../assets/images/index_goods1.png" alt="">
        <span class="fs30 color_3">连帽系腰带鹅绒羽绒服</span>
        <div class="color_r fs22 num">
            <p class="fw_b fm_p">￥</p><em class="fs36">199</em><i>.00</i>
        </div>
    </a>
</div>-->
<?php if(!(empty($tagList) || (($tagList instanceof \think\Collection || $tagList instanceof \think\Paginator ) && $tagList->isEmpty()))): ?>
<div class="youLike">
    <div class="navBox">
        <div class="divActive" data-tag_id="0">
            <span>精选</span>
            <p>猜你喜欢</p>
        </div>
        <?php if(is_array($tagList) || $tagList instanceof \think\Collection || $tagList instanceof \think\Paginator): $i = 0; $__LIST__ = $tagList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?>
        <div data-tag_id="<?php echo htmlentities($tag['id']); ?>">
            <span><?php echo htmlentities($tag['title']); ?></span>
            <p><?php echo htmlentities($tag['subtitle']); ?></p>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <!-- 一列 -->
    <div class="list listBox" id="tagBox-0">

    </div>
    <?php if(is_array($tagList) || $tagList instanceof \think\Collection || $tagList instanceof \think\Paginator): $i = 0; $__LIST__ = $tagList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?>
    <div class="list listBox" id="tagBox-<?php echo htmlentities($tag['id']); ?>" ></div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div>

<script id="TagTpl" type="text/html">
    {{each list as goods index}}
    <a href='<?php echo _url("goods/info",["id"=>"[[goods.goods_id]]"]); ?>'>
        <img   src="{{goods.goods_thumb}}"  class="lazy" >
        <span class="fs30 color_3">{{goods.goods_name}}</span>
        <div class="boxBottom">
            <div class="color_r fs22 num">
                <p class="fw_b fm_p">￥</p><em class="fs36">{{goods.exp_price[0]}}</em><i>.{{goods.exp_price[1]}}</i>
            </div>
            <p class="fs24 color_r fw_b btn">立即购买</p>
        </div>
    </a>
    {{/each}}
</script>
<!-- 没有相关订单-->
<script type="text/html" id="emptyTagTpl">
    <div class="empeyOrder">
        <img src="/static/mobile/default/images/emptyData.png" alt="">
        <span class="fs28 color_3">暂无相关商品</span>
    </div>
</script>
<script>
    var nowPage = [],getAgain = [],isLoadend = [];
    var _type = 0;
    $(function(){
        $('.page-bd').scroll(function(){
            var box_h=$(this).height()
            var content_h=$('.scrollBox').height()
            var scroll_h=$(this).scrollTop();
            if(content_h-box_h-scroll_h<20){
                getList();
            }
        })

        //请求列表数据
        function getList(isagain) {
            page = nowPage[_type];
            var objBox = $('#tagBox-'+_type);
            if (typeof(page) == 'undefined') page = 1;
            if (isLoadend[_type] == true ) return false;
            if (isagain == true){
                if (getAgain[_type] == false) return false;
                getAgain[_type] = false;
            }else{
                $(objBox).append('<div class="get_list_tip" data-type="'+_type+'">加载数据中...</div>');
            }
            isLoadend[_type] = true;
            $.ajax({
                url:'<?php echo _url("shop/api.goods/getTagGoodsList",["tag_id"=>"【_type】","p"=>"【page】"]); ?>',// 跳转到 action
                data:{},
                type:'post',
                cache:false,
                dataType:'json',
                success:function(res) {
                    isLoadend[_type] = false;
                    if(res.code  == 0 ){
                        _alert(res.msg);
                        getAgain[_type] = true;
                        $(objBox).find('.get_list_tip').html('加载失败，点击重新加载.');
                        return false;
                    }
                    nowPage[_type] = page+1;
                    $(objBox).find('.get_list_tip').remove();
                    if (res.list){
                        $(objBox).append(template('TagTpl',res));
                    }else{
                        $(objBox).html(template('emptyTagTpl'));
                    }
                    if (res.page_count == page) {
                        $(objBox).append('<div class="get_list_tip">—— 我也有底线的 ——</div>');
                        isLoadend[_type] = true;
                    }
                },error : function() {
                    isLoadend[_type] = false;
                    getAgain[_type] = true;
                    $(objBox).find('.get_list_tip').html('加载失败，点击重新加载.');
                }
            });
        }
        getList();//执行加载
        //重新请求数据
        $(document).on('click','.get_list_tip',function () {
            _type = $(this).data('tag_id');
            getList(true);
        })

        $('.youLike .navBox div').on('click', function () {
            var index=$(this).index();
            _type = $(this).data('tag_id');
            if ($('#tagBox-'+_type).html() == ''){
                isLoadend[_type] = false;
                getAgain[_type] = false;
                getList();//执行加载
            }
            $(this).siblings().removeClass('divActive')
            $(this).addClass('divActive')
            $('.listBox').hide()
            $('.listBox').eq(index).show()
        })

        $('.tab div').each(function () {
            if ($(this).data('type') == _type){
                $(this).trigger('click');
                isLoadend[_type] = false;
                getAgain[_type] = false;
            }
        })
    })
</script>
<?php endif; ?>


        <?php endif; ?>
    <?php endforeach; endif; else: echo "" ;endif; ?>

        <!-- 猜你喜欢 -->
        <div class="youLike hide">
            <div class="title">
                <div class="left fs36 color_3 fw_b">猜你喜欢</div>
                <a href="<?php echo url('goods/index',['is_best'=>1]); ?>" class="right"><span class="fs26 color_9">更多</span><img src="/static/mobile/default/images/rightIcon.png" alt=""></a>
            </div>
            <div class="list">
                <div class="box">
                	<?php if(is_array($bestGoods) || $bestGoods instanceof \think\Collection || $bestGoods instanceof \think\Paginator): $i = 0; $__LIST__ = $bestGoods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?>
                    <a href="<?php echo url('goods/info',['id'=>$goods['goods_id']]); ?>">
                        <img  src="/static/mobile/default/images/loading.svg" data-original="<?php echo htmlentities($goods['goods_thumb']); ?>" class="lazy" alt="">
                        <span class="fs30 color_3"><?php echo htmlentities($goods['goods_name']); ?></span>
                        <div class="color_r fs24 num"><p class="fw_b fm_p">￥</p><em class="fs36"><?php echo htmlentities($goods['exp_price'][0]); ?></em><p>.<?php echo htmlentities($goods['exp_price'][1]); ?></p></div>
                    </a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
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

<script src="/static/mobile/default/js/Swiper-4.0.7/swiper.min.js"></script>
<script>
      $(function() {
          var swiper1 = createSwiper(1, 'horizontal', 4000, 'fraction');
          var swiper2 = createSwiper(2, 'vertical', 5000, 'bullets');
          var swiper3 = createSwiper01();
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
      function createSwiper(index, _direction, time, type) {
          var swiper = new Swiper(".swiper" + index, {
              pagination: {
                  el: ".pagination" + index,
                  type: type
              },
              lazy: {
                  loadPrevNext: true,
              },
              direction: _direction,
              preloadImages: false,
              paginationClickable: true,
              loop: true,
              autoplay: {
                  delay: time,
                  disableOnInteraction: false
              },
              onSlideChangeEnd: function (swiper) {
                  swiper.update(); //swiper更新
              },
              on: {
                  slideChangeTransitionStart: function(){
                      if(index==1){
                          var bg_color = $('#swiper01').find('a').eq(this.activeIndex).data('bg_color');
                          $('.swiperGird').css('background-color',bg_color);
                      }
                  },
              },
          });
          return swiper;
      }
      function createSwiper01() {
          var length = $('.groupBox .grouplist .swiper-slide').length;
          var is_true = length>1?true:false;
          var el =is_true==true?".pagination3":"null";
          var swiper = new Swiper(".swiper3", {
              pagination: {
                  el: el,
                  clickable: true
              },
              loop: is_true,
              onSlideChangeEnd: function (swiper) {
                  swiper.update(); //swiper更新
              }
          });
          return swiper;
      }

</script>
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