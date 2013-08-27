<?php
session_start();
include "connection.php";
if (isset($_SESSION['myusername'])) {
      $myusername = $_SESSION['myusername'];
}
else {
     header("location:../index.php");
}
$value_zero = array();
$value_one = array();
$value_two = array();
$value_three = array();
$value_four = array();
$flag_one_row = array();
$pgm_id = Array();
$conseq = array();
$value = array();
$flg = array();
//
//// Select all the rows in the markers table
//$query = "select b.program_desc,a.VAL_ENDDATE,a.enddate  from pr_roi_report a join pr_roi_program b on a.PROGRAM_ID = b.PROGRAM_ID   order by a.PROGRAM_ID,a.enddate  ";
$query = "select b.program_desc,a.val_enddate,a.enddate,b.rep_flag 
    from pr_roi_report a
    join pr_roi_program b
      on a.program_id = b.program_id
   where a.enddate >=(select distinct min(enddate) from pr_roi_report order by enddate desc limit 5)
     and a.enddate <=(select distinct max(enddate) from pr_roi_report order by enddate desc limit 5) 
order by a.enddate desc,b.program_id";
$result = mysqli_query($con,$query);
if (!$result) {
    die("Invalid query: " . mysqli_error());
}
$num = mysqli_num_rows($result);
$program_desc = array();
while ($row = mysqli_fetch_array($result)) {

    if ($end_date != $row[2]) {

        $en_date[] = $row[2];
        $end_date = $row[2];
    }
    $program_desc[] = $row[0];
    $ProdCatArray[] = $row;
}

$ii = 0;
$max = count($ProdCatArray);

for ($i = 0; $i < count($ProdCatArray); $i++) {
    $value[$ii][] = $ProdCatArray[$i][1];

    $conseq[$ii][] = $ProdCatArray[$i][2];
    $flg[$ii][] = $ProdCatArray[$i][3];


    if ($i + 1 < $max) {
        $dif = $ProdCatArray[$i + 1][2] == $ProdCatArray[$i][2];
        if ($dif == 0) {

            $ii++;
        }
    }
}

$value_zero = $value[0];
$value_one = $value[1];
$value_two = $value[2];
$value_three = $value[3];
$value_four = $value[4];
$flag_one_row = $flg[0];


$jj = 0;
$maximum = count($program_desc);
$pgm_ids = Array();
for ($i = 0; $i < count($program_desc) / 5; $i++) {
    $pgm_ids[$jj][] = $program_desc[$i];
    if ($i + 1 < $maximum) {
        //$dif = $program_desc[$i+1] == $program_desc[$i];
        if ($program_desc[$i + 1] == $program_desc[$i]) {

            $jj++;
        }
    }
}
$pgm_id = $pgm_ids[0];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
	<link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/jquery-ui.css" />
        <script type="text/javascript" src="../js/main.js"></script>
        <script src="../js/jquery-1.9.1.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <script src="../js/jquery.validate.js"></script>
        <title>
            ROI Report
        </title>
        <style type='text/css'>
            .height_table_row {
                background-color: #FAFAFA;
                height:20px;
            }
            .google-visualization-table-tr-odd {
                background-color: #FAFAFA;
                height: 20px;
            }
            .google-visualization-table-table {
                border: #000 1px solid;

            }
            /*    .google-visualization-table-th
                {
                  border: 1px solid #999797;
                }*/
            .bold-font{

                background-color:#aaaaaa;
                font-weight: bold;
            }
        </style>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>

        <script type="text/javascript">
            google.load('visualization', '1', {packages:['table']});
            google.setOnLoadCallback(drawTable);
            function drawTable() {
                var cssClassNames = {
                    'headerRow': 'bold-font',
                    'tableRow': 'height_table_row'
                };
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Period Ending'); 
                data.addColumn('string', '<?php echo $newDate = date("m/d/Y", strtotime($en_date[0])); ?>');
                data.addColumn('string', '<?php echo $newDate = date("m/d/Y", strtotime($en_date[1])); ?>');
                data.addColumn('string', '<?php echo $newDate = date("m/d/Y", strtotime($en_date[2])); ?>');
                data.addColumn('string', '<?php echo $newDate = date("m/d/Y", strtotime($en_date[3])); ?>');
                data.addColumn('string', '<?php echo $newDate = date("m/d/Y", strtotime($en_date[4])); ?>');
   
                data.addRows([
<?php
//$j=0;
for ($j = 0; $j < count($value_zero); $j++) {
/*    if ($j == 0 || $j == 4 || $j == 7 || $j == 10 || $j == 12) {
        echo "['','','','','',''],";
    }
    if ($flag_one_row[$j] == 'N') {
        echo "['$pgm_id[$j]','" . number_format($value_zero[$j], 0) . "','" . number_format($value_one[$j], 0) . "','" . number_format($value_two[$j], 0) . "','" . number_format($value_three[$j], 0) . "','" . number_format($value_four[$j], 0) . "'],\n";
    }
    else if ($flag_one_row[$j] == 'P') {
        echo "['$pgm_id[$j]','" . number_format($value_zero[$j], 0) . "%','" . number_format($value_one[$j], 0) . "%','" . number_format($value_two[$j], 0) . "%','" . number_format($value_three[$j], 0) . "%','" . number_format($value_four[$j], 0) . "%'],\n";
    }
    else if ($flag_one_row[$j] == 'C') {
        echo "['$pgm_id[$j]','$" . number_format($value_zero[$j], 0) . "','$" . number_format($value_one[$j], 0) . "','$" . number_format($value_two[$j], 0) . "','$" . number_format($value_three[$j], 0) . "','$" . number_format($value_four[$j], 0) . "'],\n";
    }
    else if ($flag_one_row[$j] == 'D') {
        echo "['$pgm_id[$j]','" . number_format($value_zero[$j], 3, '.', '') . "','" . number_format($value_one[$j], 3, '.', '') . "','" . number_format($value_two[$j], 3, '.', '') . "','" . number_format($value_three[$j], 3, '.', '') . "','" . number_format($value_four[$j], 3, '.', '') . "'],\n";
    }
    else {
        echo "['$pgm_id[$j]','" . number_format($value_zero[$j], 0) . "','" . number_format($value_one[$j], 0) . "','" . number_format($value_two[$j], 0) . "','" . number_format($value_three[$j], 0) . "','" . number_format($value_four[$j], 0) . "'],\n";
    }*/
	if($j!=count($value_zero)-1){
    if ($j == 0 || $j == 4 || $j == 7 || $j == 10 || $j == 12) {
        echo "['','','','','',''],";
    }
    if ($flag_one_row[$j] == 'N') {
        echo "['$pgm_id[$j]','" . number_format($value_zero[$j], 0) . "','" . number_format($value_one[$j], 0) . "','" . number_format($value_two[$j], 0) . "','" . number_format($value_three[$j], 0) . "','" . number_format($value_four[$j], 0) . "'],\n";
    }
    else if ($flag_one_row[$j] == 'P') {
        echo "['$pgm_id[$j]','" . number_format($value_zero[$j], 0) . "%','" . number_format($value_one[$j], 0) . "%','" . number_format($value_two[$j], 0) . "%','" . number_format($value_three[$j], 0) . "%','" . number_format($value_four[$j], 0) . "%'],\n";
    }
    else if ($flag_one_row[$j] == 'C') {
        echo "['$pgm_id[$j]','$" . number_format($value_zero[$j], 0) . "','$" . number_format($value_one[$j], 0) . "','$" . number_format($value_two[$j], 0) . "','$" . number_format($value_three[$j], 0) . "','$" . number_format($value_four[$j], 0) . "'],\n";
    }
    else if ($flag_one_row[$j] == 'D') {
        echo "['$pgm_id[$j]','" . number_format($value_zero[$j], 3, '.', '') . "','" . number_format($value_one[$j], 3, '.', '') . "','" . number_format($value_two[$j], 3, '.', '') . "','" . number_format($value_three[$j], 3, '.', '') . "','" . number_format($value_four[$j], 3, '.', '') . "'],\n";
    }
    else {
        echo "['$pgm_id[$j]','" . number_format($value_zero[$j], 0) . "','" . number_format($value_one[$j], 0) . "','" . number_format($value_two[$j], 0) . "','" . number_format($value_three[$j], 0) . "','" . number_format($value_four[$j], 0) . "'],\n";
    }
    }
    else
    {
      if ($j == 0 || $j == 4 || $j == 7 || $j == 10 || $j == 12) {
        echo "['','','','','','']";
    }
    if ($flag_one_row[$j] == 'N') {
        echo "['$pgm_id[$j]','" . number_format($value_zero[$j], 0) . "','" . number_format($value_one[$j], 0) . "','" . number_format($value_two[$j], 0) . "','" . number_format($value_three[$j], 0) . "','" . number_format($value_four[$j], 0) . "']\n";
    }
    else if ($flag_one_row[$j] == 'P') {
        echo "['$pgm_id[$j]','" . number_format($value_zero[$j], 0) . "%','" . number_format($value_one[$j], 0) . "%','" . number_format($value_two[$j], 0) . "%','" . number_format($value_three[$j], 0) . "%','" . number_format($value_four[$j], 0) . "%']\n";
    }
    else if ($flag_one_row[$j] == 'C') {
        echo "['$pgm_id[$j]','$" . number_format($value_zero[$j], 0) . "','$" . number_format($value_one[$j], 0) . "','$" . number_format($value_two[$j], 0) . "','$" . number_format($value_three[$j], 0) . "','$" . number_format($value_four[$j], 0) . "']\n";
    }
    else if ($flag_one_row[$j] == 'D') {
        echo "['$pgm_id[$j]','" . number_format($value_zero[$j], 3, '.', '') . "','" . number_format($value_one[$j], 3, '.', '') . "','" . number_format($value_two[$j], 3, '.', '') . "','" . number_format($value_three[$j], 3, '.', '') . "','" . number_format($value_four[$j], 3, '.', '') . "']\n";
    }
    else {
        echo "['$pgm_id[$j]','" . number_format($value_zero[$j], 0) . "','" . number_format($value_one[$j], 0) . "','" . number_format($value_two[$j], 0) . "','" . number_format($value_three[$j], 0) . "','" . number_format($value_four[$j], 0) . "']\n";
    }  
    }
}
?>
                            ]);
                            var table = new google.visualization.Table(document.getElementById('chart_div'));
        
                            table.draw(data, {allowHtml: true,showRowNumber: false, 'cssClassNames': cssClassNames});
                        }
     
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
                        <li class="has-sub"><a href="DefaultHome.php">Home </a>

                                        <ul>
                                        <li><a href="DefaultHome.php">&nbsp;Overview&nbsp;</a></li>
                                        <li><a href="Treemap.php">&nbsp;Product Hierarchy&nbsp;</a></li>
                                        <li class="last"><a href="ScatterChart.php">&nbsp;Aggregate Sales&nbsp;</a></li>
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
                        <li class="active has-sub"><a href="ROIReportChart.php">Reports </a>
                      <ul>
                    <li class="last"><a href="ROIReportChart.php" >&nbsp;ROI Report&nbsp;</a></li>

                </ul>

                        </li>
                    </ul>
                </div>
            </div>
            <div id="tabs" style="margin-top: 10px;">
                <div class="controls" id="chartarea">

                    <div id="tabs-1">
                        <div class="heading" style="width:370px; padding-top:10px; margin-top:10px; text-align: center; font-size: 14px; font-weight: bold;  ">
                            PROGRAM AND ROI TRENDS
                        </div>
                        <div id="chart_div" style=" margin-top:20px;width: 99%; height: 100%;"></div>
                    </div>
		   <div style="margin-left: 10px;margin-top: 25px;font-style: italic;font-size: 12px;color:red;"><label>*Values listed above represent averages for each purchase cycle period</label></div>
                </div>
   <div style="margin-top:40px;height: 29px;background-color:#0093d0 ">
                <?php //require 'Mainmenu.php'; ?>
</div>
            </div>

    </body>
</html>
