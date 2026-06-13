<h3>ユーザアカウント一覧</h3>
<table>
    <tr>
        <th><a href="<?= $appRoot ?>/u/sort?order=uid">ユーザID</a></th>
        <th><a href="<?= $appRoot ?>/u/sort?order=uname">氏名</a></th>
        <th><a href="<?= $appRoot ?>/u/sort?order=urole">ユーザ種別</a></th>
        <th>操作</th>
    </tr>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user['uid'] ?></td>
            <td><?= $user['uname'] ?></td>
            <td><?= $user['urole_name'] ?></td>
            <td>
                <a class="a-btn" href="<?= $appRoot ?>/u/show?id=<?= $user['uid'] ?>">詳細</a>
            </td>
        </tr>
    <?php } ?>
</table>