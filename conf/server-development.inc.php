<?php

// 開発環境のサーバー設定
return [
    // docker-lampp84を使用する場合
    'db' => [ // データベースサーバーの接続情報
        'host'   => 'mysql',
        'user'   => 'root',
        'passwd' => 'root',
        'dbname' => 'wp2026db',
    ], 

    // xamppを使用する場合
    /**
    'db' => [ // データベースサーバーの接続情報
        'host'   => 'localhost',
        'user'   => 'root',
        'passwd' => '',
        'dbname' => 'wp2026db',
    ], 
    */
];