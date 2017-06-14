<?php
use yii\helpers\Url;
?>

<link rel="stylesheet" href="/css/comment-edit.css">
<script src="/utils/zepto.js"></script>
<script src="/js/comment-edit.js"></script>
<link rel="stylesheet" href="/css/calc-detail.css">
<script src="/js/calc-detail.js"></script>
<style>
    .comment-edit .editor input{
        width: 100%;
        height: 30px;
        box-sizing: border-box;
        font-size: 14px;
        outline: none;
        border: none;
        resize: none;
    }
    input::-webkit-input-placeholder{
        color: #E3E3E3;
    }
    input:-moz-placeholder{
        color:#666;
    }
    input::-moz-placeholder{
        color:#666;
    }
    input:-ms-input-placeholder{
        color:#666;
    }
</style>

<nav class="nav text-center">
    <a href="javascript:history.back(-1);"><div class="back-btn"><i class="icon iconfont">&#xe600;</i></div></a>
    <span class="title text-ellipsis">评论</span>
</nav>
<div class="gray-space"></div>
<form class="form-horizontal" action="<?php echo Url::to(['release/comment']); ?>" method="post">
<div class="comment-edit">

    <div class="editor padding-double">
        <textarea name="content" placeholder="请输入内容"></textarea>
    </div>
    <div class="gray-space"></div>

    <input type="hidden" name="parentId" value="<?= $id; ?>">
    <div class="footer flex border-top">
        <div class="commit" onclick="submit();">
            评论
        </div>
    </div>
</div>
</form>
<div id="dialogContent"></div>

<div class="console">
    请输入您的帖子内容...
</div>

<div class="select-menu">

</div>

<script>
    function submit() {
        $('form').submit();
    }
</script>
