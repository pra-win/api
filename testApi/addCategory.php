<?php
  session_start();
  header('Access-Control-Allow-Origin:*');
  header('Content-Type:application/json');

  $user = $_SESSION['user'];

  if($user === 'admin'){
    $data = json_decode(file_get_contents("php://input"));

    $cname = $data->cname;
    $type = $data->type;

    $res = '{
        "message":"Categories added successfuly",
        "success": true,
        "response": [
          {"cname":"'.$cname.'","type":"'.$type.'"}
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
