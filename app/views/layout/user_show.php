<h3>ユーザアカウント詳細</h3>
<table>
    <tr>
        <td width="20%">ユーザID</td><td><?= $user['uid']?></td>
    </tr>
    <tr>
        <td>氏名</th><td><?= $user['uname'] ?></td>
    </tr>
    <tr>
        <td>ユーザ種別</td><td><?= $user['urole_name'] ?></td>
    </tr>
</table>
<a class="a-btn bg-primary" href="<?=$_appRoot_ ?>/u/edit?id=<?= $user['uid'] ?>">編集</a>
<a class="a-btn bg-warning" href="<?=$_appRoot_ ?>/u/delete?id=<?= $user['uid'] ?>">削除</a>
