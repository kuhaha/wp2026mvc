<?php
return [
    'app' =>[
        'name' => '教育プログラム配属Webシステム2026',
        'version' => '1.0.1',
        'released' => '2026-5-12',
        'developer'=> 'hoge@qmail.com',

        'survey_start' => '2027-3-1',
        'survey_end' => '2027-3-28',
    ],

    'mvc'=>[
        'classes'=> [// MVCクラス：クラス略称=>クラス名
            'u' => 'User',    //アカウント  
            's' => 'Student', //学生 
            'p' => 'Program', //教育プログラム
            'w' => 'Wish',    //希望
        ],

        'actions' => [//有効なアクション
            'list',   // 一覧
            'show',   // 詳細
            'edit',   // 編集
            'save',   // 保存
            'delete', // 削除
            'register',  // 希望登録
            'decide', // 決定
            'login',  // ログイン
            'logout', // ログアウト
        ],

        'defaults' => [
            'c' => 'u', //デフォルトのクラス略称
            'class' => 'User', //デフォルトのクラス名
            'action' => 'list',//デフォルトのアクション
        ],
    ],
    
    'db'  =>[
        'host'   => 'mysql',
        'user'   => 'root',
        'passwd' => 'root',
        'dbname' => 'wp2026db',
    ], 


   
];
