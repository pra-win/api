<?php
  $filePath = $_POST['filePath'];
  echo($filePath);
$file = fopen($filePath, "r");

while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
{
 echo ($emapData[0].' '.$emapData[1]."<br>");

  // $sql = "INSERT into tableName(name,email,address) values('$emapData[0]','$emapData[1]','$emapData[2]')";
  // mysqli_query($con, $sql);
}
fclose($file);


?>
