<?php /*a:1:{s:60:"F:\WWW\M\application\publics\view\sys_admin\links\index.html";i:1613985989;}*/ ?>
<div class="modal-dialog" id="selectUrl" style="width: 930px;">

    <div class="modal-content">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">选择链接</h4>
        </div>
        <div class="modal-body">
            <ul class="nav nav-tabs" id="selectUrlTab">
                <?php if($linkstype == 'all'): ?>
                <li class="active"><a href="#sut_shop" data-toggle="tab">商城</a></li>
                <?php endif; if($linkstype == 'all' || $linkstype == 'article'): ?>
                <li class="<?php echo $linkstype=='article' ? 'active' : ''; ?>"><a href="#sut_article" data-toggle="tab">文章</a></li>
                <?php endif; if($linkstype == 'all' || $linkstype == 'goods'): ?>
                <li class=""><a href="#sut_good" data-toggle="tab">商品</a></li>
                <?php endif; if($linkstype == 'all'): ?>
                    <li class=""><a href="#sut_cate" data-toggle="tab">商品分类</a></li>

                    <li class="hide"><a href="#sut_coupon" data-toggle="tab">超级券</a></li>
                    <li><a href="#sut_diypage" data-toggle="tab">装修</a></li>
                    <?php if(!(empty($is_activity) || (($is_activity instanceof \think\Collection || $is_activity instanceof \think\Paginator ) && $is_activity->isEmpty()))): ?>
                    <li><a href="#sut_activity" data-toggle="tab">活动</a></li>
                    <?php endif; ?>
                <?php endif; ?>

            </ul>
            <div class="tab-content ">

                <div class="tab-pane <?php echo $linkstype=='all' ? 'active' : ''; ?>" id="sut_shop">
                    <div class="page-head"><h4><i class="fa fa-folder-open-o"></i> 商城页面</h4></div>
                    <?php if(is_array($links) || $links instanceof \think\Collection || $links instanceof \think\Paginator): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <nav  data-id="0"  data-href="<?php echo htmlentities($vo['url']); ?>" class="btn btn-default btn-sm" title="<?php echo htmlentities($vo['name']); ?>"><?php echo htmlentities($vo['name']); ?></nav>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>

                <div class="tab-pane <?php echo $linkstype=='goods' ? 'active' : ''; ?>" id="sut_good">
                    <div class="input-group">
                        <input type="text" placeholder="请输入商品名称进行搜索" id="select-good-kw" value="" class="form-control">
                        <span class="input-group-addon btn btn-default select-btn" data-type="good">搜索</span>
                    </div>
                    <div id="select-good-list"></div>
                </div>

                <div class="tab-pane" id="sut_cate">
                    <?php if(is_array($CategoryList) || $CategoryList instanceof \think\Collection || $CategoryList instanceof \think\Paginator): $i = 0; $__LIST__ = $CategoryList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="line">
                        <div class="icon icon-<?php echo htmlentities($vo['level']); ?>"></div>
                        <nav title="选择" class="btn btn-default btn-sm" data-id="0" data-href="/shop/goods/index/cid/<?php echo htmlentities($vo['id']); ?>">
                            选择
                        </nav>
                        <div class="text"><?php echo htmlentities($vo['name']); ?></div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>

                <div class="tab-pane <?php echo $linkstype=='article' ? 'active' : ''; ?>" id="sut_article">
                    <div class="input-group">
                        <input type="text" placeholder="请输入文章名称进行搜索" id="select-article-kw" value=""
                               class="form-control">
                        <span class="input-group-addon btn btn-default select-btn" data-type="article">搜索</span>
                    </div>
                    <div id="select-article-list"></div>
                </div>

                <div class="tab-pane" id="sut_coupon">
                    <div class="input-group">
                        <input type="text" placeholder="请输入优惠券名称进行搜索" id="select-coupon-kw" value=""
                               class="form-control">
                        <span class="input-group-addon btn btn-default select-btn" data-type="coupon">搜索</span>
                    </div>
                    <div id="select-coupon-list"></div>
                </div>
                <div class="tab-pane" id="sut_diypage">
                    <div class="input-group">
                        <input type="text" placeholder="请输入装修名称进行搜索" id="select-diypage-kw" value=""
                               class="form-control">
                        <span class="input-group-addon btn btn-default select-btn" data-type="diypage">搜索</span>
                    </div>
                    <div id="select-diypage-list"></div>
                </div>
                <div class="tab-pane" id="sut_activity">
                    <?php if(empty($ActivityList) || (($ActivityList instanceof \think\Collection || $ActivityList instanceof \think\Paginator ) && $ActivityList->isEmpty())): ?>
                    <div class="tip">暂无相关活动信息。</div>
                    <?php else: if(is_array($ActivityList) || $ActivityList instanceof \think\Collection || $ActivityList instanceof \think\Paginator): $i = 0; $__LIST__ = $ActivityList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="line good">
                        <div class="image"><img src="<?php echo htmlentities($vo['activity_img']); ?>"/></div>
                        <nav title="选择" class="btn btn-default btn-sm" data-id="0" data-href="/activity/index/index/id/<?php echo htmlentities($vo['id']); ?>">
                            选择
                        </nav>
                        <div class="text">
                            <p class="name"><?php echo htmlentities($vo['activity_title']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>
        </div>

    </div>

</div>
<script type="text/javascript">
    $(function(){
        $(document).off("click",".select-btn");
        $(document).on("click",".select-btn",function(){
            var type = $(this).data("type");
            var kw = $.trim($("#select-"+type+"-kw").val());
            if(!kw){
                _alert("请输入搜索关键字！",true);
                return;
            }
            $("#select-"+type+"-list").html('<div class="tip">正在进行搜索...</div>');
            $.ajax("<?php echo url('search'); ?>", {
                type: "get",
                dataType: "html",
                cache: false,
                data: {kw:kw, type:type}
            }).done(function (html) {
                $("#select-"+type+"-list").html(html);
            });
        });
    });
    $(document).off('click','nav');
    $(document).on('click','nav',function(){
        var url = $(this).data('href');
        var id = $(this).data('id');
        var title = $(this).data('title');
        <?php if($linksfun == 'assigBack'): ?>
            assigBack('<?php echo htmlentities($searchType); ?>','<?php echo htmlentities($_menu_index); ?>',id,title,url);
        <?php else: ?>
        window.parent.McMore.selectUrlCallback(url,'<?php echo htmlentities($searchType); ?>','<?php echo htmlentities($_menu_index); ?>');
        <?php endif; ?>
    })
</script>
