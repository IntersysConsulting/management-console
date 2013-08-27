<?php
session_start();
//date_default_timezone_set('America/New_York');
date_default_timezone_set(timezone_name_from_abbr("CST"));
require 'connection.php';
if(isset($_SESSION['myusername'])) {
    $myusername = $_SESSION['myusername'];
}
else {
   header("location:../index.php");
}
//$db_host       = "localhost";
//$db_name        = "mpr";
//$db_username    = "root";
//$db_password    = "root555";
$today = date('Y-m-d H:i:s');
$updated_values=$_GET['arr'];
$decodedata =json_decode($updated_values);


////// DATABASE: Try to connect
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
        $result = mysqli_query($con,"UPDATE pr_roi_adj SET ".$data->col_nam."='".$data->col_value."',last_updated_time='".$today."',last_updated_by='".$myusername."' WHERE  user_id='".$data->user_id_val."' ") or die ('Unable to update row.');
    }


?>
