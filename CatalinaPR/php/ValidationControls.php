<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
        <link rel="stylesheet" href="../css/jquery-ui.css" />
	<link rel="stylesheet" href="../css/bootstrap.css">
        <script type="text/javascript" src="../js/main.js"></script>
        <script src="../js/jquery-1.9.1.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <script src="../js/jquery.validate.js"></script>
        <title>Validation Control</title>
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
<div id="content" >

                <div class="controls" id="chartarea">
                    <div id="tabs-1">
                        <div class="heading" style="width:330px; margin-left: 255px;">
                            <div style="text-align: center; font-weight: bold; font-size: 14px;">Control Validation Rules</div>
                            <div style=" text-align: center;">Minimum and Maximum Offer for  Controls</div>
                        </div>
                       <!-- <div>
                            <div class="segment" style="margin-left: 0px;width: 240px; height:20px;">Metric</div>
                            <div class="headers" style="width:330px; margin-left: 255px; margin-top:-24px;">
                                <ul style="float: left; list-style-type: none;">
                                    <li style="width:164px !important"><b>Minimum</b></li>
                                    <li style="width:88px !important"><b>Maximum</b></li>
                                </ul>
                            </div>
                        </div>-->

                        <form action="ValControls_Update.php" method="POST" id="update">
                            <div style="width:700px;margin-left: 100px;">
                                <?php
                                require 'connection.php';
                                if (isset($_SESSION['myusername'])) {
                                    $myusername = $_SESSION['myusername'];
                                }
                                else {
                                    header("location:../index.php");
                                }

                              //  $query = "SELECT a.user_id,a.metric_id,b.metric_desc, a.minimum,a.maximum FROM pr_val_control_rule a INNER JOIN pr_metric b ON a.metric_id = b.metric_id AND a.user_id ='app' where a.metric_id!=9";
                                 $query = "SELECT a.user_id,a.metric_id,b.metric_desc, a.minimum,a.maximum  FROM pr_val_control_rule a INNER JOIN pr_metric b ON a.metric_id = b.metric_id AND a.user_id ='app' AND upper(b.metric_desc) <> 'OFFERS PER DECK'";
				$results = mysqli_query($con, $query) or die("Error performing query");
                                $i = 1;
                                ?>

                               <!-- <table style="width:589px;" cellpadding='0' cellspacing='0'>-->
				<table class="table table-striped" cellpadding='0' cellspacing='0'>
        <thead>
        <tr>
        <td style="width:150px;"><label><b>Metric</b></label></td>
<td style="width:0px;"></td>
<td style="width:0px;"></td>
<td style="">&nbsp;</td>
<td style="text-align:center;"> <b>Minimum</b></td>
<td style="text-align:center;"> <b>Maximum</b></td>
</tr>
</thead>
<tbody>
                                    <?php while ($row = mysqli_fetch_array($results)) {  ?>
                                        <tr style="  height:10px;" class="val_control_row">

                                            <td class="segmentdesc" style="width:240px; padding-top:1px;"><label id="segment" name="segment"><?php echo $row[2]; ?></label></td>
                                            <td><input id="val_control_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                                            <td><input id="val_control_metric_id['<?php echo $i ?>']" type="hidden" name="metric_id" value="<?php echo $row[1]; ?>" /></td>
                                            <td>&nbsp;</td>
                                            <td style="width:163px;"><input name="val_con['<?php echo $i ?>']"  id="minimum" class="inpu_text" style="text-align: center; height:20px;  width:163px; font-size: 10px;"  value="<?php echo $row[3]; ?>"/></td>
                                            <td style="width:163px;"><input name="val_con['<?php echo $i ?>']"  id="maximum" class="inpu_text"  style="text-align: center; height:20px; width:163px;"   value="<?php echo $row[4]; ?>"/></td>
                                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                                        </tr>

                                    <?php $i++;
                                    } ?>
				</tbody>
                                </table>
                                <?php mysqli_close($con); ?>
                                <div id="Val_control_err"><label> Please enter value between -.10 and .20 </label></div>
                                <div class="updating" id="updating" style="margin-left:400px;">Your updates were saved</div>
                               <!-- <div>
                                    <div><input style="margin-left:250px; margin-top:20px; font-size: 13px;" type="button" name="save" id="val_control_save" value="save"/></div>
                                    <div style="margin-top: -25px; margin-left: 350px;"><input style=" font-size: 13px;" type="button" name="cancel" id="cancel" value="cancel"/></div>
                                    
                                </div>-->
				<div style="float:right;margin-right:30px;width:200px;">
                                    <div style="display:inline-block;width:50px;margin:15px;"><input style="padding-right:15px;padding-left:15px;font-weight:600;font-size:13px;" type="button" class="btn" name="save" id="val_control_save" value="Save"></div>
                                    <div style="display:inline-block;width:50px;"><input style="font-size: 13px;font-weight:600;" type="button" name="cancel" id="cancel" class="btn" value="Cancel"></div>
                                    
                                </div>
                            </div>  
                        </form>

                    </div>
                </div>

            </div>
   <div style="margin-top:90px;height: 29px;background-color:#0093d0 ">
                <?php //require 'Mainmenu.php'; ?>
</div>
        </div>

    </body>
</html>







