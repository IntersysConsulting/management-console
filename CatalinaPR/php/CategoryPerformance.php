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
	<title>Category Performance</title>

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

        <div class="heading" style="width:263px; margin-left: 217px;">
            <div style="text-align: center; font-weight: bold; font-size: 14px;">Category Performance</div>
            <div style="text-align:center; font-style: italic;">ROI adjustment based on category Performance</div>
        </div>
        <div style="margin-left:70px;">
            <div class="segment" style="margin-left: 7px;width: 125px">Index</div>
            <div class="headers" style="width:263px; margin-left: 147px;">
                <ul style="float: left; list-style-type: none;">
                    <li style="width:128px !important"><b>Bottom Quartile</b></li>
                    <li style="width:88px !important"><b>Top Quartile</b></li>


                </ul>
            </div>
        </div>

<!--        <form action="CategoryPerf_Update.php" method="POST" id="update" style="width:550px; margin-left:70px;">
            <div>-->
                <?php
                require 'connection.php';
                if (isset($_SESSION['myusername'])) {
                    $myusername = $_SESSION['myusername'];
                }
                else {
                    header("location:../index.php");
                }

                $query = "SELECT a.user_id,a.index_id,b.index_desc,a.bottom_quartile,a.top_quartile FROM pr_category_perf a INNER JOIN pr_index b ON a.index_id = b.index_id INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='" . $myusername . "'";
                $results = mysql_query($query, $con) or die("Error performing query");
                $i = 0;
                ?>

                <table style="margin-left: 72px;" cellpadding='0' cellspacing='0'>
                    <?php while ($row = mysql_fetch_array($results)) { ?>
                        <tr style="height:18px" class="sales_change_row">

                            <td class="segmentdesc" style="width:130px; border:#868282 1px solid;"><label id="Index" name="Index"><?php echo $row[2]; ?></label></td>
                            <td style="width:10px;"><input id="cat_per_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                            <td style="width:10px;"><input id="cat-per_index_id['<?php echo $i ?>']" type="hidden" name="indext_id" value="<?php echo $row[1]; ?>" /></td>
                            <td style="width:130px;"><input name="cat_per['<?php echo $i ?>']"  id="bottom_quartile"  class="inpu_text" style="text-align: center; height:20px; width:130px; font-size: 10px;"  value="<?php echo number_format($row[3], 2, '.', ''); ?>"/></td>
                            <td style="width:130px;"><input name="cat_per['<?php echo $i ?>']"  id="top_quartile"  class="inpu_text"  style="text-align: center; height:20px; width:130px; font-size: 10px;"   value="<?php echo number_format($row[4], 2, '.', ''); ?>"/></td>
                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                        </tr>

                        <?php $i++;
                    } ?>
                </table>
                <?php mysql_close($con); ?>
                <div id="cat_perf_err"><label> Please enter value between 5 and 120 </label></div>
                <div class="updating" id="cat_perf_updating" style="margin-left:300px;">Updated...</div>
                <div style="margin-left:60px;">
                    <div><input style="margin-left:200px; margin-top:15px; font-size: 13px;" type="button" name="save" id="cat_perf_save" value="save"/></div>
                    <div style="margin-top: -25px; margin-left: 300px;"><input style=" font-size: 13px;" type="button" name="cancel" id="cat_perf_cancel" value="cancel"/></div>
                    
                </div>
</div>
</div>

<!--            </div>  
        </form>-->
    </body>
</html>
