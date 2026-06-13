<h3>ユーザアカウント一覧</h3>
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
<!--ページネーション-->
<ul class="pagination">
<?php for ($p = 1; $p <= $pages; $p++ ) { ?>
    <li>
    <a href="<?= $appRoot ?>/u/page?n=<?= $p ?>" 
        <?= $p==$page ? 'aria-current="page"' : '' ?>
        ><?= $p ?>
    </a>
    </li>
<?php } ?>
</ul>
<!--ページネーション-->