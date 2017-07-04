<?php
use yii\helpers\Url;
?>

<link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/bootstrap-fileinput/4.3.9/css/fileinput.min.css">
<script type="text/javascript" src="https://cdn.bootcss.com/bootstrap-fileinput/4.3.9/js/fileinput.min.js"></script>
<script type="text/javascript" src="https://cdn.bootcss.com/bootstrap-fileinput/4.3.9/js/locales/zh.min.js"></script>
<script type="text/javascript" src="/js/dialog.js"></script>

<link rel="stylesheet" href="/css/comment-edit.css">
<script src="/js/comment-edit.js"></script>
<link rel="stylesheet" href="/css/calc-detail.css">
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
    .upload-botton {
        width: 150px;
        height: 45px;
        margin: 5px 0;
    }

    .upload-botton i {
        font-size: 24px;
    }
    /*模态框居中*/
    .tb {display: table;pointer-events: none;width: 100%;height: 100%;  }
    .tb>.tc {display: table-cell;pointer-events: none;vertical-align: middle;}
    .tb>.tc>div {pointer-events: auto;}
</style>

<nav class="nav text-center">
    <a href="javascript:history.back(-1);"><div class="back-btn"><i class="icon iconfont">&#xe600;</i></div></a>
    <span class="title text-ellipsis">发布帖子</span>
</nav>
<div class="gray-space"></div>
<form class="form-horizontal" action="<?php echo Url::to(['release/create']); ?>" method="post">
<div class="comment-edit">
    <div class="calc">
        <div class="list font-14 padding-left-double padding-right-double">
            <div class="item-box item padding-top-double padding-bottom-double">
                <span class="color-light-font">选择分类</span>
                <div class="float-right">
                    <span class="select">求购</span>
                    <i class="iconfont">&#xe601;</i>
                </div>
            </div>
        </div>
        <div class="gray-space"></div>
    </div>

    <div class="editor padding-double">
        <input type="text" name="title" placeholder="请输入标题">
    </div>
    <div class="gray-space"></div>
    <div class="editor padding-double">
        <textarea name="content" placeholder="请输入内容"></textarea>
        <div style="width: 60px;height: 60px;border: dashed 2px #ccc;position: relative;line-height: 60px;text-align: center;font-size: 25px;color: #ccc;">
            <input type="file" name="file" id="txt_file" multiple class="file-loading"/>
        </div>
    </div>
    <div class="gray-space"></div>
    <!--图片展示区域-->
    <div class="file-drop-zone" style="margin: 12px 0 12px 0;width: 100%;display: none;">
        <div class="file-preview-thumbnails"></div>
        <div class="clearfix"></div>
        <div class="file-preview-status text-center text-success"></div>
    </div>

    <div class="filebox" style="display: none"></div>

    <div class="gray-space"></div>

    <input type="hidden" name="cid" value="1">
    <div class="footer flex border-top">
        <div class="commit">
            发布
        </div>
    </div>
</div>
</form>
<div id="dialogContent"></div>
<a class="link-hope" style="display: none;" href="#hope"></a>
<div class="console">
    请输入您的帖子内容...
</div>

<div class="select-menu">

</div>
<div class="menu-list list text-center">
    <div class="item padding-double header">
        选择分类
    </div>
    <div class="container">
        <?php foreach ($data as $key => $value) { ?>
            <div cid="<?php echo $value['id'] ?>" class="item padding-double font-14">
                <?php echo $value['name'] ?>
            </div>
        <?php } ?>
    </div>
</div>
<script>
    var json = '<?php echo json_encode($data);?>';
    var test_data = JSON.parse(json);

    $(function () {
        var oFileInput = new FileInput();
        oFileInput.Init("txt_file", "/release/upload");
    });

    var FileInput = function () {
        var oFile = new Object();
        oFile.Init = function (ctrlName, uploadUrl) {
            var control = $('#' + ctrlName);
            //初始化上传控件的样式
            control.fileinput({
                language: 'zh', //设置语言
                uploadUrl: uploadUrl, //上传的地址
                allowedFileExtensions: ['jpg', 'gif', 'png'],//接收的文件后缀
                showUpload: false, //是否显示上传按钮
                showCaption: false,//是否显示标题
                showRemove: false, //显示移除按钮
                showPreview: false, //是否显示预览区域
                browseClass: "", //按钮样式
                dropZoneEnabled: true,//是否显示拖拽区域
                maxFileSize: 4096,//单位为kb，如果为0表示不限制文件大小
                //minFileCount: 0,
                maxFileCount: 9, //表示允许同时上传的最大文件个数
                enctype: 'multipart/form-data',
                validateInitialCount: true,
                previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
                msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！"
            });

            $("#txt_file").on("filebatchselected", function (event, files) {
                $(".kv-upload-progress").remove();
                $(this).fileinput("upload");
            }).on("fileuploaded", function (event, data) {
                if (data.response.code == 200) {
                    $(".file-drop-zone").css('display','block');
                    var img = '<div class="file-preview-frame krajee-default"><div class="kv-file-content" style="height: 60px;">'+
                        '<img src="'+data.response.imgpath+'" id="img" onclick="delimg(this)" index="'+ data.response.class +'" class="file-preview-image kv-preview-data" style="width:auto;height:60px;">'+
                        '</div></div>';
                    $(".file-preview-thumbnails").append(img);

                    $(".kv-file-remove").remove();
                    var html = '<input type="hidden" class="'+ data.response.class +'" name="imgfile[]" value="'+ data.response.imgpath +'">';
                    $(".filebox").append(html);
                }
            });
        };
        return oFile;
    };

    function delimg(obj) {
        $.onlyAlert('delimg', '删除图片', '确定删除图片吗？', function () {
            $(obj).parents('.file-preview-frame').remove();
            if($(".file-preview-frame").length == 0){
                $(".file-drop-zone").css('display','none');
                $(".kv-upload-progress").remove();
            }
            var c = $(obj).attr('index');
            $("."+c).remove();
        })
    }
</script>
