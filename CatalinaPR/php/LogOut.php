<?php
session_start();
if(isset($_SESSION['myusername'])){
     unset($_SESSION['myusername']); 
      header("location:LoginDesign.php");
     }
     else
     {
          header("location:../index.php");
     }
?>