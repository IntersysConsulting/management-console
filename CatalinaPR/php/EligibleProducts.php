<?php session_start(); ?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Purchase Cycle Adj.</title>
        <script type="text/javascript" src="../js/main.js"></script>
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
    </head>
    <body>


        <div class="heading" style="padding-top: 10px; width:570px; margin-top:10px; text-align: center; font-size: 18px; font-weight: bolder;margin-left: 20px;  ">
            Product Categories Eligible for Personalized Reward Program
        </div>
        <div>
        <div class="segment" style="width:250px;height:38px;margin-top:30px; margin-left:50px;text-decoration: none !important;">
            <div style="margin-top: 10px; font-weight:bolder; font-size:16px;">Super Category Description</div>
            
        </div>
        <div style="margin-top: -40px; margin-left: 350px;"><?php 
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
                                    echo "<input type='hidden' id='username' value='".$myusername."'/>"
        
        ?>
        </div>
        </div>
        
        <div style="margin-top: 20px;">
            <div class="segment" id="Prod_cat_code" style="width: 160px;height: 20px;">Product Category Code</div>
            <div class="segment" id="Prod_cat_desc"style="margin-top: -22px;margin-left: 185px;width: 260px;height: 20px">Product Category Description</div>
            <div class="heading" id="pc_value" style="width: 132px;margin-top: -22px;margin-left: 463px;height: 20px;text-align: center;text-decoration: underline;font-weight: bold;">Value</div>
            
        </div>
	<table style="width: 605px; margin-top:5px;" cellpadding="0" cellspacing="0" border="0" id="CategoryTable"></table>
        
                <div id="prod_cat_err"><label> Please enter value between -.10 and .20 </label></div>
                <div>
                    <div><input style="margin-left:220px;  margin-top:15px; font-size: 13px;" type="button" name="save" id="pro_cat_save" value="save"/></div>
                    <div style="margin-top: -25px; margin-left: 300px;"><input style=" font-size: 13px;" type="button" name="cancel" id="cancel" value="cancel"/></div>
                </div>

            </div>  
        </form>
 </body>
</html>