<?php
session_start();
date_default_timezone_set(timezone_name_from_abbr("CST"));
require 'connection.php';
if (isset($_SESSION['myusername'])) {
    $myusername = $_SESSION['myusername'];
}
else {
   header("location:../index.php");
}

$today = date('Y-m-d H:i:s');
$updated_values = $_GET['arr'];
$decodedata = json_decode($updated_values);


foreach ($decodedata as $data) {
    
    $result = mysqli_query($con,"UPDATE pr_product_category SET " . $data->col_nam . "='" . $data->col_value . "',last_updated_time='".$today."',last_updated_by='".$myusername."' WHERE  user_id='" . $data->user_id_val . "'  AND super_category_id='" . $data->sup_id_val . "' AND product_category_code='" . $data->cat_code . "' AND product_category_id='" . $data->prod_id_val . "' ") or die('Unable to update row.');
}
?>
