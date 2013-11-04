<?php

class IpnHandler {
  
  private $mysql;
  
  public function __construct($mysql){
    $this->mysql = $mysql;
    $this->process();
  }
  
  public function process(){
    $listener = new IpnListener();
    $listener->use_sandbox = true;
    try {
      $verified = $listener->processIpn();
    } catch (Exception $e) {
      $info = $this->mysql->getInfo();
      if($info['log_invalid_ipns']) $this->logIpn($e);
    }

    $this->logIpn($listener->getTextReport(), $verified);
    if ($verified) {
      
    }
  }
  
  public function logIpn($text, $valid = false){
    $mysql = $this->mysql;
    $info = $mysql->getInfo();
    
    //Convert valid to numeric boolean
    $valid = ($valid)? 1 : 0;
    
    //Insert IPN log in MySQL
    $mysql->insert($info['log_pp_raw_table'], array(
    	'text' => $text,
        'valid' => $valid
    ));
  }
  
}

?>