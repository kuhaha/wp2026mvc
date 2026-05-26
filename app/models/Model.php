<?php
// $table変数が未定義のため、abstractをつけてインスタンスが生成できないようにする
abstract class Model
{
   // データベース接続やCRUD操作 
   private $db;
   protected $table;

   public function __construct($conf)
   {
      $db = new mysqli($conf['host'],$conf['user'],$conf['passwd'],$conf['dbname']);
      if ($db->connect_errno) {
         die($db->connect_error);
      }
      $db->set_charset('utf8mb4');
      $this->db = $db;
   }

   // 問い合わせ類SQL文実行（汎用）
   public function query($sql){
      $rs = $this->db->query($sql);
      return $rs ? $rs->fetch_all( MYSQLI_ASSOC) : [];
   } 
   // 更新類SQLの実行（汎用）
   public function excute($sql){
      $ok = $this->db->query($sql);
      return $ok ? $this->db->affected_rows : -1;
   }

   public function insertId(){
      return $this->db->insert_id;
   }

   // 特定テーブルから一覧用データを検索する 
   public function getList($where=1, $orderby='', $limit=0, $offset=0){
      $sql = "SELECT * FROM %s WHERE %s";
      $sql = sprintf($sql, $this->table, $where);
      $sql .= $orderby ? " ORDER BY {$orderby}" : '';
      $sql .= $limit>0 ? " LIMIT {$limit} OFFSET {$offset}" : '';
      return $this->query($sql);
   }

   // 特定テーブルからデータを1行検索する   
   public function getDetail($where){
      $sql = "SELECT * FROM %s WHERE %s";
      $sql = sprintf($sql, $this->table, $where);
      $rs = $this->db->query($sql);
      return $rs ? $rs->fetch_assoc() : [];
   }

   // 特定テーブルから条件を満たすデータを削除する
   public function delete ($where){
      $sql = "DELETE * FROM %s WHERE %s";
      $sql = sprintf($sql, $this->table, $where);
      return $this->excute($sql);
   }

   // 特定テーブルにデータを1行追加する
   public function insert ($data){
      $fields = $values = [];
      foreach ($data as $key=>$value){
         $fields[] = $key;
         $values[] = is_numeric($value) ? $value : "'{$value}'";
      }
      $fields = implode (',', $fields); 
      $values = implode (',', $values);
      $sql = "INSERT INTO %s (%s) VALUES (%s)";
      return $this->excute($sql);
   }

   // 特定テーブルを更新する
   public function update ($data, $where){
      $values = [];
      foreach ($data as $key=>$value){
         $value = is_numeric($value) ? $value : "'{$value}'";
         $values[] = "{$key}={$value}";
      }
      $set_values = implode (',', $values);
      $sql = "UPDATE %s SET %s WHERE %s";
      $sql = sprintf($sql, $this->table, $set_values, $where);
      return $this->excute($sql);
   }

}
