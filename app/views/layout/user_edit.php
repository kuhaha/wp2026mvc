<h3>ユーザアカウント編集</h3>
<form action="<?= $_app_root_ ?>/u/save" method="post">
<input type="hidden" name="act" value="<?= $act ?>">
<table>
    <tr>
        <td width="20%">ユーザID</td><td><input type="text" name="uid" value="<?= $user['uid']?>"></td>
    </tr>
    <tr>
        <td>氏名</th><td><input type="text" name="uname" value="<?= $user['uname'] ?>"></td>
    </tr>
    <tr>
        <td>パスワード</th><td><input type="password" name="upass"></td>
    </tr>
    <tr>
        <td>パスワード確認</th><td><input type="password" name="upass2"></td>
    </tr>
    <tr>
        <td>ユーザ種別</td>
        <td>
<?php echo HtmlHelper::radio($uroles, 'urole', $user['urole']);?>
        </td>
    </tr>
</table>
<input type="submit" name="保存">
<input type="reset" value="取消">
</form>