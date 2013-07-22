<?php
session_start();
if (isset($_SESSION['myusername'])) {
    $myusername = $_SESSION['myusername'];
}
else {
   header("location:../index.php");
}
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
        <title>Sales Change Goals</title>
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
                        <li><a href="ValidationControls.php">&nbsp;Controls&nbsp;</a></li>
                        <li><a href="ProgramParameter.php">&nbsp;Program Parameters&nbsp;</a></li>
                        <li class="last"><a href="EligibleProduct.php">&nbsp;Eligible Product&nbsp;</a></li>
                                  </ul>

                        </li>
                        <li class="has-sub"><a href="ROIReportChart.php">Reports </a>
                      <ul>
                    <li class="last"><a href="ROIReportChart.php">&nbsp;ROI Report&nbsp;</a></li>

                </ul>

                        </li>
                    </ul>
                </div>
            </div>



            <div id="tabs" style="margin-top:10px;">
                <div class="controls" id="chartarea">

                    <div id="tabs-1">
                        <div class="heading">
                            <div style="text-align: center; font-weight: bold; font-size: 14px;">Sales Change Goals</div>
                            <div style="font-style: italic; text-align: center;">Quintile Change-current Period vs Previous Period or same period Last Year</div>
                        </div>
                        <div>
                            <div class="segment">Segment</div>
                            <div class="headers">
                                <ul style="float: left; list-style-type: none;">
                                    <li> <b>-5</b></li>
                                    <li> <b>-4</b></li>
                                    <li> <b>-3</b></li>
                                    <li> <b>-2</b></li>
                                    <li> <b>-1</b></li>
                                    <li> <b>0</b></li>
                                    <li> <b>1</b></li>
                                    <li> <b>2</b></li>
                                    <li> <b>3</b></li>
                                    <li> <b>4</b></li>
                                    <li> <b>5</b></li>
                                </ul>
                            </div>
                        </div>
                       <form action="SalesChange_Update.php" method="POST" id="update"> 
                            <div>
                                <?php
                                require 'connection.php';
                                if (isset($_SESSION['myusername'])) {
                                    $myusername = $_SESSION['myusername'];
                                }
                                else {
                                    header("location:../index.php");
                                }
                                $query = "SELECT a.user_id,a.segment_id,b.segment_desc, a.n5_val, a.n4_val, a.n3_val, a.n2_val, a.n1_val, a.zed_val, a.p5_val, a.p4_val, a.p3_val, a.p2_val, a.p1_val FROM pr_sales_change a INNER JOIN pr_segment b ON a.segment_id = b.segment_id INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='" . $myusername . "'";
                                $results = mysqli_query($con,$query) or die("Error performing query");
                                $i = 0;
$num = mysqli_num_rows($result);
echo "4343" . "$num";
                                ?>

                                <table style=" width:605px; " cellpadding='0' cellspacing='0'>
                                <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr style="height:8px;" class="sales_change_row">
				<?php echo "Test row"; ?>

                                            <td class="segmentdesc" style="width:120px; border:#868282 1px solid;"><label id="segment" name="segment"><?php echo $row[2]; ?></label></td>
                                            <td style="width:0px;"><input id="user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                                            <td style="width:0px;"><input id="segment_id['<?php echo $i ?>']" type="hidden" name="segment_id" value="<?php echo $row[1]; ?>" /></td>
                                             <td style="width:15px;">&nbsp;</td>
                                            <td style="width:38px;"><input name="inp_text['<?php echo $i ?>']"  id="n5_val" class="saleschange_inpu_text" style="width:38px; font-size: 10px;"  value="<?php echo number_format($row[3], 2, '.', ''); ?>"/></td>
                                            <td style="width:38px;"><input name="inp_text['<?php echo $i ?>']"  id="n4_val" class="saleschange_inpu_text"  style="width:37px;"   value="<?php echo number_format($row[4], 2, '.', ''); ?>"/></td>
                                            <td style="width:38px;"><input name="inp_text['<?php echo $i ?>']"  id="n3_val" class="saleschange_inpu_text"  style="width:38px;" value="<?php echo number_format($row[5], 2, '.', ''); ?>"/></td>
                                            <td style="width:38px;"><input name="inp_text['<?php echo $i ?>']"  id="n2_val" class="saleschange_inpu_text"  style="width:38px;" value="<?php echo number_format($row[6], 2, '.', ''); ?>"/></td>
                                            <td style="width:38px;"><input name="inp_text['<?php echo $i ?>']"  id="n1_val" class="saleschange_inpu_text"  style="width:40px;" value="<?php echo number_format($row[7], 2, '.', ''); ?>"/></td>
                                            <td style="width:38px;"><input name="inp_text['<?php echo $i ?>']"  id="zed_val" class="saleschange_inpu_text"  style="width:39px;" value="<?php echo number_format($row[8], 2, '.', ''); ?>"/></td>
                                            <td style="width:38px;"><input name="inp_text['<?php echo $i ?>']"  id="p5_val" class="saleschange_inpu_text"  style="width:39px;" value="<?php echo number_format($row[9], 2, '.', ''); ?>"/></td>
                                            <td style="width:38px;"><input name="inp_text['<?php echo $i ?>']"  id="p4_val" class="saleschange_inpu_text"  style="width:40px;" value="<?php echo number_format($row[10], 2, '.', ''); ?>"/></td>
                                            <td style="width:38px;"><input name="inp_text['<?php echo $i ?>']"  id="p3_val" class="saleschange_inpu_text"  style="width:40px;" value="<?php echo number_format($row[11], 2, '.', ''); ?>"/></td>
                                            <td style="width:38px;"><input name="inp_text['<?php echo $i ?>']" id="p2_val" class="saleschange_inpu_text"  style="width:39px;" value="<?php echo number_format($row[12], 2, '.', ''); ?>"/></td>
                                            <td style="width:38px;"><input name="inp_text['<?php echo $i ?>']" id="p1_val" class="saleschange_inpu_text"  style="width:40px;" value="<?php echo number_format($row[13], 2, '.', ''); ?>"/></td>
                                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                                        </tr>
                                 <?php $i++;
                                  } ?>
                                </table>
                                <?php mysqli_close($con); ?>
                                <div id="sales_change_err"><label> Please enter value between -.10 and .20 </label></div>
                                <div class="updating" id="updating">Updated...</div>
                                <div style="margin-left:-30px;">
                                    <div style="width:100px;"><input style="margin-left:250px; margin-top:20px; font-size: 13px;" type="button" name="save" id="save" value="save"/></div>
                                    <div style="margin-top: -25px; margin-left: 350px; width:100px;"><input style=" font-size: 13px;" type="button" name="cancel" id="cancel" value="cancel"/></div>
                                    
                                </div>
                                
                            </div>  
                        </form> 

                    </div>
                </div>

            </div>
        </div>

    </body>
</html>





