<?php /*a:1:{s:51:"F:\WWW\M\application\mainadmin\view\menus\info.html";i:1613985989;}*/ ?>
<form class="form-horizontal form-validate form-modal" method="post" action="<?php echo url('info'); ?>">
    <div class="modal-dialog" style="width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $row['id']>0 ? '编辑菜单' : '添加菜单'; ?></h4>
            </div>
            <div class="modal-body">
            			<div class="form-group">
                            <label class="control-label">所属菜单：</label>
                            <div class="col-sm-6">
                                <select class="input-xlarge" data-rule-required="true" name="pid" onchange="$('#group').val($(this).find('option:selected').data('group'))">
                                    <option value="0">===顶级菜单===</option>
                                    <?php if(is_array($menusList) || $menusList instanceof \think\Collection || $menusList instanceof \think\Paginator): $i = 0; $__LIST__ = $menusList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <option value="<?php echo htmlentities($vo['id']); ?>" data-group="<?php echo htmlentities($vo['group']); ?>" <?php echo $vo['id']==$row['pid'] ? 'selected' : ''; ?>><?php echo htmlentities($vo['name']); ?></option>
                                            <?php if(is_array($vo['list']) || $vo['list'] instanceof \think\Collection || $vo['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vob): $mod = ($i % 2 );++$i;?>
                                                <option value="<?php echo htmlentities($vob['id']); ?>" data-group="<?php echo htmlentities($vo['group']); ?>" <?php echo $vob['id']==$row['pid'] ? 'selected' : ''; ?>>|-&nbsp;<?php echo htmlentities($vob['name']); ?></option>
                                            <?php if(is_array($vob['submenu']) || $vob['submenu'] instanceof \think\Collection || $vob['submenu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vob['submenu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voc): $mod = ($i % 2 );++$i;?>
                                                <option value="<?php echo htmlentities($voc['id']); ?>" data-group="<?php echo htmlentities($vo['group']); ?>" <?php echo $voc['id']==$row['pid'] ? 'selected' : ''; ?>>|--- <?php echo htmlentities($voc['name']); ?></option>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                		<div class="form-group">
                            <label class="control-label">菜单名称：</label>
                            <div class="col-sm-6">
                                <input type="text" class="input-xlarge" data-rule-maxlength="20" data-rule-required="true" name="name" value="<?php echo htmlentities($row['name']); ?>" >
                            </div>
                        </div>
                <div class="form-group">
                    <label class="control-label">所属组：</label>
                    <div class="col-sm-6 ">
                        <input type="text" class="input-xlarge" data-rule-maxlength="20" id="group" name="group" value="<?php echo htmlentities($row['group']); ?>" >
                    </div>
                </div>

                        <div class="form-group">
                            <label class="control-label">控制器：</label>
                            <div class="col-sm-6 ">
                                <input type="text" class="input-xlarge" data-rule-maxlength="30"  name="controller" value="<?php echo htmlentities($row['controller']); ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">功能：</label>
                            <div class="col-sm-6 ">
                                <input type="text" class="input-xlarge" data-rule-maxlength="20"  name="action" value="<?php echo htmlentities($row['action']); ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                          	<label class="control-label">状态：</label>
                            <div class="col-sm-6">
                              <label class="radio-inline">
                                  <input name="status" value="1" <?php echo $row['status']==1 ? 'checked' : ''; ?> class="js_undertake " type="radio" >
                                  正常
                              </label>
                              <label class="radio-inline">
                                  <input name="status" value="0" <?php echo $row['status']==0 ? 'checked' : ''; ?> class="js_undertake" type="radio" >隐藏
                              </label>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        <div class="form-group">
                            <label class="control-label">子菜单列：</label>
                            <div class="col-sm-6 ">
                                <input type="text" class="input-xlarge" data-rule-maxlength="150"  name="urls" value="<?php echo htmlentities($row['urls']); ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">图标：</label>
                            <div class="col-sm-6 ">
                                <input type="text" class="input-xlarge" data-rule-maxlength="20"  name="icon" value="<?php echo htmlentities($row['icon']); ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">排序：</label>
                            <div class="col-sm-6 ">
                                <input type="text" class="input-xlarge" data-rule-maxlength="10"  name="sort_order" value="<?php echo htmlentities($row['sort_order']); ?>" >
                            </div>
                        </div>

            </div>
            <div class="modal-footer">
                <input  type="hidden" name="id" value="<?php echo htmlentities(intval($row['id'])); ?>"/>
                <button type="submit" class="btn btn-primary" data-loading-text="保存中..." disabled>保存</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</form>