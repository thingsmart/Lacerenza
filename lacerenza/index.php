<?php
	session_start();
    if (isset($_SESSION['username'])) {
		header('Location: ./home.php');
		exit();
	}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Lacerenza </title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">

    <script src="js/JQuery/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>

	<!--SCRIPT SITO-->
	<script src="js/sito/index.js" type="text/javascript"></script>
	
	<!--SCRIPT PER LOGIN-->
	<script src="js/md5.min.js" type="text/javascript" ></script>
    <script src="js/JQuery/jquery.form.js" type="text/javascript"></script>
	<script src="js/JQuery/jquery.validate.min.js" type="text/javascript"></script>

</head>

<style>

html, body {
    height: 100%;
}

#map {
    width: 100%;
    height: 100%;
    min-height: 100%;
    display: block;
}

.container {
	margin: 0 auto;
	height:800px;
	width:100%;
	background-image: url('css/images/bg-login.jpg');
	background-repeat: no-repeat;
	background-size: cover;
   }

h1 {
	color:#f2f2f2;
}

footer {
	background-color: #ddd;
	color: #f2f2f2;
	text-align:center;
	height: 50px;
	margin-top:-50px;
}

footer p {
	padding-top:12px;
	color:#666;
}

footer a {
	color:white;
	font-weight:bolder;
}

.fill { 
    min-height: 100%;
    height: 100%;
}
 
</style>

<body>


<div class="container fill">
    <div id="map">
    <div class="omb_login">
    	
		<div class="row">
		<div style="text-align:center;" class="col-md-6 col-md-offset-3">
		<!-- <img src="css/images/logo.png"/> -->
		</div>
		</div>
		
		<div class="row omb_row-sm-offset-3" style="margin-top: 135px;background-color: rgba(0, 0, 0, 0.3);padding:100px 0 100px 0;border:1px solid black;">
			<div class="col-xs-12 col-sm-6">	
			    <form class="omb_loginForm" action="" autocomplete="off" method="POST">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control"  id="username" name="username" placeholder="Username">
					</div>
					<span class="errore-username help-block"></span>
										
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<input  type="password" class="form-control" id="password" name="password" placeholder="Password">
					</div>
                    <span class="errore-password help-block"></span>
				</form>
					<button class="btn btn-lg btn-primary btn-block" id="btn-login" type="submit">Login</button>
				
			</div>
    	</div>
		

	</div>

	</div>

</div>
<footer>
		<p>Designed by <a href="http://www.jetbit.it" target="_blank">Jetbit</a></p>
	</footer>
</body>
</html>	
