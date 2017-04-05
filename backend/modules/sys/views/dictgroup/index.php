<?php

use yii\helpers\Url;
use common\models\sys\DictGroup;
use common\widgets\GoLinkPager;
?>
<link href="/css/form.css" rel="stylesheet">

<div class="search-nav">
    <form class="form-inline" action="<?= Url::toRoute('/sys/dictgroup/index') ?>" class="form-inline" method="get">
        <div class="form-group input-group-sm">
            <label>名称：</label>
            <input class="form-control ipt" type="text" name="name" value="<?php if (isset($params['name'])): ?><?= $params['name'] ?><?php endif; ?>" size="20">&nbsp;
        </div>   
        <div class="form-group input-group-sm">
            <label>编码：</label>
            <input class="ipt form-control" type="text" name="code" value="<?php if (isset($params['code'])): ?><?= $params['code'] ?><?php endif; ?>" size="20">&nbsp;
        </div>
        <div class="form-group input-group-sm">
            <button class="btn btn-default menu_source" id="btnSearch" type="submit"><i class="glyphicon glyphicon-search"></i> 查询</button>
            <button class="btn btn-default menu_source" id="btnSearch" type="button" onclick="Dialog('','添加字典组','<?php echo Url::toRoute('/sys/dictgroup/add'); ?>', 530, 130)"><i class="glyphicon glyphicon-plus-sign"></i> 新增</button>
        </div>
    </form>
</div>
<table class="table-center table table-bordered table-striped table-hover table-condensed">
    <thead>
        <tr>
            <th  align="center">ID</th>
            <th  align="center">名称</th>
            <th align="center">编码</th>
            <th align="center">管理操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($info['data'] as $val): ?>
            <tr>
                <td><?php echo  $val->id; ?></td>
                <td align="center"><?php echo $val->name; ?></td>
                <td align="center"><?php echo $val->code ?></td>
                <td>
                    <a class="btn btn-info button" href="javascript:Dialog('','编辑分组','<?php echo Url::toRoute(['/sys/dictgroup/edit', 'id' => $val->id]) ?>', 530, 130)"><i class="glyphicon glyphicon-edit"></i> 编辑</a>
                    <a class="btn btn-danger button" href="javascript:confirmurl('<?php echo Url::toRoute(['/sys/dictgroup/delete', 'id' => $val->id]); ?>', '确定要刪除吗?')" ><i class="glyphicon glyphicon-trash"></i> 删除</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="pull-right">
    <?php echo GoLinkPager::widget(['pagination' => $info['pages']]);?>
</div>