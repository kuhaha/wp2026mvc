<?php

return [
    'app' => [
        'name' => '教育プログラム配属Webシステム2026',
        'version' => '1.0.1',
        'released' => '2026-5-12',
        'developer'=> 'hoge@qmail.com',

        'survey_start' => '2027-3-1 10:00:00',
        'survey_end' => '2027-3-28 18:00:00',
    ],

    'mvc'=> [
        'classes'=> [// MVCクラス：クラスID=>クラス名
            'u' => 'User',    //アカウント  
            's' => 'Student', //学生 
            'p' => 'Program', //教育プログラム
            'w' => 'Wish',    //希望
        ],

        'actions' => [//有効なアクション
            'home',   // ホーム
            'list',   // 一覧
            'show',   // 詳細
            'edit',   // 編集
            'save',   // 保存
            'delete', // 削除確認
            'deleted',// 削除実行
            'register',   // 希望登録（画面）
            'registered', // 希望保存（DB保存）
            'decide',  // 配属先登録（画面）
            'decided', // 配属先保存（DB保存）
            'summary', // 集計
            'noentry', // 未登録者
            'auth',   // 認証
            'login',  // ログイン
            'logout', // ログアウト
        ],

        'defaults' => [
            'c' => 'u', //デフォルトのクラスID
            'class' => 'User', //デフォルトのクラス名
            'action' => 'home',//デフォルトのアクション
        ],
    ],

    'menu'=> [//トップメニュー
        0 => [  // 未ログイン時
            //'ユーザ登録' => '/u/register',
            'ログイン' => '/u/login',
        ],
        1 => [   //学生メニュー
            '成績・配属結果確認' => '/s/show',
            '希望登録' => '/w/register',
            'ログアウト' => '/u/logout',
        ],
        2 => [   //教員メニュー
            '希望一覧・配属決定'  => '/w/list',
            '未登録者' => '/w/noentry',
            '希望集計' => '/w/summary',
            'ログアウト' => '/u/logout',
        ],
        9 => [   //管理者メニュー
            'アカウント' => '/u/list',
            '対象学生' => '/s/list',
            '教育プログラム' => '/p/list',
            'ログアウト' => '/u/logout',
        ]
    ]   
];
