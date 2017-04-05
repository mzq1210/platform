<?php
use yii\helpers\Url;
use common\components\Tools;
use common\widgets\GoLinkPager;
?>

<link href="/css/form.css" rel="stylesheet">

<div class="search-nav">
    <form class="form-inline" action="<?= Url::toRoute('/sys/log/index') ?>" method="get" id="myform">
        <div class="form-group input-group-sm">
            <label for="txtName">操作类型：</label>
            <select class="form-control" name="type">
                <option value="">-操作类型-</option>
                <option <?php if (isset($params['type']) && $params['type'] == 1) echo 'selected="selected"' ?>
                    value="1">添加
                </option>
                <option <?php if (isset($params['type']) && $params['type'] == 2) echo 'selected="selected"' ?>
                    value="2">更新
                </option>
                <option <?php if (isset($params['type']) && $params['type'] == 3) echo 'selected="selected"' ?>
                    value="3">删除
                </option>
                <option <?php if (isset($params['type']) && $params['type'] == 4) echo 'selected="selected"' ?>
                    value="4">登陆
                </option>
            </select>
        </div>

        <div class="form-group input-group-sm">
            <label for="txtName">开始日期：</label>
            <div class='input-group date'>
                <input type='text' class="form-control start_date" name="start_date"
                       value="<?php echo isset($params['start_date']) ? $params['start_date'] : ''; ?>"
                       placeholder="开始日期"/>
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
            </div>
        </div>

        <div class="form-group input-group-sm">
            <label for="txtName">截止日期：</label>
            <div class='input-group date'>
                <input type='text' class="form-control end_date" name="end_date"
                       value="<?php echo isset($params['end_date']) ? $params['end_date'] : ''; ?>"
                       placeholder="截止日期"/>
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
            </div>
        </div>
        <div class="form-group input-group-sm">
            <label for="txtName">用户名：</label>
            <input class="form-control ipt" id="txtName" placeholder="输入用户名" name="operator" value="<?php echo isset($params['operator']) ? $params['operator'] : ''; ?>">
        </div>
        <button class="btn btn-default" id="btnSearch" type="submit"><i class="glyphicon glyphicon-search"></i> 查询</button>
        <button class="btn btn-default" type="button" id="doButton"><i class="glyphicon glyphicon-trash"></i> 删除30天以前的日志</button>
    </form>
</div>

<table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
    <tr>
        <th>序号</th>
        <th>模块名</th>
        <th>路由</th>
        <th>操作类型</th>
        <th>操作用户</th>
        <th>操作IP</th>
        <th>操作时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php $num = 0 ?>
    <?php if (!empty($info['data'])): ?>
        <?php foreach ($info['data'] as $val): ?>
            <?php $num++; ?>
            <tr>
                <td><?php echo $params['pageSize'] * ((isset($_GET['page']) ? $_GET['page'] : 1) - 1) + $num; ?></td>
                <td><?= $val->module; ?></td>
                <td><?= $val->route; ?></td>
                <td><?php echo $val->type == 1 ? '添加' : ($val->type == 2 ? '更新' : ($val->type == 3 ? '删除' : '登陆')); ?></td>
                <td><?= $val->username->username; ?></td>
                <td><?= $val->ip; ?></td>
                <td><?= $val->add_time; ?></td>
                <td>
                    <a class="btn btn-success button"
                       href="javascript:Dialog('info','操作详情', '<?= Url::toRoute(['/sys/log/detail', 'id' => $val->id]); ?>', 800, 500, true)"><i
                            class="glyphicon glyphicon-zoom-in"></i> 查看</a>
                    <a class="btn btn-danger button"
                       href="javascript:confirmurl('<?= Url::toRoute(['/sys/log/delete', 'id' => $val->id]); ?>', '确定要刪除吗?')"><i
                            class="glyphicon glyphicon-trash"></i> 删除</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<div class="pull-right">
<?php echo GoLinkPager::widget(['pagination' => $info['pages']]); ?>
</div>
<!--<script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.zh-CN.min.js"></script>
<link rel="stylesheet" href="/css/bootstrap-datetimepicker.css">-->
<script type="text/javascript" src="/jedate/jedate.js"></script>
<script type="text/javascript">
    //日期插件
    var myDate = new Date();
    var monthStr = myDate.getMonth()+1;
    var dateStr = myDate.getFullYear() +'-'+ monthStr + '-' + myDate.getDate() + " 23:59:59";

    $(function () {
        jeDate({
            dateCell: '.start_date',
            isinitVal:false,
            format: 'YYYY-MM-DD', // 分隔符可以任意定义，该例子表示只显示年月
            minDate: '2010-06-01', //最小日期
            maxDate: dateStr, //最大日期
            festival: true, //显示节日
        });
        jeDate({
            dateCell: '.end_date',
            isinitVal:false,
            format: 'YYYY-MM-DD', // 分隔符可以任意定义，该例子表示只显示年月
            minDate: '2010-06-01', //最小日期
            maxDate: dateStr, //最大日期
            festival: true, //显示节日
        });
        $('#doButton').on('click',function(){
            confirmurl('<?= Url::toRoute(['/sys/log/deletelog']); ?>', '确定要刪除吗?')
        })
    })
</script>