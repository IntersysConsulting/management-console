<?php
$error = $_GET['err'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="../css/bootstrap.css" />
        <title>Catalina Personalized Rewards</title>
        <script type="text/javascript" src="js/main.js"></script>
        
    </head>
    <body>
        <div class="home">
            <div style="display:inline-block;position:relative;margin-top:10px;"><img src="../images/logo.png"/></div>
            <div style="height: 29px;background-color:#0093d0; margin-bottom:50px;">
                <?php //require 'Mainmenu.php'; ?>
</div>

<div id="content">
            <div class="login" style="margin-bottom:100px;">
                <div style="font-size:18px;margin-top:15px;margin-left:90px;">Login - Welcome!</div>
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
                        <?php if($error) {?><input type="password" value="" name="passwrd" style="margin-left:40px;" id="passwrd" maxlength="15" />
                        <?php } else { ?><input type="password" value="Enter Password" name="passwrd" style="margin-left:40px;" id="passwrd" maxlength="15" />
                        <?php } ?>
                    </div>
                    <label id="passwrd_error">"Please input password between 8 and 15 characters"</label>
                    <div id="log_error"><label for="password"  id="error" style="color: red; margin-left: 10px; font-size: 11px;"> <?php echo $error; ?></label></div>
                    <div></div>
                    <div style="margin-left: 50px ;margin-top:20px;">
                        <input class="btn" type="submit" value="Login" name="submit" style="font-size:13px;font-weight:600;margin-left:40px;" id="submit"  />
                        <input class="btn" type="button" value="Cancel" name="cancel" style="margin-left:30px;font-size:13px;font-weight:600" id="login_cancel"  />
                    </div>
                </form>
            </div>
        </div>

    <div style="height: 29px;background-color:#0093d0;">
                <?php //require 'Mainmenu.php'; ?>
</div>
  <!--         <div style="display:inline-block;position:relative;margin-left:20px;float:right;"><img style="width:450px;" src="../images/footer.png"/></div> -->

</div>
    </body>
    <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <script charset="utf-8" type="text/javascript" src="js/app_server.php"
        xml:space="preserve">
    </script>
</html>




