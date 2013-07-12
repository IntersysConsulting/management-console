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

<div id="logout">
<a href="LogOut.php" id="logout" style="text-decoration: none;height:15px; font-size: 14px;color: #7A98D1;font-weight: bolder;">Logout</a>
            </div>
            <div style="text-decoration: none;font-size:10px;color:#BACBEB; font-weight:bolder;margin-top:27px;position:absolute;margin-left:120px;"><a>Personalized Rewards</a></div>
            <div style="display:inline-block;"><img src="../images/logo.JPG"/></div>

            <div style="height: 29px;background-color: #BACBEB; margin-bottom:50px;">
                <?php //require 'Mainmenu.php'; ?>
</div>

<div id="content">
            <div class="login" style="margin-left:auto; margin-right:auto;margin-bottom:100px;">
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
    <div style="height: 29px;background-color: #BACBEB; margin-bottom:50px;">
                <?php //require 'Mainmenu.php'; ?>
</div>

</div>
    </body>
    <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <script charset="utf-8" type="text/javascript" src="js/app_server.php"
        xml:space="preserve">
    </script>
</html>




