<?php

require 'connection.php';

$today = date('Y-m-d H:i:s');
$updated_values = $_GET['arr'];
$decodedata = json_decode($updated_values);


foreach ($decodedata as $data) {
    
    $result = mysql_query("UPDATE pr_product_category SET " . $data->col_nam . "='" . $data->col_value . "',update_date='" . $today . "' WHERE  user_id='" . $data->user_id_val . "'  AND super_category_id='" . $data->sup_id_val . "' AND product_category_code='" . $data->cat_code . "' ", $con) or die('Unable to update row.');
}
?>
