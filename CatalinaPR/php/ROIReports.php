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
        <title>ROI Reports</title>
    </head>
    <body>
        <div class="home" style="height:820px; width:780px;">
            <div style="margin-left: 300px;margin-top: 20px;">Personalized Rewards</div>
            <div style="margin-left: 50px;"><img src="../images/logo.JPG"/></div>
            <div id="logout" >
                <a href="LogOut.php" id="logout" style="text-decoration: none;height:15px; font-size: 14px;color: #7A98D1;font-weight: bolder;margin-left: 640px;">Logout</a>
            </div>
            <div style="margin-left: 50px;height: 29px;background-color: #BACBEB;width: 680px; ">
                <?php //require 'Mainmenu.php'; ?>
                <div class="mainmenu">
                    <ul>
                        <li><a href="DefaultHome.php">Home </a></li>
                        <li><a href="SalesChange.php">Controls </a></li>
                        <li><a href="GuardRails.php">Guard Rails </a></li>
                        <li><a href="ValidationControls.php">Validation Rules </a></li>
                        <li  class="active"><a href="ROIReports.php">Reports </a></li>
                    </ul>
                </div>
            </div>
            <div id="tabs" style="margin-left: 50px;margin-top: 35px;width: 650px; height: 298px;">
                <ul>
                    <li><a href="#tabs-1" onclick="ProgramParams();">&nbsp;ROI Report&nbsp;</a></li>

                </ul>
                <div class="controls" style="height:610px; width:680px;">

                    <div id="tabs-1">
                        <div class="heading" style="width:370px; padding-top:10px; margin-top:10px; text-align: center; font-size: 18px; font-weight: bolder;  ">
                            PROGRAM AND ROI TRENDS
                        </div>


                        <div style="width:630px; margin-left:-5px; border:black 1px solid; margin-top:30px;">
                            <?php
                            require 'connection.php';
                            if (isset($_SESSION['myusername'])) {
                                $myusername = $_SESSION['myusername'];
                                echo '<div><input id="user_id" type="hidden"  value="';
                                echo $myusername;
                                echo'" /></div>';
                            }
                            else {
                                header("location:../index.php");
                            }
                            $query = "select distinct a.enddate from pr_roi_report a  INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='" . $myusername . "' order by a.enddate desc limit 5; ";
                            $results = mysql_query($query, $con) or die("Error performing query");
                            $i = 0;
                            ?>
                            <div style="border: black 1px solid;">
                                <div  style="width: 125px">Period Ending</div>
                                <div class="headers" style="width:500px; background-color: transparent;margin-left:200px; border:transparent; ">
                                    <ul style="float: left; list-style-type: none;">
                                        <?php while ($row = mysql_fetch_array($results)) {  ?>
                                            <li style="width:85px !important"><b><?php echo $newDate = date("m/d/Y", strtotime($row[0]));; ?></b></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>

                            <?php
                            require 'connection.php';
                            $query = "select b.program_desc,a.VAL_ENDDATE,b.rep_flag,a.program_id  from pr_roi_report a join pr_roi_program b on a.PROGRAM_ID = b.PROGRAM_ID INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id = '" . $myusername . "' order by a.PROGRAM_ID,a.enddate ";
                            $results = mysql_query($query, $con) or die("Error performing query");
                            $i = 0;
                            if (mysql_num_rows($results) == 0) {
                                $content = '<td>No Items</td></tr>';
                            }
                            else {
                                $count = 0;
                                $item_per_row = 5;
                                $row_count = 1;
                                $content = '<table id="roitable" style="width:630px;" cellpadding="0" cellspacing="0"><tr>';
                                
                                while ($row = mysql_fetch_array($results)) {
                                   
                                    if ($row_count % 4 === 0 && $previous_row_count != $row_count && ($row[2]=='N'||$row[2]=='P' ) ) {
                                        
                                        $previous_row_count = $row_count;
                                        $content.='<tr style="width:300px; height:15px; border:black 1px solid;"></tr>';
                                    }
                                    else if($row_count % 4=== 0 && $previous_row_count != $row_count&& ($row[2]=='C')&&$row[3]!=12)
                                    {
                                        $previous_row_count = $row_count;
                                        $content.='<tr style="width:300px; height:15px; border:black 1px solid;"></tr>';
                                    }
                                    else if( $previous_row_count != $row_count&& ( $row[3]==11))
                                    {
                                        $previous_row_count = $row_count;
                                        $content.='<tr style="width:300px; height:15px; border:black 1px solid;"></tr>';
                                    }
                                    else if($previous_row_count != $row_count&&($row[2]=='D')&&$row[3]==13)
                                    {
                                        $previous_row_count = $row_count;
                                       $content.='<tr style="width:300px; height:15px; border:black 1px solid;"></tr>';
                                    }
                                    if ($pgm_desc != $row[0]) {
                                        $content .= '<td valign=top style="width:200px; text-align:left;">' . $row[0] . '</td>';
                                        $pgm_desc = $row[0];
                                        if($row[2]=='N'){
                                        $formattedNum = number_format($row[1], 0);
                                        $content .= '<td valign=top>' . $formattedNum . '</td>';
                                        }
                                        else if($row[2]=='C'){
                                             $formattedNum = '$'.number_format($row[1], 0);
                                            $content .= '<td valign=top>' . $formattedNum . '</td>';
                                        }
                                        else if($row[2]=='P'){
                                             $formattedNum = number_format($row[1], 0).'%';
                                            $content .= '<td valign=top style="padding-top:9px;">' . $formattedNum . '</td>';
                                        }
                                        else if($row[2]=='D'){
                                             $formattedNum = number_format($row[1], 3, '.', '');
                                            $content .= '<td valign=top>' . $formattedNum . '</td>';
                                        }
                                        else
                                        {
                                           $formattedNum = number_format($row[1], 0);
                                        $content .= '<td valign=top>' . $formattedNum . '</td>'; 
                                        }
                                    }
                                    else {
                                        if($row[2]=='N'){
                                        $formattedNum = number_format($row[1], 0);
                                        $content .= '<td valign=top>' . $formattedNum . '</td>';
                                        }
                                        else if($row[2]=='C'){
                                             $formattedNum = '$'.number_format($row[1], 0);
                                            $content .= '<td valign=top>' . $formattedNum . '</td>';
                                        }
                                        else if($row[2]=='P'){
                                             $formattedNum = number_format($row[1], 0).'%';
                                            $content .= '<td valign=top style="padding-top:9px;">' . $formattedNum . '</td>';
                                        }
                                        else if($row[2]=='D'){
                                             $formattedNum = number_format($row[1], 3, '.', '');
                                            $content .= '<td valign=top>' . $formattedNum . '</td>';
                                        }
                                        else
                                        {
                                           $formattedNum = number_format($row[1], 0);
                                        $content .= '<td valign=top>' . $formattedNum . '</td>'; 
                                        }
                                    }
                                    $count++;
                                    if ($count % $item_per_row === 0) {
                                        $content .= '</tr>';
                                        ++$row_count;
                                    }
                                }

                                $content .= '</tr>';
                            }
                            if ($count % $item_per_row !== 0) {
                                $content .= '</td>';
                            }
                            $content.='</table>';
                            echo $content;
                            ?>

                            

                        </div>
                    </div>

                </div>
            </div>

    </body>






</html>







