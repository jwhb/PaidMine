<?php

class LoginAction implements Action{
  public function dispatch($args){
    if (version_compare(PHP_VERSION, '5.3.7', '<')) {
        exit("Sorry, this action requires at least PHP 5.3.7 or above!");
    } else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
        require_once(f_inc . 'c_pl_pwcomplib.php');
    }
    
    // load the login class
    require_once(f_inc . 'c_pl_login.php');
    
    // create a login object. when this object is created, it will do all login/logout stuff automatically
    // so this single line handles the entire login process. in consequence, you can simply ...
    
    $login = new PL_Login();
    if ($login->isUserLoggedIn() == true) {
      $aa = new AdminAction();
      $aa->dispatch(array());
    } else {
      $tpl = new mytpl();
      $tpl->assign('title', 'Login');
      $tpl->assign('errors', $login->errors);
      $tpl->assign('messages', $login->messages);
      $tpl->draw('login');
    }
  }
}
