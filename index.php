<?php
session_start();

//アプリケーション全体の設定ファイルを読み込む
$conf = require('conf/config.inc.php');

//サーバー別の設定ファイルを読み込む。必要に応じて、片方をコメントアウトして下さい
//$server = require('conf/server-development.inc.php');  //開発用サーバーを使用する場合
$server = require('conf/server-deployment.inc.php');//公開用サーバーを使用する場合

require "app/Dispatcher.php";
$dispatcher = new Dispatcher($conf, $server);
$dispatcher->run();