<?php /*a:1:{s:55:"../template/default/shop\..\..\customize\icongroup.html";i:1613985992;}*/ ?>
<div class="fui-icon-group noborder col-<?php echo htmlentities($diyInfo['params']['rownum']); ?> selecter" style="background-color: <?php echo htmlentities($diyInfo['style']['background']); ?>;
        border-top: <?php echo htmlentities($diyInfo['params']['bordertop']); ?>px solid <?php echo htmlentities($diyInfo['style']['bordercolor']); ?>;
        border-bottom: <?php echo htmlentities($diyInfo['params']['borderbottom']); ?>px solid <?php echo htmlentities($diyInfo['style']['bordercolor']); ?>;
        <?php if($diyInfo['params']['border'] == '1'): ?>
            border-left: 1px solid <?php echo htmlentities($diyInfo['style']['bordercolor']); ?>;
            border-right: 1px solid <?php echo htmlentities($diyInfo['style']['bordercolor']); ?>;
        <?php endif; ?>
">
    <?php if(is_array($diyInfo['data']) || $diyInfo['data'] instanceof \think\Collection || $diyInfo['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $diyInfo['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <a class="fui-icon-col" style="border-left: none;" href="<?php echo htmlentities((isset($vo['linkurl']) && ($vo['linkurl'] !== '')?$vo['linkurl']:'javascript:;')); ?>" data-nocache="true">
            <?php if($vo['dotnum'] > '0'): ?>
                <div class="badge" style="background-color: <?php echo htmlentities($diyInfo['style']['dotcolor']); ?>;"><?php echo htmlentities($vo['dotnum']); ?></div>
            <?php endif; ?>
            <div class="icon icon-green radius"><i class="icon <?php echo htmlentities($vo['iconclass']); ?>" style="color: <?php echo htmlentities($diyInfo['style']['iconcolor']); ?>;"></i></div>
            <div class="text" style="color: <?php echo htmlentities($diyInfo['style']['textcolor']); ?>;"><?php echo htmlentities($vo['text']); ?></div>
        </a>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div>