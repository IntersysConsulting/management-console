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
        <title>Guard Rails</title>
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
                        <li class="active has-sub"><a href="GuardRails.php">Guard Rails </a>
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




            <div id="content" >
                <div class="controls" id="chartarea">

                    <div id="tabs-1">
                        <div class="heading" style="width:290px; margin-left: 260px;">
                            <div style="text-align: center; font-weight: bold; font-size: 14px;">Program Guard Rails</div>
                            <div style="  text-align: center;">Minimum and Maximum Offer Values</div>
                        </div>
                       <!-- <div style="margin-left:110px; margin-top: 21px;">

                            <div class="headers" style="width:290px; margin-left: 150px;">
                                <ul style="float: left; list-style-type: none;">
                                    <li style="width:144px !important"><b>Minimum</b></li>
                                    <li style="width:88px !important"><b>Maximum</b></li>


                                </ul>
                            </div>
                        </div>-->

                        <form action="GuardRails_Update.php" method="POST" id="update">
                            <div style="margin-top: 10px; margin-left: 103px;width:700px;">
                                <?php
                                require 'connection.php';
                                if (isset($_SESSION['myusername'])) {
                                    $myusername = $_SESSION['myusername'];
                                }
                                else {
                                    header("location:../index.php");
                                }
                                $query = "SELECT a.user_id,a.metric_id,b.metric_desc, a.minimum,a.maximum FROM pr_guard_rails a INNER JOIN pr_guard_rails_metric b ON a.metric_id = b.metric_id  AND a.user_id ='app'";
                                $results = mysqli_query($con, $query) or die("Error performing query");
                                $i = 0;
                                ?>

                               <!-- <table style="width:550px;" cellpadding='0' cellspacing='0'>-->
				<table class="table table-striped" cellpadding='0' cellspacing='0'>
        <thead>
        <tr>
        <td style="width:150px;"><label><b></b></label></td>
<td style="width:0px;"></td>
<td style="width:0px;"></td>
<td style="">&nbsp;</td>
<td style="text-align:center;"> <b>Minimum</b></td>
<td style="text-align:center;"> <b>Maximum</b></td>


</tr>
</thead>
<tbody>
                                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr style=" height:10px" class="sales_change_row">

                                            <td class="segmentdesc" style="width:240px;"><label id="metric" name="metric"><?php echo $row[2]; ?></label></td>
                                            <td><input id="guard_rails_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                                            <td><input id="guard_rails_metric_id['<?php echo $i ?>']" type="hidden" name="metric_id" value="<?php echo $row[1]; ?>" /></td>
                                            <td>&nbsp;</td>
                                            <td style="width:143px;"><input name="guard_rails['<?php echo $i ?>']"  id="minimum" class="inpu_text" style="text-align: center; height:20px; width:143px; font-size: 10px;"  value="<?php echo $row[3]; ?>"/></td>
                                            <td style="width:143px;"><input name="guard_rails['<?php echo $i ?>']"  id="maximum" class="inpu_text"  style="text-align: center; height:20px; width:143px;"   value="<?php echo $row[4]; ?>"/></td>

                                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                                        </tr>

                                 <?php $i++;
                                  } ?>
				</tbody>
                                </table>
                                <?php mysqli_close($con); ?>
                                <div id="guard_rails_err"><label> Please enter value between 0 and 30 </label></div>
                                <div class="updating" id="updating" style="margin-left:420px;">Your updates were saved</div>
                               <!-- <div style="margin-left:60px;">
                                    <div><input style="margin-left:250px; margin-top:20px; font-size: 13px;" type="button" name="save" id="guard_rails_save" value="save"/></div>
                                    <div style="margin-top: -25px; margin-left: 350px;"><input style=" font-size: 13px;" type="button" name="cancel" id="cancel" value="cancel"/></div>
                                    
                                </div>-->
				<div style="float:right;margin-right:30px;width:200px;">
                                    <div style="display:inline-block;width:50px;margin:15px;"><input style="padding-right:15px;padding-left:15px;font-weight:600;font-size:13px;" type="button" class="btn" name="save" id="guard_rails_save" value="Save"></div>
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






