<?php
    require 'common.php';
    
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
  sleep(2);
  echo($res);
 ?>
