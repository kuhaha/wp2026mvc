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

   public function render($layout, $data=[])
   {
      include 'HtmlHelper.php';      
      ob_start(); //バッファをオンにして画面出力を一時保留する

      // 連想配列から展開し変数として利用可能にする。
      // 例：$vars=['foo'=>'hello', 'pi'=>3.14]; extract($vars);
      // 実行後、変数$fooと$piが使えるようになり、それぞれ'hello'と3.14が入っている

      extract($data); // 画面ごとに必要なデータを展開。例えば、表示用データ
      extract($this->shared_vars);  // 複数画面共通のデータを展開。例えば、システム名、ユーザ名

      include "layout/page_header.php";
      include "layout/{$layout}.php";
      include "layout/page_footer.php";

      ob_end_flush(); //出力用バッファをフラッシュする
   }
   
   public function redirect(string $url)
   {
      $real_url = $this->url_base . DIRECTORY_SEPARATOR . ltrim($url, DIRECTORY_SEPARATOR);
      header("Location:{$real_url}");
   }
}
