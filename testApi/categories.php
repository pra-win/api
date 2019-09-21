<?php
  require 'common.php';
  require 'db-connection.php';

  $sql = "select * from `category-master`";

  $result = $conn->query($sql);
  $newCategoryArray = array();

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $obj = new stdClass;
          $obj->cid = $row["category-id"];
          $obj->cname = $row["category-name"];
          $obj->type = $row["category-type"];
          $obj->addedDate = $row["category-added-date"];
          array_push($newCategoryArray, $obj);
      }
  }

  $conn->close();
    $myJSON = json_encode($newCategoryArray);
    $res = '{
        "message":"Categories Data",
        "success": true,
        "response":'.$myJSON.'
      }';
  //sleep(2);
  echo($res);
 ?>
