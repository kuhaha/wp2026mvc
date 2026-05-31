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
<button class="open-modal open-btn" data-modal="delete">削除</button>
<!-- モーダル本体 -->
<div class="modal" id="modal-delete">
    <div class="modal-content">
        <button class="close-btn" data-modal="delete">
            &times;
        </button>
        <h3>削除確認</h3>
        <p>ユーザ<?= $user['uname'] ?>（<?= $user['uid']?>）を本当に削除しますか？</p>
        <a class="ok-btn" href="<?= $_appRoot_ ?>/u/deleted?id=<?= $user['uid'] ?>">OK</a>
    </div>
</div>
<!-- モーダルの処理を実施するスクリプト -->
<script type="text/javascript" src="<?= $_appRoot_ ?>/js/modal-window.js"></script>