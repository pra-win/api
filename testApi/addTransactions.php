<?php
    require 'common.php';
    require 'db-connection.php';

    $data = json_decode($_POST['data']);

    $newArray = array();

    foreach ($data as $key => $value) {
        $obj = new stdClass;
        $obj->amt = $value->amt;
        $obj->category = $value->category;
        $obj->tranDate = $value->tranDate;
        $obj->tranDesc = $value->tranDesc;
        $obj->keyWords = $value->keyWords;

        $sql = "INSERT INTO `transaction`(`transaction-amt`, `category-id`, `transaction-date`, `transaction-desc`, `transaction-keyword`)
                VALUES ($value->amt,$value->category,'".date("Y-m-d h:i:s", $value->tranDate)."','".$value->tranDesc."','".$value->keyWords."')";

        if ($conn->query($sql) === TRUE) {
            $obj->cid = $conn->insert_id;
            $cnt++;
        }

        array_push($newArray, $obj);
    }

    $conn->close();

    if($cnt) {
      $myJSON = json_encode($newArray);
      $res = '{
          "message":"'.$cnt.' Transactions added successfuly",
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

  sleep(2);
  echo($res);
 ?>
