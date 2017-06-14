<?php
use yii\helpers\Url;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Document</title>

    <style>
        .fonts{
            font-size: 50px;
        }
        .titles{
            width: 100%;
            height: 80px;
            background: white;
            font-size: 45px;
            color: black;
            line-height: 70px;
            margin-top: 25px

        }
        .title{
            width: 100%;
            height: 100px;
            background: white;
            font-size: 40px;
            color: black;
            /*border-bottom: 1px solid black;*/
        }
        .content{
            margin-top: 5px;
        }
        .contents{
            margin-top: 5px;
            font-size: 40px;

        }
        .bottom{
            height: 120px;
            padding-top: 15px;
        }
        .bottom img{
            width: 90px;
            height: 90px;

        }
        .btn2{
            width: 100%;
            height: 120px;
            color: white;
            background:lightskyblue;
            font-size: 40px;

        }
        .pic{
            width: 100%;
            max-height:200px;
        }
        input {
            border-style:none;
            border:0;background:transparent;
        }
    </style>
</head>
<body>

<form action="<?php echo Url::to(['release/create']); ?>" method="post">
<div class="titles">
    #爆料#
</div>
<div class="title">
    <input type="text" name="title" placeholder="  标题 （必填)"  class="title fonts">
</div>
<div class="content">
    <textarea name="content" placeholder=" 内容 "style="height:250px;width:100%" class="fonts contents"></textarea>
</div>
<div class="bottom">
    <img src="/wx_images/take.jpg" alt="">
    <img src="/wx_images/photo.jpg" alt="">
</div>
<div class="pic">

</div>
    <input type="submit" value="提交" class="btn2"  />
</form>
<!--底部-->
<footer>

</footer>
</body>
</html>
