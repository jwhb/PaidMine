<?php

class ShopAction{
  
  private $mysql;
  private $item_table = 'items';
  
  public function __construct($mysql = null){
    if($mysql == null) $mysql = new mysql(Config::getMysqlInfo());
    $this->mysql = $mysql;
  }
  
  public function dispatch($args){
    $this->item_table = (isset($this->mysql->info['item_table']))
      ? $this->mysql->info['item_table'] : 'items';
    
    $tpl = new mytpl();
    $tpl->assign('title', 'Products');
    $tpl->assign('items', $this->getItems());
    $tpl->draw('products');
  }
  
  public function getItems($show_inactive = false){
    $cond = ($show_inactive)? '' : 'active=1';
    $result = $this->mysql->select(array(
        'table' => $this->item_table,
        'condition' => $cond
    ));
    return($result);
  }
  
}
