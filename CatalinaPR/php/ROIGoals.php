<?php session_start(); ?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Program ROI Goals</title>
        <script type="text/javascript" src="../js/main.js"></script>
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
    </head>
    <body>


        <div class="heading">
            <div style="text-align: center; font-weight: bold; font-size: 14px;">Program ROI Goals</div>
            <div style="font-style: italic; text-align: center;">Quintile Change-current Period vs Previous Period or same period Last Year</div>
        </div>
        <div>
            <div class="segment">Segment</div>
            <div class="headers">
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

<!--        <form action="ROIGoals_Update.php" method="POST" id="update">
            <div>-->
                <?php
                require 'connection.php';
                if (isset($_SESSION['myusername'])) {
                    $myusername = $_SESSION['myusername'];
                }
                else {
                    header("location:../index.php");
                }

                $query = "SELECT a.user_id,a.segment_id,b.segment_desc, a.n5_val, a.n4_val, a.n3_val, a.n2_val, a.n1_val, a.zed_val, a.p5_val, a.p4_val, a.p3_val, a.p2_val, a.p1_val FROM pr_roi_goals a INNER JOIN pr_segment b ON a.segment_id = b.segment_id INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='" . $myusername . "'";
                $results = mysql_query($query, $con) or die("Error performing query");
                $i = 0;
                ?>

                <table style=" width:605px; " cellpadding='0' cellspacing='0'>
                <?php while ($row = mysql_fetch_array($results)) { ?>
                        <tr style=" height:8px" class="roi_goals_row">

                            <td class="segmentdesc" style="width:120px; border:#868282 1px solid;"><label id="segment" name="segment"><?php echo $row[2]; ?></label></td>
                            <td style="width:0px;"><input id="roi_goals_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                            <td style="width:0px;"><input id="roi_goals_segment_id['<?php echo $i ?>']" type="hidden" name="segment_id" value="<?php echo $row[1]; ?>" /></td>
                            <td style="width:15px;">&nbsp;</td>
                            <td style="width:38px;"><input name="roi_goals['<?php echo $i ?>']"  id="n5_val" class="inpu_text" style="width:38px; font-size: 10px;"  value="<?php echo number_format($row[3], 2, '.', ''); ?>"/></td>
                            <td style="width:38px;"><input name="roi_goals['<?php echo $i ?>']"  id="n4_val" class="inpu_text"  style="width:38px;"   value="<?php echo number_format($row[4], 2, '.', ''); ?>"/></td>
                            <td style="width:38px;"><input name="roi_goals['<?php echo $i ?>']"  id="n3_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[5], 2, '.', ''); ?>"/></td>
                            <td style="width:38px;"><input name="roi_goals['<?php echo $i ?>']"  id="n2_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[6], 2, '.', ''); ?>"/></td>
                            <td style="width:38px;"><input name="roi_goals['<?php echo $i ?>']"  id="n1_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[7], 2, '.', ''); ?>"/></td>
                            <td style="width:38px;"><input name="roi_goals['<?php echo $i ?>']"  id="zed_val" class="inpu_text"  style="width:39px;" value="<?php echo number_format($row[8], 2, '.', ''); ?>"/></td>
                            <td style="width:38px;"><input name="roi_goals['<?php echo $i ?>']"  id="p5_val" class="inpu_text"  style="width:39px;" value="<?php echo number_format($row[9], 2, '.', ''); ?>"/></td>
                            <td style="width:38px;"><input name="roi_goals['<?php echo $i ?>']"  id="p4_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[10], 2, '.', ''); ?>"/></td>
                            <td style="width:38px;"><input name="roi_goals['<?php echo $i ?>']"  id="p3_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[11], 2, '.', ''); ?>"/></td>
                            <td style="width:38px;"><input name="roi_goals['<?php echo $i ?>']" id="p2_val" class="inpu_text"  style="width:39px;" value="<?php echo number_format($row[12], 2, '.', ''); ?>"/></td>
                            <td style="width:38px;"><input name="roi_goals['<?php echo $i ?>']" id="p1_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[13], 2, '.', ''); ?>"/></td>
                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                        </tr>

                    <?php $i++;
                    } ?>
                </table>
                    <?php mysql_close($con); ?>
                <div id="roi_goals_err"><label> Please enter value between 10 and 120 </label></div>
                <div>
                    <div><input style="margin-left:250px; margin-top:20px; font-size: 13px;" type="button" name="save" id="ROI_Goals_save" value="save"/></div>
                    <div style="margin-top: -25px; margin-left: 350px;"><input style=" font-size: 13px;" type="button" name="cancel" id="cancel" value="cancel"/></div>
                    <div class="updating" id="roi_goal_updating">Updated...</div>
                </div>

<!--            </div>  
        </form>-->
    </body>
</html>