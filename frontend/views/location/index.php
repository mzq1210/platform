<?php
use yii\helpers\Url;
?>
<link rel="stylesheet" href="/css/houseType-detail.css">

<nav class="nav text-center">
    <div class="back-btn"><i class="icon iconfont">&#xe600;</i></div>
    <span class="title text-ellipsis">周边</span>
    <div class="share-btn"><i class="icon iconfont">&#xe684;</i></div>
</nav>
<div class="houseType-detail">
    <?php foreach ($data as $key => $value): ?>
    <div class="gray-space"></div>
    <div class="special">
        <div class="title padding-double border-bottom">
            <div>
                <?= $value['name'];?>
            </div>
        </div>
        <div class="content padding-double font-14 color-normal-font">
        <?php foreach ($value['childs'] as $k => $v): ?>
            <a href="<?php echo Url::toRoute(['/location/list', 'id' => $v['id']]); ?>" ><?= $v['name'];?>&nbsp;</a>
        <?php endforeach;?>
        </div>
    </div>
    <?php endforeach;?>
</div>