<?php

class Dispatcher
{
    private array $config;
    private string $model_dir;
    private string $view_dir;
    private string $ctrl_dir;
    private string $app_root;// プロジェクト・ホームディレクトリ, 例：/wp2026mvc

    function __construct(array $conf, array $server)
    {
        $this->config = $conf;
        $this->config['db'] = $server['db'];
        $this->model_dir = "models";
        $this->view_dir  = "views";
        $this->ctrl_dir  = "controllers"; 
        $this->app_root = dirname($_SERVER['PHP_SELF']); 
    }

    /** 
     リクエストを解析し、MVCモデル構築に必要な情報を抽出する。
    例：http://www.example.jp/wp2026mvc/u/edit/?id=s0002
    */
    private function parseRequest()
    {
        $res = [];
        $defaults = $this->config['mvc']['defaults'];
        $classes =  $this->config['mvc']['classes'];
        
        $path = $_SERVER['REDIRECT_URL'] ?? $_SERVER['REQUEST_URI']; // リスクエストの絶対パス, 例：/wp2026mvc/u/edit/
        $path = substr($path, strlen($this->app_root)); // リスクエストの相対パス。例： /u/edit/
        $path = trim($path, '/'); // 前後の'/'を取り除く。例：u/edit
        $parts = explode('/', $path);   // '/'で区切った部分を抽出し配列にする。例：['u','edit']
        
        $c = $parts[0] ?? $defaults['c'];   // クラスIDを抽出する。例：u
        $res['class'] = $classes[$c] ?? $defaults['class']; // 実際のクラス名を特定する。例：User
        $res['action'] = $parts[1] ?? $defaults['action'];  // アクションを抽出する。例：edit ※デフォルトはlist
        $res['args'] = $_GET; // 引数を取得する。例：['id'=>s0002]
        return $res;
    }

    /** 
     解析結果をもとに、MVCモデルを構築し、アクションを呼び出す。
    */
    public function run()
    { 
        $res = $this->parseRequest();
        extract($res);//配列から変数を展開。以下3行と同じ
        // $class = $res['class'];
        // $action = $res['action'];
        // $args = $res['args'];

        // モデルmodel
        require "{$this->model_dir}/{$class}Model.php";
        $modelClass = "{$class}Model";
        $model = new $modelClass($this->config['db']);

        // ビューview
        require "{$this->view_dir}/{$class}View.php";
        $viewClass = "{$class}View";
        $view = new $viewClass($this->app_root);

        //複数のビュー間に変数(camelCase)をシェアする
        $urole = $_SESSION['urole'] ?? 0;
        $view->share('appRoot', $this->app_root);
        $view->share('appName', $this->config['app']['name']);
        $view->share('appMenu', $this->config['menu'][$urole] ?? []); // 通常メニューの場合
       
        // ここから bootstrap5 対応メニューバー
        /*
        $use_menu = $this->config['bs5menu'];   // BootStrapメニュー（bs5menu）の場合 
        $menu['public'] = $use_menu['common']['public'];
        if ($urole > 0){
            $names = [1=>'学生', 2=>'教員', 9=>'管理者',];
            $menu['common'] = $use_menu['common']['after-login'];
            $menu['login'] = ['ログアウト'=>'/u/logout'];
            $menu['dropdown'] =  [
                'name'=> $names[$urole] ?? 'ゲスト',
                'items'=>$use_menu['dropdown'][$urole]??[],
            ];
        }else{
            $menu['common'] = $use_menu['common']['before-login'];
            $menu['login'] = ['ログイン'=>'/u/login'];
            $menu['dropdown'] = [];
        }
        $view->share('appMenu', $menu);
        */
        // ここまで　bootstrap5 対応メニューバー  

        $view->share('userRole', $urole);
        $view->share('userName', $_SESSION['uname'] ?? 'ゲスト');

        //コントローラーcontroller
        require "{$this->ctrl_dir}/{$class}Controller.php";
        $controllerClass = "{$class}Controller";
        $controller = new $controllerClass($model, $view);
        $actionFunc = "{$action}Action";

        //アクションを呼び出す（dispatch）
        if (method_exists($controller, $actionFunc)) {
            call_user_func_array([$controller, $actionFunc], $args);// メソッドを呼び出す。例：$controller->editAction('s0002');
        } else {
            $controller->errorAction("エラー：{$actionFunc}()：未定義アクション！");
        }
    }
}
