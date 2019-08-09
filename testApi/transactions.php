<?php
  session_start();
  header('Access-Control-Allow-Origin:*');
  header('Content-Type:application/json');

  $user = $_SESSION['user'];

  if($user === 'admin'){

    $res = '{
        "message":"Transaction data.",
        "success": true,
        "response": [
            {
                "id":1,
                "cname":"Shopping",
                "ctype":"e",
                "tranDesc":"dmart",
                "tranDate":"01-08-2019",
                "amt":3000
            },
            {
                "id":2,
                "cname":"Salary",
                "ctype":"i",
                "tranDesc":"july salary",
                "tranDate":"05-08-2019",
                "amt":50000
            },
            {
                "id":3,
                "cname":"Fule",
                "ctype":"e",
                "tranDesc":"pulser",
                "tranDate":"06-08-2019",
                "amt":300
            },
            {
                "id":4,
                "cname":"Cat",
                "ctype":"e",
                "tranDesc":"Doctor",
                "tranDate":"08-08-2019",
                "amt":1000
            }
        ]
      }';
  } else {
    $res = '{
        "message":"Unknown user",
        "success": true
      }';
  }
  //sleep(2);
  echo($res);

 ?>
