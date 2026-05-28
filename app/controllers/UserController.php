<?php
include_once 'Controller.php';

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
      session_start();
      unset($_SESSION);
      session_destroy();
      $this->view->redirect('/u/login');
   }

   /**ユーザ一覧 */
   public function listAction()
   {
      $users = $this->model->getList();
      $this->view->render('user_list', ['users' => $users]);
   }

   /**詳細確認 */
   public function showAction($id)
   {
      $where = "uid='{$id}'";
      $user = $this->model->getDetail($where);
      if ($user) {
         $this->view->render('user_show', ['user'=>$user]);
      }else{
         $this->view->render('msg_error', ['message'=>"エラー：対象のユーザ「{$id}」が存在しません。"]);
      }
   }
   
   /**編集 */
   public function editAction($id=null)
   {
      $where = "uid='{$id}'";
      $user = $this->model->getDetail($where);
      $act = $user ? 'update' : 'insert';
      $user = $user ?? ['uid'=>'', 'uname'=>'名前なし', 'upass'=>'', 'urole'=>1];
      $uroles = $this->model->getCodeDef('uroles');      
      $this->view->render('user_edit', ['act'=>$act, 'user' => $user, 'uroles'=>$uroles]);
   }

   /** 結果保存 */
   public function saveAction()
   {
      $data = $_POST;
   
      $act = $data['act'] ?? 'insert';
      $fields = ['uid', 'uname', 'upass', 'urole'];
      foreach ( $data as $key=>$_){
         if (!in_array($key, $fields)) unset($data[$key]);
      }
      $uid =  $data['uid'];      
      $where = "uid='$uid'";
      if ($act=='insert') $this->model->insert($data);
      else $this->model->update($data, $where);
      $this->view->redirect('/u/list');
   }

   /**  削除確認 */
   public function deleteAction($id)
   {
      $where = "uid='{$id}'";
      $user = $this->model->getDetail($where);
      if ($user){
         $this->view->render('msg_confirm', [
            'title'=>'削除確認',
            'message'=>"ユーザ「{$user['uname']}」（{$user['uid']}）を完全に削除します。<br/>続けてもよろしいでしょうか？", 
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
