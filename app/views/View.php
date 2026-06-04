<?php
class View
{
   private string $app_root = '';
   private array $shared_vars = [];

   function __construct(string $base)
   {
      $this->app_root = rtrim($base, '/');
      // $this->shared_vars['appRoot'] = $this->app_root;
   }

   /**  複数の画面間に共通する変数を定義する。
    * 引数：string  $var - 変数名となる文字列。mixed $value - 変数の値。
    *   他の変数名と被らないように、camelCaseに統一する 
   */       
   public function share(string $var, mixed $value)
   {
      $this->shared_vars[$var] = $value;
   }

   public function render(string $layout, array $data=[]): void
   {
      include 'TagHelper.php';      
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

   // 相対パス（例「u/edit/?id=s0003」）から絶対パスへ変換（例えば、「/wp2026mvc/u/edit/?id=s00xx」）
   public function at(string $relative_url): string
   {
      return  $this->app_root . '/' . ltrim($relative_url, '/');

   } 
   public function redirect(string $url): void
   {
      $real_url = $this->at($url);
      header("Location:{$real_url}");
   }
}
