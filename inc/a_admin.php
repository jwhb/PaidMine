<?php

class AdminAction implements Action{
  
  private $mysql;
  private $item_table = 'items';
  
  public function __construct($mysql = null){
    if($mysql == null) $mysql = new mysql(Config::getMysqlInfo());
    $this->mysql = $mysql;
  }
  
  public function dispatch($args){
    require_once(f_inc . 'c_pl_login.php');
    $login = new PL_Login();
    
    if ($login->isUserLoggedIn() == true) {
      $tpl = new mytpl();
      $tpl->assign('title', 'Admin Panel');
      $tpl->draw('admin');
    }else{
      require_once(f_inc . 'a_login.php');
      $la = new LoginAction();
      $la->dispatch(array());
    }
  }
}
