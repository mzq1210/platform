<?php

use yii\helpers\Url;
use common\models\sys\DictGroup;
use common\widgets\GoLinkPager;
?>
<link href="/css/form.css" rel="stylesheet">

<div class="search-nav">
    <form action="<?= Url::toRoute('/sys/dict/index') ?>" class="form-inline" method="get">
        <div class="form-group input-group-sm">
            <label for="txtName">编码：</label>
            <input class="ipt form-control" type="text" name="code" value="<?php if (isset($params['code'])): ?><?= $params['code'] ?><?php endif; ?>" size="20">&nbsp;
        </div>                  
        <div class="form-group input-group-sm">
            <label>标签：</label>
            <input class="form-control ipt" type="text" name="label" value="<?php if (isset($params['label'])): ?><?= $params['label'] ?><?php endif; ?>" size="20">&nbsp;
        </div>      
        <div class="form-group input-group-sm">
            <label>字典组：</label>
            <select name="dict_group_id" class="form-control" >
                <option value="0">请选择</option>
                <?php foreach (DictGroup::find()->select(['id', 'name'])->where(['del_flag' => 0])->all() as $list): ?>
                    <option <?php if (isset($params['dict_group_id']) && $params['dict_group_id'] == $list->id): ?>selected=""<?php endif; ?> value="<?= $list->id; ?>"><?= $list->name; ?></option>
                <?php endforeach; ?>
            </select>          
        </div>      
        <div class="form-group input-group-sm">
            <button class="btn btn-default" id="btnSearch" type="submit"><i class="glyphicon glyphicon-search"></i> 查询</button>
            <button class="btn btn-default" id="btnSearch" type="button" onclick="Dialog('','添加字典','<?php echo Url::toRoute('/sys/dict/add'); ?>', 460, 180)"><i class="glyphicon glyphicon-plus-sign"></i> 新增</button>
        </div>
    </form>
</div>

<table class="table-center table table-bordered table-striped table-hover table-condensed">
    <thead>
        <tr>
            <th  align="center">ID</th>
            <th  align="center">编码</th>
            <th align="center">标签</th>
            <th align="center">字典组</th>
            <th align="center">管理操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($info['data'] as $val): ?>
            <tr>
                <td><?= $val->id; ?></td>
                <td align="center"><?= $val->code; ?></td>
                <td align="center"><?= $val->label ?></td>
                <td align="center"><?= DictGroup::getName($val->dict_group_id) ?></td>
                <td>
                    <a class="btn btn-info button" href="javascript:Dialog('edit','编辑字典','<?php echo Url::toRoute(['/sys/dict/edit', 'id' => $val->id]) ?>', 460, 180)"><i class="glyphicon glyphicon-edit"></i> 编辑</a>
                    <a class="btn btn-danger button" href="javascript:confirmurl('<?= Url::toRoute(['/sys/dict/delete', 'id' => $val->id]); ?>', '确定要刪除吗?')" ><i class="glyphicon glyphicon-trash"></i> 删除</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="pull-right">
    <?php echo GoLinkPager::widget(['pagination' => $info['pages']]); ?>
</div>