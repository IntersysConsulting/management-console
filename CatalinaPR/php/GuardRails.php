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
        <script>
            $(function() {
                $( "#tabs" ).tabs({
                    beforeLoad: function( event, ui ) {
                        ui.jqXHR.error(function() {
                            ui.panel.html(
                            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
                                "If this wouldn't be a demo." );
                        });
                    }
                });
            });
        </script>
        <title>Guard Rails</title>
    </head>
    <body>
        <div class="home">
            <div style="margin-left: 300px;margin-top: 20px;">Personalized Rewards</div>
            <div style="margin-left: 50px;"><img src="../images/logo.JPG"/></div>
            <div id="logout" >
                <a href="LogOut.php" id="logout" style="text-decoration: none;height:15px; font-size: 14px;color: #7A98D1;font-weight: bolder;margin-left: 610px;">Logout</a>
            </div>
            <div style="margin-left: 50px;height: 29px;background-color: #BACBEB;width: 650px; ">
                <div class="mainmenu">
                    <ul>
                        <li><a href="DefaultHome.php">Home </a></li>
                        <li><a href="SalesChange.php">Controls </a></li>
                        <li  class="active"><a href="GuardRails.php">Guard Rails </a></li>
                        <li><a href="ValidationControls.php">Validation Rules </a></li>
<!--                        <li><a href="ROIReports.php">Reports </a></li>-->
                        <li><a href="ROIReportChart.php">Reports</a></li>
                    </ul>
                </div>
            </div>
            <div id="tabs" style="margin-left: 50px;margin-top: 35px;width: 650px; height: 298px;">
                <ul>
                    <li><a href="#tabs-1">&nbsp;Guard Rails&nbsp;</a></li>

                </ul>
                <div class="controls">

                    <div id="tabs-1">
                        <div class="heading" style="width:290px; margin-left: 260px;">
                            <div style="text-align: center; font-weight: bold; font-size: 14px;">Program Guard Rails</div>
                            <div style=" font-style: italic; text-align: center;">Minimum and Maximum Offer Values</div>
                        </div>
                        <div style="margin-left:110px; margin-top: 21px;">

                            <div class="headers" style="width:290px; margin-left: 150px;">
                                <ul style="float: left; list-style-type: none;">
                                    <li style="width:144px !important"><b>Minimum</b></li>
                                    <li style="width:88px !important"><b>Maximum</b></li>


                                </ul>
                            </div>
                        </div>

<!--                        <form action="GuardRails_Update.php" method="POST" id="update">-->
<!--                            <div style="margin-top: 10px; margin-left: 3px;">-->
                                <?php
                                require 'connection.php';
                                if (isset($_SESSION['myusername'])) {
                                    $myusername = $_SESSION['myusername'];
                                }
                                else {
                                    header("location:../index.php");
                                }
                                $query = "SELECT a.user_id,a.metric_id,b.metric_desc, a.minimum,a.maximum FROM pr_guard_rails a INNER JOIN pr_guard_rails_metric b ON a.metric_id = b.metric_id INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='" . $myusername . "'";
                                $results = mysql_query($query, $con) or die("Error performing query");
                                $i = 0;
                                ?>

                                <table style="width:550px;" cellpadding='0' cellspacing='0'>
                                    <?php while ($row = mysql_fetch_array($results)) { ?>
                                        <tr style=" height:10px" class="sales_change_row">

                                            <td class="segmentdesc" style="width:240px; border:#868282 1px solid;"><label id="metric" name="metric"><?php echo $row[2]; ?></label></td>
                                            <td><input id="guard_rails_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                                            <td><input id="guard_rails_metric_id['<?php echo $i ?>']" type="hidden" name="metric_id" value="<?php echo $row[1]; ?>" /></td>
                                            <td>&nbsp;</td>
                                            <td style="width:143px;"><input name="guard_rails['<?php echo $i ?>']"  id="minimum" class="inpu_text" style="text-align: center; height:20px; width:143px; font-size: 10px;"  value="<?php echo $row[3]; ?>"/></td>
                                            <td style="width:143px;"><input name="guard_rails['<?php echo $i ?>']"  id="maximum" class="inpu_text"  style="text-align: center; height:20px; width:143px;"   value="<?php echo $row[4]; ?>"/></td>

                                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                                        </tr>

                                 <?php $i++;
                                  } ?>
                                </table>
                                <?php mysql_close($con); ?>
                                <div id="guard_rails_err"><label> Please enter value between 0 and 30 </label></div>
                                <div>
                                    <div><input style="margin-left:250px; margin-top:20px; font-size: 13px;" type="button" name="save" id="guard_rails_save" value="save"/></div>
                                    <div style="margin-top: -25px; margin-left: 350px;"><input style=" font-size: 13px;" type="button" name="cancel" id="cancel" value="cancel"/></div>
                                    <div class="updating" id="updating">Updated...</div>
                                </div>
<!--                            </div>  -->
<!--                        </form>-->

                    </div>
                </div>

            </div>
        </div>

    </body>
</html>






