<?php
$conf = require('conf/config.inc.php');

/** 
 リクエストを解析し、MVCモデル構築に必要な情報を抽出する。
 例：http://localhost/wp2026mvc/u/edit/?id=2
*/
$base = dirname($_SERVER['PHP_SELF']); // プロジェクト・ホームフォルダ, 例：/wp2026mvc
$request = $_SERVER['REQUEST_URI'];    // リスクエスの絶対パス, 例：/wp2026mvc/u/edit/?id=2
$relative = substr($request, strlen($base));//リスクエスの相対パス /u/edit/?id=2

//クラスとアクションを抽出する
$defaults = $conf['mvc']['defaults'];
$classes =  $conf['mvc']['classes'];
$parts = explode('/', $relative);   //　'/'で区切る部分を抽出する。例：['',u,'edit','?id=2']
$c = $parts[1] ?? $defaults['c'];   // 一文字のクラスIDを抽出する。例：u
$class = $classes[$c] ?? $defaults['class']; // クラスのフルネームを特定する。例：User
$action = $parts[2] ?? $defaults['action'];  // アクションを抽出する。例：list
$args = $_GET; // 引数を取得する。例：['id'=>2]

/** 
 解析結果をもとに、MVCモデルを構築する。
*/
$app_dir = 'app';
$model_dir = "{$app_dir}/models";
$view_dir  = "{$app_dir}/views";
$ctrl_dir  = "{$app_dir}/controllers";

// モデルmodel
include "{$model_dir}/{$class}Model.php";
$modelClass = "{$class}Model";
$model = new $modelClass($conf['db']);

// ビューview
include "{$view_dir}/{$class}View.php";
$viewClass = "{$class}View";
$view = new $viewClass($base);
$view->share('_app_name_', $conf['app']['name']);

//コントローラーcontroller
include "{$ctrl_dir}/{$class}Controller.php";
$controllerClass = "{$class}Controller";
$controller = new $controllerClass($model, $view);
$actionFunc = "{$action}Action";

// アクションを呼び出す（dispatch）
if (method_exists($controller, $actionFunc)) {
    call_user_func_array([$controller, $actionFunc], $args);// メソッドを呼び出す。例：$controller->editAction(2);
} else {
    $controller->errorAction("{$actionFunc}()：未定義アクション！");
}
