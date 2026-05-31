<form action="<?= $_appRoot_ ?>/u/auth" method="post">
<table>
<tr><td width="20%">ユーザ名：</td><td><input type="text" name="uid" placeholder="uid"></td></tr>
<tr><td>パスワード：</td><td><input type="password" name="upass"  placeholder="upass"></td></tr>
</table>
<input type="submit" value="ログイン"><input type="reset" value="取消">
</form>