<?php /*a:1:{s:52:"../template/default/shop\..\..\customize\banner.html";i:1613985992;}*/ ?>
<div class='fui-swipe'>
    <div class='fui-swipe-wrapper'>
        <?php if(is_array($diyInfo['data']) || $diyInfo['data'] instanceof \think\Collection || $diyInfo['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $diyInfo['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <a class='fui-swipe-item' href="<?php echo htmlentities((isset($vo['linkurl']) && ($vo['linkurl'] !== '')?$vo['linkurl']:'javascript:;')); ?>" data-nocache="true"><img src="<?php echo htmlentities($vo['imgurl']); ?>" style="display: block; width: 100%; height: auto;"/></a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <style>
        .fui-swipe-page .fui-swipe-bullet {background: <?php echo htmlentities($diyInfo['style']['background']); ?>; opacity: <?php echo htmlentities($diyInfo['style']['opacity']); ?>;}
        .fui-swipe-page .fui-swipe-bullet.active {opacity: 1;}
    </style>
    <div class="fui-swipe-page <?php echo htmlentities($diyInfo['style']['dotalign']); ?> <?php echo htmlentities($diyInfo['style']['dotstyle']); ?>" style="padding: 0 <?php echo htmlentities($diyInfo['style']['leftright']); ?>px; bottom: <?php echo htmlentities($diyInfo['style']['bottom']); ?>px; "></div>
</div>