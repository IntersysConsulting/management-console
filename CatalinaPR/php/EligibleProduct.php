<?php 
session_start();
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Eligible Products.</title>
        <script type="text/javascript" src="../js/main.js"></script>
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
    </head>
    <body>
        <div class="heading" id="headings" style="padding-top: 10px; width:570px; margin-top:10px; text-align: center; font-size: 18px; font-weight: bolder;margin-left: 20px;  ">
            Product Categories Eligible for Personalized Reward Program
        </div>
        <div>
        <div class="segment" id="super"style="width:250px;height:38px;margin-top:30px; margin-left:50px;text-decoration: none !important;">
            <div style="margin-top: 10px; font-weight:bolder; font-size:16px;">Super Category Description</div>
            
        </div>
        <div style="margin-top: -40px; margin-left: 350px;">
        <?php 
        require 'connection.php';
            if (isset($_SESSION['myusername'])) {
                $myusername = $_SESSION['myusername'];
            }
            else {
                header("location:../index.php");
            }
                                    $sql = "SELECT a.super_category_desc,a.super_category_id FROM pr_super_category a";
                                    $result = mysql_query($sql);

                                    echo "<select id='drp_dwn_super_category' name='super_category_desc' style='margin-left: -7px;width: 175px; height: 38px;font-size:16px; font-weight:bold; font-family:calibri;'>";
                                    echo "<option style='text-align:center;' value=''></option>";
                                    while ($row = mysql_fetch_array($result)) {
                                        
                                        echo "<option style='text-align:center;' value='" . $row[1] . "'>" . $row[0] . "</option>";
                                    }
                                    echo "</select>";
                                    echo "<input type='hidden' id='username' value='".$myusername."'/>";
                                            
        
        ?>
        </div>
        </div>
        
        <div style="margin-top: 60px;">
            <div class="segment" id="Prod_cat_code" style="width: 157px;height: 20px;">Product Category Code</div>
            <div class="segment" id="Prod_cat_desc"style="margin-top: -22px;margin-left: 182px;width: 255px;height: 20px">Product Category Description</div>
            <div class="heading" id="pc_value" style="width: 132px;margin-top: -22px;margin-left: 458px;height: 20px;text-align: center;text-decoration: underline;font-weight: bold;">Value</div>
            
        </div>
        <form action="EligibleProducts_Update.php" method="POST" id="update" style="margin-top:5px;">
          <div>
        <?php
        
         require 'connection.php';
            if (isset($_SESSION['myusername'])) {
                $myusername = $_SESSION['myusername'];
                }
            else {
                header("location:../index.php");
            }
            $val=$_GET['sup_id'];
             if($val!=null){
                    $sql = "SELECT a.user_id,a.super_category_id,a.product_category_code,a.product_category_desc,a.pc_value FROM pr_product_category a WHERE a.user_id='".$myusername."' AND a.super_category_id=".$val."";
                    $result = mysql_query($sql);
                    $i=0;
                    echo "<table style='width:630px; margin-left:5px;' cellpadding='0' cellspacing='0'>";
                    while ($row = mysql_fetch_array($result)) {
                        echo "<tr style='height:20px;' >";
                        echo "<td class='segmentdesc' style='width:120px; padding-top:1px; border:#868282 1px solid;'><label id='segment' name='segment'>"; echo $row[2];  echo "</label></td>";
                        echo '<td style="width:15px"><input id="prod_cat_user_id['; echo $i; echo']" type="hidden" name="user_id" value="'; echo $row[0]; echo'" /></td>';
                        echo '<td><input id="super_cat_code['; echo $i; echo']" type="hidden" name="super_cat_code" value="'; echo $row[2]; echo'" /></td>';
                        echo '<td class="segmentdesc" style="width:195px; border:#868282 1px solid; padding-top:1px"><label id="segment" name="segment">'; echo $row[3];  echo '</label></td>';
                        echo '<td style="width:20px"><input id="super_cat_id['; echo $i; echo']" type="hidden" name="super_cat_id" value="'; echo $row[1]; echo'" /></td>';
                        echo '<td style="width:130px;"><input name="prod_cat['; echo $i; echo ']"  id="pc_value" class="inpu_text" style="text-align: center; height:20px; width:130px; font-size: 10px;"  value="';echo $row[4]; echo'"/></td>';
                        echo "</tr>";
                        $i++;
                    }
                    echo '</table>';
             }
             else
             {

             }
         ?>
         <div id="sample"></div>
                               
                <div id="prod_cat_err"><label> Please enter value between -.10 and .20 </label></div>
                <div style="margin-top: 20px;">
                    <div><input style="margin-left:220px;  margin-top:15px; font-size: 13px;" type="button" name="save" id="pro_cat_save" value="save"/></div>
                    <div style="margin-top: -25px; margin-left: 300px;"><input style=" font-size: 13px;" type="button" name="cancel" id="prod_cat_ancel" value="cancel"/></div>
                </div>

            </div>  
        </form>
 </body>
</html>
