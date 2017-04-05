<?php 
use yii\helpers\Url;
use common\widgets\GoLinkPager;
?>
<link href="/css/form.css" rel="stylesheet">

<div class="search-nav">
	<form class="form-inline" name="searchform" action="<?php echo Url::toRoute(['/sys/icon/index']); ?>" method="get">
		<div class="form-group input-group-sm">
			<label for="txtName">名称：</label>
			<input class="form-control ipt" id="txtName" placeholder="名称" name="name" value="<?php echo isset($params['name']) ? $params['name'] : '';?>">
		</div>
		<div class="form-group">
			<button class="btn btn-default" id="btnSearch" type="submit"><i class="glyphicon glyphicon-search"></i> 搜索</button>
			<button class="btn btn-default" type="button" onclick="Dialog('','添加图标','<?php echo Url::toRoute('/sys/icon/add'); ?>', 400, 140)"><i class="glyphicon glyphicon-plus-sign"></i> 添加图标</button>
		</div>
	</form>
</div>

<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
	<tr>
		<th>序号</th>
		<th>图标</th>
		<th>类名</th>
		<th>名称</th>
		<th>操作</th>
	</tr>
	</thead>
	<tbody>
	<?php if($info):?>
		<?php foreach($info as $val):?>
			<tr>
				<td><?=$val->id;?></td>
				<td><i class="glyphicon <?=$val->icon;?>" style="font-size: 18px;color: #1ABC9C;"></i></td>
				<td><?=$val->icon;?></td>
				<td><?=$val->name;?></td>
				<td>
					<a class="btn btn-info button" href="javascript:Dialog('','修改图标','<?php echo Url::toRoute(['/sys/icon/edit','id' =>$val->id]); ?>', 400, 140)"><i class="glyphicon glyphicon-edit"></i> 编辑</a>
					<a class="btn btn-danger button" href="javascript:confirmurl('<?= Url::toRoute(['/sys/icon/delete', 'id' => $val->id]); ?>', '确定要刪除吗?')" ><i class="glyphicon glyphicon-trash"></i> 删除</a>
				</td>
			</tr>
		<?php endforeach;?>
	<?php endif;?>
	</tbody>
</table>
<div class="pull-right">
	<?php echo GoLinkPager::widget(['pagination' => $pages]);?>
</div>
