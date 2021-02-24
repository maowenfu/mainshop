<?php /*a:1:{s:62:"F:\WWW\M\application\member\view\sys_admin\users\add_user.html";i:1613985989;}*/ ?>
<form class="form-horizontal form-validate form-modal" method="post" action="<?php echo url('addUser'); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">新增会员</h4>
            </div>
            <div class="modal-body">
            			
                		<div class="form-group">
                            <label class="col-sm-2 control-label"> 会员用户名</label>
                            <div class="col-sm-6">
                                <input type="text" class="input-large" data-rule-maxlength="20" data-rule-required="true" name="nick_name" value="" ><span class="maroon">*</span>
                            </div>
                        </div> 
                         <div class="form-group">
                            <label class="col-sm-2 control-label"> 注册手机</label>
                            <div class="col-sm-6 ">
                                <input aria-required="true" class="input-large" data-rule-required="true" name="mobile" value="" data-rule-maxlength="11" type="text"><span class="maroon">*</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> 用户密码</label>
                            <div class="col-sm-6 ">
                                <input aria-required="true" class="input-large" data-rule-required="true" name="password" value="" type="password"><span class="maroon">*</span>
                            </div>
                        </div> 
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> 确认密码</label>
                            <div class="col-sm-10 ">
                                <input aria-required="true" class="input-large" data-rule-required="true" name="password_again" value="" type="password"><span class="maroon">*</span>
                            </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-loading-text="保存中..." disabled>保存</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</form>