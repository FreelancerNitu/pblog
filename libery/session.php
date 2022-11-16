<?php


class Session{
  
  public static function init(){
    session_start();
  }

  public static function set($key, $value){
    $_SESSION[$key] = $value;
  }

  public static function get($key){
    if(isset($_SESSION[$key])){
      return  $_SESSION[$key];
    }else{
      return false;
    }
  }
  
  // Checking user login or not
  public static function loginCheck(){
    self::init();
    if(self::get('login') == true){
      herder('Location: index.php');
    }
  }

  // If user singout, he/she can not going any page.

  public static function checkSession(){
    self::init();
    if(self::get('login') == false){
      self::destroy();
      header('Location: login.php');
    }
  }
  

  // Destroy function
  public static function destroy(){
    session_destroy();
    header('Location: login.php');
  }
  
}


?>