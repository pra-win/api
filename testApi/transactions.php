<?php
  require 'common.php';
  require 'db-connection.php';

  // $sql = "SELECT `transaction-id`, `transaction-amt`, `category-id`, `transaction-date`, `transaction-desc`, `transaction-keyword`
  //         FROM `transaction`";
  //
  // $data = new stdClass;
  // if(isset($_POST["data"])) {
  //   $data =  json_decode($_POST["data"]);
  //   $startIndex = $data->startItem;
  //   $endIndex = $data->endItem;
  //   if($endIndex == 0){
  //     $endIndex = 10;
  //   }
  //   if($data) {
  //     $sql = "SELECT `transaction-id`, `transaction-amt`, `category-id`, `transaction-date`, `transaction-desc`, `transaction-keyword`
  //             FROM `transaction` ORDER BY `transaction-date` DESC LIMIT $data->startItem,$data->endItem";
  //   }
  // }

  $sql = "SELECT `transaction-id`, `transaction-amt`, `category-id`, `transaction-date`, `transaction-desc`, `transaction-keyword`
          FROM `transaction`";

  //"SELECT * FROM `transaction` ORDER BY `transaction-id` DESC LIMIT 40,50;"



  $result = $conn->query($sql);
  $newCategoryArray = array();

  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {

          $q = "SELECT `category-name`, `category-type` FROM `category-master` WHERE `category-id` = ".$row['category-id'];
          $r = $conn->query($q);
          $rw = $r->fetch_assoc();

          $obj = new stdClass;
          $obj->id = $row["transaction-id"];
          $obj->cname = $rw['category-name'];
          $obj->ctype = $rw['category-type'];
          $obj->tranDesc = $row["transaction-desc"];
          $obj->tranDate = $row["transaction-date"];
          $obj->amt = $row["transaction-amt"];
          $obj->keyWords = $row["transaction-keyword"];
          array_push($newCategoryArray, $obj);
      }
  }

  $conn->close();
  $myJSON = json_encode($newCategoryArray);
  $res = '{
      "message":"Transaction Data",
      "success": true,
      "response":'.$myJSON.'
    }';
  //sleep(2);
  echo($res);
 ?>
