<?php
	
	include '../includes/config.php';
	include '../includes/sessions.php';
?>

<?php
if (isset($_SESSION['login_user'])){
	header("location:admin.php");
}
	?>
	<!DOCTYPE html>
<html lang="en">
<head>
	<title>new cms</title>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" type="image/jpg" href="images/icon.png">
	 	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	 	<link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
	 		<link rel="stylesheet" href="hover-master/css/hover-min.css">
  				<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
  					<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
  						<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<style type="text/css">
		body{

		}
		.footer a:hover{
			font-weight: bolder;
			background-color: lawngreen;
			color: black !important;

		}
		.logout a:hover{
			text-decoration: none;
			color: lawngreen !important;
		}
	</style>

</head>
<body style="background: url('images/background.jpg')" >

	<div class="container" >
		<div class="row header bg-dark text-white">
			<div class="col-12">
				<div class="row py-2">
				<div class="col-1"><a href="../../newcms/public/login.php"><img src="images/icon.png" height="60" width="60" /></a>	</div>

				<div class="col-2 offset-9 pt-3 logout "><a href="../../newcms/public/index.php" class="text-white font-weight-bold ">Public<i class="far fa-eye pl-2"></i></a> </div>
				</div>
			</div>

		</div>

<div class="row" style="min-height: 500px">




	<div class="col-12" style="background: url(images/transparent.png);">
		<?php if (isset($_SESSION['message'])) {
			message();
		} ?>
		<?php

					if (isset($_POST['login'])){


					$username=mysqli_real_escape_string($conn , $_POST['name']);
					$password = mysqli_real_escape_string($conn ,  $_POST['pass']);

					$record_query = "SELECT username FROM admin WHERE username='{$username}' and password='{$password}'";
			$record = mysqli_query($conn , $record_query);
					$record_count = mysqli_num_rows($record);

if (empty($username) || empty($password)  ) {
			echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='result'  >
								  <strong>WARNIING!</strong><br>";
			echo "Complete the followings:";
			echo " <ul>";
			if (empty($username)) {
				echo "<li>Enter user name</li>" ;
			}

			if (empty($password)){
				echo "<li>Enter Password</li>";
			}




			echo"</ul>";


echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";


	}
	elseif ($record_count == 0 ) {
		echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='result'  >
								  <strong class='text-danger'>LOGIN FAILED!</strong><br>";
								  echo " <ul>";

					echo "<li class='text-danger'> Invalid username or password</li>";

			echo"</ul>";


echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";


	}
					$password = md5($password);
					$query = "SELECT username FROM admin WHERE username='$username' and password='$password'";
					$admin = mysqli_query($conn , $query);
					$count = mysqli_num_rows($admin);
					 if ($count != 0)
					{
					$_SESSION['login_user']=$username;
					$_SESSION['message'] = "login success";
					 header("location:admin.php");
					  }



					}

?>

		<div class="justify-content-center"><p class="h1 text-white mx-auto font-italic">LOGIN</p></div>

		<form action="" method="post" class="w-50 mx-auto my-4">
			<div class="form-group">

				<input type="text" name="name" class="form-control form-control-lg " placeholder="Enter admin name" id="name" />
			</div>
			<div class="form-group">

				<input type="password" name="pass" class="form-control form-control-lg mt-4" placeholder="Enter admin password" id="name" />
			</div>



				<div class="form-group my-3">
					<input type="submit" value="LOGIN" name="login" class="form-control bg-success text-white font-weight-bold form-control-lg hvr-pulse mt-3" class="btn btn-success text-white" >

				</div>



		</form>
		<div class="row w-50 mx-auto justify-content-end">
			<p class="h5 text-white">Trouble Signing in? <a href="forgot_password.php" >Forgot Password</a> </p>
		</div>
		



</div></div>






<?php
	include '../includes/layout/footer.php';
?>