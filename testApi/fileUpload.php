<?php
require 'common.php';
require 'db-connection.php';

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

          $deleteTran = "DELETE FROM `transaction`";
          if ($conn->query($deleteTran) === TRUE) {

            $deleteCat = "DELETE FROM `category-master`";
            if ($conn->query($deleteCat) === TRUE) {

              $file = fopen($filePath, "r");
              $categoryArray = array();
              $exists_array = array();
              $transactionsArray = array();

              while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
              {
                $obj = new stdClass;
                $data = strval($emapData[1])." ".strval($emapData[2]);
                $obj->catName = strval($emapData[1]);
                $obj->catType = strval($emapData[2]);
                $obj->traAmt = $emapData[3];
                $obj->traDate = $emapData[4];
                $obj->traDesc = strval($emapData[5]);

                if( !in_array( $obj->catName, $exists_array ) && $obj->catName !== "categoryName") {
                    $exists_array[] = $obj->catName;
                    array_push($categoryArray, $obj);
                }
                array_push($transactionsArray, $obj);
              }
              foreach($categoryArray as $key=>$value) {
                $cType = 'a';
                if($value->catType === 'income') {
                  $cType = "i";
                } elseif ($value->catType === 'expense') {
                  $cType = "e";
                }

                $addCat = "INSERT INTO `category-master`(`category-name`, `category-type`, `category-added-date`)
                           VALUES ('".$value->catName."','".$cType."','". date('Y-m-d h:i:s') ."')";

                 if ($conn->query($addCat) === TRUE) {
                     $obj->cid = $conn->insert_id;
                     $cnt++;
                 }
              }
              $cnt = 0;
              foreach ($transactionsArray as $key => $value) {
                $catIdq = "SELECT `category-id` FROM `category-master` WHERE `category-name` = '".$value->catName."'";
                $result = $conn->query($catIdq);
                $cId = $result->fetch_assoc()['category-id'];

                $traAmt = $value->traAmt;
                $traDate = $value->traDate;
                $traDesc = $value->traDesc;
                $keyWords = "NA";

                $tranQ = "INSERT INTO `transaction`(`transaction-amt`, `category-id`, `transaction-date`, `transaction-desc`, `transaction-keyword`)
                        VALUES ($traAmt,$cId,'".$traDate."','".$traDesc."','".$keyWords."')";

                if ($conn->query($tranQ) === TRUE) {
                    $obj->cid = $conn->insert_id;
                    $cnt++;
                }
              }
            }
          }

          fclose($file);
          $conn->close();

            $response = array(
                "status" => "success",
                "error" => false,
                "message" => "File uploaded successfully.".$cnt." Recordes added.",
                "data" => $data
              );
        } else
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
