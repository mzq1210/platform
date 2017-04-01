<?php
    use yii\helpers\Url;
    use yii\helpers\Html; 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>汇金行MPS系统</title>
        <script src="/js/jquery-1.9.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/common.js"></script>
        <script src="/js/formvalidator.js"></script>
        <script src="/js/formvalidatorregex.js"></script>
        <script src="/js/dialog-min.js"></script>
        <script src="/js/dialog-plus-min.js"></script>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/webmain.css">
        <link rel="stylesheet" href="/css/ui-dialog.css">
         <link rel="stylesheet" href="/css/table_form.css">
    </head>
    <?php $this->beginPage() ?> 
<?php $this->beginBody() ?> 
    <body>
        <?php echo $content; ?>
    </body>
    <?php $this->endBody() ?> 
<?php $this->endPage() ?>
</html>
