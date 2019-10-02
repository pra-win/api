<?php
  session_start();
  header('Access-Control-Allow-Origin:*');
  header('Content-Type:application/json');
  $res = "";

  $data = json_decode(file_get_contents("php://input"));


  if($data) {
    $uid = $data->uid;
    $pass = $data->pass;


    if($uid === "admin" && $pass === "test") {
      $_SESSION['user'] = "admin";
      $res = '{
          "message":"authenticated",
          "success": true
        }';
    } else {
      $res = '{
          "message":"Invalid Cridentials.",
          "success": false
        }';
    }

  } else {
    $res = '{
        "message":"please pass valid data",
        "success": false
      }';
  }

  echo($res);
 ?>
