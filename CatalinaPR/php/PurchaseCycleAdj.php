<?php session_start(); ?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Purchase Cycle Adj.</title>
        <script type="text/javascript" src="../js/main.js"></script>
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
    </head>
    <body>


        <div class="heading" style="width:270px; margin-left: 170px;">
            <div style="text-align: center; font-weight: bold; font-size: 14px;">Purchase Cycle Adjustment</div>
            <div style="text-align:center; font-style: italic;">Super Categories</div>
        </div>
        <div>
            <div class="segment" style="margin-left: 7px;width: 145px">Segment</div>
            <div class="headers" style="width:270px; margin-left: 170px;">
                <ul style="float: left; list-style-type: none;">
                    <li style="width:89px !important"><b>Food</b></li>
                    <li style="width:89px !important"><b>Drug</b></li>
                    <li style="width:89px !important"><b>GM</b></li>

                </ul>
            </div>
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
               
                $query = "SELECT a.user_id,a.segment_id,b.segment_desc,  a.food, a.drug, a.gm FROM pr_purch_cycle_adj a INNER JOIN pr_segment b ON a.segment_id = b.segment_id INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='" . $myusername . "'";
                $results = mysql_query($query, $con) or die("Error performing query");
                $i = 0;
                ?>

                <table style="margin-left: 2px;">
                    <?php while ($row = mysql_fetch_array($results)) { ?>
                        <tr style=" float:left; height:18px" class="pur_cycle_row">

                            <td style="width:145px; text-decoration:none; height:10px;" class="segment"><label id="segment" name="segment"><?php echo $row[2]; ?></label></td>
                            <td><input id="pur_cycle_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                            <td><input id="pur_cycle_segment_id['<?php echo $i ?>']" type="hidden" name="segment_id" value="<?php echo $row[1]; ?>" /></td>
                            <td>&nbsp;</td>
                            <td style="width:86px;"><input name="pur_cyc['<?php echo $i ?>']"  id="food"  class="inpu_text" style="text-align: center; width:88px; font-size: 10px;"  value="<?php echo number_format($row[3], 2, '.', ''); ?>"/></td>
                            <td style="width:88px;"><input name="pur_cyc['<?php echo $i ?>']"  id="drug"  class="inpu_text"  style="text-align: center; width:88px; font-size: 10px;"   value="<?php echo number_format($row[4], 2, '.', ''); ?>"/></td>
                            <td style="width:95px;"><input name="pur_cyc['<?php echo $i ?>']"  id="gm"  class="inpu_text"  style="text-align: center; width:88px; font-size: 10px;" value="<?php echo number_format($row[5], 2, '.', ''); ?>"/></td>
                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                        </tr>

                        <?php $i++;
                    } ?>
                </table>
                <?php mysql_close($con); ?>
                <div id="pur_cycle_adj_err"><label> Please enter value between 30 and 100 </label></div>
                <div>
                    <div><input style="margin-left:200px;  margin-top:15px; font-size: 13px;" type="button" name="save" id="pur_cycle_save" value="save"/></div>
                    <div style="margin-top: -25px; margin-left: 300px;"><input style=" font-size: 13px;" type="button" name="cancel" id="cancel" value="cancel"/></div>
                </div>

            </div>  
        </form>
    </body>
</html>