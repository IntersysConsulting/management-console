<?php

session_start();
require 'connection.php';
$tbl_name = "pr_user"; // Table name 
// Connect to server and select databse.


// username and password sent from form 
$myusername = $_POST['userid'];
$mypassword = $_POST['passwrd'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql = "SELECT * FROM $tbl_name WHERE user_id='$myusername' and password='$mypassword'";
$result = mysql_query($sql);

// Mysql_num_row is counting table row
$count = mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if ($count == 1) {

// Register $myusername, $mypassword and redirect to file "SalesChange.php"
    //session_register("myusername");
    //session_register("mypassword");
     
    $_SESSION['myusername']=$myusername;
   if(isset($_SESSION['myusername'])){
      header("location:DefaultHome.php");
     }
     else
     {
          header("location:../index.php");
     }
}
else {
//echo "Wrong Username or Password";
    $err = "Insufficient Privileges or unable to authenticate,please contact  xxxx for further assistance";
//header("location:../LoginDesign?err=" . $err);
    header("location:../index.php?err=" . $err);
}
?>
