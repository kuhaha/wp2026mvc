<h3>ユーザアカウント一覧</h3>
<form action="<?= $appRoot ?>/u/search" method="post">
<?= TagHelper::radio($uroles, 'urole', $urole) ?><br>
<input type="text" name="keywd" value="<?= $keywd ?>" placeholder="検索語入力">
<input type="submit" value="検　索">
</form>

<table>
    <tr>
        <th>ユーザID</th>
        <th>氏名</th>
        <th>ユーザ種別</th>
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