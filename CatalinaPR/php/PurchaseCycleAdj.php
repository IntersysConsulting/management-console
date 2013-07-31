<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
        <link rel="stylesheet" href="../css/jquery-ui.css" />
	<link rel="stylesheet" href="../css/bootstrap.css" />
        <script type="text/javascript" src="../js/main.js"></script>
        <script src="../js/jquery-1.9.1.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <script src="../js/jquery.validate.js"></script>
	<title>Purchase Cycle Adj.</title>

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
                                        <li class="last"><a href="ScatterChart.php">&nbsp;Product Categories&nbsp;</a></li>
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


        <div class="heading" style="width:265px;">
            <div style="text-align: center; font-weight: bold; font-size: 14px;">Purchase Cycle Adjustment</div>
            <div style="text-align:center; ">Super Categories</div>
        </div>


        <form action="PurchaseCycle_Update.php" method="POST" id="update">
            <div>
                <?php
                require 'connection.php';
                if (isset($_SESSION['myusername'])) {
                    $myusername = $_SESSION['myusername'];
                }
                else {
                    header("location:../index.php");
                }
               
                $query = "SELECT a.user_id,a.segment_id,b.segment_desc,  a.food, a.drug, a.gm FROM pr_purch_cycle_adj a INNER JOIN pr_segment b ON a.segment_id = b.segment_id AND a.user_id ='app'";
                $results = mysqli_query($con, $query) or die("Error performing query");
                $i = 0;
                ?>

                <table class="table table-striped" cellpadding='0' cellspacing='0'>

	<thead>
	<tr>

			<td style="width:130px;"><label><b>Segment</b></label></td>
 <td style="width:0px;"><input id="user_id['0']" type="hidden" name="user_id" value="" /></td>
                                            <td style="width:0px;"><input id="segment_id['0']" type="hidden" name="segment_id" value="" /></td>
                                             <td style="">&nbsp;</td>
                                    <td style="text-align:center;width:84px !important"> <b>Food</b></td>
                                    <td style="text-align:center;width:84px !important"> <b>Drug</b></td>
                                    <td style="text-align:center;width:84px !important"> <b>GM</b></td>

	</tr>
	</thead>
	<tbody>

                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <tr style="height:8px" class="pur_cycle_row">

                            <td><label id="segment" name="segment"><?php echo $row[2]; ?></label></td>
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
		</tbody>
                </table>
                <?php mysqli_close($con); ?>
                <div id="pur_cycle_adj_err"><label> Please enter value between 30 and 100 </label></div>
                 <div class="updating" id="pur_cyc_updating">Updated...</div>
                <div style="float:right;margin-right:130px;width:200px;">
                    <div style="display:inline-block;width:50px;margin:15px;"><input style="padding-right:15px;padding-left:15px;font-weight:600;font-size:13px;" type="button" class="btn" name="save" id="pur_cycle_save" value="Save"/></div>
                    <div style="display:inline-block;width:50px;"><input style="font-size: 13px;font-weight:600;" type="button" class="btn" name="cancel" id="purch_cylce_adj_cancel" value="Cancel"/></div>
                   
</div>
</div>

        </form>
</div>
   <div style="margin-top:90px;height: 29px;background-color:#0093d0 ">
                <?php //require 'Mainmenu.php'; ?>
</div>
</div>
    </body>
</html>
