<?php session_start(); ?>
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
	<title>HouseHold Performance</title>

    </head>
    <body>

        <div class="home">


<div id="logout" >
                <a href="LogOut.php"  style="text-decoration: none; display:inline-block;height:15px; font-size: 14px;color: #0093d0;font-weight: bolder;">Logout</a>
            </div>
 <div style="text-decoration: none;font-size:10px;color:#BACBEB; font-weight:bolder;margin-top:27px;position:absolute;margin-left:160px;"><a>Personalized Rewards</a></div>
            <div style="display:inline-block;"><img style="width:150px;height:100%;" src="../images/logo.png"/></div>

            <div style="height: 29px;background-color: #0093d0;">
                <?php //require 'Mainmenu.php'; ?>


                <div class="mainmenu">
                    <ul>
                        <li class="has-sub"><a href="DefaultHome.php">Home </a>

                                        <ul>
                                        <li><a href="DefaultHome.php">&nbsp;Overview&nbsp;</a></li>
                                        <li><a href="Treemap.php">&nbsp;Product Hierarchy&nbsp;</a></li>
                                        <li class="last"><a href="ScatterChart.php">&nbsp;Aggregate Sales&nbsp;</a></li>
                                   </ul>
                </li>
                        <li class="active has-sub"><a href="SalesChange.php">Controls </a>
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
                        <li class="has-sub"><a href="ValidationControls.php">Validation Rules </a>
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
        <div class="heading" style="width:420px; margin-left: 220px;">
            <div style="text-align: center; font-weight: bold; font-size: 14px;">Household Performance</div>
            <div style="text-align: center; ">ROI adjustment based on HH Activation and Achievement</div>
        </div>
<!--        <div style="margin-left:20px;">
            <div class="segment" style="margin-left: 7px;width: 180px">Index</div>
            <div class="headers" style="width:290px; margin-left: 200px;">
                <ul style="float: left; list-style-type: none;">
                    <li style="width:144px !important"><b>Bottom Quartile</b></li>
                    <li style="width:88px !important"><b>Top Quartile</b></li>
                </ul>
            </div>
        </div> -->


                <?php
                require 'connection.php';
                if (isset($_SESSION['myusername'])) {
                    $myusername = $_SESSION['myusername'];
                }
                else {
                    header("location:../index.php");
                }
                ?>
                <?php
                $query = "SELECT a.user_id,a.index_id,b.index_desc,a.bottom_quartile,a.top_quartile FROM pr_hh_perform a INNER JOIN pr_index b ON a.index_id = b.index_id  AND a.user_id ='app'";
                $results = mysqli_query($con, $query) or die("Error performing query");
                $i = 0;
                ?>
		<div style="width:600px;margin-left: 100px;">
               <!-- <table style="margin-left: 25px; width:490px; " cellpadding='0' cellspacing='0'>-->
		<table class="table table-striped" cellpadding='0' cellspacing='0'>
	        <thead>
	        <tr>
	        <td style="width:150px;"><label><b>Index</b></label></td>
		<td style="width:0px;"></td>
		<td style="width:0px;"></td>
		<td>&nbsp;</td>
		<td style="text-align:center;"> <b>Bottom Quartile</b></td>
		<td style="text-align:center;"> <b>Top Quartile</b></td>
		</tr>
		</thead>
		<tbody>
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <tr style=" height:10px;" class="sales_change_row">

                            <td class="segmentdesc" style="width:180px;"><label id="index" name="index"><?php echo $row[2]; ?></label></td>
                            <td><input id="hh_perf_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                            <td><input id="hh_perf_index_id['<?php echo $i ?>']" type="hidden" name="index_id" value="<?php echo $row[1]; ?>" /></td>
                            <td>&nbsp;</td>
			    <?php if($row[3]==0.00){ ?>
                            <td style="width:144px;"><input name="hh_perf['<?php echo $i ?>']"  id="bottom_quartile"  class="inpu_text" style="text-align: center; height:20px; width:144px; font-size: 10px;"  value="<?php echo number_format($row[3], 0, '.', ''); ?>"/></td>
                             <?php } else{ ?>
                            <td style="width:144px;"><input name="hh_perf['<?php echo $i ?>']"  id="bottom_quartile"  class="inpu_text" style="text-align: center; height:20px; width:144px; font-size: 10px;"  value="<?php echo number_format($row[3], 2, '.', ''); ?>"/></td>
                            <?php } if($row[4]==0.00){ ?>
                            <td style="width:144px;"><input name="hh_perf['<?php echo $i ?>']"  id="top_quartile"  class="inpu_text"  style="text-align: center; height:20px; width:144px; font-size: 10px;"   value="<?php echo number_format($row[4], 0, '.', ''); ?>"/></td>
                            <?php } else{ ?>
                            <td style="width:144px;"><input name="hh_perf['<?php echo $i ?>']"  id="top_quartile"  class="inpu_text"  style="text-align: center; height:20px; width:144px; font-size: 10px;"   value="<?php echo number_format($row[4], 2, '.', ''); ?>"/></td>
                            <?php } ?>
                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                        </tr>

                        <?php $i++;
                    } ?>
		</tbody>
                </table>
                <?php mysqli_close($con); ?>
                <div id="hh_perf_err"><label> Please enter value between -0.05 and 0.05 </label></div>
                <div class="updating" id="hh_perf_updating" style="margin-left:370px;">Your updates were saved</div>
                <div style="float:right;margin-right:30px;width:200px;">
                    <div style="display:inline-block;width:50px;margin:15px;"><input style="padding-right:15px;padding-left:15px;font-weight:600;font-size:13px" type="button"class="btn" name="save" id="hh_perf_save" value="Save"/></div>
                    <div style="display:inline-block;width:50px;"><input style="font-size: 13px;font-weight:600;" type="button" class="btn" name="cancel" id="hh_perf_cancel" value="Cancel"/></div>
                    
                </div></div>
</div>
   <div style="margin-top:90px;height: 29px;background-color:#0093d0 ">
                <?php //require 'Mainmenu.php'; ?>
</div>
</div>


    </body>
</html>

