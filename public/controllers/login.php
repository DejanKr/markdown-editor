<?php
chdir(__DIR__);
include_once ('base.php');
include_once ('/../../library/model/user.php');
include_once('/../../library/user.php');

class login extends BaseController
{

  public function __construct ($controller, $request)
  {

    $controller = 'login';
    
    parent::__construct($controller, $request);
    
    
  }

  public function check()
  {
    $user = new UserModel();
    //var_dump($this->request);
    $user->checkUser($this->request);
  }
  
  public function login()
  {
    $data=$this->request;
    $this->action='login';
    //$edi=new EditorModel();
    return $this->getView();
  }



}