<div class="divbody" style="background-color: #EEEEEE; padding: 10px; height: auto;" id="heightBody" >
    <div align="left">
        <ul class="homelishow" style="height: 130px; background-color:#FFFFFF">
            <li>
                <div class="homeiconss">
                    <div class="div00"><span style="display:none" class="badge red"></span></div>
                    <div style="background-color:#EFBB62" class="homeiconss2">
                        <div class="div01"><i class="glyphicon glyphicon-bell"></i></div>
                        <div id="todo_text">提醒信息</div>
                    </div>
                </div>
            </li>
            <li>
                <div class="homeiconss">
                    <div class="div00"><span style="display:none" class="badge red"></span>
                    </div>
                    <div style="background-color:#3BBDDB" class="homeiconss2">
                        <div class="div01"><i class="glyphicon glyphicon-time"></i></div>
                        <div id="daiban_text">待办/处理</div>
                    </div>
                </div>
            </li>
            <li>
                <div class="homeiconss">
                    <div class="div00"><span style="display:none" class="badge red"></span>
                    </div>
                    <div style="background-color:#B67FF4" class="homeiconss2">
                        <div class="div01"><i class="glyphicon glyphicon-bookmark"></i></div>
                        <div id="applymy_text">我的申请</div>
                    </div>
                </div>
            </li>
            <li>
                <div class="homeiconss">
                    <div class="div00"><span style="display:none" class="badge red"></span>
                    </div>
                    <div style="background-color:#888888" class="homeiconss2">
                        <div class="div01"><i class="glyphicon glyphicon-refresh"></i></div>
                        <div id="refresh_text">175秒后刷新</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    var getWindowSize = function () {
        return ["Height", "Width"].map(function (name) {
            return window["inner" + name] ||
                document.compatMode === "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ]
        });
    }

    window.onload = function () {
        if (!+"\v1" && !document.querySelector) { // for IE6 IE7
            document.body.onresize = resize;
        } else {
            window.onresize = resize;
        }
        function resize() {
            setHeight();
            return false;
        }
    }

    setHeight()

    function setHeight(){
        var str = getWindowSize();
        strs = str.toString().split(","); //字符分割
        var heights = strs[0]-20, Body = $('body');
        $('#heightBody').height(heights);
        var openClose = $("#heightBody").height() + 39;
        $("#heightBody").css("height", openClose);
    }
</script>