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
<a class="a-btn bg-primary" href="<?= $appRoot ?>/u/edit?id=<?=$user['uid']?>">編集</a>
<button class="open-modal open-btn" data-modal="del">削除</button>
<!-- モーダル本体 -->
<div class="modal" id="modal-del">
    <div class="modal-content">
        <button class="close-btn" data-modal="del">
            &times;
        </button>
        <h3>削除確認</h3>
        <p>ユーザ「<?= $user['uname'] ?>」（<?= $user['uid'] ?>）」を完全に削除します。<br/>続けてもよろしいでしょうか？</p>
        <a class="ok-btn" href="<?= $appRoot ?>/u/deleted?id=<?= $user['uid'] ?>">OK</a>
    </div>
</div>
<!-- モーダルの処理を実施するスクリプト -->
<script type="text/javascript" src="<?= $appRoot ?>/js/modal-window.js"></script>