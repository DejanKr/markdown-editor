<?php

/*
session_start();

$loggedIn = false;


if(isset($_REQUEST['login-submit']))
{
  include "model/editor.php";
  $edit=new LoginModel();


}
else
{
  $loggedIn=true;


}





var_dump($_REQUEST);

*/

session_start();

//$_SESSION=array();
$loggedIn = false;
if (isset($_SESSION['logged'])) {
    if ($_SESSION['logged'] == 'yes') {
        $loggedIn = true;
    }
}


if (!$loggedIn) {
    $controller = $action = 'login';
    if (isset($_REQUEST['login-submit'])) {
        $action = 'check';
    }
    if(isset($_REQUEST['register-submit']))
    {
        $controller='registration';
        $action='register_member';
    }


} else if (empty($_REQUEST)) {
    $controller = $action = 'index';
} else {
    if (isset($_REQUEST['c']))
        $controller = $_REQUEST['c'];
    else
        $controller = 'index';

    if (isset($_REQUEST['a']))
        $action = $_REQUEST['a'];
    else
        $action = 'index';
}


$controllers = [
    'index' => [ //controllers
        'index',//actions
        'showList', //actions
    ],
    'editor' => [
        'index', 'save', 'test', 'generate', 'deleteDocument' //actions
    ],
    'login' => [
        'login',
        'check'
    ],
    'registration'=>[
        'register_member'
    ]

];


if (!isset($controller, $controllers))
    die("404");

$actions = $controllers[$controller];

if (!in_array($action, $actions))
    die("404");


include_once("controllers/{$controller}.php");
//var_dump($controller,$_REQUEST);
$controller = new $controller($controller, $_REQUEST);


$controller->$action();
//var_dump($controller);