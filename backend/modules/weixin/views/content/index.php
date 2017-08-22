<?php
use yii\helpers\Url;
use common\models\wechat\User;
use common\models\wechat\Category;
use common\widgets\GoLinkPager;

?>
<link href="/css/form.css" rel="stylesheet">
<div class="search-nav">
    <form class="form-inline" action="<?= Url::toRoute('/weixin/content/index') ?>" method="get">
        <div class="form-group input-group-sm">
            <label for="txtName">标题：</label>
            <input class="form-control ipt" id="txtName" placeholder="标题" name="title"
                   value="<?= empty($params['title']) ? '' : $params['title'];?>">
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
        <th>标题</th>
        <th>内容</th>
        <th>所属分类</th>
        <th>用户</th>
        <th>发表时间</th>
        <th>查看数</th>
        <th>点赞数</th>
        <th>评论数</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($info as $val): ?>
        <tr>
            <td><?= $val->id; ?></td>
            <td style="text-align: left;"><?php echo mb_substr($val->title, 0, 20);?></td>
            <td style="text-align: left;"><?php echo mb_substr($val->content, 0, 20).'...';?></td>
            <td><?= Category::getThisCategory($val->cid)['name']; ?></td>
            <td><?= User::getUserInfo(['id' =>$val->uid])['name']; ?></td>
            <td><?= date('Y-m-d H:i:s', $val->ctime); ?></td>
            <td><?= $val->look; ?></td>
            <td><?= $val->zan; ?></td>
            <td><?= $val->coments; ?></td>
            <td>
                <a class="btn btn-danger button" href="javascript:confirmurl('<?= Url::toRoute(['/weixin/content/delete', 'id' => $val->id]); ?>', '确定要刪除吗?')""><i class="glyphicon glyphicon-trash"></i> 删除</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="pull-right">
    <?php echo GoLinkPager::widget(['pagination' => $pages]); ?>
</div>