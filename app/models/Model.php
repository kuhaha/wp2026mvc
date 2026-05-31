<?php
// $table変数が未定義のため、abstractをつけてインスタンスが生成できないようにする
abstract class Model
{
   // データベース接続やCRUD操作 
   private $db;
   protected $table;

   const CODES = [
      'uroles' => [ 1=>'学生', 2=>'教員', 9=>'管理者'],
      'sex' => [ 0=>'不詳', 1=>'男', 2=>'女', ],
    ]; 

   public function __construct(array $conf)
   {
      $db = new mysqli($conf['host'],$conf['user'],$conf['passwd'],$conf['dbname']);
      if ($db->connect_errno) {
         die($db->connect_error);
      }
      $db->set_charset('utf8mb4');
      $this->db = $db;
   }

   // 各種コードの定義を返す。
   // 引数$nameは、コードの種別名。例：'urole', 'sex'。
   public static function getCodeDef(string $name): array
   {
      return self::CODES[$name] ?? [];
   }

   // 問い合わせ類SQL文を実行（特定のテーブルに依存しない）
   public function query(string $sql): array
   {
      $rs = $this->db->query($sql);
      return $rs ? $rs->fetch_all( MYSQLI_ASSOC) : [];
   } 
   // 更新類SQLを実行（特定のテーブルに依存しない）
   public function excute(string $sql): int
   {
      $ok = $this->db->query($sql);
      return $ok ? $this->db->affected_rows : -1;
   }

   // 直近自動生成されたIDの値を返す
   public function insertId(): int
   {
      return $this->db->insert_id;
   }

   // 一覧用データを検索する（特定のテーブルを対象とする） 
   public function getList(string $where='1', string $orderby='', int $limit=0, int $offset=0): array
   {
      $sql = "SELECT * FROM %s WHERE %s";
      $sql = sprintf($sql, $this->table, $where);
      $sql .= $orderby ? " ORDER BY {$orderby}" : '';
      $sql .= $limit>0 ? " LIMIT {$limit} OFFSET {$offset}" : '';
      return $this->query($sql);
   }

   // 詳細データを1行検索する（特定のテーブルを対象とする）   
   public function getDetail(string $where): array
   {
      $sql = "SELECT * FROM %s WHERE %s";
      $sql = sprintf($sql, $this->table, $where);
      $rs = $this->db->query($sql);
      return $rs->fetch_assoc() ?? [];
   }

   // 条件を満たすデータを削除する（特定のテーブルを対象とする）
   public function delete (string $where): int
   {
      $sql = "DELETE FROM %s WHERE %s";
      $sql = sprintf($sql, $this->table, $where);
      return $this->excute($sql);
   }

   // 1行のデータを追加する（特定テーブルを対象とする）
   public function insert (array $data): int
   {
      $fields = $values = [];
      foreach ($data as $key=>$value){
         $fields[] = $key;
         $values[] = is_numeric($value) ? $value : "'{$value}'";
      }
      $fields = implode (',', $fields); 
      $values = implode (',', $values);
      $sql = "INSERT INTO %s (%s) VALUES (%s)";
      $sql = sprintf($sql, $this->table, $fields, $values);
      return $this->excute($sql);
   }

   // データを更新する（特定のテーブルを対象とする）
   public function update (array $data, string $where): int
   {
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
   // 文字列をサニタイズ（無害化）する
   public function sanitize(string $str): string
   {
      return htmlspecialchars($str);
   }

}
