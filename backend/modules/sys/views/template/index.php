<?php
use common\widgets\GoLinkPager;
?>

<!--日期所需文件-->
<link href="/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="/js/moment-with-locales.js"></script>
<script src="/js/bootstrap-datetimepicker.min.js"></script>
<link href="/css/form.css" rel="stylesheet">

<!--提示信息-->
<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong>警告！</strong> 您没有权限访问！
</div>

<!--搜索导航-->
<div class="search-nav">
    <form class="form-inline" role="form" action="" method="get">
        <div class="form-group input-group-sm">
            <label for="txtName">用户名：</label>
            <input type="text" class="form-control ipt" id="txtName" placeholder="用户名" name="name" value="">
        </div>
        <div class="form-group input-group-sm">
            <label for="Select">选择站点：</label>
            <select id="Select" class="form-control">
                <option value="0">-选择站点-</option>
                <option value="" >站点001</option>
            </select>
        </div>
        <div class="form-group">
            <div class="input-group input-group-sm">
                <input id="calendar" class="form-control input-w-min" type="text" placeholder="选择日期">
                <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
            </div>
        </div>
        <div class="form-group input-group-sm">
            <select id="style" class="form-control" style="padding: 0px;width: 42px;">
                <option value="1">小</option>
                <option value="2">中</option>
                <option value="3">大</option>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i> 查询</button>
            <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-plus-sign"></i> 新增</button>
        </div>
        <div class="form-group input-group-sm">
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-tags"></span>&nbsp;标签
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation" class="dropdown-header">标签组</li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">标签1</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">标签2</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">标签3</a></li>
                </ul>
            </div>
        </div>
        <div class="form-group input-group-sm right">
            <button class="btn btn-default dropdown-toggle" data-toggle="modal" data-target=".bs-example-modal-lg" type="button" id="dropdownMenu1" data-toggle="dropdown">
                <span class="glyphicon glyphicon-cog"></span>
            </button>
        </div>
    </form>
</div>


<!--模态框-->
<!-- Large modal -->
<div class="modal fade bs-example-modal-lg">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">标题</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">确定</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--表格-->
<table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
    <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>手机号</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>admin</td>
            <td>18325632541</td>
            <td>
                <i class="status status-red"></i> <span class="font-red">状态 0</span></i>
                <i class="status status-green"></i> <span class="font-green">状态 0</span></i>
                <i class="status status-yellow"></i> <span class="font-yellow">状态 0</span></i>
                <i class="status status-blue"></i> <span class="font-blue">状态 0</span></i>
            </td>
            <td>
                <a onclick="Copy(this)" id="test" class="btn btn-success button" href="javascript:void(0);"><i class="glyphicon glyphicon-zoom-in"></i> 查看</a>
                <a class="btn btn-success button" href=""><i class="glyphicon glyphicon-plus-sign"></i> 添加子菜单</a>
                <a class="btn btn-success button" href=""><i class="glyphicon glyphicon-ok-sign"></i> 已授权</a>
                <a class="btn btn-warning button" href=""><i class="glyphicon glyphicon-cog"></i> 权限设置</a>
                <a class="btn btn-warning button" href=""><i class="glyphicon glyphicon-question-sign"></i> 未授权</a>
                <a class="btn btn-warning button" href=""><i class="glyphicon glyphicon-user"></i> 分配角色</a>
                <a class="btn btn-info button" href=""><i class="glyphicon glyphicon-edit"></i> 编辑</a>
                <a class="btn btn-primary button" href=""><i class="glyphicon glyphicon-random"></i> 导出</a>
                <a class="btn btn-primary button" href=""><i class="glyphicon glyphicon-comment"></i> 发送通知</a>
                <a class="btn btn-danger button" href=""><i class="glyphicon glyphicon-trash"></i> 删除</a>
                <a class="btn btn-danger button" href=""><i class="glyphicon glyphicon-ban-circle"></i> 禁止</a>
                <a class="btn btn-default button" href=""><i class="glyphicon glyphicon-remove-sign"></i> 取消</a>
                <div class="btn-group">
                    <button type="button" class="btn btn-info button"><span class="glyphicon glyphicon-cog"></span> 操作
                    </button>
                    <button type="button" class="btn btn-info button dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu pull-right min-w" role="menu">
                        <li><a href="javascript:"><i class="glyphicon glyphicon-chevron-left"></i> 分配</a></li>
                        <li><a href="javascript:"><i class="glyphicon glyphicon-chevron-right"></i> 归还</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:"><i class="glyphicon glyphicon-edit"></i> 编辑</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:"><i class="glyphicon  glyphicon-remove-circle"></i> 报废</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:"><i class="glyphicon glyphicon-info-sign"></i> 历史</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:"><i class="glyphicon glyphicon-trash "></i> 删除</a></li>
                    </ul>
                </div>
                <div class="dropdown" style="display: inline-block">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">更多<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="disabled">
                            <a href="javascript:;" disabled="disabled"><span>启动</span></a></li>
                        <li class=""><a href="javascript:;"><span>停止</span></a></li>
                        <li class=""><a href="javascript:;"><span>重启</span></a></li>
                        <li class=""><a href="javascript:;"><span>重置密码</span></a></li>
                        <li class=""><a href="javascript:;"><span>修改信息</span></a></li>
                        <li class=""><a href="javascript:;"><span>连接管理终端...</span></a></li>
                        <li class=""><a href="javascript:;" ><span>连接帮助</span></a></li>
                        <li class=""><a href="javascript:;"><span>安全组配置</span></a></li>
                        <li class=""><a href="javascript:;"><span>创建自定义镜像</span></a></li>
                        <li class=""><a href="javascript:;""><span>购买相同配置</span></a></li>
                    </ul>
                </div>
            </td>
        </tr>
    </tbody>
</table>

<!--分页-->
<div class="pull-right">
    <?php echo GoLinkPager::widget(['pagination' => $pages]);?>
</div>

<script type="text/javascript">
    //日历宽度
    $('#style').change(function () {
        var calendar = $('#calendar');
        var size = $(this).val();
        if(size == 2){
            calendar.removeClass().addClass('form-control input-w-middle');
        }else if(size == 3){
            calendar.removeClass().addClass('form-control input-w-max');
        }else{
            calendar.removeClass().addClass('form-control input-w-min');
        }
    });
</script>
