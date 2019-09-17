<?php
    require 'common.php';

    $data = json_decode(file_get_contents("php://input"));

    $newCategoryArray = array();

    foreach ($data as $key => $value) {
        $obj = new stdClass;
        $obj->cname = $value->cname;
        $obj->type = $value->type;
        array_push($newCategoryArray, $obj);
    }

    $myJSON = json_encode($newCategoryArray);

    $res = '{
        "message":"Categories added successfuly",
        "success": true,
        "response":'.$myJSON.'
      }';
  sleep(2);
  echo($res);
 ?>
