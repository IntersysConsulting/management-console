<?php session_start();
?>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Program ROI Adjustment</title>
  <script type="text/javascript" src="../js/main.js"></script>
   <link type="text/css" rel="stylesheet" href="../css/main.css" />
</head>
<body>
 

    <div class="heading" style="margin-left:80px;">
                            <div style="text-align: center; font-weight: bold; font-size: 14px;">Program ROI Adjustment</div>
                            <div style="font-style: italic; text-align: center;">Monthly Segment Change-Recency, Frequency, Monetary Value</div>
                        </div>
                        <div>
                            
                            <div class="headers" style="margin-left:80px; margin-top:1px;">
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
                        
                        <form action="ROIAdj_Update.php" method="POST" id="update" style="margin-left: 75px;">
                            <div>
                                <?php
                                require 'connection.php';
                                 if(isset($_SESSION['myusername']))    
                                {		
                                        $myusername = $_SESSION['myusername'];	
                                }
                                else
                                {
                                     header("location:../index.php");
                                }
                      
                                
                                ?>
                                <?php
//                                $query = "select * From $db_table ";
                                $query="SELECT a.user_id, a.n5_val, a.n5_val, a.n4_val, a.n3_val, a.n2_val, a.n1_val, a.zed_val, a.p5_val, a.p4_val, a.p3_val, a.p2_val, a.p1_val FROM pr_roi_adj a  INNER JOIN pr_user c ON a.user_id = c.user_id AND a.user_id ='".$myusername."'";
                                $results = mysql_query($query, $con) or die("Error performing query");
                                $i=0;
                                ?>

                                <table>
                                    <?php while ($row = mysql_fetch_array($results)) { ?>
                                        <tr style=" float:left; height:18px" class="sales_change_row">
                                            
                                            
                                            <td><input id="roi_adj_user_id['<?php echo $i ?>']" type="hidden" name="user_id" value="<?php echo $row[0]; ?>" /></td>
                                            <td><input name="roi_adj['<?php echo $i ?>']"  id="n5_val" class="inpu_text" style="width:38px; font-size: 10px;"  value="<?php echo number_format($row[1], 2, '.', ''); ?>"/></td>
                                            <td><input name="roi_adj['<?php echo $i ?>']"  id="n4_val" class="inpu_text"  style="width:38px;"   value="<?php echo number_format($row[2], 2, '.', ''); ?>"/></td>
                                            <td><input name="roi_adj['<?php echo $i ?>']"  id="n3_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[3], 2, '.', ''); ?>"/></td>
                                            <td><input name="roi_adj['<?php echo $i ?>']"  id="n2_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[4], 2, '.', ''); ?>"/></td>
                                            <td><input name="roi_adj['<?php echo $i ?>']"  id="n1_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[5], 2, '.', ''); ?>"/></td>
                                            <td><input name="roi_adj['<?php echo $i ?>']"  id="zed_val" class="inpu_text"  style="width:39px;" value="<?php echo number_format($row[6], 2, '.', ''); ?>"/></td>
                                            <td><input name="roi_adj['<?php echo $i ?>']"  id="p5_val" class="inpu_text"  style="width:39px;" value="<?php echo number_format($row[7], 2, '.', ''); ?>"/></td>
                                            <td><input name="roi_adj['<?php echo $i ?>']"  id="p4_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[8], 2, '.', ''); ?>"/></td>
                                            <td><input name="roi_adj['<?php echo $i ?>']"  id="p3_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[9], 2, '.', ''); ?>"/></td>
                                            <td><input name="roi_adj['<?php echo $i ?>']" id="p2_val" class="inpu_text"  style="width:39px;" value="<?php echo number_format($row[10], 2, '.', ''); ?>"/></td>
                                            <td><input name="roi_adj['<?php echo $i ?>']" id="p1_val" class="inpu_text"  style="width:40px;" value="<?php echo number_format($row[11], 2, '.', ''); ?>"/></td>
                                            <td><input type="hidden" id="row_num" value="<?php echo $i ?>"/></td>
                                        </tr>

                                    <?php $i++; } ?>
                                </table>
                                <?php mysql_close($con); ?>
                                <div id="roi_adj_err"><label> Please enter value between 0.00 and 0.20 </label></div>
                                <div>
                                    <div><input style="margin-left:150px; margin-top:20px; font-size: 13px;" type="button" name="save" id="roi_adj_save" value="save"/></div>
                                <div style="margin-top: -25px; margin-left: 300px;"><input style=" font-size: 13px;" type="button" name="cancel" id="cancel" value="cancel"/></div>
                                </div>
                               
                            </div>  
                        </form>

                   

  

 
 
</body>
</html>