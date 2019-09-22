<?php

session_start();
require 'common.php';

$response = array();
$upload_dir = '/home/pravin/www/html/api/testApi/uploads/';
$server_url = 'http://localhost:80';

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

        $filePath = "uploads/".$random_name;
        if(move_uploaded_file($file_tmp_name , $upload_name)) {

          $file = fopen($filePath, "r");

          while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
          {
           $data = $emapData[0].' '.$emapData[1];

            // $sql = "INSERT into tableName(name,email,address) values('$emapData[0]','$emapData[1]','$emapData[2]')";
            // mysqli_query($con, $sql);
          }
          fclose($file);

            $response = array(
                "status" => "success",
                "error" => false,
                "message" => "File uploaded successfully",
                "data" => $data
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
