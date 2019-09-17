<?php
  require 'common.php';

  unset($_SESSION['user']);

  session_destroy();

  sleep(5);

  $res = '{
      "message":"Loged out",
      "success": true
    }';
  echo($res);

 ?>
