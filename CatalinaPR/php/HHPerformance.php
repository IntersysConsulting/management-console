<?php session_start(); ?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Category Performance..</title>
        <script type="text/javascript" src="../js/main.js"></script>
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
    </head>
    <body>


        <div class="heading" style="width:290px; margin-left: 220px;">
            <div style="text-align: center; font-weight: bold; font-size: 14px;">Household Performance</div>
            <div style=" font-style: italic;">ROI adjustment based on HH Activation and Achievement</div>
        </div>
        <div style="margin-left:20px;">
            <div class="segment" style="margin-left: 7px;width: 180px">Index</div>
            <div class="headers" style="width:290px; margin-left: 200px;">
                <ul style="float: left; list-style-type: none;">
                    <li style="width:144px !important"><b>Bottom Quartile</b></li>
                    <li style="width:88px !important"><b>Top Quartile</b></li>
                    

                </ul>
            </div>
        </div>

        <form action="HHPerf_Update.php" method="POST" id="update" style="width:550px; margin-left:20px;">
            <div>
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
                $query = "SELECT a.user_id,a.index_id,b.index_desc,a.bottom_quartile,a.top_quartile FROM pr_hh_perform a INNER JOIN pr_index b ON a.index_id = b.index_id INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='" . $myusername . "'";
                $results = mysql_query($query, $con) or die("Error performing query");
                $i = 0;
                ?>

                <table style="margin-left: 6px; width:490px; " cellpadding='0' cellspacing='0'>
                <?php while ($row = mysql_fetch_array($results)) { ?>
                        <tr style=" height:10px;" class="sales_change_row">

                            <td class="segmentdesc" style="width:180px; border:#868282 1px solid;"><label id="index" name="index"><?php echo $row[2]; ?></label></td>
                            <td><input id="hh_perf_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                            <td><input id="hh_perf_index_id['<?php echo $i ?>']" type="hidden" name="index_id" value="<?php echo $row[1]; ?>" /></td>
                            <td>&nbsp;</td>
                            <td style="width:144px;"><input name="hh_perf['<?php echo $i ?>']"  id="bottom_quartile"  class="inpu_text" style="text-align: center; height:20px; width:144px; font-size: 10px;"  value="<?php echo number_format($row[3], 2, '.', ''); ?>"/></td>
                            <td style="width:144px;"><input name="hh_perf['<?php echo $i ?>']"  id="top_quartile"  class="inpu_text"  style="text-align: center; height:20px; width:144px; font-size: 10px;"   value="<?php echo number_format($row[4], 2, '.', ''); ?>"/></td>
                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                        </tr>

    <?php $i++;
} ?>
                </table>
<?php mysql_close($con); ?>
                <div id="hh_perf_err"><label> Please enter value between -0.05 and 0.05 </label></div>
                <div>
                    <div><input style="margin-left:190px; margin-top:15px; font-size: 13px;" type="button" name="save" id="hh_perf_save" value="save"/></div>
                <div style="margin-top: -25px; margin-left: 290px;"><input style=" font-size: 13px;" type="button" name="cancel" id="cancel" value="cancel"/></div>
                                </div>

            </div>  
        </form>
 </body>
</html>

