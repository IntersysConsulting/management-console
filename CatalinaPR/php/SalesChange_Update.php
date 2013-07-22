<?php
require 'connection.php';
//$db_host       = "localhost";
//$db_name        = "mpr";
//$db_username    = "root";
//$db_password    = "root555";
$today = date('Y-m-d H:i:s');
$updated_values=$_GET['arr'];
$decodedata =json_decode($updated_values);


//// DATABASE: Try to connect
//if (!$db_connect = mysql_connect($db_host, $db_username, $db_password))
//        die('Unable to connect to MySQL.');
//if (!$db_select = mysql_select_db($db_name, $db_connect))
//        die('Unable to select database');

// DATABASE: Clean data before use
//function clean($value)
//{
//        return mysql_real_escape_string($value);
//}

foreach($decodedata as $data)

    {
         
        $result = mysqli_query("UPDATE pr_sales_change SET ".$data->col_nam."='".$data->col_value."',update_date='".$today."' WHERE  user_id='".$data->user_id_val."'  AND segment_id='".$data->seg_id_val."'  ",$con) or die ('Unable to update row.');
    }


?>

