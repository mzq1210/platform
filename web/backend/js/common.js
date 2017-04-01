function confirmurl(url, message) {
    artConfirm(message, function () {
        $.post(url, function () {
            window.location.reload();
        });
    });

}
function redirect(url) {
    if (window.self === window.self) {
        window.top.location.href = url;
    } else {
        location.href = url;
    }
}

/**
 * 確信彈出框
 * @param content
 * @param okVal
 * @param callback
 * @param cancelVal
 * @param isFresh
 * @constructor
 */
function artConfirm(content, callback, okVal, cancelVal, isFresh) {
    if (!okVal)
        okVal = '确认';
    if (!cancelVal)
        cancelVal = '取消';
    window.top.dialog({
        title: '友情提示',
        content: content ? content : '确定操作吗' + '？',

        button: [
            {
                value: okVal,
                callback: function () {
                    this.close();
                    callback && callback();
                    return true;
                },
                autofocus: true
            },
            {
                value: cancelVal
            }],
        width: '282'
        /*ok: function () {
            this.close();
            callback && callback();
            return true;
        },
        okValue: okVal,
        cancelValue: cancelVal,
        cancel: function () {
            if (isFresh)
                window.location.reload();
            return true;
        },
        width: '282'*/
    }).showModal();
}

/**
 * 統一頁面中的彈窗消息
 * @param content
 * @param title
 * @param okVal
 */
function artAlert(content, title, okVal) {
    if (!title)
        title = '提示';
    if (!okVal)
        okVal = '确定';
    window.top.dialog({
        title: title,
        id:'alert',
        content: content,
        okVal: okVal,
        width: '282'
    }).showModal();
    setTimeout(timing_close ,2000);
}
function timing_close(){
    window.top.dialog({id:'alert'}).close().remove();
}

function alertProgressBar(content, title, okVal) {
    if (!title)
        title = '提示';
    if (!okVal)
        okVal = '确定';
    window.top.dialog({
        title: title,
        id:'alert',
        content: content,
        okVal: okVal,
        width: '282',
        time: 2
    }).showModal();
    progressBar(1000);
    setTimeout(timing_close ,2000);
}

/**
 * 进度条
 */
function progressBar(time) {
    var breaker=100;
    var turn=100/(time/breaker);
    var progress=0;
    var timer = setInterval(function(){
        progress=progress+turn;
        window.top.$("#processbar").attr("style", "width:"+progress+"%");
        if (progress>=100) {
            clearInterval(timer);
            window.top.$("#title").html("生成敏感词库成功!");
        }
    }, breaker);
}

/**
 * 全选checkbox,注意：标识checkbox id固定为为check_box
 * @param string name 列表check名称,如 uid[]
 */
function selectall(name) {
    if ($("#check_box").prop("checked") == false) {
        $("input[name='" + name + "']").each(function () {
            this.checked = false;
        });
    } else {
        $("input[name='" + name + "']").each(function () {
            this.checked = true;
        });
    }
}

function openwinx(url, name, w, h) {
    if (!w)
        w = screen.width - 4;
    if (!h)
        h = screen.height - 95;
    //url = url + '&pc_hash=' + pc_hash;
    window.open(url, name, "top=100,left=400,width=" + w + ",height=" + h + ",toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no");
}

//弹出对话框
//type 为空 则弹框有确认和取消按钮 如果不为空 则没有确认 和 取消按钮
function omnipotent(id, linkurl, title, w, h, close_type, type) {
    var art = window.top;
    if (!type)
        type = '';
    if (!w)
        w = 700;
    if (!h)
        h = 500;
    if(type){
        art.dialog({
            id:id,url: linkurl, title: title, width: w, height: h, lock: true
        });
    }else{
        art.dialog({id: id, url: linkurl, title: title, width: w, height: h, lock: true,
                cancelValue: '取消',
                cancel: function () {
                },
                okValue: '确定',
                ok: function () {
                    if (close_type == 2) {
                        art.dialog({id: id}).close()
                    } else {
                        var iframe = window.top.$("iframe").contents().find("#dosubmit");
                        iframe.click();
                        return false;
                    }
                }
        }).showModal();
    }
}

function view(id, name, url, width, height) {
    dialog({title: name, id: id, iframe: url, width: width, height: height}).show();
}

/**
 * 彈出框
 * @param id
 * @param name
 * @param url
 * @param width
 * @param height
 * @param type
 * @param okVal
 * @param cancelVal
 */
function Dialog(id, name, url, width, height, type, okVal, cancelVal) {
    var art = window.top;
    if (!id)
        id = 'edit';
    if (!okVal)
        okVal = '确认';
    if (!cancelVal)
        cancelVal = '取消';
    if(type === true){
        art.dialog({title: name, id: id, url: url, width: width, height: height}).showModal();
    }else{
        art.dialog({title: name, id: id, url: url, width: width, height: height,
            button: [
                {
                    value: okVal,
                    callback: function () {
                        var obj = this;
                        this.title('提交中…');
                        window.top.$("button.ui-dialog-autofocus").attr("disabled",true);
                        var iframe = window.top.$("iframe").contents().find("#dosubmit");
                        iframe.click();
                        setTimeout(function(){
                            obj.title(name);
                            window.top.$("button.ui-dialog-autofocus").removeAttr("disabled");
                        },1000);
                        return false;
                    },
                    autofocus: true
                },
                {
                    value: cancelVal
                }
            ]
            /*cancelValue: cancelVal,
            cancel: function () {
            },
            okValue: okVal,
            ok: function () {
                var obj = this;
                this.title('提交中…');
                window.top.$("button.ui-dialog-autofocus").attr("disabled",true);
                var iframe = window.top.$("iframe").contents().find("#dosubmit");
                iframe.click();
                setTimeout(function(){
                    obj.title(name);
                    window.top.$("button.ui-dialog-autofocus").removeAttr("disabled");
                },1000);
                return false;
            }*/
        }).showModal();
    }
}

//成功或失败弹窗
function alertpop(msg, width, height) {
    window.top.dialog({
        title: '消息',
        width: width + 'px',
        height: height + 'px',
        content: msg,
        okValue: '确 定',
        ok: function () {}
    }).showModal();
}