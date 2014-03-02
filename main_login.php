<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DreamHost</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/login.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body id="domains">
    <?php 
// file_put_contents("logLogin", "main_login\n",FILE_APPEND|LOCK_EX);
  
?>
<div id="logo" class="row">
  <div class="small-12 medium-8 medium-centered columns">
    <img src="assets/FitnessManager.png">
    </img>
  </div>
</div>
<div class="row">
    <div id="login" class="panel small-12 medium-6 medium-centered columns">
      <form id="loginForm"name="form1" method="post" action="retrieveFromDB/checklogin.php">
	<label>Username:</label>
	<input name="myusername" type="text" id="myusername" placeholder="Arnold">
	  <label>Password:</label>
	  <input name="mypassword" type="password" id="mypassword" placeholder="******">
	    <input class="button" type="submit" name="Submit" value="Login">
	    </form>
	  </div>
	</div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>


	</body>
      </html>

