<?php

require_once('config.php');
require_once(f_inc . 'c_mysql.php');
require_once(f_inc . 'c_raintpl.php');
require_once(f_inc . 'c_mytpl.php');
Config::postConfig();

function initMysql(){
  $mysql = new mysql(Config::getMysqlInfo());
  return $mysql;
}

session_start();

$args = $_REQUEST;
unset($args['p']);

$action = (isset($args['p']))? $args['p'] : 'index';
switch($action){
	case 'index':
	case 'shop':
	case 'shoplogin':
	  require_once(f_inc . 'a_shop.php');
	  $action = new ShopAction(initMysql());
	  $action->dispatch($args);
	default:
	  
	  break;
}
