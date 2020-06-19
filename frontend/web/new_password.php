<?php
  include 'includes/config.php';
  include 'includes/sessions.php';

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

				<input type="password" name="pass1" class="form-control form-control-lg bg-light" placeholder="Enter new password"  />
			</div>
			<div class="form-group">

				<input type="password" name="pass2" class="form-control form-control-lg bg-light" placeholder="confirm new password"  />
			</div>




				<div class=" my-3">
					<input type="submit" value="Change Password" name="change_password" class="form-control w-100 text-white bg-success text-white font-weight-bold form-control-lg mt-4"  >


				</div>



		</form>



</div>
</div>
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
			 $_SESSION['message'] = null;
			if (empty($pass1)) {
				$_SESSION['message'] .= "<li>Enter password</li>" ;
			}
			if (empty($pass2)) {
				$_SESSION['message'] .= "<li>confirm password</li>";
			}
				header("location:new_password.php");

			
	}elseif ($pass1 != $pass2) {
				
					$_SESSION['message'] .= "<li>Password does not match </li>" ;

				header("location:new_password.php");

			}elseif($lengthpass <5){
				
					$_SESSION['message'] .= "<li>Password must be atleat five characters</li>" ;

			
				header("location:new_password.php");
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
</body>

</html>