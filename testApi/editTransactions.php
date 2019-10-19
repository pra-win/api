<?php
    require 'common.php';
    require 'db-connection.php';

    $data = json_decode($_POST['data']);

    $newCategoryArray = array();

    $cnt = 0;

    foreach ($data as $key => $value) {
        $obj = new stdClass;
        $obj->amt = number_format($value->amt, 2, '.', '');
        $obj->category = $value->category;

        $tDate = new DateTime($value->tranDate);
        $obj->tranDate = $tDate->format('Y-m-d H:i:s');
        $obj->tranDesc = $value->tranDesc;
        $obj->keyWords = $value->keyWords;
        $obj->id = $value->id;
        $obj->futureTransaction = $value->futureTransaction;

        $sql = "UPDATE `transaction`
                SET `transaction-amt`= $obj->amt,
                    `category-id`= $obj->category,`transaction-date`= '$obj->tranDate',
                    `transaction-desc`='$obj->tranDesc',`transaction-keyword`= '$obj->keyWords',
                    `future-transaction`= $obj->futureTransaction
                WHERE `transaction-id` = ".$obj->id." ";

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
          "message":"'.$cnt.' Transaction updated successfuly",
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
