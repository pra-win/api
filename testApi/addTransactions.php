<?php
    require 'common.php';

    $data = json_decode($_POST['data']);

    $newCategoryArray = array();

    foreach ($data as $key => $value) {
        $obj = new stdClass;
        $obj->amt = $value->amt;
        $obj->category = $value->category;
        $obj->tranDate = $value->tranDate;
        $obj->tranDesc = $value->tranDesc;
        array_push($newCategoryArray, $obj);
    }

    $myJSON = json_encode($newCategoryArray);

    $res = '{
        "message":"Transactions added successfuly",
        "success": true,
        "response":'.$myJSON.'
      }';
  sleep(2);
  echo($res);
 ?>
