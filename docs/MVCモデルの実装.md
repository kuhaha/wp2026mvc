### MVCモデル実装の詳細

#### モデル：

- `app/models/Model.php`：**モデルの基礎となるクラス**。データベース接続、基本的なＣＲＵＤ処理等を実現している。

  - `__construct($conf)`：データベース接続情報を引数にモデルを初期化するコンストラクタ。

  - `query($sql)`：問い合わせのSQL文を実行し、結果を配列として返すメソッド。

  - `excute($sql, $where)`：更新のためのSQL文を実行し、影響を受けた行数を返すメソッド。

  - `getList($where, $orderby, $limt, $offset)`：あるテーブルに対する問い合わせ結果を返すメソッド。

  - `getDetail($where)`：あるテーブルから一行のみを返すメソッド。

  - `insert($data)`：あるテーブルに1行のテータを追加するメソッド。

  - `delete($where)`：あるテーブルから条件を満たすデータを削除するメソッド。

  - `update($data, $where)`：あるテーブルの条件を満たすデータを更新するメソッド。

  - `insertID()`：直近自動生成されたIDの値を返すメソッド。

  - `sanitize($string)`：文字列をサニタイズ（無害化）するメソッド。攻撃に使われそうな文字を無害化する。

- `app/models/UserModel.php`：**ユーザアカウントを管理するクラス**。`Model`クラスを継承しモデルの基本機能が使える。

  - `auth($uid, $passwd)`：パスワード照合を行うメソッド。

#### コントローラー

- `app/controllers/Conroller.php`：**コントローラーの基礎となるクラス**。
  - `__construct($model, $view)`：モデルクラス`$model`とビュークラス`$view`を引数にコントローラーを初期化するコンストラクタ。
  - `errorAction($msg)`：すべてコントローラーで共通するアクションメソッド。エラーメッセージを出力する。
- `app/controllers/UserController.php`：ユーザアカウントに関する機能を利用可能にするクラス。
  - `homeAction()`：ホームページを表示するアクション。
  - `loginAction()`：ログイン画面を表示するアクション。
  - `authAction()`：パスワード照合を行うアクション。
  - `logoutAction()`：ログアウトを行うアクション。
  - `listAction()`：アカウントを一覧するアクション。
  - `showAction()`：アカウント詳細を表示するアクション。
  - `editAction()`：アカウントの編集画面を表示するアクション。
  - `saveAction()`：編集結果を保存するアクション。
  - `deleteAction()`：削除を確認するアクション。
  - `deletedAction()`：削除を確定するアクション。

#### ビュー

- `app/views/View.php`：
  - `__contruct($base)`：プロジェクト・ホームディレクトリ`$base`を引数にビューを初期化するコンストラクタ。
  - `render($layout, $data)`：画面レイアウトを元に、`$data`を使って画面を生成する。
  - `redirect($url)`：引数の**URL**へ画面を転送する。 URLは以下のパターンに従う。
    - 「`/クラスID/アクション/`」、「`/クラスID/アクション`」、「`/クラスID/アクション/?key=val`」、「`/クラスID/アクション?key=val`」
    - 例：`/u/list/`または、`/u/list`、`/u/edit/?id=s0001`または、`/u/edit?id=s0001`
  - `share($var, $value)`：画面レイアウトに共通の変数をシェアする。
- `app/views/UserView.php`：
- `app/views/layout`フォルダ：
  - `bs5_page_header.php`：
  - `bs5_page_footer.php`：
  - `page_header.php`：
  - `page_footer.php`：
  - `msg_error.php`：エラーメッセージを表示する画面。
  - `msg_confirm.php`：メッセージを表示して確認を行う画面。承認されたら次のアクションを起こす。
  - `user_login.php`：ログイン画面。
  - `user_list.php`：アカウント一覧画面。
  - `user_show.php`：アカウント詳細画面。
  - `user_edit.php`：アカウント編集画面。
