<?php

define('debug', false);
define('f_inc', 'inc/');
define('provider', 'PaidMine');

class Config {
  
  public static function getMysqlInfo() {
    return(array(
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'db' => 'paidmine',

        'log_invalid_ipns' => true,
        
        'item_table' => 'items',
        'user_table' => 'users',
        'log_pp_raw_table' => 'log_pp_raw'
    ));
  }
  
  public static function postConfig(){
    raintpl::$tpl_dir = f_inc . 'tpl/'; // template directory
    raintpl::$cache_dir = f_inc . 'cache/'; // cache directory
    raintpl::configure('path_replace', false);
  }

}
