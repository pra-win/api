<?php
    require 'common.php';
    require 'db-connection.php';

    $data = json_decode($_POST['data']);

    $newArray = array();

    $cnt = 0;
    foreach ($data as $key => $value) {
        $obj = new stdClass;
        $obj->amt = number_format($value->amt, 2, '.', '');
        $obj->category = $value->category;

        $tDate = new DateTime($value->tranDate);
        $obj->tranDate = $tDate->format('Y-m-d H:i:s');
        $obj->tranDesc = $value->tranDesc;
        $obj->keyWords = $value->keyWords;

        $sql = "INSERT INTO `transaction`(`transaction-amt`, `category-id`, `transaction-date`, `transaction-desc`, `transaction-keyword`)
                VALUES ($obj->amt, $obj->category,'".$obj->tranDate."','".$obj->tranDesc."','".$obj->keyWords."')";

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
