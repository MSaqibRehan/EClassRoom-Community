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
if (!isset($_SESSION['account'])){
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
				<div class="col-1"><a onclick="return confirm('Are you sure you want to leave this page?')" href="../../newcms/public/login.php"><img src="images/icon.png" height="60" width="60" /></a>	</div>

				
				</div>
			</div>

		</div>

<div class="row" style="min-height: 500px">




	<div class="col-12 " style="background: url(images/transparent.png);">
		<?php

					if (isset($_POST['verif'])){


					$verify=mysqli_real_escape_string($conn , $_POST['verify']);

					$record_query = "SELECT * FROM admin WHERE id = $account_id";
			$record = mysqli_query($conn , $record_query);
			if (!$record) {
				die ("error");
			}
			$record_set = mysqli_fetch_assoc($record);


if (empty($verify) || $record_set['verification'] != $verify ) {
			echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='result'  >
								  <strong>WARNIING!</strong><br>";
			echo "Complete the followings:";
			echo " <ul>";
			if (empty($verify)) {
				echo "<li>Enter verification code</li>" ;
			}elseif ($record_set['verification'] != $verify) {
				echo "<li>invalid varification code</li>";
			}


			echo"</ul>";


echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";


	}else{


					if($verify == $record_set['verification']){
						$_SESSION['verified'] = $verify;

					 	header("location:new_password.php?account=". urlencode($account_id));

					}else{
							echo mysqli_error($conn);
					  	$_SESSION['message'] = "something went wrong please try again ";
					  	header("location:login.php");
					  }

			}
					}

?>

		<div class=" d-flex justify-content-center"><p class="h1 text-white mx-auto font-italic">Forget Password</p></div>

		<form action="" method="post" class="w-50 mx-auto my-4">
			<div class="form-group">

				<input type="text" name="verify" class="form-control form-control-lg " placeholder="Enter verification code"  />
			</div>




				<div class=" my-3">
					<input type="submit" value="verif" name="verif" class=" text-white font-weight-bold btn btn-success" class="btn btn-success text-white" >
					<a href="forgot_password.php" class="btn btn-primary" >Cancel</a>

				</div>



		</form>



</div></div>






<?php
	include '../includes/layout/footer.php';
?>