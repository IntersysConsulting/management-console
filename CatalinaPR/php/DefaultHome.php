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
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">
    google.load('visualization', '1', {packages: ['motionchart']});

    function drawVisualization() {
    
      var time = [['2000W01', '2000W02'],
                  ['2002Q3', '2002Q4'],
                  [1990, 1991],
                  [(new Date(2000, 0, 1)), (new Date(2000, 0, 2))]];
    
      var columnType;
      switch (timeUnits) {
       case 0:
       case 1:
         columnType = 'string';
         break;
       case 2:
       columnType = 'number';
       break;
       case 3:
       columnType = 'date';
       break;
      }
    
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Fruit');
      data.addColumn(columnType, 'Time');
      data.addColumn('number', 'Sales');
      data.addColumn('number', 'Expenses');
      data.addColumn('string', 'Location');
      data.addRows([
        ['Apples', time[timeUnits][0], 1000, 300, 'East'],
        ['Oranges', time[timeUnits][0], 950, 200, 'West'],
        ['Bananas', time[timeUnits][0], 300, 250, 'West'],
        ['Apples', time[timeUnits][1], 1200, 400, 'East'],
        ['Oranges', time[timeUnits][1], 900, 150, 'West'],
        ['Bananas', time[timeUnits][1], 788, 617, 'West']
      ]);
    
      var motionchart = new google.visualization.MotionChart(
          document.getElementById('visualization'));
      motionchart.draw(data, {'width': 600, 'height': 300});
    }
    
    var timeUnits = 0;
    
    
    

    google.setOnLoadCallback(drawVisualization);

    function changeTimeUnits(value) {
      timeUnits = parseInt(value, 10);  
      drawVisualization();
    }
    
  </script>
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
        <title>Sales Change Goals</title>
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
                        <li  class="active"><a href="DefaultHome.php">Home </a></li>
                        <li><a href="SalesChange.php">Controls </a></li>
                        <li><a href="GuardRails.php">Guard Rails </a></li>
                        <li><a href="ValidationControls.php">Validation Rules </a></li>
                        <li><a href="ROIReports.php">Reports </a></li>
                    </ul>
                </div>

            </div>
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
    <div id="visualization" style="width: 600px; height: 300px; margin-left:80px;"></div>

        </div>
        
    </body>
    

            


            
</html>





