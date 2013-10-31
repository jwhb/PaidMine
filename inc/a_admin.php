<?php

class AdminAction implements Action{
  
  private $mysql;
  private $item_table = 'items';
  
  public function __construct($mysql = null){
    if($mysql == null) $mysql = new mysql(Config::getMysqlInfo());
    $this->mysql = $mysql;
  }
  
  public function dispatch($args){
    $tpl = new mytpl();
    $tpl->assign('title', 'Admin Panel');
    $tpl->draw('admin');
  }
}
