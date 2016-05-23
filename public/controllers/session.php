<?php

chdir(__DIR__);


class session
{
  private $loggedIn = false;
  public $userID;

  public function __construct ()
  {
    session_start();
    $this->checkLogin();

  }
  public function isLoggedIn()
  {
    return $this->loggedIn();
  }
  public function login($user)
  {
    if($this->loggedIn)
    {

    }
    else{

    }
    if($user)
    {
      $this->userID=$_SESSION['userID']=$user;
      $this->loggedIn=true;
      //echo $user;

    }

  }

  public function logout()
  {
    unset($_SESSION['userID']);
    unset($this->userID);
    $this->loggedIn=false;



  }
  private function checkLogin()
  {
    if(isset($_SESSION['userID']))
    {
      $this->userID=$_SESSION('userID');
      $this->loggedIn=true;
    }
    else
    {
      unset($this->userID);
      $this->loggedIn=false;
    }
  }

}