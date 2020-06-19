<?php
  include 'includes/config.php';
  include 'includes/sessions.php';

?>
<?php
	if (isset($_GET['account'])) {
		$account_id = $_GET['account'];
	}
?>


	?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>blog</title>
    <!-- meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
       <link href="css/style.css" rel="stylesheet" type="text/css" />
       <link rel="icon" type="image/jpg" href="images/icon.png">
    <link href="css/fontawesome-all.css" rel="stylesheet" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.js" type="text/javascript" ></script>
    <script src="bootstrap/js/popper.min.js" type="text/javascript" ></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>


</head>


<body >
    <div class="row container-fluid">

    <div class=" w3l-login-form w-50 mt-5" >
        <h2>Forgot Password</h2>
        <?php if (isset($_SESSION['message'])) {
            message();
        } ?>

		

		

		<form action="" method="post" >
			<div class="form-group">

				<input type="text" name="verify" class="form-control form-control-lg " placeholder="Enter verification code"  />
			</div>




				<div class=" my-3">
					<input type="submit" value="verif" name="verif" class=" text-white font-weight-bold btn btn-success" class="btn btn-success text-white" >
					<a href="forgotpassword.php" class="btn btn-primary" >Cancel</a>

				</div>



		</form>



</div>
</div>

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
			$_SESSION['message'] = null;
			if (empty($verify)) {
				$_SESSION['message'] .= "<li>Enter verification code</li>" ;
			}elseif ($record_set['verification'] != $verify) {
				$_SESSION['message'] .= "<li>invalid varification code</li>";
			}




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
</body>

</html>