<?php
  session_start();
  header('Access-Control-Allow-Origin:*');
  header('Content-Type:application/json');

  unset($_SESSION['user']);

  session_destroy();

  sleep(5);

  $res = '{
      "message":"Loged out",
      "success": true
    }';
  echo($res);

 ?>
