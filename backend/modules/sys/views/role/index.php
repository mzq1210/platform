<?php 
use yii\helpers\Url;
use common\widgets\GoLinkPager;
?>
<link href="/css/form.css" rel="stylesheet">
<div class="search-nav">
	<form class="form-inline" name="searchform" action="<?php echo Url::toRoute(['/sys/role/index']); ?>" method="get">
		<div class="form-group input-group-sm">
			<label for="txtName">名称：</label>
			<input class="form-control ipt" id="txtName" placeholder="名称" name="name" value="<?php echo isset($params['name']) ? $params['name'] : '';?>">
		</div>
		<div class="form-group input-group-sm">
			<button class="btn btn-default" id="btnSearch" type="submit"><i class="glyphicon glyphicon-search"></i> 查询</button>
			<button class="btn btn-default" type="button" onclick="Dialog('','添加角色','<?php echo Url::toRoute('/sys/role/add'); ?>', 600, 320)"><i class="glyphicon glyphicon-plus-sign"></i> 添加角色</button>
		</div>
	</form>
</div>
<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
	<tr>
		<th>序号</th>
		<th>名称</th>
		<th>描述</th>
		<th>操作</th>
	</tr>
	</thead>
	<tbody>
	<?php if($info):?>
		<?php foreach($info as $val):?>
			<tr>
				<td><?=$val->id;?></td>
				<td><?=$val->name;?></td>
				<td><?=$val->desc;?></td>
				<td>
					<a class="btn btn-warning button" href="javascript:dataSource.getOrganizTree('<?=$val->id;?>','<?=$val->siteid;?>')"><i class="glyphicon glyphicon-cog"></i> 权限设置</a>
					<a class="btn btn-info button" href="javascript:Dialog('','修改角色','<?php echo Url::toRoute(['/sys/role/edit','id' =>$val->id]); ?>', 600, 320)"><i class="glyphicon glyphicon-edit"></i> 编辑</a>
					<a class="btn btn-danger button" href="javascript:confirmurl('<?= Url::toRoute(['/sys/role/delete', 'id' => $val->id]); ?>', '确定要刪除吗?')" ><i class="glyphicon glyphicon-trash"></i> 删除</a>
				</td>
			</tr>
		<?php endforeach;?>
	<?php endif;?>
	</tbody>
</table>
<div class="pull-right">
	<?php echo GoLinkPager::widget(['pagination' => $pages]);?>
</div>
</form>
<script type="text/javascript">
	/**
	 * 分配权限
	 */
	dataSource = {};//闭包函數中不用var申明变量,代表全局变量
	dataSource.getOrganizTree = function(id,siteid){
		var art = window.top;
		$.post('/ajax/getmenu',{id:id, siteid:siteid}, function(data){
			art.dialog({
				title: '菜单权限选择',
				content: data,
				id: 'getmenu',
				width: '370'
			}).showModal();
		});
	};
</script>
