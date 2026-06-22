<form action="<?= $appRoot ?>/u/auth" method="post" class="form">
<table class="table table-hover">
<tr><td width="20%">ユーザ名：</td><td><input type="text" name="uid" placeholder="uid" class="form-control"></td></tr>
<tr><td>パスワード：</td><td><input type="password" name="upass"  placeholder="upass" class="form-control"></td></tr>
</table>
<input type="submit" value="ログイン" class="btn btn-primary"><input type="reset" value="取消" class="btn btn-danger">
</form>