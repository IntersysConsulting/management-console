<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
        <link rel="stylesheet" href="../css/jquery-ui.css" />
        <script type="text/javascript" src="../js/main.js"></script>
        <script src="../js/jquery-1.9.1.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <script src="../js/jquery.validate.js"></script>
        <title>Validation Control</title>
    </head>
    <body>
        <div class="home">


<div id="logout" >
                <a href="LogOut.php" id="logout" style="text-decoration: none;height:15px; font-size: 14px;color: #7A98D1;font-weight: bolder;">Logout</a>
            </div>
            <div style="text-decoration: none;font-size:10px;color:#BACBEB; font-weight:bolder;margin-top:27px;position:absolute;margin-left:120px;"><a>Personalized Rewards</a></div>
            <div style="display:inline-block;"><img src="../images/logo.JPG"/></div>

            <div style="height: 29px;background-color: #BACBEB;">
                <?php //require 'Mainmenu.php'; ?>


                <div class="mainmenu">
                    <ul>
                        <li class="active has-sub"><a href="DefaultHome.php">Home </a>

                                        <ul>
                                        <li><a href="DefaultHome.php">&nbsp;Time Lapse&nbsp;</a></li>
                                        <li><a href="DefaultHome.php">&nbsp;Table&nbsp;</a></li>
                                        <li class="last"><a href="DefaultHome.php">&nbsp;Scatter Plot.&nbsp;</a></li>
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
                        <li class="has-sub"><a href="ValidationControls.php">Validation Rules </a>
                            <ul>
                        <li><a href="ValidationControls.php" onclick="Controls();">&nbsp;Controls&nbsp;</a></li>
                        <li><a href="ProgramParameter.php" onclick="ProgramParams();">&nbsp;Program Parameters&nbsp;</a></li>
                        <li class="last"><a href="EligibleProduct.php" onclick="ProgramParams();">&nbsp;Eligible Product&nbsp;</a></li>
                                   </ul>

                        </li>
                        <li class="has-sub"><a href="ROIReports.php">Reports </a>
                      <ul>
                    <li class="last"><a href="ROIReports.php" onclick="ProgramParams();">&nbsp;ROI Report&nbsp;</a></li>

                </ul>

                        </li>
                    </ul>
                </div>
            </div>
<div id="content" >

                <div class="controls" id="chartarea" style="width:680px;height:370px;" >
                    <div id="tabs-1" style=" margin-left: 20px; margin-top: 20px;">
                        <div class="heading" style="width:330px; margin-left: 255px;">
                            <div style="text-align: center; font-weight: bold; font-size: 14px;">Control Validation Rules</div>
                            <div style=" font-style: italic; text-align: center;">Minimum and Maximum Offer for  Controls</div>
                        </div>
                        <div>
                            <div class="segment" style="margin-left: 0px;width: 240px; height:20px;">Metric</div>
                            <div class="headers" style="width:330px; margin-left: 255px; margin-top:-24px;">
                                <ul style="float: left; list-style-type: none;">
                                    <li style="width:164px !important"><b>Minimum</b></li>
                                    <li style="width:88px !important"><b>Maximum</b></li>


                                </ul>
                            </div>
                        </div>

<!--                        <form action="ValControls_Update.php" method="POST" id="update">-->
<!--                            <div>-->
                                <?php
                                require 'connection.php';
                                if (isset($_SESSION['myusername'])) {
                                    $myusername = $_SESSION['myusername'];
                                }
                                else {
                                    header("location:../index.php");
                                }

                                $query = "SELECT a.user_id,a.metric_id,b.metric_desc, a.minimum,a.maximum FROM pr_val_control_rule a INNER JOIN pr_metric b ON a.metric_id = b.metric_id INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='" . $myusername . "'";
                                $results = mysqli_query($query, $con) or die("Error performing query");
                                $i = 0;
                                ?>

                                <table style="width:589px;" cellpadding='0' cellspacing='0'>
                                    <?php while ($row = mysql_fetch_array($results)) { ?>
                                        <tr style="  height:10px;" class="val_control_row">

                                            <td class="segmentdesc" style="width:240px; padding-top:1px; border:#868282 1px solid ;"><label id="segment" name="segment"><?php echo $row[2]; ?></label></td>
                                            <td><input id="val_control_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                                            <td><input id="val_control_metric_id['<?php echo $i ?>']" type="hidden" name="metric_id" value="<?php echo $row[1]; ?>" /></td>
                                            <td>&nbsp;</td>
                                            <td style="width:163px;"><input name="val_con['<?php echo $i ?>']"  id="minimum" class="inpu_text" style="text-align: center; height:20px;  width:163px; font-size: 10px;"  value="<?php echo $row[3]; ?>"/></td>
                                            <td style="width:163px;"><input name="val_con['<?php echo $i ?>']"  id="maximum" class="inpu_text"  style="text-align: center; height:20px; width:163px;"   value="<?php echo $row[4]; ?>"/></td>
                                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                                        </tr>

                                    <?php $i++;
                                    } ?>
                                </table>
                                <?php mysql_close($con); ?>
                                <div id="Val_control_err"><label> Please enter value between -.10 and .20 </label></div>
                                <div class="updating" id="updating" style="margin-left:300px;">Updated...</div>
                                <div>
                                    <div><input style="margin-left:250px; margin-top:20px; font-size: 13px;" type="button" name="save" id="val_control_save" value="save"/></div>
                                    <div style="margin-top: -25px; margin-left: 350px;"><input style=" font-size: 13px;" type="button" name="cancel" id="cancel" value="cancel"/></div>
                                    
                                </div>
<!--                            </div>  -->
<!--                        </form>-->

                    </div>
                </div>

            </div>
        </div>

    </body>
</html>







