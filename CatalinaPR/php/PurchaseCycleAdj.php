<?php session_start(); ?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Purchase Cycle Adj.</title>
        <script type="text/javascript" src="../js/main.js"></script>
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
        <link rel="stylesheet" href="../css/jquery-ui.css" />
        <script type="text/javascript" src="../js/main.js"></script>
        <script src="../js/jquery-1.9.1.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <script src="../js/jquery.validate.js"></script>

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


<div id="content">
<div class="controls" id="chartarea">
    <div style="margin-left:20px; margin-top:20px;">
        <div class="heading" style="width:265px; margin-left: 180px;">
            <div style="text-align: center; font-weight: bold; font-size: 14px;">Purchase Cycle Adjustment</div>
            <div style="text-align:center; font-style: italic;">Super Categories</div>
        </div>
        <div>
            <div class="segment" style="width: 170px">Segment</div>
            <div class="headers" style="width:265px; margin-left: 180px;">
                <ul style="float: left; list-style-type: none;">
                    <li style="width:84px !important"><b>Food</b></li>
                    <li style="width:89px !important"><b>Drug</b></li>
                    <li style="width:89px !important"><b>GM</b></li>

                </ul>
            </div>
        </div>

<!--        <form action="PurchaseCycle_Update.php" method="POST" id="update">
            <div>-->
                <?php
                require 'connection.php';
                if (isset($_SESSION['myusername'])) {
                    $myusername = $_SESSION['myusername'];
                }
                else {
                    header("location:../index.php");
                }
               
                $query = "SELECT a.user_id,a.segment_id,b.segment_desc,  a.food, a.drug, a.gm FROM pr_purch_cycle_adj a INNER JOIN pr_segment b ON a.segment_id = b.segment_id INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='" . $myusername . "'";
                $results = mysqli_query($query, $con) or die("Error performing query");
                $i = 0;
                ?>

                <table style=" width:455px; " cellpadding='0' cellspacing='0'>
                    <?php while ($row = mysql_fetch_array($results)) { ?>
                        <tr style="height:8px" class="pur_cycle_row">

                            <td class="segmentdesc" style="width:180px; border:#868282 1px solid;"><label id="segment" name="segment"><?php echo $row[2]; ?></label></td>
                            <td style="width:0px;"><input id="pur_cycle_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                            <td style="width:0px;"><input id="pur_cycle_segment_id['<?php echo $i ?>']" type="hidden" name="segment_id" value="<?php echo $row[1]; ?>" /></td>
                            <td style="width:15px;">&nbsp;</td>
                            <td style="width:86px;"><input name="pur_cyc['<?php echo $i ?>']"  id="food"  class="inpu_text" style=" width:88px; font-size: 10px;"  value="<?php echo number_format($row[3], 2, '.', ''); ?>"/></td>
                            <td style="width:88px;"><input name="pur_cyc['<?php echo $i ?>']"  id="drug"  class="inpu_text"  style="width:88px; font-size: 10px;"   value="<?php echo number_format($row[4], 2, '.', ''); ?>"/></td>
                            <td style="width:95px;"><input name="pur_cyc['<?php echo $i ?>']"  id="gm"  class="inpu_text"  style=" width:88px; font-size: 10px;" value="<?php echo number_format($row[5], 2, '.', ''); ?>"/></td>
                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                        </tr>

                        <?php $i++;
                    } ?>
                </table>
                <?php mysql_close($con); ?>
                <div id="pur_cycle_adj_err"><label> Please enter value between 30 and 100 </label></div>
                 <div class="updating" id="pur_cyc_updating">Updated...</div>
                <div style="margin-left:30px;">
                    <div><input style="margin-left:200px;  margin-top:15px; font-size: 13px;" type="button" name="save" id="pur_cycle_save" value="save"/></div>
                    <div style="margin-top: -25px; margin-left: 300px;"><input style=" font-size: 13px;" type="button" name="cancel" id="purch_cylce_adj_cancel" value="cancel"/></div>
                   
                </div>
</div>
</div>
</div>

<!--            </div>  
        </form>-->
    </body>
</html>
