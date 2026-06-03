<style>
.my-card {
    display: flex;                 /* 横並びにする */
    justify-content: flex-start;    /* 左寄せ */
    gap: 10px;                     /* 要素間の余白 */
}
.box {
    padding: 10px 20px;
    border-bottom: 1px solid #999393;
}
</style>

<h3>画像付きユーザアカウント一覧</h3>

<?php foreach ($users as $i=>$user) { ?>
    <div class="my-card">
        <div class="box">
            <img src="<?= $appRoot ?>/img/<?= $user['uid'] ?>.png" height="120">  
        </div>
        <div class="box">
            <?= $user['uid'] ?><br>
            <?= $user['uname'] ?><br>
            <?= $user['urole_name'] ?><br>
            <a class="a-btn" href="<?= $appRoot ?>/u/show?id=<?= $user['uid'] ?>">詳細</a>
        </div>
    </div>    
<?php } ?>
</table>