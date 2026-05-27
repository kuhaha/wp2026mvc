<?php
include_once 'Controller.php';

class UserController extends Controller
{
   public function loginAction()
   {
      $this->view->render('user_login');
   }

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
         $this->view->render('error_msg', ['message'=>'ログイン失敗：ユーザIDかパスワードが間違っています。']);
      }
   }

   function homeAction()
   {
      $this->view->render('user_home');
   }

   public function logoutAction()
   {
      session_start();
      unset($_SESSION);
      session_destroy();
      $this->view->redirect('/u/login');
   }

   public function listAction()
   {
      $users = $this->model->getList();
      $this->view->render('user_list', ['users' => $users]);
   }

   public function showAction($id)
   {
      $where = "uid='{$id}'";
      $user = $this->model->getDetail($where);
      $this->view->render('user_show', ['user'=>$user]);
   }

   public function editAction($id=null)
   {
      $where = "uid='{$id}'";
      $user = $this->model->getDetail($where);
      $act = $user ? 'update' : 'insert';
      $user = $user ?? ['uid'=>'', 'uname'=>'名前なし', 'upass'=>'', 'urole'=>1];
      $uroles = $this->model->getCodeDef('uroles');      
      $this->view->render('user_edit', ['act'=>$act, 'user' => $user, 'uroles'=>$uroles]);
   }

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

   public function deleteAction($id)
   {
      $where = "uid='{$id}'";
      $this->model->delete($where);
      $this->view->redirect('/u/list');
   }

}
