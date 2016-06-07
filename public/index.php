<?php


session_start();


$loggedIn = false;
if (isset($_SESSION['logged'])) {
    if ($_SESSION['logged'] == 'yes') {
        $loggedIn = true;
    }
}


if (!$loggedIn) {
    $controller = $action = 'login';

    if (isset($_REQUEST['login-submit'])) {

        $action = 'checkLogin';

    }
    if (isset($_REQUEST['register-submit'])) {

        $controller = 'registration';
        $action = 'registerMember';

    }
    if (isset($_REQUEST['activation'])) {
        $controller = 'registration';
        $action = 'activation';
    }
    if (isset($_REQUEST['forgotpass'])) {
        $controller = 'login';
        $action = 'forgotpass';
    }
    if (isset($_REQUEST['reset'])) {
        $controller = 'login';
        $action = 'resetPass';


    }
    if (isset($_REQUEST['rp'])) {
        $controller = 'login';
        $action = 'newPass';

    }
    if (isset($_REQUEST['activateCode'])) {
        $controller = 'login';
        $action = 'setPass';

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
    
    'index' => [ 
        'index',
        'showList', 
    ],
    'editor' => [
        'index', 
        'save', 
        'test', 
        'generate', 
        'deleteDocument' 
    ],
    'login' => [
        'login',
        'checkLogin',
        'resetPass',
        'newPass',
        'setPass'
    ],
    'registration' => [
        'registerMember',
        'activation'
    ]

];


if (!isset($controller, $controllers))
    die("404");

$actions = $controllers[$controller];

if (!in_array($action, $actions))
    die("404");


include_once("controllers/{$controller}.php");

$controller = new $controller($controller, $_REQUEST);
$controller->$action();

