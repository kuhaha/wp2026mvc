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

   function errorAction(string $msg)
   {
      $this->view->render('msg_error', ['message' => $msg]);
   }
}