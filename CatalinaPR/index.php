<?php
$error = $_GET['err'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="css/main.css" />
        <title>Catalina Personalized Rewards</title>
        <script type="text/javascript" src="js/main.js"></script>
        
    </head>
    <body>
        <div class="home">
            <div style="margin-left: 300px;margin-top: 20px;">Personalized Rewards</div>
            <div style="margin-left: 50px;"><img src="images/logo.JPG"/></div>
            <div style="margin-left: 50px;height: 29px;background-color: #BACBEB;width: 650px; ">
                <div id="mainmenu">
                    <ul>
                        <li class="active"><a href="php/LoginDesign.php" >Home </a></li>
                        <li><a href="php/SalesChange.php">Controls </a></li>
                        <li><a href="php/GuardRails.php">Guard Rails </a></li>
                        <li><a href="php/ValidationControls.php">Validation Rules </a></li>
                        <li><a href="php/ROIReports.php">Reports </a></li>
                    </ul>
                </div>

            </div>
           
            <div class="login">
                <div style="margin-top: 10px;margin-left: 200px;">Login</div>
                <form  method='post' action='php/Login.php' id='login' name="login" >
                    <div style="margin-top: 30px;margin-left: 50px;">
                        <label for="user_id" style="margin-left:40px;">User ID </label>
                        <?php if($error) {?><input type="text" value="" name="userid" style="margin-left:40px;" id="userid" maxlength="20" />
                        <?php } else { ?><input type="text" value="Enter Text" name="userid" style="margin-left:40px;" id="userid" maxlength="20" />
                        <?php } ?>
                    </div>
                    <label id="userid_error">"Please Enter user_id between 8 and 20 characters"</label>
                    <div style="margin-top: 15px;margin-left: 50px;">
                        <label for="password" style="margin-left:40px;">Password </label>
                        <?php if($error) {?><input type="password" value="" name="passwrd" style="margin-left:26px;" id="passwrd" maxlength="15" />
                        <?php } else { ?><input type="password" value="Enter Password" name="passwrd" style="margin-left:26px;" id="passwrd" maxlength="15" />
                        <?php } ?>
                    </div>
                    <label id="passwrd_error">"Please input password between 8 and 15 characters"</label>
                    <div id="log_error"><label for="password"  id="error" style="color: red; margin-left: 10px; font-size: 11px;"> <?php echo $error; ?></label></div>
                    <div></div>
                    <div style="margin-left: 145px;">
                        <input type="submit" value="Login" name="submit" style="margin-left:40px;" id="submit"  />
                        <input type="button" value="Cancel" name="cancel" style="margin-left:40px;" id="login_cancel"  />
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <script charset="utf-8" type="text/javascript" src="js/app_server.php"
        xml:space="preserve">
    </script>
</html>




