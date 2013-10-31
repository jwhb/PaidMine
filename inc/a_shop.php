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
      $this->startPurchase($args['id'], $tpl);
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
  
  public function startPurchase($item_id, $tpl = null){
    if($tpl == null) $tpl = new MyTPL();
    $item = $this->getItemById($item_id);
    if(!$item){
      //TODO: Better error messages
      die('Item with ID <strong>' . $item_id . '</strong> not found.');
    }else{
      $tpl->assign('item', $item);
      $tpl->draw('purchase');
    }
  }
  
  /* Helper functions */
  
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
  
  public function getItemById($item_id){
    $result = $this->mysql->row(array(
        'table' => $this->item_table,
        'condition' => 'id=' . $item_id
    ));
    return($result);
  }
}
