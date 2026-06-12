<?php
class Controller
{
   protected $model;
   protected $view;
   protected $page_length = 10;

   function __construct($model, $view)
   {
      $this->model = $model;
      $this->view = $view;
   }

   function setPageLength(int $n)
   {
      $this->page_length = $n;
   }

   function errorAction(string $msg)
   {
      $this->view->render('msg_error', ['message' => $msg]);
   }
}