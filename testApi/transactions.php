<?php
  require 'common.php';
  require 'db-connection.php';

  $data = new stdClass;
  if(isset($_POST["params"])) {
    $data =  json_decode($_POST["params"]);
    $fromDate = new DateTime($data[0]->fromDate);
    $fromDate = $fromDate->format('Y-m-d');

    $toDate = new DateTime($data[0]->toDate);
    $toDate = $toDate->format('Y-m-d');

    $id = $data[0]->id;

    $sql = "SELECT `transaction-id`, `transaction-amt`, `category-id`, `transaction-date`, `transaction-desc`, `transaction-keyword`, `future-transaction`
    FROM `transaction`";

    if($fromDate && $toDate) {
      $sql = "SELECT `transaction-id`, `transaction-amt`, `category-id`, `transaction-date`, `transaction-desc`, `transaction-keyword`, `future-transaction`
              FROM `transaction` WHERE `transaction-date`
              BETWEEN '".$fromDate."' AND '".$toDate."'";
    }

    if($id) {
      $sql = "SELECT `transaction-id`, `transaction-amt`, `category-id`, `transaction-date`, `transaction-desc`, `transaction-keyword`, `future-transaction`
              FROM `transaction` WHERE `transaction-id` = ".$id."";
    }
  }

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
          $obj->futureTransaction = $row["future-transaction"];
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
  echo($res);
 ?>
