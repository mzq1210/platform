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
            <input class="form-control ipt" id="txtName" placeholder="用户名" name="name" value="<?= empty($params['name']) ? '' : $params['name'];?>">
        </div>
        <div class="form-group">
            <button class="btn btn-default" id="btnSearch" type="submit"><i class="glyphicon glyphicon-search"></i> 查询
            </button>
        </div>
        <div class="form-group input-group-sm" style="margin-left: 100px;">
            <label for="txtName">用户总数：</label>
            <input class="form-control ipt" disabled value="<?= $count;?>" style="font-weight: 700;color: #00f;">
        </div>
        <div class="form-group input-group-sm" style="margin-left: 100px;">
            <label for="txtName">今日活跃数：</label>
            <input class="form-control ipt" disabled value="<?= $todayLogin;?>" style="font-weight: 700;color: #00f;">
        </div>
    </form>

</div>

<table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
    <tr>
        <th>ID</th>
        <th>头像</th>
        <th>用户名</th>
        <th>OpenID</th>
        <th>性别</th>
        <th>注册时间</th>
        <th>手机号</th>
        <th>城市</th>
        <th>积分</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($info as $val): ?>
        <tr>
            <td><?= $val->id; ?></td>
            <td><img style="width: 30px;height: 30px;border-radius: 50%;" src="<?= $val->headimgurl;?>" alt=""></td>
            <td><?= $val->name;?></td>
            <td><?= $val->openid;?></td>
            <td><?php echo ($val->sex == 1)? '男':'女'; ?></td>
            <td><?= date('Y-m-d H:i:s', $val->ctime); ?></td>
            <td><?= $val->phone; ?></td>
            <td><?= $val->country; ?></td>
            <td><?= $val->integration; ?></td>
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