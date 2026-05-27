<?php
class View
{
   private $url_base = '';
   private $shared_vars = [];

   function __construct($base)
   {
      $this->url_base = rtrim($base, DIRECTORY_SEPARATOR);
      $this->shared_vars['_app_root_'] = $this->url_base;
   }

   public function share($var, $value)
   {
      $this->shared_vars[$var] = $value;
   }

   public function render(string $layout, array $data=[])
   {
      ob_start(); //バッファをオンにして出力をせず一時保存する
      // 連想配列から展開し変数として利用可能にする。
      // 例：$vars=['foo'=>'hello', 'pi'=>3.14]; extract($vars);
      // 実行後、変数$fooと$piが使えるようになり、それぞれ'hello'と3.14が入っている
      extract($data); // 画面ごとに必要なデータ。例えば、表示用データ
      extract($this->shared_vars);  // 複数画面共通のデータ。例えば、システム名、ユーザ名
      include "layout/pg_header.php";
      include "layout/{$layout}.php";
      include "layout/pg_footer.php";
      ob_end_flush(); //アクティブな出力用バッファをフラッシュ(まとめて出力)する
   }
   
   public function redirect(string $url)
   {
      $real_url = $this->url_base . DIRECTORY_SEPARATOR . ltrim($url, DIRECTORY_SEPARATOR);
      header("Location:{$real_url}");
   }
}
