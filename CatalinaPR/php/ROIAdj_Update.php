<?php

$db_host       = "localhost";
$db_name        = "mpr";
$db_username    = "root";
$db_password    = "root555";
$today = date('Y-m-d H:m:s');
$updated_values=$_GET['arr'];
$decodedata =json_decode($updated_values);


//// DATABASE: Try to connect
if (!$db_connect = mysql_connect($db_host, $db_username, $db_password))
        die('Unable to connect to MySQL.');
if (!$db_select = mysql_select_db($db_name, $db_connect))
        die('Unable to select database');

// DATABASE: Clean data before use
function clean($value)
{
        return mysql_real_escape_string($value);
}

foreach($decodedata as $mydata)

    {
         echo $mydata->col_value . "\n";
        $result = mysql_query("UPDATE pr_roi_adj SET ".$mydata->col_nam."='".$mydata->col_value."',update_date='".$today."' WHERE  user_id='".$mydata->user_id_val."' ",$db_connect) or die ('Unable to update row.');
    }


?>
