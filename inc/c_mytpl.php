<?php

class MyTPL extends RainTPL{

  function draw($tpl_name, $return_string = false){
    try{
      $this->assign('username', (
          (isset($_SESSION['mcname'])? $_SESSION['mcname'] : false)
      ));
      if(!isset($this->var['title'])) $this->assign('title', 'Page');
      parent::draw('header');
      parent::draw($tpl_name, $return_string);
      parent::draw('footer');
    }catch(Exception $e){
      die('Could not render page. Error: ' . $e->getMessage());
    }
  }
  
}
