<h3>ユーザアカウント詳細</h3>
<form action="<?= $_app_root_ ?>/u/save" method="post">
<table>
    <tr>
        <td width="20%">ユーザID</td><td><?= $user['uid']?></td>
    </tr>
    <tr>
        <td>氏名</th><td><?= $user['uname'] ?></td>
    </tr>
    <tr>
        <td>ユーザ種別</td><td><?= $user['urole'] ?></td>
    </tr>
</table>