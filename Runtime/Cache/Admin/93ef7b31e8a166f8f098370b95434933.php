<?php if (!defined('THINK_PATH')) exit();?><form action="<?php echo U('Admin/News/insert');?>" class="form_dogocms" method="post" enctype="multipart/form-data">
    <div class="division">
        <table>
            <tbody>
                <tr>
                    <th>文档标题：</th>
                    <td><input type="text" name="title" value="<?php echo ($data["title"]); ?>"/></td>
                </tr>
                <tr>
                    <th>文档副标题：</th>
                    <td><input type="text" name="subtitle" value="<?php echo ($data["subtitle"]); ?>" /></td>
                </tr>
                <tr>
                    <th>文档属性：</th>
                    <td>
            <?php $arr = explode(',',$data['flag']); foreach($flag as $k=>$v){ if(in_array($k,$arr)){ echo '<input name="flag[]" type="checkbox" value="'.$k.'" checked="checked"/>'.$v; }else{ echo '<input name="flag[]" type="checkbox" value="'.$k.'"/>'.$v; } } ?>
            </td>
            </tr>
            <tr>
                <th>文档分类：</th>
                <td><input name="sort_id" class="easyui-combotree combotree" data-options="url:'<?php echo U('Admin/NewsSort/jsonTree');?>',required:true,"  value="<?php echo ($id); ?>"  style="width:200px;" /><span class="red">*请先选择文档分类</span></td>
            </tr>
            <tr>
                <th>文档标题图：</th>
                <td>
                    <input type="text" id="url1" name="titlepic" value="<?php echo ($data["titlepic"]); ?>" />
                    <input type="button" id="image1" value="选择图片" />
                </td>
            </tr>
            <tr>
                <th>关键词：</th>
                <td><input type="text" name="keywords" value="<?php echo ($data["keywords"]); ?>" /></td>
            </tr>
            <tr>
                <th>描述简介：</th>
                <td><textarea name="description" rows="3" cols="30"><?php echo ($data["description"]); ?></textarea></td>
            </tr>
            <tr>
                <th>审核状态：</th>
                <td><input type="radio" checked="checked" name="status[]" value="12"> 审核 <input type="radio" name="status[]" value="10"> 未审核 <input type="radio" name="status[]" value="11"> 未通过审核 </td>
            </tr>
            <tr>
                <th>文档内容：</th>
                <td><textarea id="content" name="content" style="width:720px;height:400px;visibility:hidden;"><?php echo (stripslashes($data["content"])); ?></textarea></td>
            </tr>
            </tbody>
        </table></div>

</form>
<script>
    $(function() {
        KindEditor.create('#content', {
            themeType: 'simple',
            allowFileManager: true,
            uploadJson: '<?php echo U("Admin/Upload/uploadImg");?>',
            fileManagerJson: '<?php echo U("Admin/Upload/fileManagerJson");?>',
            afterBlur: function() {
                this.sync();
            }
        });
        var editor = KindEditor.editor({
            allowFileManager: true,
            uploadJson: '<?php echo U("Admin/Upload/uploadImg");?>',
            fileManagerJson: '<?php echo U("Admin/Upload/fileManagerJson");?>'
        });
        KindEditor('#image1').click(function() {
            editor.loadPlugin('image', function() {
                editor.plugin.imageDialog({
                    imageUrl: KindEditor('#url1').val(),
                    clickFn: function(url, title, width, height, border, align) {
                        KindEditor('#url1').val(url);
                        editor.hideDialog();
                    }
                });
            });
        });

    });
</script>