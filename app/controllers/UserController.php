<?php
include_once 'Controller.php';

class UserController extends Controller
{
   public function listAction()
   {
      $users = $this->model->getList();
      $this->view->render('user_list', ['users' => $users]);
   }

   public function editAction($id=null)
   {
      $where = "uid='{$id}'";
      $user = $this->model->getDetail($where);
      $act = $user ? 'update' : 'insert';
      $this->view->render('user_edit', ['act'=>$act, 'user' => $user]);
   }

   public function saveAction($data)
   {
      
      $user = $this->model->getDetail($where);
      $act = $user ? 'update' : 'insert';
      $this->view->render('user_edit', ['act'=>$act, 'user' => $user]);
   }

}
