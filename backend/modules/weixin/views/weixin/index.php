<?php
use yii\helpers\Url;
use common\widgets\GoLinkPager;
use common\components\library\DictTool;
use app\components\Acl;

$isAclCreate = Acl::isAclAuth('oa', 'device', 'add');
$isAclEdit = Acl::isAclAuth('oa', 'device', 'edit');
$isAclDelete = Acl::isAclAuth('oa', 'device', 'delete');
$isAclWaste = Acl::isAclAuth('oa', 'device', 'waste');
$isAclImport = Acl::isAclAuth('oa', 'device', 'import');
$isAclExport = Acl::isAclAuth('oa', 'device', 'export');
?>
<link href="/css/form.css" rel="stylesheet">

<div class="search-nav">
    <form class="form-inline" action="<?= Url::toRoute('/oa/device/index') ?>" method="get">
        <div class="form-group input-group-sm">
            <label for="txtName">设备名称：</label>
            <input class="form-control ipt" id="txtName" placeholder="设备名称" name="name"
                   value="<?= empty($param['name']) ? '' : $param['name'] ?>">
        </div>
        <div class="form-group input-group-sm">
            <label for="Select">所属公司：</label>
            <select id="company" class="form-control width-120" name="company">
                <option value="">-选择公司-</option>
                <?php if ($company): foreach ($company as $val): ?>
                    <option value="<?= $val['code'] ?>"
                            <?php if (isset($param['company']) && $param['company'] == $val['code']): ?>selected<?php endif; ?> ><?= $val['label'] ?></option>
                <?php endforeach;endif; ?>
            </select>
        </div>
        <div class="form-group input-group-sm">
            <label for="txtName">型号：</label>
            <input class="form-control ipt" id="model" placeholder="设备型号" name="model"
                   value="<?= empty($param['model']) ? '' : $param['model'] ?>">
        </div>
        <div class="form-group input-group-sm">
            <label for="txtName">SN码：</label>
            <input class="form-control ipt" id="sn" placeholder="SN码" name="sn"
                   value="<?= empty($param['sn']) ? '' : $param['sn'] ?>">
        </div>
        <div class="form-group">
            <button class="btn btn-default" id="btnSearch" type="submit"><i class="glyphicon glyphicon-search"></i> 查询
            </button>

            <button class="btn btn-default <?= $isAclCreate ?>" id="btnAdd" type="button"
                    onclick="Dialog('','新增设备','<?php echo Url::toRoute('/oa/device/add'); ?>', 600, 570)"><i
                    class="glyphicon glyphicon-plus-sign"></i> 新增
            </button>
            <button class="btn btn-default <?= $isAclImport ?>" id="btnImport" type="button"
                    onclick="Dialog('','导入设备信息','<?php echo Url::toRoute('/oa/device/import'); ?>', 600, 250,true)"><i
                    class="glyphicon glyphicon-retweet"></i> 批量导入
            </button>
            <button class="btn btn-default <?= $isAclExport ?>" id="btnExport" type="button"
                    onclick='location.href="<?php echo Url::toRoute('/oa/device/export')?>"'><i
                    class="glyphicon glyphicon-random"></i> 设备导出
            </button>
        </div>
    </form>
</div>

<table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
    <tr style="text-align: center;">
        <th>ID</th>
        <th>设备名称</th>
        <th width="5%">所属公司</th>
        <th>品牌名称</th>
        <th>型号</th>
        <th>SN号码</th>
        <th>存放位置</th>
        <th width="8%">入库时间</th>
        <th>原价</th>
        <th>备注</th>
        <th width="5%">使用人</th>
        <th width="6%">使用状态</th>
        <th width="9%">管理操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($info as $val): ?>
        <tr>
            <td><?php echo $val->id; ?></td>
            <td><?php echo $val->name; ?></td>
            <td><?php echo DictTool::getLabel($company, $val->company); ?></td>
            <td><?php echo DictTool::getLabel($brandList, $val->brand_id); ?></td>
            <td><?php echo $val->model; ?></td>
            <td><?php echo $val->sn; ?></td>
            <td><?php echo $val->position; ?></td>
            <td><?php echo $val->add_time; ?></td>
            <td><?php echo $val->price; ?></td>
            <td><?php echo $val->remark; ?></td>
            <td><?php echo $val->use_person; ?></td>
            <td><?php if ($val->status == 0):echo '<i class="status status-yellow"></i> <span class="font-yellow">未使用</span>';
                elseif ($val->status == 1):echo '<i class="status status-green"></i> <span class="font-green">使用中</span>';
                else:echo '<i class="status status-silvery"></i> <span class="font-silvery">已报废</span>';endif; ?></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-info button"><span class="glyphicon glyphicon-cog"></span> 操作
                    </button>
                    <button type="button" class="btn btn-info button dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu pull-right min-w" role="menu">
                        <?php if ($val->status == 0) { ?>
                            <li><a href="javascript:Dialog('','分配设备','<?php echo Url::toRoute(['/oa/device/assign', 'id' => $val->id]); ?>', 480, 250)"><i class="glyphicon glyphicon-chevron-left"></i> 分配</a></li>
                        <?php } elseif ($val->status == 1) { ?>
                            <li><a href="javascript:Dialog('','归还设备','<?php echo Url::toRoute(['/oa/device/returned', 'id' => $val->id]); ?>', 480, 250)"><i class="glyphicon glyphicon-chevron-right"></i> 归还</a></li>
                        <?php } ?>
                        <?php if ($val->status == 0): ?>
                            <li class="divider"></li>
                            <li class="<?= $isAclEdit ?>"><a href="javascript:Dialog('','编辑设备信息','<?= Url::toRoute(['/oa/device/edit', 'id' => $val->id]); ?>', 600, 570)"><i class="glyphicon glyphicon-edit"></i> 编辑</a></li>
                            <li class="divider <?= $isAclWaste ?>"></li>
                            <li class="<?= $isAclWaste ?>"><a href="javascript:confirmurl('<?= Url::toRoute(['/oa/device/waste', 'id' => $val->id]); ?>','确认要进行报废吗?')"><i class="glyphicon  glyphicon-remove-circle"></i> 报废</a></li>
                        <?php endif; ?>
                        <li class="divider"></li>
                        <li><a href="javascript:Dialog('','查看历史数据','<?= Url::toRoute(['/oa/device/record', 'id' => $val->id]); ?>', 900, 700,true)"><i class="glyphicon glyphicon-info-sign"></i> 历史</a></li>
                        <?php if ($val->status != 1): ?>
                            <li class="divider <?php echo $isAclDelete;?>"></li>
                            <li class="<?php echo $isAclDelete;?>"><a href="javascript:confirmurl('<?= Url::toRoute(['/oa/device/delete', 'id' => $val->id]); ?>', '确定要刪除吗?')"><i class="glyphicon glyphicon-trash "></i> 删除</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="page-left">
    <i class="status status-yellow"></i> <span class="font-yellow">未使用（<?php echo isset($count[0])? $count[0]['cnt'] : 0; ?>）</span>
    <i class="status status-green"></i> <span class="font-green">使用中（<?php echo isset($count[1])? $count[1]['cnt'] : 0; ?>）</span>
    <i class="status status-silvery"></i> <span class="font-silvery">已报废（<?php echo isset($count[2])? $count[2]['cnt'] : 0; ?>）</span>
</div>
<div class="pull-right">
    <?php echo GoLinkPager::widget(['pagination' => $pages]); ?>
</div>
