<script type="text/javascript" src="/js/jquery.ztree.core.js"></script>
<script type="text/javascript" src="/js/jquery.ztree.excheck.js"></script>
<link href="/css/zTreeStyle.css" rel="stylesheet" type="text/css" />
<SCRIPT type="text/javascript">
    <!--
    var setting = {
        callback: {
            onCheck: function (event, treeId, treeNode) {
                _checkedNode = treeNode;
            }
        },
        check: {
            enable: true,
            chkStyle: "checkbox",
            radioType: "all"
        },
        data: {
            key: {
                name: "name",
                title: "name"
            },
            simpleData: {
                enable: true,
                idKey: "id",
                pIdKey: "pId",
                rootPId: null
            }
        }
    };
    var zNodes =[
        <?php foreach($dataProvider as $val):?>
        { id:<?php echo $val['id']; ?>, pId:<?php echo $val['parentid']; ?>, name:"<?php echo $val['name']; ?>", open:true},
        <?php endforeach;?>
    ];

    var menuIds = [
        <?php foreach($menuIds as $v):?>
        <?php echo $v; ?>,
        <?php endforeach;?>
    ];
    $(document).ready(function(){
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    });
    //-->
</SCRIPT>
<div class="table-list" id="load_priv">
    <table width="100%" cellspacing="0" id="dnd-organiz">
        <tbody>
            <ul id="treeDemo" class="ztree" style="max-height: 400px;width:390px;overflow-x:hidden;overflow-y: auto;"></ul>
        </tbody>
    </table>
    <input type="hidden" name="roleid" value="<?=$params['id']?>">
    <input type="button" id="dosubmitCel" class="btn btn-default" name="dosubmit1" value="取消"/>
    <input type="button" class="btn btn-primary" name="dosubmit" id="dosubmitSel" value="选择" />
</div>
<input type="hidden" value="" dct-name="" id="selHiddenOrganiz">
<script type="text/javascript">
    $(document).ready(function() {
        //默认选中
        var treeObj = $.fn.zTree.getZTreeObj('treeDemo');
        var nodes = treeObj.getCheckedNodes(false);
        $.each(nodes,function(key,value){
            if($.inArray(value.id, menuIds)>=0){
                var node = nodes[key];
                node.checked = true;
                treeObj.updateNode(node);
            }
        });

        $("#dosubmitSel").click(function(){
            var roleid = $("input[name=roleid]").val();
            var treeObject = $.fn.zTree.getZTreeObj('treeDemo');
            var _checkedTreeNode = treeObject.getCheckedNodes(true);

            if(_checkedTreeNode && _checkedTreeNode.length > 0) {
                var ids = '';
                $.each(_checkedTreeNode,function(key,value){
                    ids += value.id+',';
                });
                $.post('/sys/role/roleset',{ids:ids, roleid:roleid}, function(data){
                        if(data.status == 200) {alert("成功！")}
                });
                dialog({id:'getmenu'}).close();
            }else{
                artAlert('请选择权限!');
                return false;
            }
            dialog({id:'getmenu'}).close();
        });
        $("#dosubmitCel").click(function () {
            dialog({id:'getmenu'}).close();
        });
    });
</script>