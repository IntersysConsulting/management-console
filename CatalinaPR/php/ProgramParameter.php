<?php session_start(); ?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Program Parameter.</title>
        <script type="text/javascript" src="../js/main.js"></script>
        <script src="../js/jquery-1.9.1.js"></script>
        <script src="../js/jquery-ui.js"></script>

        <link type="text/css" rel="stylesheet" href="../css/main.css" />
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
        <div class="heading" style="width:370px; padding-top:10px; margin-top:10px; text-align: center; font-size: 18px; font-weight: bolder;">
            Program Parameter Values
        </div>
        <?php
        require 'connection.php';
        if (isset($_SESSION['myusername'])) {
            $myusername = $_SESSION['myusername'];
        }
        else {
            header("location:../index.php");
        }
        $query = "SELECT a.p_parameter FROM pr_program_param a  INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='" . $myusername . "'";
        $results = mysql_query($query, $con) or die("Error performing query");
        ?>
        <div style="margin-top:20px; margin-left:70px;">
            <table>
                <?php while ($row = mysql_fetch_array($results)) { ?>
                    <tr style=" float:left; height:35px">

                        <td style="width:280px; text-decoration:none; height:30px; text-align: left;" class="segment"><label id="param" name="param"><?php echo $row[0]; ?></label></td>
                    </tr>
                <?php } ?>
            </table>

        </div>

        <form action="ProgramParameter_Update.php" method="POST" id="update" style="width: 250px;margin-left: 359px; margin-top:-285px;">
            <div>
                <?php
                require 'connection.php';
                if (isset($_SESSION['myusername'])) {
                    $myusername = $_SESSION['myusername'];
                }
                else {
                    header("location:../index.php");
                }

                $query = "SELECT a.user_id,a.p_parameter,a.p_parameter_id,a.p_value FROM pr_program_param a  INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='" . $myusername . "' ";
                $results = mysql_query($query, $con) or die("Error performing query");
                $i = 0;
                ?>

                <table>
                    <?php while ($row = mysql_fetch_array($results)) { ?>
                        <tr style=" float:left; height:35px" class="Pgm_Param_row">
                            <td><input id="pgm_param_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                            <td><input id="pgm_parameter['<?php echo $i ?>']" type="hidden" name="parameter" value="<?php echo $row[1]; ?>" /></td>
                            <td><input id="pgm_parameter_id['<?php echo $i ?>']" type="hidden" name="parameter" value="<?php echo $row[2]; ?>" /></td>
                            <td>&nbsp;</td>
                            <td style="width:150px; height:30px;">
                                <?php if (strtoupper($row[1]) != 'DEFAULT SEGMENT(FOR DEFAULT OFFERS)') { ?>
                                    <input name="pgm_param['<?php echo $i ?>']"  id="p_value"  class="inpu_text" style="text-align: center; height:30px; width:150px; font-size: 12px; font-weight: bold;"  value="<?php echo $row[3]; ?>"/>
                                    <?php
                                }
                                else {
                                    require 'connection.php';
                                    $sql = "SELECT a.segment_desc FROM pr_segment a";
                                    $result = mysql_query($sql);

                                    echo "<select id='drp_dwn_segment' name='segment_desc' style='margin-left: -7px;width: 155px; height: 35px;font-size:12px; font-weight:bold; font-family:calibri;'>";
                                    while ($row = mysql_fetch_array($result)) {
                                        echo "<option style='text-align:center;' value='" . $row[0] . "'>" . $row[0] . "</option>";
                                    }
                                    echo "</select>";
                                }
                                ?>
                            </td>
                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                        </tr>

                        <?php $i++;
                    } ?>
                </table>
                <?php mysql_close($con); ?>
                <div id="pgm_param_err"><label> Please enter value between -.10 and .20 </label></div>
                <div class="updating" id="pgm_param_updating" style="margin-left: -45px !important;">Updated...</div>
                <div>
                    <div><input style="margin-left:-90px;  margin-top:15px; font-size: 13px;" type="button" name="save" id="pgm_param_save" value="save"/></div>
                    <div style="margin-top: -25px; margin-left: -10px;"><input style="font-size: 13px;" type="button" name="cancel" id="pgm_cancel" value="cancel"/></div>
                    
                </div>

</div>
</div>
            </div>  
        </form>
    </body>
</html>
