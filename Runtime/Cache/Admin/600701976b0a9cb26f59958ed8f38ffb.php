<?php if (!defined('THINK_PATH')) exit();?><form action="<?php echo U('Admin/Account/updatepwd');?>" class="form_dogocms" method="post" enctype="multipart/form-data">

    <div class="division">
        <table>
            <tbody>
                <tr>
                    <th>原密码：</th>
                    <td><input type="password" name="oldpwd" data-options="required:true" class="easyui-validatebox"/><span class="red">*</span></td>
                </tr>
                <tr>
                    <th>新密码：</th>
                    <td><input type="password" name="newpwd" data-options="required:true" class="easyui-validatebox"/><span class="red">*</span></td>
                </tr>
                <tr>
                    <th>再次输入新密码：</th>
                    <td><input type="password" name="newpwd2" data-options="required:true" class="easyui-validatebox"/><span class="red">*</span></td>
                </tr>
            </tbody>
        </table></div>
</form>