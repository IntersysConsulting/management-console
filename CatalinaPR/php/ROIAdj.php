<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
        <link rel="stylesheet" href="../css/jquery-ui.css" />
        <script type="text/javascript" src="../js/main.js"></script>
        <script src="../js/jquery-1.9.1.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <script src="../js/jquery.validate.js"></script>
	<title>Program ROI Adjustment</title>
    </head>
    <body>
 <div class="home">

<div id="logout" >
                <a href="LogOut.php"  style="text-decoration: none; display:inline-block;height:15px; font-size: 14px;color: #7A98D1;font-weight: bolder;">Logout</a>
            </div>
 <div style="text-decoration: none;font-size:10px;color:#BACBEB; font-weight:bolder;margin-top:27px;position:absolute;margin-left:160px;"><a>Personalized Rewards</a></div>
            <div style="display:inline-block;"><img style="width:150px;height:100%;" src="../images/logo.png"/></div>

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
        <div class="heading" style="margin-left:80px;">
            <div style="text-align: center; font-weight: bold; font-size: 14px;">Program ROI Adjustment</div>
            <div style="font-style: italic; text-align: center;">Monthly Segment Change-Recency, Frequency, Monetary Value</div>
        </div>
        <div>

            <div class="headers" style="margin-left:80px; margin-top:1px;">
                <ul style="float: left; list-style-type: none;">
                    <li><b>-5</b></li>
                    <li><b>-4</b></li>
                    <li><b>-3</b></li>
                    <li><b>-2</b></li>
                    <li><b>-1</b></li>
                    <li><b>0</b></li>
                    <li><b>1</b></li>
                    <li><b>2</b></li>
                    <li><b>3</b></li>
                    <li><b>4</b></li>
                    <li><b>5</b></li>
                </ul>
            </div>
        </div>

<!--        <form action="ROIAdj_Update.php" method="POST" id="update" style="margin-left: 75px;">
            <div>-->
                <?php
                require 'connection.php';
                if (isset($_SESSION['myusername'])) {
                    $myusername = $_SESSION['myusername'];
                }
                else {
                    header("location:../index.php");
                }

                $query = "SELECT a.user_id, a.n5_val, a.n4_val, a.n3_val, a.n2_val, a.n1_val, a.zed_val, a.p5_val, a.p4_val, a.p3_val, a.p2_val, a.p1_val FROM pr_roi_adj a  INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='" . $myusername . "'";
                $results = mysql_query($query, $con) or die("Error performing query");
                $i = 0;
                ?>

                <table style="margin-left:80px;">
                    <?php while ($row = mysql_fetch_array($results)) { ?>
                        <tr style=" float:left; height:18px" class="sales_change_row">


                            <td><input id="roi_adj_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                            <td><input name="roi_adj['<?php echo $i ?>']"  id="n5_val" class="inpu_text" style="width:38px; font-size: 10px;"  value="<?php echo number_format($row[1], 2, '.', ''); ?>"/></td>
                            <td><input name="roi_adj['<?php echo $i ?>']"  id="n4_val" class="inpu_text"  style="width:38px;"   value="<?php echo number_format($row[2], 2, '.', ''); ?>"/></td>
                            <td><input name="roi_adj['<?php echo $i ?>']"  id="n3_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[3], 2, '.', ''); ?>"/></td>
                            <td><input name="roi_adj['<?php echo $i ?>']"  id="n2_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[4], 2, '.', ''); ?>"/></td>
                            <td><input name="roi_adj['<?php echo $i ?>']"  id="n1_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[5], 2, '.', ''); ?>"/></td>
                            <td><input name="roi_adj['<?php echo $i ?>']"  id="zed_val" class="inpu_text"  style="width:39px;" value="<?php echo number_format($row[6], 2, '.', ''); ?>"/></td>
                            <td><input name="roi_adj['<?php echo $i ?>']"  id="p5_val" class="inpu_text"  style="width:39px;" value="<?php echo number_format($row[7], 2, '.', ''); ?>"/></td>
                            <td><input name="roi_adj['<?php echo $i ?>']"  id="p4_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[8], 2, '.', ''); ?>"/></td>
                            <td><input name="roi_adj['<?php echo $i ?>']"  id="p3_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[9], 2, '.', ''); ?>"/></td>
                            <td><input name="roi_adj['<?php echo $i ?>']" id="p2_val" class="inpu_text"  style="width:39px;" value="<?php echo number_format($row[10], 2, '.', ''); ?>"/></td>
                            <td><input name="roi_adj['<?php echo $i ?>']" id="p1_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[11], 2, '.', ''); ?>"/></td>
                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                        </tr>

                        <?php $i++;
                    } ?>
                </table>
                <?php mysql_close($con); ?>
                <div id="roi_adj_err"><label> Please enter value between 0.00 and 0.20 </label></div>
                <div class="updating" id="roi_adj_updating" style="margin-top:20px;">Updated...</div>
                <div style="margin-left: 30px;">
                    <div><input style="margin-left:150px; margin-top:20px; font-size: 13px;" type="button" name="save" id="roi_adj_save" value="save"/></div>
                    <div style="margin-top: -25px; margin-left: 300px;"><input style=" font-size: 13px;" type="button" name="cancel" id="roi_adj_cancel" value="cancel"/></div>
                    
                </div>
</div>
</div>

<!--            </div>  
        </form>-->
    </body>
</html>
