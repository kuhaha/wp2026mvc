<?php
require_once 'Controller.php';

class UserController extends Controller
{
   /**ホームページ */
   function homeAction()
   {
      $this->view->render('user_home');
   }

   /**ログイン */
   public function loginAction()
   {
      $this->view->render('user_login');
   }

   /**パスワード認証 */
   public function authAction()
   {
      $uid = $_POST['uid'];
      $upass = $_POST['upass'];
      $user = $this->model->auth($uid, $upass);
      if ($user){
         $_SESSION['uid'] = $user['uid'];
         $_SESSION['uname'] = $user['uname'];
         $_SESSION['urole'] = $user['urole'];
         $this->view->redirect('/u/home');
      }
      else{
         $this->view->render('msg_error', ['message'=>'エラー：ユーザIDかパスワードが間違っています。']);
      }
   }

   /**ログアウト */
   public function logoutAction()
   {
      unset($_SESSION);
      session_destroy();
      $this->view->redirect('/u/login');
   }

   /**ユーザ一覧 */
   public function listAction()
   {
      $users = $this->model->getList();      
      //各ユーザの種別（整数のコード）から日本語名を求める
      $uroles = $this->model->getCodeDef('uroles');
      for ($i=0; $i<count($users); $i++){
         $role = $users[$i]['urole'];
         $users[$i]['urole_name'] = $uroles[$role] ?? '不詳';
      }
      $this->view->render('user_list', ['users' => $users]);
      //$this->view->render('user_list_img', ['users' => $users]);
   }

   /**ページ付きユーザ一覧 */
   public function pageAction($n=0)
   {
      $limit = 6; // 1ページに表示する最大行数
      $offset = $n > 0 ? ($n - 1) * $limit : 0;//0から数えて何行目から始まるか
      $where = '1'; 
      $orderby = '';
      $users = $this->model->getList($where, $orderby, $limit, $offset);
      $uroles = $this->model->getCodeDef('uroles');
      for ($i=0; $i<count($users); $i++){
         $role = $users[$i]['urole'];
         $users[$i]['urole_name'] = $uroles[$role] ?? '不詳';
      }

      //データ数を調べ、必要なページ数を求める。
      $_users = $this->model->getList();
      $n_users = count($_users);
      $pages = ceil($n_users / $limit);//最大ページ数

      $this->view->render('user_page', ['users' => $users, 'page'=> $n, 'pages'=>$pages]);
   }

    /**ユーザ検索・絞り込み */
   public function searchAction()
   {
      $urole = $_POST['urole'] ?? 0;
      $keywd = $_POST['keywd'] ?? '';
      $where = $urole > 0 ? "urole={$urole}" : '1';
      $where .= " AND uname LIKE '%{$keywd}%'";
      $users = $this->model->getList($where);
      $uroles = $this->model->getCodeDef('uroles');
      $uroles[0] = 'すべて';
      for ($i=0; $i<count($users); $i++){
         $role = $users[$i]['urole'];
         $users[$i]['urole_name'] = $uroles[$role] ?? '不詳';
      }
      $this->view->render('user_search', ['users' => $users, 'uroles'=>$uroles, 'keywd'=>$keywd,'urole'=>$urole]);
   }
   
   /**並べ替え */
   public function sortAction($order='')
   {
      $columns = ['uid', 'uname', 'urole'];
      $orderby = '';
      if (in_array($order, $columns) ){
         $descending = $_SESSION['sort_descending'] ?? false;
         $_SESSION['sort_descending'] = !$descending;
         $desc = $descending ? 'DESC' : 'ASC';
         $orderby = "{$order} {$desc}";
      }
      $where = '1'; 
      $users = $this->model->getList($where, $orderby);
      $uroles = $this->model->getCodeDef('uroles');
      for ($i=0; $i<count($users); $i++){
         $role = $users[$i]['urole'];
         $users[$i]['urole_name'] = $uroles[$role] ?? '不詳';
      }
      $this->view->render('user_sort', ['users' => $users]);
   }

   /**詳細確認 */
   public function showAction($id)
   {
      $where = "uid='{$id}'";
      $user = $this->model->getDetail($where);
      if ($user) {
         $uroles = $this->model->getCodeDef('uroles');
         $role = $user['urole'];
         $user['urole_name'] = $uroles[$role] ?? '不詳';
         $this->view->render('user_show', ['user'=>$user]);//削除ボタンを押すと確認画面を表示
         // $this->view->render('user_show-modal', ['user'=>$user]);//削除ボタンを押すとモーダルウィンドウを表示
      }else{
         $this->view->render('msg_error', ['message'=>"エラー：対象のユーザ「{$id}」が存在しません。"]);
      }
   }
   
   /**編集入力（新規登録と編集に共通する入力画面） */
   public function editAction($id=null)
   {
      $where = "uid='{$id}'";
      $user = $this->model->getDetail($where);
      $act = $user ? 'update' : 'insert';
      if (!$user){ 
         $user = ['uid'=>'', 'uname'=>'名前なし', 'upass'=>'', 'urole'=>1];
      }
      $uroles = $this->model->getCodeDef('uroles');      
      $this->view->render('user_edit', ['act'=>$act, 'user' => $user, 'uroles'=>$uroles]);
   }

   /** 結果保存 */
   public function saveAction()
   {
      $data = $_POST;   
      $act = $data['act'] ?? 'insert';
      $uid =  $data['uid'];  
      if ($data['upass']!=$data['upass2']){
         $this->view->render('msg_error', ['message'=>"エラー：パスワードが一致しません。"]);
      }else{
         $fields = ['uid', 'uname', 'upass', 'urole'];
         foreach ( $data as $key=>$_){
            if (!in_array($key, $fields)) unset($data[$key]);
         }

         $where = "uid='$uid'";
         if ($act=='insert') $this->model->insert($data);
         else $this->model->update($data, $where);
         $this->view->redirect('/u/list');
      }
   }

   /**  削除確認 */
   public function deleteAction($id)
   {
      //---ここから--実行権限チェック---
      if (!isset($_SESSION['urole'])){
         return $this->errorAction('この機能はログインしないと利用できません!');
      }elseif($_SESSION['urole'] != 9 ){
         return $this->errorAction('この機能は管理者でないと利用できません!');
      }
      //---ここから--実行権限チェック---
      $where = "uid='{$id}'";
      $user = $this->model->getDetail($where);
      if ($user){
         $this->view->render('msg_confirm', [
            'title'=>'削除確認',
            'message'=>"ユーザ「{$user['uname']}」（{$user['uid']}）」を完全に削除します。<br/>続けてもよろしいでしょうか？", 
            'url' => "/u/deleted/?id={$id}", 
            'label'=>'OK'
            ]
         );
      }else{
         $this->view->render('msg_error', ['message'=>"エラー：削除対象のユーザ「{$id}」が存在しません。"]);
      }
   }

   /**  完全削除 */
   public function deletedAction($id)
   {
      $where = "uid='{$id}'";
      $this->model->delete($where);
      $this->view->redirect('/u/list');
   }

}
