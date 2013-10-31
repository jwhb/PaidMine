<?php

class ShopAction implements Action{
  
  private $mysql;
  private $item_table = 'items';
  
  public function __construct($mysql = null){
    if($mysql == null) $mysql = new mysql(Config::getMysqlInfo());
    $this->mysql = $mysql;
  }
  
  public function dispatch($args){
    $tpl = new mytpl();
    if(@$args['a'] == 'buy' && isset($args['id'])){
      //TODO: Purchase request
      die('<h2>INDEV: PURCHASE REQUEST</h2>');
    }elseif(!isset($_SESSION['mcname']) && !isset($args['mcname'])){
      $tpl->assign('title', 'Shop Login');
      $tpl->draw('shoplogin');
    }else{
      if(isset($args['mcname'])){
        if(!$this->setMCName($args['mcname'])){
          //TODO: Add invalid mcname template 
          die('Invalid Minecraft name!');
        }
      }
      if(@$args['a'] == 'shoplogout'){
        if(!$this->delMCName());
        $tpl->assign('title', 'Shop Login');
        $tpl->draw('shoplogin');
        exit();
      }
      //Products page
      $this->item_table = (isset($this->mysql->info['item_table']))
        ? $this->mysql->info['item_table'] : 'items';
      $tpl->assign('title', 'Products');
      $tpl->assign('items', $this->getItems());
      $tpl->draw('products');
    }
  }
  
  public static function setMCName($mcname){
    if(!isset($_SESSION)){
      session_start();
    }
    if(preg_match('^([A-Za-z0-9_]){2,16}^', $mcname) != 1){
      return(false);
    }
    $_SESSION['mcname'] = $mcname;
    return(true);
  }
  
  public static function delMCName(){
    $_SESSION['mcname'] = false;
    session_destroy();
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
