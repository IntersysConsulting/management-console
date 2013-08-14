<?php
session_start();
include "connection.php";
if (isset($_SESSION['myusername'])) {
    $myusername = $_SESSION['myusername'];
}
else {
    header("location:../index.php");
}
/// Select all the rows in the markers table
    $query = "SELECT * FROM ag_mon_sup_sales";
    $result = mysqli_query($con,$query);
    if (!$result) {
      die("Invalid query: " . mysqli_error($con));
    }
   $num = mysqli_num_rows($result);
   while($row=@mysqli_fetch_assoc($result)){
        //$row=@mysql_fetch_assoc($result);
        $category[] = $row["prod_hier_l5_descr"];
        $sum_amount[] = $row["sum_mon_amt"];

        //$string[] = $row["cal_mon"];
        $date[] = date("Y,m,d", strtotime($row["cal_mon"]));
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
            <title>Segment Correlations</title>
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
              data.addColumn('date', 'Date');
              data.addColumn('number', 'Hardlines and Softline');
              data.addColumn('number', 'Drug, Pets and Consumables');
              data.addColumn('number', 'Grocery and Fresh');
              data.addRows([

            <?php
                $j=0;
                for($j=0;$j<$num;$j++){

                    if ($category[$j] == 'SOFTLINES' || $category[$j] == 'HARDLINES' || $category[$j] == 'IN AND OUTDOOR HOME' || $category[$j] == 'MISC.' || $category[$j] == 'SYSTEM' || $category[$j] == 'SUPPLIES AND PACKING'){
                        if ($j != ($num-1)){
                           echo "[new Date($date[$j]),$sum_amount[$j],null,null],\n";
                        }else{
                           echo "[new Date($date[$j]),$sum_amount[$j],null,null]\n";
                        }
                    }
                    else if ($category[$j] == 'GROCERY' || $category[$j] == 'FRESH'){
                        if ($j != ($num-1)){
                           echo "[new Date($date[$j]),null,$sum_amount[$j],null],\n";
                        }else{
                           echo "[new Date($date[$j]),null,$sum_amount[$j],null]\n";
                        }
                    }
                   else{
                      if ($j != ($num-1)){
                        echo "[new Date($date[$j]),null,null,$sum_amount[$j]],\n";
                      }else{
                        echo "[new Date($date[$j]),null,null,$sum_amount[$j]]\n";
                      }
                   }
              }
           ?>

             ]);

               var chart = new google.visualization.ScatterChart(
                    document.getElementById('visualization'));
                    chart.draw(data, {title: 'Aggregate Sales in Dollars vs Aggregate Trip Count per Super Category',
                        width: 900, height: 550,
                        vAxis: {title: "Aggregate Sales", titleTextStyle: {color: "green"}},
                        hAxis: {title: "Date", titleTextStyle: {color: "green"}}}
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



                <div class="mainmenu">
                    <ul>
                        <li class="active has-sub"><a href="DefaultHome.php">Home </a>

                            <ul>
                                <li><a href="DefaultHome.php">&nbsp;Overview&nbsp;</a></li>
                                <li><a href="Treemap.php">&nbsp;Product Hierarchy&nbsp;</a></li>
                                <li class="last"><a href="ScatterChart.php">&nbsp;Segment Correlations&nbsp;</a></li>
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
                <div id="chartarea">
                    <div id="visualization" style="width: 900px; height: 550px; margin-left:auto;margin-right:auto;"></div>

                </div>
            </div>
            <div style="margin-top:20px;height: 29px;background-color:#0093d0 ">

            </div>
        </div>
    </body>

</html>

