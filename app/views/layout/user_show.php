<h3>ユーザアカウント詳細</h3>
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
<a class="a-btn" href="<?=$_app_root_ ?>/u/delete?id=<?= $user['uid'] ?>">削除</a>