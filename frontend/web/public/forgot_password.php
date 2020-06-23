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
<div class="row " style="min-height: 500px">




	<div class="col-12 " style="background: url(images/transparent.png);">
		<?php

					if (isset($_POST['forgot'])){


					$email=mysqli_real_escape_string($conn , $_POST['email']);

					$record_query = "SELECT * FROM admin WHERE email='{$email}'";
			$record = mysqli_query($conn , $record_query);
			$record_set = mysqli_fetch_assoc($record);
					$record_count = mysqli_num_rows($record);

if (empty($email) ) {
			echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='result'  >
								  <strong>WARNIING!</strong><br>";
			echo "Complete the followings:";
			echo " <ul>";
			if (empty($email)) {
				echo "<li>Enter email address</li>" ;
			}



			echo"</ul>";


echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";


	}
	elseif ($record_count == 0 ) {
		echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='result'  >
								  <br>";
								  echo " <ul>";

				echo "<li>This email is not registered to any account, <br> enter valid email address</li>";

			echo"</ul>";


echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";


	} 	else{
					$code = rand(100000,999999);
					$to = "{$email}";
					$subject = "Forgot Password";
					$txt = "your Verification Code is \n\n\n $code";
					$headers = "From: no-reply" . "\r\n";

					if(mail($to,$subject,$txt,$headers)){


					$query = "UPDATE admin SET verification='{$code}' WHERE id = {$record_set['id']}";
					if(mysqli_query($conn , $query)){
						$_SESSION['account'] = $record_set['username'];
						 header("location:verify.php?account=". urlencode($record_set['id']));
					  }else{
					  	$_SESSION['message'] = $query1 .mysqli_error($conn). "\nplease try again";
					  	header("location:login.php" );
					  }
					}else{
					  	$_SESSION['message'] = "something went wrong please try again ";
					  }

			}
					}

?>

		<div class="w-50 mx-auto justify-content-start mt-5 "><p class="h1 text-white mx-auto font-italic">Forget Password</p></div>

		<form action="" method="post" class="w-50 mx-auto my-4">
			<div class="form-group">

				<input type="email" name="email" class="form-control form-control-lg " placeholder="Enter Email id"  />
			</div>




				<div class=" my-3">
					<input type="submit" value="search" name="forgot" class=" text-white btn btn-success " class="btn btn-success text-white" >
					<a href="login.php" class="btn btn-primary" >Cancel</a>

				</div>



		</form>



</div></div>






<?php
	include '../includes/layout/footer.php';
?>