<?php

class MyTPL extends RainTPL{

  function draw($tpl_name, $return_string = false){
    parent::draw('header');
    parent::draw($tpl_name, $return_string);
    parent::draw('footer');
  }
  
}
