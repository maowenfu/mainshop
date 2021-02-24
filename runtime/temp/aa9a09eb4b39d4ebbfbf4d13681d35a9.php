<?php /*a:1:{s:52:"../template/default/shop\..\..\customize\notice.html";i:1613985992;}*/ ?>
<?php if(!(empty($noticeList) || (($noticeList instanceof \think\Collection || $noticeList instanceof \think\Paginator ) && $noticeList->isEmpty()))): ?>
<div class="fui-notice" style="background: <?php echo htmlentities($diyInfo['style']['background']); ?>; border-color: <?php echo htmlentities($diyInfo['style']['bordercolor']); ?>;" data-speed="<?php echo htmlentities($diyInfo['params']['speed']); ?>">
    <div class="image"><img src="<?php echo htmlentities($diyInfo['params']['iconurl']); ?>" onerror="this.src='/static/customize/images/default/hotdot.png'"></div>
    <div class="icon"><i class="icon icon-notification1" style="font-size: 0.7rem; color: <?php echo htmlentities($diyInfo['style']['iconcolor']); ?>;"></i></div>
    <div class="text" style="color: <?php echo htmlentities($diyInfo['style']['color']); ?>;">
        <ul>
            <?php if($diyInfo['params']['noticedata'] == 1): if(is_array($noticeList) || $noticeList instanceof \think\Collection || $noticeList instanceof \think\Paginator): $i = 0; $__LIST__ = $noticeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo htmlentities((isset($vo['linkurl']) && ($vo['linkurl'] !== '')?$vo['linkurl']:'javascript:;')); ?>" style="color: <?php echo htmlentities($diyInfo['style']['color']); ?>;" data-nocache="true"><?php echo htmlentities($vo['title']); ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; else: if(is_array($noticeList) || $noticeList instanceof \think\Collection || $noticeList instanceof \think\Paginator): $i = 0; $__LIST__ = $noticeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo url('shop/article/info',['id'=>$vo['id']]); ?>" style="color: <?php echo htmlentities($diyInfo['style']['color']); ?>;" data-nocache="true"><?php echo htmlentities($vo['title']); ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
<?php endif; ?>
