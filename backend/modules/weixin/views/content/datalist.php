<?php
use yii\helpers\Url;
use common\models\wechat\User;
use common\models\wechat\Category;
use common\widgets\GoLinkPager;

?>
<link href="/css/form.css" rel="stylesheet">
<div class="search-nav">
    <form class="form-inline" action="<?= Url::toRoute('/weixin/content/datalist') ?>" method="get">
        <div class="form-group input-group-sm">
            <label for="txtName">标题：</label>
            <input class="form-control ipt" id="txtName" placeholder="标题" name="title"
                   value="<?= empty($params['title']) ? '' : $params['title'];?>">
        </div>
        <div class="form-group">
            <a href=""><button class="btn btn-default" id="btnSearch" type="submit"><i class="glyphicon glyphicon-search"></i> 查询
                </button></a>

    </form>
    <button class="btn btn-default" id="btnSearch" type="submit"><i class=""></i> 添加信息
    </button>

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

</table>
<div class="pull-right">

</div>