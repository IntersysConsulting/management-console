<?php session_start(); ?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Category Performance..</title>
        <script type="text/javascript" src="../js/main.js"></script>
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
    </head>
    <body>


        <div class="heading" style="width:270px; margin-left: 210px;">
            <div style="text-align: center; font-weight: bold; font-size: 14px;">Category Performance</div>
            <div style="text-align:center; font-style: italic;">ROI adjustment based on category Performance</div>
        </div>
        <div style="margin-left:70px;">
            <div class="segment" style="margin-left: 7px;width: 125px">Index</div>
            <div class="headers" style="width:270px; margin-left: 140px;">
                <ul style="float: left; list-style-type: none;">
                    <li style="width:128px !important"><b>Bottom Quartile</b></li>
                    <li style="width:88px !important"><b>Top Quartile</b></li>
                    

                </ul>
            </div>
        </div>

        <form action="CategoryPerf_Update.php" method="POST" id="update" style="width:550px; margin-left:70px;">
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
//                                $query = "select * From $db_table ";
                $query = "SELECT a.user_id,a.index_id,b.index_desc,a.bottom_quartile,a.top_quartile FROM pr_category_perf a INNER JOIN pr_index b ON a.index_id = b.index_id INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='" . $myusername . "'";
                $results = mysql_query($query, $con) or die("Error performing query");
                $i = 0;
                ?>

                <table style="margin-left: 2px;">
                <?php while ($row = mysql_fetch_array($results)) { ?>
                        <tr style=" float:left; height:18px" class="sales_change_row">

                            <td class="segmentdesc" style="width:130px;"><label id="Index" name="Index"><?php echo $row[2]; ?></label></td>
                            <td><input id="cat_per_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                            <td><input id="cat-per_index_id['<?php echo $i ?>']" type="hidden" name="indext_id" value="<?php echo $row[1]; ?>" /></td>
                            <td style="width:130px;"><input name="cat_per['<?php echo $i ?>']"  id="bottom_quartile"  class="inpu_text" style="text-align: center; width:130px; font-size: 10px;"  value="<?php echo number_format($row[3], 2, '.', ''); ?>"/></td>
                            <td style="width:130px;"><input name="cat_per['<?php echo $i ?>']"  id="top_quartile"  class="inpu_text"  style="text-align: center; width:130px; font-size: 10px;"   value="<?php echo number_format($row[4], 2, '.', ''); ?>"/></td>
                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                        </tr>

    <?php $i++;
} ?>
                </table>
<?php mysql_close($con); ?>
                <div id="cat_perf_err"><label> Please enter value between -.05 and .20 </label></div>
                <div>
                    <div><input style="margin-left:200px; margin-top:15px; font-size: 13px;" type="button" name="save" id="cat_perf_save" value="save"/></div>
                <div style="margin-top: -25px; margin-left: 300px;"><input style=" font-size: 13px;" type="button" name="cancel" id="cancel" value="cancel"/></div>
                                </div>

            </div>  
        </form>
 </body>
</html>
