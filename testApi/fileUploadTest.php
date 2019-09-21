<?php

session_start();
require 'common.php';

// $user = $_SESSION['user'];
//
// if($user === 'admin'){
//   header('Is-Logged-In:true');
// } else {
//   header('Is-Logged-In:false');
//   exit('{
//       "message":"Unknown user",
//       "success": true
//     }');
// }
//
// header('Content-Type: application/json; charset=utf-8');
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: PUT, GET, POST");
$response = array();
$upload_dir = '/home/pravin/www/html/api/testApi/uploads/';
$server_url = 'http://localhost:80';

//$data = file_get_contents("php://input", false);
//print_r($data);
//echo ('test'.file_put_contents("outputfile.txt", "test"));
//
// exit;

if($_FILES['file'])
{
    $file_name = $_FILES["file"]["name"];
    $file_tmp_name = $_FILES["file"]["tmp_name"];
    $error = $_FILES["file"]["error"];
    if($error > 0){
        $response = array(
            "status" => "error",
            "error" => true,
            "message" => "Error uploading the file!"
        );
    }else
    {
        $random_name = rand(1000,1000000)."-".$file_name;
        $upload_name = $upload_dir.strtolower($random_name);
        $upload_name = preg_replace('/\s+/', '-', $upload_name);

        if(move_uploaded_file($file_tmp_name , $upload_name)) {
            $response = array(
                "status" => "success",
                "error" => false,
                "message" => "File uploaded successfully",
                "url" => $server_url."/".$upload_name
              );
        }else
        {
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "Error uploading the file!"
            );
        }
    }

}else{
    $response = array(
        "status" => "error",
        "error" => true,
        "message" => "No file was sent!"
    );
}
echo json_encode($response);
?>
