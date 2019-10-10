<?php
require 'common.php';
require 'db-connection.php';

$select = "SELECT `transaction-id`,`category-name`,`category-type`, `transaction-amt`,  `transaction-date`, `transaction-desc`, `transaction-keyword`, `future-transaction`
          FROM `transaction`, `category-master`
          WHERE `transaction`.`category-id` = `category-master`.`category-id`;";

$export = $conn->query($select);

$fields = mysqli_num_fields( $export );


while ($property = mysqli_fetch_field($export)) {
    $header .= $property->name . ",";
}


while( $row = mysqli_fetch_row( $export ) )
{
    $line = '';
    foreach( $row as $value )
    {
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = ",";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . ",";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}
$data = str_replace( "\r" , "" , $data );

if ( $data == "" )
{
    $data = "\n(0) Records Found!\n";
}

$fileName = "backup_".date('Y_m_d').".csv";

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$fileName."");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";

 ?>
