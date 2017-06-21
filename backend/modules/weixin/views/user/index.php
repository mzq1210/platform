<?php
use yii\helpers\Url;
use common\models\wechat\User;
use common\models\wechat\Category;
use common\widgets\GoLinkPager;

?>
<link href="/css/form.css" rel="stylesheet">
<div class="search-nav">
    <form class="form-inline" action="<?= Url::toRoute('/weixin/user/index') ?>" method="get">
        <div class="form-group input-group-sm">
            <label for="txtName">用户名：</label>
            <input class="form-control ipt" id="txtName" placeholder="用户名" name="name"
                   value="<?= empty($params['name']) ? '' : $params['name'];?>">
        </div>
        <div class="form-group">
            <button class="btn btn-default" id="btnSearch" type="submit"><i class="glyphicon glyphicon-search"></i> 查询
            </button>
        </div>
    </form>

</div>

<table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
    <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>OpenID</th>
        <th>性别</th>
        <th>头像地址</th>
        <th>注册时间</th>
        <th>手机号</th>
        <th>城市</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($info as $val): ?>
        <tr>
            <td><?= $val->id; ?></td>
            <td><?= $val->name;?></td>
            <td><?= $val->openid;?></td>
            <td><?= $val->sex; ?></td>
            <td><?php echo mb_substr($val->headimgurl, 0, 25).'...';?></td>
            <td><?= date('Y-m-d H:i:s', $val->ctime); ?></td>
            <td><?= $val->phone; ?></td>
            <td><?= $val->country; ?></td>
            <td>
                <a class="btn btn-danger button" href="javascript:confirmurl('<?= Url::toRoute(['/weixin/user/delete', 'id' => $val->id]); ?>', '确定要刪除吗?')""><i class="glyphicon glyphicon-trash"></i> 删除</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="pull-right">
    <?php echo GoLinkPager::widget(['pagination' => $pages]); ?>
</div>