<?php
	
	include '../includes/config.php';
	include '../includes/sessions.php';
?>
<?php
	if (isset($_GET['account'])) {
		$account_id = $_GET['account'];
	}
?>

<?php
if (!isset($_SESSION['account']) && !isset($_SESSION['verified']) ){
	header("location:login.php");
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
				<div class="col-1"><img src="images/icon.png" height="60" width="60" /></div>


				</div>
			</div>

		</div>

<div class="row" style="min-height: 500px">




	<div class="col-12 " style="background: url(images/transparent.png);">
		<?php

					if (isset($_POST['change_password'])){


					$pass1=mysqli_real_escape_string($conn , $_POST['pass1']);
					$pass2=mysqli_real_escape_string($conn , $_POST['pass2']);

					$record_query = "SELECT * FROM admin WHERE id = $account_id";
			$record = mysqli_query($conn , $record_query);
			if (!$record) {
				die ("error");
			}
			$record_set = mysqli_fetch_assoc($record);
				$lengthpass = strlen($pass1);
			if (empty($pass1) || empty($pass2) ) {
			echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='result'  >
								  <strong>WARNIING!</strong><br>";
			echo "Complete the followings:";
			echo " <ul>";
			if (empty($pass1)) {
				echo "<li>Enter password</li>" ;
			}
			if (empty($pass2)) {
				echo "<li>confirm password</li>";
			}


			echo"</ul>";


echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";


	}elseif ($pass1 != $pass2) {
				echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='result'  >
								  <strong>WARNIING!</strong><br>";
				echo "Complete the followings:";
				echo " <ul>";
					echo "<li>Password does not match </li>" ;

				echo"</ul>";


				echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

			}elseif($lengthpass <5){
				echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='result'  >
								  <strong>WARNIING!</strong><br>";
				echo "Complete the followings:";
				echo " <ul>";
					echo "<li>Password must be atleat five characters</li>" ;

				echo"</ul>";


				echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

			}else{
					$pass = md5($pass1);
					$query = "UPDATE admin SET password = '{$pass}' WHERE id = $account_id";
					if (mysqli_query($conn , $query)) {

						if (isset($_SESSION['account'])){
							$_SESSION['account'] = null;
						}
						$_SESSION['verified'] =null;

						$_SESSION['message'] = "Password update success  please login";
						header("location:login.php");

					}else {
						$_SESSION['message']= "something went wrong";
						header("location:login.php");
					}


			}
					}

?>

		<div class=" d-flex justify-content-center"><p class="h1 text-white mx-auto font-italic">Forget Password</p></div>

		<form action="" method="post" class="w-50 mx-auto my-4">
			<div class="form-group">

				<input type="password" name="pass1" class="form-control form-control-lg " placeholder="Enter new password"  />
			</div>
			<div class="form-group">

				<input type="password" name="pass2" class="form-control form-control-lg " placeholder="confirm new password"  />
			</div>




				<div class=" my-3">
					<input type="submit" value="Change Password" name="change_password" class="bg-success text-white font-weight-bold form-control-lg mt-4" class="btn btn-success text-white" >


				</div>



		</form>



</div></div>






<?php
	include '../includes/layout/footer.php';
?>

