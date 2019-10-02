<?php
    require 'common.php';
    require 'db-connection.php';

    $data = json_decode($_POST['data']);

    $newCategoryArray = array();

    $cnt = 0;

    foreach ($data as $key => $value) {
        $obj = new stdClass;
        $obj->cname = $value->cname;
        $obj->type = $value->type;

        $sql = "INSERT INTO `category-master`(`category-name`, `category-type`, `category-added-date`)
                VALUES ('".$obj->cname."','".$obj->type."','". date('Y-m-d h:i:s') ."')";

        if ($conn->query($sql) === TRUE) {
            $obj->cid = $conn->insert_id;
            $cnt++;
        }
        array_push($newCategoryArray, $obj);
    }

    $conn->close();

    if($cnt) {
      $myJSON = json_encode($newCategoryArray);
      $res = '{
          "message":"'.$cnt.' Categories added successfuly",
          "success": true,
          "response":'.$myJSON.'
        }';
    } else {
      $myJSON = "{}";
      $erro = "Error:" . $conn->error;
      $res = '{
          "message":"'.$erro.'",
          "success": false,
          "response":'.$myJSON.'
        }';
    }
  echo($res);
 ?>
