<?php
    require 'common.php';
    require 'db-connection.php';

    $data = json_decode($_POST['data']);

    $newCategoryArray = array();

    $cnt = 0;

    foreach ($data as $key => $value) {
        $obj = new stdClass;
        $obj->id = $value->id;

        $sql = "DELETE FROM `transaction` WHERE `transaction-id`=".$obj->id;

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
          "message":"'.$cnt.' Transaction deleted successfuly",
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
