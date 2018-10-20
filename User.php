<?php

class User extends DB
{

  public function __construct()
  {
    session_start();
    $this->connect();
  }

  public function auth($login, $pass)
  {
    $login = htmlspecialchars($login);
    $pass = htmlspecialchars($pass);

    $auth = $this->select('select * from user where login="' . $login . '" and pass="' . $pass . '"');

    if(count($auth) > 0){
      $_SESSION['authorized'] = 1;
    }else{
      $_SESSION['authorized'] = 0;
    }
  }

  public function checkAuth()
  {
    if($_SESSION['authorized'] == 1){
      return true;
    }else{
      return false;
    }
  }
} 