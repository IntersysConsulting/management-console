<?php
$host="ec2-54-214-119-155.us-west-2.compute.amazonaws.com"; // Host name 
$username="root"; // Mysql username 
$password="ema7&7nuel"; // Mysql password 
$db_name="mpr"; // Database name 
$con=mysql_connect("$host", "$username", "$password")or die("Unable to connect to MySQL.");
mysql_select_db("$db_name")or die("Unable to select database");
?>

