<link rel="stylesheet" href="/css/table_form.css">
<div class="pad-lr-10" style="margin-top:10px;">
    <div class="table-list">
        <div class="common-form">
            <input type="hidden" name="info[userid]" value="5">
            <input type="hidden" name="info[username]" value="gfgsdg">
            <fieldset style="margin-bottom: 10px">
                <legend style="margin-top:10px; margin-bottom: 10px; font-size: 12px;">操作基本信息</legend>
                <table width="100%" class="table_form">
                    <tbody>
                    <tr>
                        <td width="120">路由</td>
                        <td><?=$info->route;?></td>
                    </tr>
                    <tr>
                        <td>操作类型</td>
                        <td><?php echo $info->type == 1 ? '添加' : ($info->type == 2 ? '更新' : ($info->type == 3 ? '删除' : '登陆'));?></td>
                    </tr>
                    <tr>
                        <td>操作时间</td>
                        <td><?=$info->add_time;?></td>
                    </tr>
                   <!-- <tr>
                        <td>操作人</td>
                        <td>sdfdsf</td>
                    </tr>-->
                    <tr>
                        <td>IP</td>
                        <td><?=$info->ip;?></td>
                    </tr>
                    </tbody></table>
            </fieldset>
            <div class="bk15"></div>
            <fieldset>
                <legend style="margin-top:10px; margin-bottom: 10px; font-size: 12px;">日志描述</legend>
                <table width="100%" class="table_form">
                    <tbody>
                    <tr>
                        <td colspan="2">
                            <?=$info->desc;?>
                        </td>
                    </tr>
                    </tbody></table>
            </fieldset>
        </div>
        <div class="bk15"></div>
        <input type="button" style="display: none" class="dialog" name="dosubmit" id="dosubmit" onclick="window.top.art.dialog({id:'info'}).close();">
    </div>
</div>