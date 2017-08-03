<?php
use yii\helpers\Url;
?>

<?php if($showWay == 1):?>
    <link href="/css/jquery.treeTable.css" rel="stylesheet">
    <script src="/js/jquery.treetable.js"></script>
    <script>
        //屏蔽下面js则把所有组织机构都展示出来，
        $(document).ready(function() {
            $("#dnd-example").treeTable({
                indent: 20
            });
        });
    </script>
<?php endif;?>


<link href="/css/form.css" rel="stylesheet">
<div class="search-nav">
    <form class="form-inline" name="searchform" action="<?php echo Url::toRoute(['/sys/category/index']); ?>" method="post">
        <div class="form-group input-group-sm">
            <label for="txtName">用户名：</label>
            <input class="form-control ipt" id="txtName" placeholder="名称" name="name" value="<?php if($params && isset($params['name'])):?><?=$params['name']?><?php endif;?>">
        </div>
        <div class="form-group input-group-sm">
            <button class="btn btn-default" id="btnSearch" type="submit"><i class="glyphicon glyphicon-search"></i> 查询</button>
            <button class="btn btn-default" type="button" onclick="Dialog('','添加菜单','<?php echo Url::toRoute('/sys/category/add'); ?>', 620, 300)"><i class="glyphicon glyphicon-plus-sign"></i> 添加菜单</button>
        </div>
    </form>
</div>
<table class="table table-bordered table-striped table-hover table-condensed" id="dnd-example">
    <thead>
    <tr>
        <th>分类名称</th>
        <th>排序</th>
        <th>是否显示为菜单</th>
        <th>管理操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if($categorys){
        echo $categorys;
    }?>
    </tbody>
</table>

<script type="text/javascript">
    function createsonmenu(id) {
        Dialog('','添加子菜单','<?php echo Url::toRoute(['/sys/category/addchildren'])?>?id='+id, 620, 330);
    }
    //编辑菜单信息
    function edit(id, username) {
        Dialog('','修改菜单-'+username+'信息','<?php echo Url::toRoute(['/sys/category/edit'])?>?id='+id, 620, 300);
    }
</script>

