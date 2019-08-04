<?php
  session_start();
  header('Access-Control-Allow-Origin:*');
  header('Content-Type:application/json');

  $user = $_SESSION['user'];

  if($user === 'admin'){
    $res = '{
        "message":"Categories Data",
        "success": true,
        "response": [
          {"cid":1, "cname":"Shopping","type":"e"},
          {"cid":2, "cname":"Clothes","type":"e"},
          {"cid":3, "cname":"Eating Out","type":"e"},
          {"cid":4, "cname":"Gifts","type":"e"},
          {"cid":5, "cname":"Genral","type":"e"},
          {"cid":6, "cname":"Fuel","type":"e"},
          {"cid":7, "cname":"Salary","type":"i"}
        ]
      }';
  } else {
    $res = '{
        "message":"Unknown user",
        "success": true
      }';
  }
  sleep(2);
  echo($res);

 ?>
