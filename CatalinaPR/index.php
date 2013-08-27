<?php
$error = $_GET['err'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
        <title>Catalina Personalized Rewards</title>
        <script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript">
         jQuery(window).load(function() {
                    $('#userid_error').hide();
                    $('#passwrd_error').hide();
         });
         $(document).ready(function() {
                    $('#userid_error').hide();
                    $('#passwrd_error').hide();
         });
        </script>
                
    </head>
    <body>
        <div class="home">
            <div style="display:inline-block;position:relative;margin-top:10px;"><img src="../images/logo.png"/></div>
	    <div style="text-decoration: none;font-size:15px;color:#BACBEB; font-weight:bolder;position:absolute;margin-left:230px;margin-top:-20px;"><a>Personalized Rewards</a></div>
            <div style="height: 29px;background-color:#0093d0; margin-bottom:50px;">
                <?php //require 'Mainmenu.php'; ?>
</div>

<div id="content">
            <div class="login" style="margin-bottom:100px;">
                <div style="font-size:18px;margin-top:15px;margin-left:145px;">Login - Welcome!</div>
                <form  method='post' action='php/Login.php' id='login' name="login"style="margin-left:30px;" >
                    <div style="margin-top: 30px;margin-left: 50px;">
                        <label for="user_id" style="margin-left:40px;">User ID </label>
                        <?php if($error) {?><input type="text" value="" name="userid" style="margin-left:40px;" id="userid" maxlength="20" />
                        <?php } else { ?><input type="text" value="ssethuma" name="userid" style="margin-left:40px;" id="userid" maxlength="20" />
                        <?php } ?>
                    </div>
                    <label id="userid_error"></label>
                    <div style="margin-top: 15px;margin-left: 50px;">
                        <label for="password" style="margin-left:40px;">Password </label>
                        <?php if($error) {?><input type="password" value="" name="passwrd" style="margin-left:40px;" id="passwrd" maxlength="15" />
                        <?php } else { ?><input type="password" value="ssethuma" name="passwrd" style="margin-left:40px;" id="passwrd" maxlength="15" />
                        <?php } ?>
                    </div>
                    <label id="passwrd_error"></label>
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




