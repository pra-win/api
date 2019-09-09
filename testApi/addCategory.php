<?php
    require 'common.php';

    $data = json_decode(file_get_contents("php://input"));

    // $cname = $data->cname;
    // $type = $data->type;

    // $temp = [
    //     {cname: "1", type: "i"},
    //     {cname: "2", type: "2"},
    //     {cname: "3", type: "i"},
    // ];
    //
    // print_r($temp);

    echo(gettype($data));

    $str = "";

    foreach ($data as $key => $value) {
        echo($value->cname.' '.$value->type);
    }

    $res = '{
        "message":"Categories added successfuly",
        "success": true,
        "response": [
          {"cname":"","type":""}
        ]
      }';
  sleep(2);
  echo($str);
 ?>
