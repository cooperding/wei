<?php if (!defined('THINK_PATH')) exit();?><table  id="datagrid_newstab<?php echo ($id); ?>" class="datagrid">

</table>


<script>
    $(function() {
        var height = $('.indexcenter').height();
        var classId = 'newstab<?php echo ($id); ?>';
        var hrefadd = '<?php echo U("Admin/News/add",array("id"=>$id));?>';
        var hrefedit = '<?php echo U("Admin/News/edit");?>';
        var hrefcancel = '<?php echo U("Admin/News/delete");?>';
        var urljson = '<?php echo U("Admin/News/listJsonId",array("id"=>$id));?>';
        //openDatagrid(classId,urljson,hrefadd,hrefedit,hrefcancel);
        $('#datagrid_' + classId).datagrid({
            url: urljson,
            idField: 'id',
            pagination: true,
            rownumbers: true,
            fitColumns: true,
            checkbox: true,
            height: height - 110,
            columns: [[
                    {field: 'id', title: 'ID', width: 50, align: 'center'},
                    {field: 'title', title: '标题', width: 200},
                    {field: 'addtime', title: '添加时间', width: 200},
                    {field: 'text', title: '所属分类', width: 80},
                    {field: 'views', title: '浏览量', width: 50, align: 'center'},
                    {field: 'status', title: '状态', width: 50},
                    //{field:'parent_id',title:'parent_id',width:200},
                    {
                        field: 'action',
                        title: '操作',
                        width: 50,
                        formatter: function(value, row, index) {
                            return '<img class="btn_do" src="/Public/Easyui/themes/icons/pencil.png" onclick="ding_edit(\'' + hrefedit + '?id=' + row.id + '\',\'' + classId + '\')"  title="编辑"/>&nbsp;\n\
<img class="btn_do" src="/Public/Easyui/themes/icons/cancel.png" onclick="ding_cancel(\'' + row.id + '\',\'' + hrefcancel + '\',\'' + classId + '\')" title=" 删除"/>&nbsp;';
                        }
                    }
                ]],
            //singleSelect:true,
            frozenColumns: [[
                    {
                        field: 'ck',
                        checkbox: true
                    }
                ]],
            toolbar: [{
                    id: 'btnadd_' + classId,
                    text: '添加',
                    iconCls: 'icon-add',
                    handler: function() {
                        var title = '添加文档';
                        openDialog(classId, hrefadd, title);
                    }
                }, '-', {
                    id: 'btnedit_' + classId,
                    text: '编辑',
                    iconCls: 'icon-edit',
                    handler: function() {
                        var ids = [];
                        var rows = $('#datagrid_' + classId).datagrid('getSelections');
                        for (var i = 0; i < rows.length; i++) {
                            ids.push(rows[i].id);
                        }
                        if (ids == '') {
                            $.messager.alert('信息提示', '请选择要操作的项', 'error');
                            return false;
                        } else if (rows.length > 1) {
                            $.messager.alert('信息提示', '请选择一个要操作的项', 'error');
                            return false;
                        }
                        var href = hrefedit + '?id=' + ids;
                        var title = '编辑信息';
                        openDialog(classId, href, title);
                    }
                }, '-', {
                    id: 'btncanel_' + classId,
                    text: '删除',
                    iconCls: 'icon-cancel',
                    handler: function() {
                        var ids = [];
                        var rows = $('#datagrid_' + classId).datagrid('getSelections');
                        for (var i = 0; i < rows.length; i++) {
                            ids.push(rows[i].id);
                        }
                        if (ids == '') {
                            $.messager.alert('信息提示', '请选择要操作的项', 'error');
                            return false;
                        }
                        var href = hrefcancel;
                        var title = '删除信息';
                        dogoDelete(ids, title, href, classId);
                    }
                }, '-', {
                    id: 'btnsearch' + classId,
                    text: '<input class="ajax_newslist" placeholder="文档标题"></input> '
                }, {
                    id: 'btnsubmit' + classId,
                    //text: '搜索',
                    iconCls: 'icon-search',
                    handler: function() {
                        var title = $('.ajax_newslist').val();
                        $('#datagrid_' + classId).datagrid('load', {
                            title: title
                        });
                    }
                }//
            ]//toolbar
        });
        var p = $('#datagrid_' + classId).datagrid('getPager');
        $(p).pagination({
            pageSize: 10, //每页显示的记录条数，默认为10
            pageList: [10, 20, 30, 40, 50, 100], //可以设置每页记录条数的列表
            beforePageText: '第', //页数文本框前显示的汉字
            afterPageText: '页    共 {pages} 页',
            displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'
        });
    });
</script>