<?php if (!defined('THINK_PATH')) exit();?><form action="<?php echo U('Admin/Members/update');?>" class="form_dogocms" method="post">
    <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
    <div class="division">
        <table>
            <tbody>
                <tr>
                    <th>用户名：</th>
                    <td><input type="text" name="username" value="<?php echo ($data["username"]); ?>" data-options="required:true" class="easyui-validatebox"/><span class="red">*用户名</span></td>
                </tr>
                <tr>
                    <th>邮箱：</th>
                    <td><input type="text" name="email" value="<?php echo ($data["email"]); ?>" data-options="required:true" class="easyui-validatebox"/><span class="red">*邮箱</span></td>
                </tr>
                <tr>
                    <th>性别：</th>
                    <td><input type="radio" name="sex[]" value="10">男<input type="radio" name="sex[]" value="11">女<input type="radio" checked="checked" name="sex[]" value="12">保密</td>
            </tr>

            <tr>
                <th>注册时间：</th>
                <td><?php echo (date("Y-m-d H:i:s",$data["addtime"])); ?></td>
            </tr>
            <tr>
                <th>注册ip：</th>
                <td><?php echo ($data["ip"]); ?></td>
            </tr>
            <tr>
                <th>密码：</th>
                <td><input type="text" name="password" value=""/><span class="red">*密码为空不修改无变化</span></td>
            </tr>
            <tr>
                <th>状态：</th>
                <td><input type="radio" checked="checked" name="status[]" value="20">启用<input type="radio" name="status[]" value="10">禁用</td>
            </tr>
            <tr>
                <th>备注：</th><td><textarea name="remark" rows="3" cols="30"><?php echo ($data["remark"]); ?></textarea><span class="red"></span></td>
            </tr>
            </tbody>
        </table>
    </div>
</form>