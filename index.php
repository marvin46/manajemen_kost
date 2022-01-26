<?php  
error_reporting(0);
session_start();
include_once 'config/class.php';

// instance objek db dan user
$user = new User();
$db = new Database();

// koneksi ke MySQL via method
$db->connectMySQL();

// cek apakah user login atau tidak via method
if($user->get_sesi()) {
  header("location:home");
}
?>
<!DOCTYPE html>
<html lang="en">
    
<head>

        <title>Kost Exclusive</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="https://yourdomain.com/favicon.png"/>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link rel="stylesheet" href="css/fullcalendar.css" />
        <link rel="stylesheet" href="js/datepicker/datepicker3.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>




    </head>
    <body>
        <div id="loginbox">            
            <form id="loginform" method="post" class="form-vertical" action="login/">
				 <div class="control-group normal_text"> <h3>LOGIN ADMIN</h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_sy"><i class="icon-user"> </i></span><input name="username" type="text" placeholder="Username" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_sy"><i class="icon-lock"></i></span><input name="password" type="password" placeholder="Password" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <center><input type="submit" class="btn btn-info" value="Login"></center>
                </div>
            </form>
           
        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/matrix.login.js"></script>
        <script src="js/matrix.calendar.js"></script>
        <script src="js/fullcalendar.min.js"></script>
        <script src="js/datepicker/bootstrap-datepicker.js"></script>
        


    </body>

</html>
