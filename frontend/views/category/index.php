<?php
use yii\helpers\Url;
?>

<style>
    .cate {
        width: 100%;margin-top: 5px;
        overflow: hidden;
    }
    .cate-list {
        float: left;
        margin: 10px 2% 5px 2%; padding-bottom: 21%;
        width: 16%; height: 0;
        text-align: center;
    }
    .cate-list a{
        display: inline-block;
        width: 50px;height: 50px;border-radius: 50%;
    }
    .cate-list a span{
        line-height: 44px;font-size: 30px;
    }
</style>
<div class="cate">
    <?php foreach ($data as $key => $value): ?>
        <div class="cate-list">
            <a href="<?php echo Url::toRoute(['/category/info'])."?id=".$value['id']; ?>" class="<?= $value['style'];?>"><span style="color: #fff" class="<?= $value['icons'];?>"></span></a>
            <div style="margin-top: 7px;font-size: 12px;"><?= $value['name'];?></div>
        </div>
    <?php endforeach;?>
</div>