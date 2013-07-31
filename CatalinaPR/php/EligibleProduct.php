<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
	<link type="text/css" rel="stylesheet" href="../css/main.css" />
        <link rel="stylesheet" href="../css/jquery-ui.css" />
	<link rel="stylesheet" href="../css/bootstrap.css">
        <script type="text/javascript" src="../js/main.js"></script>
        <script src="../js/jquery-1.9.1.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <script src="../js/jquery.validate.js"></script>
	<title>Eligible Products</title>
    </head>
    <body>

        <div class="home">


<div id="logout" >
                <a href="LogOut.php"  style="text-decoration: none; display:inline-block;height:15px; font-size: 14px;color: #0093d0;font-weight: bolder;">Logout</a>
            </div>
 <div id="prheading" style="text-decoration: none;font-size:10px;color:#BACBEB; font-weight:bolder;margin-top:27px;position:absolute;margin-left:160px;"><a>Personalized Rewards</a></div>
            <div id="logo" style="display:inline-block;"><img style="width:150px;height:100%;" src="../images/logo.png"/></div>

            <div id="mainmenubg" style="height: 29px;background-color: #0093d0;">
                <?php //require 'Mainmenu.php'; ?>

                <div class="mainmenu">
                    <ul>
                        <li class="has-sub"><a href="DefaultHome.php">Home </a>

                                        <ul>
                                        <li><a href="DefaultHome.php">&nbsp;Overview&nbsp;</a></li>
                                        <li><a href="Treemap.php">&nbsp;Product Hierarchy&nbsp;</a></li>
                                        <li class="last"><a href="ScatterChart.php">&nbsp;Product Categories&nbsp;</a></li>
                                   </ul>
                </li>
                        <li class="has-sub"><a href="SalesChange.php">Controls </a>
                                 <ul>

                                        <li><a href="SalesChange.php">&nbsp;Sales Change&nbsp;</a></li>
                                        <li><a href="ROIGoals.php">&nbsp;ROI Goals&nbsp;</a></li>
                                        <li><a href="ROIAdj.php">&nbsp;ROI Adj.&nbsp;</a></li>
                                        <li><a href="PurchaseCycleAdj.php">&nbsp;Purchase Cycle Adj.&nbsp;</a></li>
                                         <li><a href="CategoryPerformance.php">&nbsp;Category Performance&nbsp;</a></li>
                                        <li class="last"><a href="HHPerformance.php">&nbsp;HH Performance&nbsp;</a></li>
                                   </ul>
                        </li>
                        <li class="has-sub"><a href="GuardRails.php">Guard Rails </a>
                                                 <ul>
                                        <li class="last"><a href="GuardRails.php">&nbsp;Guard Rails&nbsp;</a></li>

</ul>
                        </li>
                        <li class="active has-sub"><a href="ValidationControls.php">Validation Rules </a>
                            <ul>
                        <li><a href="ValidationControls.php" >&nbsp;Controls&nbsp;</a></li>
                        <li><a href="ProgramParameter.php" >&nbsp;Program Parameters&nbsp;</a></li>
                        <li class="last"><a href="EligibleProduct.php" >&nbsp;Eligible Product&nbsp;</a></li>
                                   </ul>

                        </li>
                        <li class="has-sub"><a href="ROIReportChart.php">Reports </a>
                      <ul>
                    <li class="last"><a href="ROIReportChart.php" >&nbsp;ROI Report&nbsp;</a></li>

                </ul>

                        </li>
                    </ul>
                </div>
            </div>


<div id="content">
<div class="controls" id="chartarea">
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
                                    $query = "SELECT a.super_category_desc,a.super_category_id FROM pr_super_category a";
                                    $result = mysqli_query($con,$query) or die("Error on performing query");

                                    echo "<select id='drp_dwn_super_category' name='super_category_desc' style='margin-left: -7px;width: 175px; height: 38px;font-size:16px; font-weight:bold; font-family:calibri;'>";
                                    echo "<option style='text-align:center;' value=''></option>";
                                    while ($row = mysqli_fetch_array($result)) {
                                        
                                        echo "<option style='text-align:center;' value='" . $row[1] . "'>" . $row[0] . "</option>";
                                    }
                                    echo "</select>";
                                    echo "<input type='hidden' id='username' value='".$myusername."'/>";
                                            
        
        ?>
        </div>
        </div>
        
   <!--     <div style="margin-top: 60px;">
            <div class="segment" id="Prod_cat_code" style="margin-left:5px;width: 157px;height: 20px;">Product Category Code</div>
            <div class="segment" id="Prod_cat_desc"style="margin-top: -22px;margin-left: 182px;width: 255px;height: 20px">Product Category Description</div>
            <div class="heading" id="pc_value" style="width: 132px;margin-top: -22px;margin-left: 458px;height: 20px;text-align: center;text-decoration: underline;font-weight: bold;">Value</div>
            
        </div>-->
        <form action="EligibleProducts_Update.php" method="POST" id="update" style="margin-top:5px;">
          <div style="width:700px; margin-top:35px;">
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
                    $result = mysqli_query($con,$sql) or die("Error on Performing next query");
                    $i=0;
                   // echo "<table style='width:630px; margin-left:5px;' cellpadding='0' cellspacing='0'>";
		    echo "<table class='table table-striped' cellpadding='0' cellspacing='0'>";
		    echo '<thead>
        <tr>
        <td style="width:150px;"><label><b>Product Category Code</b></label></td>
<td style="width:0px;"></td>
<td style="width:0px;"></td>
<td style="width:170px;"><label><b>Product Category Description</b></label></td>
<td style="text-align:center;"> </td>
<td style="text-align:center;"> <b>Value</b></td>
</tr>
</thead>
<tbody>';
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr style='height:20px;' >";
                        echo "<td class='segmentdesc' style='width:120px; padding-top:1px;'><label id='segment' name='segment'>"; echo $row[2];  echo "</label></td>";
                        echo '<td style="width:10px"><input id="prod_cat_user_id['; echo $i; echo']" type="hidden" name="user_id" value="'; echo $row[0]; echo'"/></td>';
                        echo '<td style="width:0px;"><input id="super_cat_code['; echo $i; echo']" type="hidden" name="super_cat_code" value="'; echo $row[2]; echo'"/></td>';
                        echo '<td class="segmentdesc" style="width:195px;  padding-top:1px"><label id="segment" name="segment">'; echo $row[3];  echo '</label></td>';
                        echo '<td style="width:20px"><input id="super_cat_id['; echo $i; echo']" type="hidden" name="super_cat_id" value="'; echo $row[1]; echo'"/></td>';
                       // echo '<td style="width:130px;"><input name="prod_cat['; echo $i; echo ']"  id="pc_value" class="inpu_text" style="text-align: center;display:block !important; height:20px; width:130px; font-size: 10px;"  value="';echo $row[4]; echo'"/></td>';
			echo '<td style="width:50px;"><select name="prod_cat1['; echo $i; echo']" id="pc_value" style="margin-left: -7px;width: 155px;display:block !important; height: 35px;font-size:12px; font-weight:bold; font-family:calibri;">';
                                 echo '<option style="text-align:center;" value="YES">YES</option>';
                                 echo '<option style="text-align:center;" value="NO">NO</option>';
                                echo '</select></td>';
                        echo "</tr>";
                        $i++;
                    }
		    echo '</tbody>';
                    echo '</table>';
             }
             else
             {

             }
         ?>
         <div id="sample"></div>
                               
                <div id="prod_cat_err"><label> Please enter value YES/NO </label></div>
                <div class="prod_cat_updating" >Updated...</div>
                <div style="float:right;margin-right:30px;width:200px;">
                    <div style="display:inline-block;width:50px;margin:15px;"><input style="padding-right:15px;padding-left:15px;font-weight:600;font-size:13px;" type="button"class="btn" name="save" id="pro_cat_save" value="Save"/></div>
                    <div style="display:inline-block;width:50px;"><input style="font-weight:600; font-size: 13px;" type="button"class="btn" name="cancel" id="prod_cat_ancel" value="Cancel"/></div>
                    
                </div>
</div>

         </div>  
           </form>
</div>

   <div id="bottomstripe" style="margin-top:90px;height: 29px;background-color:#0093d0 ">
                <?php //require 'Mainmenu.php'; ?>
</div>
</div>
 </body>
</html>
