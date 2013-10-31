<?php

require_once('config.php');
require_once(f_inc . 'c_mysql.php');
require_once(f_inc . 'c_raintpl.php');
require_once(f_inc . 'c_mytpl.php');
require_once(f_inc . 'i_action.php');
Config::postConfig();

function initMysql(){
  $mysql = new mysql(Config::getMysqlInfo());
  return $mysql;
}

session_start();

$args = $_REQUEST;
unset($args['p']);

$action = (isset($_GET['p']))? $_GET['p'] : 'index';
switch($action){
	case 'admin':
	  require_once(f_inc . 'a_admin.php');
	  $action = new AdminAction(initMysql());
	  $action->dispatch($args);
	  break;
	case 'register':
	  require_once(f_inc . 'a_register.php');
	  $action = new RegisterAction();
	  $action->dispatch($args);
	  break;
	case 'login':
	  require_once(f_inc . 'a_login.php');
	  $action = new LoginAction();
	  $action->dispatch($args);
	  break;
	case 'index':
	case 'shop':
	case 'shoplogin':
	  require_once(f_inc . 'a_shop.php');
	  $action = new ShopAction(initMysql());
	  $action->dispatch($args);
	  break;
	default:
	  //TODO: 404?
	  break;
}
