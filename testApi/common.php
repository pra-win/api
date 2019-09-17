<?php
  session_start();
  header('Access-Control-Allow-Origin:*');
  header('Content-Type:application/json');

  $user = $_SESSION['user'];

  if($user === 'admin'){
    header('Is-Logged-In:true');
  } else {
    header('Is-Logged-In:false');
    exit('{
        "message":"Unknown user",
        "success": true
      }');
  }
 ?>
