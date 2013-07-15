<?php
$host="localhost"; // Host name 
$username=""; // Mysql username 
$password=""; // Mysql password 
$db_name="mpr"; // Database name 
$con=mysql_connect("$host", "$username", "$password")or die("Unable to connect to MySQL.");
mysql_select_db("$db_name")or die("Unable to select database");
?>

