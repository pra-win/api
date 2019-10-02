<?php
  require 'common.php';

  unset($_SESSION['user']);

  session_destroy();

  $res = '{
      "message":"Loged out",
      "success": true
    }';
  echo($res);

 ?>
