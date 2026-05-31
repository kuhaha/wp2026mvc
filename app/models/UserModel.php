<?php
require_once 'Model.php';

class UserModel extends Model
{
   protected $table = 'tbl_user';

   public function auth(string $uid, string $passwd): array
   {
      $safe_uid = $this->sanitize($uid);
      $safe_passwd = $this->sanitize($passwd);
      $where = "uid='{$safe_uid}' AND upass='{$safe_passwd}'";
      return $this->getDetail($where);
   }

}
