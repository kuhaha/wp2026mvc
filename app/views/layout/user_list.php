<h3>ユーザアカウント一覧</h3>
<table>
    <tr>
        <th>ユーザID</th>
        <th>氏名</th>
        <th>ユーザ種別</th>
    </tr>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user['uid'] ?></td>
            <td><?= $user['uname'] ?></td>
            <td><?= $user['urole_name'] ?></td>
        </tr>
    <?php } ?>
</table>