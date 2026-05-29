

```html
<button class="open-modal open-btn" data-modal="1">遵守事項</button>
<button class="open-modal open-btn" data-modal="2">削除</button>

<!-- モーダル本体 -->
<!--- メッセージ表示用モーダルウィンドウ--->
<div class="modal" id="modal-1">
    <div class="modal-content">
        <button class="close-btn" data-modal="1">
            &times;
        </button>
        <h3>レンタル機材借用際の遵守事項</h3>
        (1) 他部所間の又貸しを禁止します。(2) 申請された貸出日の当日朝9時以降に機材の受取をお願いします。(3) 申請された貸出日を２日過ぎますと、自動的にキャンセルされます。その場合は、再度申請してください。(4) 返却期日は必ず厳守してください。
    </div>
</div>

<div class="modal" id="modal-2">
    <div class="modal-content">
        <button class="close-btn" data-modal="2">
            &times;
        </button>
        <h3>削除確認</h3>
        <p>この項目は本当に削除しますか？</p>
        <a class="ok-btn" href="/u/deleted?id=s00xx">OK</a>
    </div>
</div>

<!-- モーダル本体 -->
<script type="text/javascript" src="<?= $_app_root_ ?>/js/modal-window.js"></script>
``` 