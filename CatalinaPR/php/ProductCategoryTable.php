<?php
header('Content-Type: text/javascript; charset=UTF-8');
require 'JsonProductCategory.php';
$db_host       = "localhost";
$db_name        = "mpr";
$db_username    = "root";
$db_password    = "root555";
$category_id=$_GET['cat_desc'];
$user_id=$_GET['user'];


//// DATABASE: Try to connect
if (!$db_connect = mysql_connect($db_host, $db_username, $db_password))
        die('Unable to connect to MySQL.');
if (!$db_select = mysql_select_db($db_name, $db_connect))
        die('Unable to select database');

$sql = "SELECT a.user_id,a.super_category_id,a.product_category_code,a.product_category_desc,a.pc_value FROM pr_product_category a WHERE a.user_id='".$user_id."' AND a.super_category_id=".$category_id."";
$result = mysql_query($sql);
$ProdCatArray=array();
while ($row = mysql_fetch_array($result)) { 
    $jsonPC = new JsonProductCategory();				
			$jsonPC->SetuserId($row[0]);
			$jsonPC->SetSuperCatId($row[1]);
			$jsonPC->SetProdCategoryCode($row[2]);
			$jsonPC->SetProdcatDesc($row[3]);
			$jsonPC->SetPValue($row[4]);
    $ProdCatArray[]=$jsonPC;

}
                $jsonOut = '({"result" :{"product":'.json_encode($ProdCatArray,TRUE).'}})';			
		header('Content-Length: '. strlen($jsonOut."CategoryCallback"));
		echo $_GET['callback'] . $jsonOut;
//echo  json_encode($ProdCatArray,TRUE);
mysql_close($con);
?>
