<?php
  session_start();
  header('Access-Control-Allow-Origin:*');
  header('Content-Type:application/json');

  $user = $_SESSION['user'];

  if($user === 'admin'){
    $res = '{
        "message":"Data for valid user",
        "success": true
      }';
  } else {
    $res = '{
        "message":"Unknown user",
        "success": true
      }';
  }

  echo($res);

 ?>
