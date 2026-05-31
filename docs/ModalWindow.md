## Modal Window - モーダルウィンドウ（ダイアログ）

モーダルウィンドウとは、開いている画面の上に重ねて表示される子ウィンドウ（ダイアログ）のこと。表示中は背景の操作が制限され、ウィンドウ内で何らかのアクションを完了（またはキャンセル）するまで元の画面に戻れないのが特徴である。

**主な使い方**
1. **警告や確認**: データの削除や購入手続きなど、取り返しのつかない操作の前に「本当に実行しますか？」と確認を促す。
2. **エラー通知**: 処理に失敗した際、ユーザーに即座に原因を伝える。情報の強制表示: 利用規約の同意画面や、サイトの重要なお知らせなど。

使い方例は、`app/views/layout/user_show-modal.php`を参照してください。

**モーダルウィンドウを実現するプログラムやCSSについて**
1. JavaScriptコード(ボタンクリック後の処理)は、`js/modal-window.js`
2. スタイルシート（ボタンや背景の色等）は`css/modal.css`

を参照してください。


```html

<!--
モーダルボタン：モーダルウィンドウを開くボタン（同じページに複数使用可能）
data-modal="ID"のIDは数字でなくでもよいが、一意性を保つ必要がある。
モーダル本体にあるid="modal-ID"、閉じるボタンdata-modal="ID"と同じものでないといけない
-->
<button class="open-modal open-btn" data-modal="1">通知</button>
<button class="open-modal open-btn" data-modal="2">確認</button>

<!-- ここからモーダル本体 -->
<!--- 通知用モーダルウィンドウ--->
<div class="modal" id="modal-1">
    <div class="modal-content">
        <button class="close-btn" data-modal="1">
            &times;
        </button>
        <h3>通知用モーダルウィンドウ</h3>
        レンタル機材は 他部所間の又貸しを禁止します。申請された貸出日の当日朝9時以降に機材の受取をお願いします。申請された貸出日を２日過ぎますと、自動的にキャンセルされます。その場合は、再度申請してください。また、返却期日は必ず厳守してください。
    </div>
</div>
<!--- 確認用モーダルウィンドウ--->
<div class="modal" id="modal-2">
    <div class="modal-content">
        <button class="close-btn" data-modal="2">
            &times;
        </button>
        <h3>確認用モーダルウィンドウ</h3>
        <p>この項目は本当に削除しますか？</p>
        <a class="ok-btn" href="<?=$_app_root_?>/u/deleted?id=s00xx">OK</a>
    </div>
</div>
<!-- ここまでモーダル本体 -->

<!-- モーダルウィンドウを実現するJavaScriptコード--> 
<script type="text/javascript" src="<?= $_app_root_ ?>/js/modal-window.js"></script>
``` 