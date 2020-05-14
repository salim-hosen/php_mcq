<?php
  class Session{
    public static function init(){
      session_start();
    }

    public static function set($key,$val){
      if(isset($key) && isset($val)){
        $_SESSION[$key] = $val;
      }else{
        return false;
      }
    }

    public static function get($key){
      if(isset($_SESSION[$key])){
        return $_SESSION[$key];
      }else{
        return false;
      }
    }

    public static function destroy(){
      session_destroy();
    }
  }
?>
