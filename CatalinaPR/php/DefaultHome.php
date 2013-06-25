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
                <?php require 'Mainmenu.php'; ?>

            </div>
            <div id="tabs" style="margin-left: 50px;margin-top: 35px;width: 650px; height: 298px;">
                <ul>
                    <li><a href="#tabs-1">&nbsp;Sales Change&nbsp;</a></li>
                    <li><a href="ROIGoals.php">&nbsp;ROI Goals&nbsp;</a></li>
                    <li><a href="ROIAdj.php">&nbsp;ROI Adj.&nbsp;</a></li>
                    <li><a href="PurchaseCycleAdj.php">&nbsp;Purchase Cycle Adj.&nbsp;</a></li>
                    <li><a href="CategoryPerformance.php">&nbsp;Category Performance&nbsp;</a></li>
                    <li><a href="HHPerformance.php">&nbsp;HH Performance&nbsp;</a></li>
                </ul>
                <div class="controls">

                    <div id="tabs-1">
                        <div class="heading">
                            <div style="text-align: center; font-weight: bold; font-size: 14px;">Sales Change Goals</div>
                            <div style="font-style: italic;">Quintile Change-current Period vs Previous Period or same period Last Year</div>
                        </div>
                        <div>
                            <div class="segment">Segment</div>
                            <div class="headers">
                                <ul style="float: left; list-style-type: none;">
                                    <li><b>-5</b></li>
                                    <li>  <b>-4</b></li>
                                    <li>  <b>-3</b></li>
                                    <li>  <b>-2</b></li>
                                    <li>  <b>-1</b></li>
                                    <li>  <b>0</b></li>
                                    <li> <b>1</b></li>
                                    <li> <b>2</b></li>
                                    <li> <b>3</b></li>
                                    <li> <b>4</b></li>
                                    <li> <b>5</b></li>
                                </ul>
                            </div>
                        </div>
                        
                        

                    </div>
                </div>

            </div>
        </div>
        
    </body>
    

            


            
</html>





