<?php
use yii\helpers\Url;

?>
<div class="pad_10">
    <div class="common-form">
        <table width="100%" class="table_form contentWrap">
            <tr>
                <th width="100">用户名：</th>
                <td><?= $user->username ?></td>
            </tr>
            <tr>
                <th>最后登陆时间：</th>
                <td><?= $user->userInfo->login_time ?></td>
            </tr>
            <tr>
                <th>最后登陆IP：</th>
                <td><?= $user->userInfo->ip ?></td>
            </tr>
            <tr>
                <th width="100">真实姓名：</th>
                <td><?= $user->realname ?></td>
            </tr>
            <tr>
                <th width="100">手机号：</th>
                <td><?= $user->mobile ?></td>
            </tr>
            <tr>
                <th width="100">所属站点：</th>
                <td><?= $siteName ?></td>
            </tr>
            <tr>
                <th width="100">组织结构：</th>
                <td><?= $deptName ?></td>
            </tr>
            <tr>
                <th width="100">状态：</th>
                <td><?= $user->status == 1 ? '禁用' : '启用' ?></td>
            </tr>
        </table>
    </div>
</div>
