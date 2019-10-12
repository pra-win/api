<?php
  $servername = "localhost";
  $username = "root";
  $password = "password";
  $dbname = "money-manager";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      //die("Connection failed: " . $conn->connect_error);
      die('{
          "message":"Connection failed '.$conn->connect_error.'",
          "success": false,
          "response":""
        }');
  }
  //echo "Connected successfully";
?>
