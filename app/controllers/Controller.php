<?php
class Controller
{
   protected $model;
   protected $view;
   function __construct($model, $view)
   {
      $this->model = $model;
      $this->view = $view;
   }

   function errorAction($msg){
      $this->view->render('error_msg', ['message' => $msg]);
   }
}