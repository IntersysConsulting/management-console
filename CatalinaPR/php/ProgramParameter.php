<?php 
session_start(); 
function segmentList($rows){
    
  require 'connection.php';
  if (isset($_SESSION['myusername'])) {
         $myusername = $_SESSION['myusername'];
  }
  else {
          header("location:../index.php");
  }
  $segmentArr=array();
  $sql = "select distinct a.segment_desc from pr_segment a join pr_program_param b 
             where b.user_id ='app' 
             and a.segment_desc='".$rows."'
             union 
             select distinct a.segment_desc
             from pr_segment a"; 
  $result = mysqli_query($con, $sql) or die("Error on segment query");
  while ($row = mysqli_fetch_array($result)) {
   $segmentArr[]=$row[0];   
  }
  mysqli_close($con);
  return $segmentArr;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
              <link type="text/css" rel="stylesheet" href="../css/main.css" />
        <link rel="stylesheet" href="../css/jquery-ui.css" />
        <link rel="stylesheet" href="../css/bootstrap.css">
        <script type="text/javascript" src="../js/main.js"></script>
        <script src="../js/jquery-1.9.1.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <script src="../js/jquery.validate.js"></script>
        <title>Program Parameter</title>
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
                                <li class="last"><a href="ScatterChart.php">&nbsp;Aggregated Sales&nbsp;</a></li>
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
                        <li class="active has-sub"><a href="ValidationControls.php">Validation Rules </a>
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
                    <div class="heading" style="width:370px; padding-top:10px; margin-top:10px; text-align: center; font-size: 18px; font-weight: bolder;">
                        Program Parameter Values
                    </div>
                  
                    <form action="ProgramParameter_Update.php" method="POST" id="update" style="">
                        <div>
                            <?php
                            require 'connection.php';
                            if (isset($_SESSION['myusername'])) {
                                $myusername = $_SESSION['myusername'];
                            }
                            else {
                                header("location:../index.php");
                            }

                            $query = "SELECT a.user_id,a.p_parameter,a.p_param_id,a.p_value FROM pr_program_param a  WHERE a.user_id ='app' ";
                            $result = mysqli_query($con, $query) or die("Error performing queryi");
                            $i = 0;
                            ?>

               <!-- <table>-->
                            <table class="table table-striped" cellpadding='0' cellspacing='0'>
                                <?php while ($row = mysqli_fetch_array($result)) { ?>
                                    <tr style=" height:35px" class="Pgm_Param_row">
                                        <td><input id="pgm_param_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                                        <td><label id="pgm_parameter['<?php echo $i ?>']"  name="parameter"><?php echo $row[1]; ?></label></td>
                                        <td><input id="pgm_parameter_id['<?php echo $i ?>']" type="hidden" name="parameter" value="<?php echo $row[2]; ?>" /></td>
                                        <td>&nbsp;</td>
                                        <td style="width:150px; height:30px;">

                                            <?php if (strtoupper($row[1]) == 'DEFAULT SEGMENT(FOR DEFAULT OFFERS)') { 
//                                                require 'connection.php';
//                                                //$sql = "SELECT  a.segment_desc FROM pr_segment a ";
//                                                $sql = "select distinct a.segment_desc from pr_segment a join pr_program_param b 
//                                                        where b.user_id ='app' 
//                                                           and a.segment_desc='".$row[3]."'
//                                                        union 
//                                                        select distinct a.segment_desc
//                                                          from pr_segment a"; 
//                                                $result = mysqli_query($con, $sql) or die("Error on segment query");
//
//                                                echo "<select id='drp_dwn_segment' name='segment_desc' style='margin-left: -7px;width: 155px; height: 35px;font-size:12px; font-weight:bold; font-family:calibri;'>";
//                                                while ($row = mysqli_fetch_array($result)) {
//                                                    echo "<option style='text-align:center;' value='" . $row[0] . "'>" . $row[0] . "</option>";
//                                                }
//                                                echo "</select>";
                                                 $segmentArray=array();
                                                 $segmentArray=segmentList($rows[3]);
                                                 echo "<select id='drp_dwn_segment' name='segment_desc' style='margin-left: -7px;width: 155px; height: 35px;font-size:12px; font-weight:bold; font-family:calibri;'>";
                                                for($j=0;$j<6;$j++) {
                                                    echo "<option style='text-align:center;' value='" . $segmentArray[$j] . "'>" . $segmentArray[$j] . "</option>";
                                                }
                                                echo "</select>";
                                            }
                                            else if($row[2]== 5)
                                            {
                                                echo "<select id='drp_dwn_5' name='yes_no' style='margin-left: -7px;width: 155px; height: 35px;font-size:12px; font-weight:bold; font-family:calibri;'>";
                                                    echo "<option style='text-align:center;' value='".$row[3]."'>" . $row[3] . "</option>";
                                                    if($row[3]=='NO'){
                                                    echo "<option style='text-align:center;' value='YES'>YES</option>";
                                                    }
                                                    else {
                                                    echo "<option style='text-align:center;' value='NO'>NO</option>";
                                                    }
                                                    
                                                echo "</select>";
                                            }
                                            else if($row[2]== 7){
                                                echo "<select id='drp_dwn_7' name='yes_no' style='margin-left: -7px;width: 155px; height: 35px;font-size:12px; font-weight:bold; font-family:calibri;'>";
                                                    echo "<option style='text-align:center;' value='".$row[3]."'>" . $row[3] . "</option>";
                                                    if($row[3]=='NO'){
                                                    echo "<option style='text-align:center;' value='YES'>YES</option>";
                                                    }
                                                    else {
                                                    echo "<option style='text-align:center;' value='NO'>NO</option>";
                                                    }
                                                echo "</select>";
                                            }
                                            else {
                                                ?>
                                                <input name="pgm_param['<?php echo $i ?>']"  id="p_value"  class="inpu_text" style="text-align: center; height:30px; width:150px; font-size: 12px; font-weight: bold;"  value="<?php echo $row[3]; ?>"/>
                                                <?php 
                                            }
                                            ?>
                                        </td>
                                        <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                                    </tr>

                                    <?php $i++;
                                } ?>
                            </table>
                            <?php mysqli_close($con); ?>
                            <div id="pgm_param_err" style="margin-left: 670px !important;"><label> Please enter value between -.10 and .20 </label></div>
                            <div class="updating" id="pgm_param_updating" style="margin-left: 700px !important;">Ypur Updated were saved</div>
                            <!-- <div>
                                 <div><input style="margin-left:-90px;  margin-top:15px; font-size: 13px;" type="button" name="save" id="pgm_param_save" value="save"/></div>
                                 <div style="margin-top: -25px; margin-left: -10px;"><input style="font-size: 13px;" type="button" name="cancel" id="pgm_cancel" value="cancel"/></div>
                             </div>-->
                            <div style="float:right;margin-right:30px;width:200px;">
                                <div style="display:inline-block;width:50px;margin:15px;"><input style="padding-right:15px;padding-left:15px;font-weight:600;font-size:13px;" type="button" class="btn" name="save" id="pgm_param_save" value="Save"></div>
                                <div style="display:inline-block;width:50px;"><input style="font-size: 13px;font-weight:600;" type="button" name="cancel" id="pgm_cancel" class="btn" value="Cancel"></div>

                            </div>
                        </div>
                </div>
                </form>
            </div>
            <div style="margin-top:90px;height: 29px;background-color:#0093d0 ">
                <?php //require 'Mainmenu.php'; ?>
            </div>
    </body>
</html>
