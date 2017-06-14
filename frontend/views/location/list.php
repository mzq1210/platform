<?php
use yii\helpers\Url;
?>
<link rel="stylesheet" href="/css/see-count.css">
<script src="/js/see-counst.js"></script>
<style>
    .tel{
        float: right;width: 40px;height: 40px;
        border: solid 2px green;
        border-radius: 50%;
        text-align: center;line-height: 40px;
        margin-top: 10px;
    }
</style>
<nav class="nav text-center">
    <div class="back-btn"><i class="icon iconfont">&#xe600;</i></div>
    <span><?= $data['name'];?></span>
</nav>
<div class="see-count">
    <div class="gray-space"></div>
    <div class="see-list">
        <div class="list-content">
            <div class="content">
                <?php foreach ($info as $key => $value): ?>
                <a href="<?php echo Url::toRoute(['/location/detail']); ?>" >
                <div>
                    <div class="box">
                        <div class="grid font-15">
                            <div class="text-left"><?= $value->name;?></div>
                        </div>
                        <div class="msg padding">
                            <?php if(isset($value->telephone)):?>
                            <a href="tel:<?= $value->telephone;?>" class="iconfont inline-block margin-right font-17 tel">&#xe67f;</a>
                            <?php endif;?>
                            <div class="margin-bottom">
                                <span class="font-14">电话：<?php echo isset($value->telephone)? $value->telephone: '暂无';?></span>
                            </div>
                            <div class="margin-bottom">
                                <span class="font-14">地址：<?= $value->address;?></span>
                            </div>
                        </div>
                    </div>
                    <div class="gray-space"></div>
                </div>
                </a>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>