<?php /*a:1:{s:51:"../template/default/shop\..\..\customize\goods.html";i:1613985992;}*/ ?>
<?php if($diyInfo['params']['goodsscroll'] == 0): ?>
<div class="fui-goods-group <?php echo htmlentities($diyInfo['style']['liststyle']); ?>" style="background: <?php echo htmlentities($diyInfo['style']['background']); ?>;">
    <?php if(is_array($diyInfo['data']) || $diyInfo['data'] instanceof \think\Collection || $diyInfo['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $diyInfo['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <a class="fui-goods-item" data-goodsid="<?php echo htmlentities($vo['gid']); ?>" href="<?php echo htmlentities((isset($vo['linkurl']) && ($vo['linkurl'] !== '')?$vo['linkurl']:'javascript:;')); ?>" data-nocache="true" style="position: relative;">
        <?php if($diyInfo['params']['showicon'] == 0): ?>
            <div class="image auto" style="background:none; min-height: 50px;">
                <img class="exclude" src="<?php echo htmlentities($vo['thumb']); ?>" />
            </div>
        <?php endif; if($diyInfo['params']['showicon'] == 1): ?>
        <div class="image auto  <?php echo htmlentities($diyInfo['style']['iconstyle']); ?>" data-text="<?php echo htmlentities($goodsicon[$diyInfo['style']['goodsicon']]); ?>" style="background:none; min-height: 50px;">
            <img class="exclude" src="<?php echo htmlentities($vo['thumb']); ?>" />
        </div>
        <?php endif; if($diyInfo['params']['showicon'] == 2): ?>
        <div class="image auto  " data-text="<?php echo htmlentities($goodsicon[$diyInfo['style']['goodsicon']]); ?>" style="background:none; min-height: 50px;">
            <div class="goodsicon <?php echo htmlentities($diyInfo['params']['iconposition']); ?>" style="top: <?php echo htmlentities($diyInfo['style']['iconpaddingtop']); ?>px; right: <?php echo htmlentities($diyInfo['style']['iconpaddingleft']); ?>px; text-align: <?php echo htmlentities($diyInfo['params']['iconposition_text']); ?>;">
                <img src="<?php echo htmlentities($diyInfo['params']['goodsiconsrc']); ?>" style="width: <?php echo htmlentities($diyInfo['style']['iconzoom']); ?>%;">
            </div>
            <img class="exclude" src="<?php echo htmlentities($vo['thumb']); ?>" />
        </div>
        <?php endif; ?>

        <div class="detail">
            <div class="name" style="color: <?php echo htmlentities($diyInfo['style']['titlecolor']); ?>;"><?php echo htmlentities($vo['title']); ?></div>
            <?php if($diyInfo['params']['showproductprice'] == 1 || $diyInfo['params']['showsales'] == 1): ?>
                <p class="productprice ">
                    <?php if($diyInfo['params']['showproductprice'] == 1 && $vo['productprice'] > 0): ?>
                        <span style="color: <?php echo htmlentities($diyInfo['style']['productpricecolor']); ?>;"><?php echo htmlentities($diyInfo['params']['productpricetext']); ?><span style="<?php echo $diyInfo[params][productpriceline]==1 ? 'text-decoration :  line-through;':''; ?>">&yen;<?php echo htmlentities($vo['productprice']); ?></span></span>
                    <?php endif; if($diyInfo['params']['showsales'] == 1): ?>
                        <span style="color: <?php echo htmlentities($diyInfo['style']['salescolor']); ?>;"><?php echo htmlentities($diyInfo['params']['salestext']); ?>: <?php echo htmlentities($vo['sales']); ?></span>
                    <?php endif; ?>
                </p>
            <?php else: ?>
                <p class="productprice noheight"></p>
            <?php endif; ?>
            <div class="price"><span class="text" style="color: <?php echo htmlentities($diyInfo['style']['pricecolor']); ?>;"><p class="minprice">&yen;<?php echo htmlentities($vo['price']); ?></p></span>
                <span class="buy <?php echo htmlentities($diyInfo['style']['buystyle']); ?>" style="border-color: <?php echo htmlentities($diyInfo['style']['buybtncolor']); ?>;
                      <?php if($diyInfo['style']['buystyle'] == 'buybtn-6'): ?>
                        background-color:<?php echo htmlentities($diyInfo['style']['buybtncolor']); ?>;
                      <?php endif; ?>
                ">
                     <?php if($diyInfo['style']['buystyle'] == 'buybtn-3'): ?>
                        <i class="icon icon-cartfill" style="color: <?php echo htmlentities($diyInfo['style']['buybtncolor']); ?>;"></i>
                     <?php elseif($diyInfo['style']['buystyle'] == 'buybtn-4'): ?>
                        <i class="icon icon-cart" style="color: <?php echo htmlentities($diyInfo['style']['buybtncolor']); ?>;"></i>
                     <?php elseif($diyInfo['style']['buystyle'] == 'buybtn-5'): ?>
                        <i class="icon icon-add" style="color: <?php echo htmlentities($diyInfo['style']['buybtncolor']); ?>;"></i>
                    <?php elseif($diyInfo['style']['buystyle'] == 'buybtn-6'): ?>
                        <i class="icon icon-add"></i>
                     <?php else: ?>
                        购买
                     <?php endif; ?>
                </span>
            </div>
        </div>
        <?php if($diyInfo['params']['saleout'] == 1 && $vo['total'] < 1): ?>
        <div class="salez" style="background-image: url('/static/customize/images/default/defico.jpg'); "></div>
        <?php endif; ?>
    </a>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<?php else: ?>
<div class="swiper swiper-<?php echo htmlentities($diyInfo['_key']); ?>" data-element=".swiper-<?php echo htmlentities($diyInfo['_key']); ?>" data-view="<?php echo htmlentities($diyInfo['style']['view']); ?>" data-free="true" data-btn="true">
    <div class="swiper-container fui-goods-group <?php echo htmlentities($diyInfo['style']['liststyle']); ?>" style="background: <?php echo htmlentities($diyInfo['style']['background']); ?>;">
        <div class="swiper-wrapper">
            <?php if(is_array($diyInfo['data']) || $diyInfo['data'] instanceof \think\Collection || $diyInfo['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $diyInfo['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <a class="swiper-slide fui-goods-item" data-goodsid="<?php echo htmlentities($vo['gid']); ?>" href="<?php echo htmlentities((isset($vo['linkurl']) && ($vo['linkurl'] !== '')?$vo['linkurl']:'javascript:;')); ?>" data-nocache="true" style="position: relative;">
                <div class="image auto  <?php echo htmlentities($diyInfo['style']['iconstyle']); ?>" data-text="<?php echo htmlentities($goodsicon[$diyInfo['style']['goodsicon']]); ?>" style="background:none; min-height: 50px;">
                    <img class="exclude" src="/static/customize/images/loading.png" data-lazy="<?php echo htmlentities($vo['thumb']); ?>" />
                </div>
                <div class="detail">
                    <div class="name" style="color: <?php echo htmlentities($diyInfo['style']['titlecolor']); ?>;"><?php echo htmlentities($vo['title']); ?></div>
                    <?php if($diyInfo['params']['showproductprice'] == 1 || $diyInfo['params']['showsales'] == 1): ?>
                    <p class="productprice ">
                        <?php if($diyInfo['params']['showproductprice'] == 1 && $vo['productprice'] > 0): ?>
                        <span style="color: <?php echo htmlentities($diyInfo['style']['productpricecolor']); ?>;"><?php echo htmlentities($diyInfo['params']['productpricetext']); ?><span style="<?php echo $diyInfo[params][productpriceline]==1 ? 'text-decoration :  line-through;':''; ?>">&yen;<?php echo htmlentities($vo['productprice']); ?></span></span>
                        <?php endif; if($diyInfo['params']['showsales'] == 1): ?>
                        <span style="color: <?php echo htmlentities($diyInfo['style']['salescolor']); ?>;"><?php echo htmlentities($diyInfo['params']['salestext']); ?>: <?php echo htmlentities($vo['sales']); ?></span>
                        <?php endif; ?>
                    </p>
                    <?php else: ?>
                    <p class="productprice noheight"></p>
                    <?php endif; ?>
                    <div class="price"><span class="text" style="color: <?php echo htmlentities($diyInfo['style']['pricecolor']); ?>;"><p class="minprice">&yen;<?php echo htmlentities($vo['price']); ?></p></span>
                        <span class="buy <?php echo htmlentities($diyInfo['style']['buystyle']); ?>" style="border-color: <?php echo htmlentities($diyInfo['style']['buybtncolor']); ?>;
                      <?php if($diyInfo['style']['buystyle'] == 'buybtn-6'): ?>
                        background-color:<?php echo htmlentities($diyInfo['style']['buybtncolor']); ?>;
                        <?php endif; ?>
                        ">
                        <?php if($diyInfo['style']['buystyle'] == 'buybtn-3'): ?>
                        <i class="icon icon-cartfill" style="color: <?php echo htmlentities($diyInfo['style']['buybtncolor']); ?>;"></i>
                        <?php elseif($diyInfo['style']['buystyle'] == 'buybtn-4'): ?>
                        <i class="icon icon-cart" style="color: <?php echo htmlentities($diyInfo['style']['buybtncolor']); ?>;"></i>
                        <?php elseif($diyInfo['style']['buystyle'] == 'buybtn-5'): ?>
                        <i class="icon icon-add" style="color: <?php echo htmlentities($diyInfo['style']['buybtncolor']); ?>;"></i>
                        <?php elseif($diyInfo['style']['buystyle'] == 'buybtn-6'): ?>
                        <i class="icon icon-add"></i>
                        <?php else: ?>
                        购买
                        <?php endif; ?>
                        </span>
                    </div>
                </div>
                <?php if($vo['total'] < 1): if($diyInfo['params']['saleout'] == 0): ?>
                        <div class="salez" style="background-image: url('/static/customize/images/default/defico.jpg'); "></div>
                    <?php elseif($diyInfo['params']['saleout'] == 1): ?>
                        <div class="salez diy" style="background-image: url('/static/customize/images/default/saleout-<?php echo htmlentities($diyInfo['style']['saleoutstyle']); ?>.png'); "></div>
                    <?php endif; ?>
                <?php endif; ?>
            </a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="swiper-button-next swiper-button-white"></div>
        <div class="swiper-button-prev swiper-button-white"></div>
    </div>
    <script>
        $(function () {
            var goodsGroup = $(".swiper-<?php echo htmlentities($diyInfo['_key']); ?> .fui-goods-group");
            var swiperBtnTop= goodsGroup.find('.image').outerHeight() * 0.5;
            var swiperBtn = goodsGroup.find('.swiper-button-white');
            var swiperBtnMarginTop = swiperBtnTop - (swiperBtn.height() * 0.5)+10;
            swiperBtn.css({'top':0, 'margin-top': swiperBtnMarginTop})
        })
    </script>
</div>
<?php endif; ?>