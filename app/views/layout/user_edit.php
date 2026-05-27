<h3>ユーザアカウント編集</h3>
<form action="/u/auth" method="post">
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
        <td>パスワード確認</th><td><input type="password" name="upass"></td>
    </tr>
    <tr>
    <tr>
    <tr>
        <td>ユーザ種別</td>
        <td>
            <?php foreach ($uroles as $key=>$value) { ?>
            <?php $checked = $key==$user['urole'] ? 'checked' : '' ?>
            <input type="radio" name="urole" value="<?= $key ?>" <?=$checked  ?>><?= $value ?>
            <?PHP } ?> 
        </td>
    </tr>
</table>
<input type="submit" name="保存">
<input type="reset" value="取消">
</form>