<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link href="/wx_css/category.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="cate_box">
    <div class="top">
        <img src="https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=2463515519,2418020666&fm=23&gp=0.jpg"/>
        <p>热门分类</p>
    </div>
    
    <ul class="list">
    <?php foreach ($data as $key => $value) {?>
        <a href="<?= Yii::$app->urlManager->createUrl(['weixin/release/forms'])?>"><li ><?php echo $value['name']; ?></li></a>
    <?php } ?>
    </ul>

</div>


<!--底部-->
<footer>

</footer>
</body>
</html>
