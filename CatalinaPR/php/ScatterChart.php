<?php
session_start();
include "connection.php";
if (isset($_SESSION['myusername'])) {
      $myusername = $_SESSION['myusername'];
}
else {
     header("location:../index.php");
}
// Select all the rows in the markers table
$query = "SELECT * FROM pr_ag_prodcat;";
$result = mysqli_query($con,$query);
if (!$result) {
  die("Invalid query: " . mysqli_error($con));
}
$num = mysqli_num_rows($result);
while($row=@mysqli_fetch_assoc($result)){
        //$row=@mysql_fetch_assoc($result);
        $prod[] = $row["prodtypdesc"];
	$brand[] = $row["branddesc"];
	$sum_amount[] = $row["sumamt"];
        $sum_qty[]=$row["sumqty"];
        $sum_trip[]=$row["sumtrip"];
	$year[] = $row["year"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Home</title>
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
        <link rel="stylesheet" href="../css/jquery-ui.css" />
	<link rel="stylesheet" href="../css/bootstrap.css" />
        <script type="text/javascript" src="../js/main.js"></script>
        <script src="../js/jquery-1.9.1.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <script src="../js/jquery.validate.js"></script> 
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">
    google.load('visualization', '1', {packages: ['corechart']});

    function drawVisualization() {

          var data = new google.visualization.DataTable();
          data.addColumn('number', 'Sum Trips');
          data.addColumn('number', 'Groceries');
          data.addColumn('number', 'Drugs');
          for (var i = 0; i < 500; ++i) {
            data.addRow([Math.sin(i / 5) * 0.25, Math.cos(i / 25), null])
          }
          for (var i = 0; i < 500; i++) {
            data.addRow([Math.sin(i / 25), null, Math.cos(i / 10) * 0.5]);
          }

          var chart = new google.visualization.ScatterChart(
              document.getElementById('visualization'));
          chart.draw(data, {title: 'Aggregate Sales in Dollars vs Aggregate Trip Count per Super Category',
                            width: 900, height: 550,
                            vAxis: {title: "Aggregate Sales", titleTextStyle: {color: "green"}},
                            hAxis: {title: "Aggregate Trip Count", titleTextStyle: {color: "green"}}}
                    );
      }


    google.setOnLoadCallback(drawVisualization);

  </script>
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
                        <li class="active has-sub"><a href="DefaultHome.php">Home </a>

                                        <ul>
                                        <li><a href="DefaultHome.php">&nbsp;Overview&nbsp;</a></li>
                                        <li><a href="Treemap.php">&nbsp;Product Hierarchy&nbsp;</a></li>
                                        <li class="last"><a href="ScatterChart.php">&nbsp;Product Categories&nbsp;</a></li>
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
<!--
<div style="margin-bottom: 10px; padding: 5px; border: 1px solid gray; background-color: buttonface;">
      <form action="">
        <span> Select time units: </span>
        <select style="font-size: 12px" onchange="changeTimeUnits(this.value)">
          <option value=0>Week</option>
          <option value=1>Quarter</option>
          <option value=2>Year</option>
          <option value=3>Date</option>
          </select>
        </form>
      </div>
-->
<div id="chartarea">
    <div id="visualization" style="z-index:-1;width: 900px; height: 550px; margin-left:auto;margin-right:auto;"></div>

        </div>
</div>
 <div style="margin-top:20px;height: 29px;background-color:#0093d0 ">
                <?php //require 'Mainmenu.php'; ?>
</div>
</div>
        
    </body>
    

            


            
</html>

