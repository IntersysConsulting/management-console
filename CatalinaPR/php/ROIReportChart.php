<?php
session_start();
include "connection.php";
$value_zero=array();
$value_one=array();
$value_two=array();
$value_three=array();
$value_four=array();
$flag_one_row=array();
$pgm_id=Array();
$conseq = array(); 
$value=array();
$flg=array();

$query = "select b.program_desc,a.val_enddate,a.enddate,b.rep_flag 
    from pr_roi_report a
    join pr_roi_program b
      on a.program_id = b.program_id
   where a.enddate >=(select distinct min(enddate) from pr_roi_report order by enddate desc limit 5)
     and a.enddate <=(select distinct max(enddate) from pr_roi_report order by enddate desc limit 5) 
order by a.enddate desc,b.program_id";
$result = mysql_query($query);
if (!$result) {
  die("Invalid query: " . mysql_error());
}
$num = mysql_num_rows($result);
$program_desc=array();
while ($row = mysql_fetch_array($result)) {

    if ($end_date != $row[2]) {

       $en_date[]=$row[2];
       $end_date = $row[2];
    }
    $program_desc[]=$row[0];
    $ProdCatArray[]=$row;
    
}

$ii = 0;
$max = count($ProdCatArray);

for($i = 0; $i < count($ProdCatArray); $i++) {
    $value[$ii][]=$ProdCatArray[$i][1];

    $conseq[$ii][] = $ProdCatArray[$i][2];
    $flg[$ii][]=$ProdCatArray[$i][3];

    
    if($i + 1 < $max) {
        $dif = $ProdCatArray[$i+1][2] == $ProdCatArray[$i][2];
        if($dif==0) {
            
            $ii++;
        }   
    }
}

        $value_zero=$value[0];
        $value_one=$value[1];
        $value_two=$value[2];
        $value_three=$value[3];
        $value_four=$value[4];
        $flag_one_row=$flg[0];


$jj = 0;
$maximum = count($program_desc);
$pgm_ids=Array();
for($i = 0; $i < count($program_desc)/5; $i++) {
    $pgm_ids[$jj][]=$program_desc[$i];
    if($i + 1 < $maximum) {
        //$dif = $program_desc[$i+1] == $program_desc[$i];
        if($program_desc[$i+1] == $program_desc[$i]) {
            
            $jj++;
        }   
    }
}
$pgm_id=$pgm_ids[0];
?>
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
        <title>
      ROI Report using google chart
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
		for($j=0;$j<=13;$j++){
                    if($j==0||$j==4||$j==7||$j==10||$j==12)
                    {
                        echo "['','','','','',''],";
                    }
                  if($flag_one_row[$j]=='N'){  
		echo "['$pgm_id[$j]','".number_format($value_zero[$j],0)."','".number_format($value_one[$j],0)."','".number_format($value_two[$j],0)."','".number_format($value_three[$j],0)."','".number_format($value_four[$j],0)."'],\n";
                  }
                  else if($flag_one_row[$j]=='P'){
                      echo "['$pgm_id[$j]','".number_format($value_zero[$j],0)."%','".number_format($value_one[$j],0)."%','".number_format($value_two[$j],0)."%','".number_format($value_three[$j],0)."%','".number_format($value_four[$j],0)."%'],\n";
                  }
                  else if($flag_one_row[$j]=='C'){
                      echo "['$pgm_id[$j]','$".number_format($value_zero[$j],0)."','$".number_format($value_one[$j],0)."','$".number_format($value_two[$j],0)."','$".number_format($value_three[$j],0)."','$".number_format($value_four[$j],0)."'],\n";
                  }
                  else
                  {
                      echo "['$pgm_id[$j]','".number_format($value_zero[$j],3,'.','')."','".number_format($value_one[$j],3,'.','')."','".number_format($value_two[$j],3,'.','')."','".number_format($value_three[$j],3,'.','')."','".number_format($value_four[$j],3,'.','')."'],\n";
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
      <div class="home" style="width:900px !important; height:800px !important;">
            <div style="margin-left: 350px;margin-top: 20px;">Personalized Rewards</div>
            <div style="margin-left: 50px;"><img src="../images/logo.JPG"/></div>
            <div id="logout" >
                <a href="LogOut.php" id="logout" style="text-decoration: none;height:15px; font-size: 14px;color: #7A98D1;font-weight: bolder;margin-left: 800px;">Logout</a>
            </div>
            <div style="margin-left: 50px;height: 29px;background-color: #BACBEB;width: 820px; ">
               <div class="mainmenu">
                    <ul style="margin-top: 7px;">
                        <li><a href="DefaultHome.php">Home </a></li>
                        <li><a href="SalesChange.php">Controls </a></li>
                        <li><a href="GuardRails.php">Guard Rails </a></li>
                        <li><a href="ValidationControls.php">Validation Rules </a></li>
                        <li class="active"><a href="ROIReportChart.php">Reports</a></li>
                    </ul>
                </div>

            </div>
            <div id="tabs" style="margin-left: 50px;margin-top: 35px;width: 780px; height: 828px;">
                <ul>
                    <li><a href="#tabs-1">&nbsp;ROI Report&nbsp;</a></li>

                </ul>
          
                <div class="controls" style="height:580px; width:790px;">

                    <div id="tabs-1">
                        <div class="heading" style="width:370px; padding-top:10px; margin-top:10px; text-align: center; font-size: 18px; font-weight: bolder;  ">
                            PROGRAM AND ROI TRENDS
                        </div>
                        <div id="chart_div" style=" margin-top:20px;width: 99%; height: 100%;"></div>
                       </div>

                </div>
            </div>
      
  </body>
</html>