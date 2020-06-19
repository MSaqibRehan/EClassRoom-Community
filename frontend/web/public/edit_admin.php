<?php
	include '../includes/layout/header.php';
	include '../includes/config.php';
	include '../includes/sessions.php';
?>
<?php
	if(!isset($_SESSION["login_user"])){
		header("Location:login.php");
	}
 ?>
<?php
	if (isset($_GET['admin'])) {
		$selected_admin = $_GET['admin'];
		$safe_selected_admin = mysqli_real_escape_string($conn , $selected_admin);

	}else {
		$safe_selected_admin = null;
	}
?>
<?php
    function GetImageExtension($imagetype)
    {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return false;
       }

     }
?>

<div class="row" style="min-height: 500px">

		<div class="col-3 bg-info py-3">
			<div class="w-100 mx-auto">
			<p class="h4 ">Content Management</p>
			<a href="manage_content.php" class="btn btn-lg btn-primary w-100">Manage Content</a>
			<a href="manage_admin.php" class="btn btn-lg btn-primary w-100 my-3">Manage admins</a>
			<a href="logout.php" class="btn btn-lg btn-danger w-100">LOGOUT</a>
		</div>
		</div>

	<div class="col-9 bg-light" >

<?php
	if (isset($_POST['edit_admin'])) {
		$name = mysqli_real_escape_string($conn , $_POST['name']);
		$pass = mysqli_real_escape_string($conn , $_POST['pass']);
		$email = mysqli_real_escape_string($conn , $_POST['email']);
		$file_name=$_FILES["image"]["name"];
		$temp_name=$_FILES["image"]["tmp_name"];
	    $imgtype=$_FILES["image"]["type"];
    	$ext= GetImageExtension($imgtype);
    	$imagename=$_FILES["image"]["name"];

    	 $target_path = "images/".$imagename;
    	 $re ="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
    	$query2="SELECT * FROM admin WHERE email='$email' AND id != {$safe_selected_admin}";
      $result2=mysqli_query($conn,$query2);
$eemails = -1;
      while ($row2 = mysqli_fetch_assoc($result2)) {
          if ($row2['email'] == $email) {
          	$eemails++;
          }
      }

		$record_query = "SELECT * FROM admin WHERE id != $safe_selected_admin";
			$record = mysqli_query($conn , $record_query);
			$record_set = mysqli_fetch_assoc($record);
			$countset = 0;
			$img_count = 0;
			
			while($record_set = mysqli_fetch_assoc($record)){
					if ($name == $record_set['username']) {
						$countset++;
					}
					if ($target_path == $record_set['image']) {
					$img_count++;
				}
			}
			$lengthpass = -1;
			$lengthpass = strlen($pass);
			$length = strlen($name);
		if (empty($name) || empty($pass) || !preg_match("/^[a-zA-Z0-9]+$/" , $name) || $length >=40 || $lengthpass <5 || $countset >= 1 || $img_count != 0 || empty($imagename) ||$_FILES["image"]["size"] > 2000000 || $ext == 'false' || empty($email) || $eemails != -1 || (!preg_match($re , $email))) {
			echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'  >
								  <strong>WARNIING!</strong><br>";
			echo "Complete the followings:";
			echo " <ul>";
			if (empty($name)) {
				echo "<li>Enter user name</li>" ;
			}elseif (!preg_match("/^[a-zA-Z0-9]+$/" , $name)) {
				echo "<li>no white spaces and special characters are allowed for name</li>" ;
			}elseif ($length >= 40 ) {
				echo "<li>Username too long</li>" ;
			}elseif($countset >= 1){
				echo "<li>Username already exist</li>" ;
			}

			if (empty($pass) || $lengthpass == -1){
				echo "<li>Enter Password</li>";
			}	elseif($lengthpass < 5){
					echo "<li>Password must be atleat eight characters</li>" ;
			}
			if (empty($email)) {
				echo "<li>Enter Email Address</li>" ;
			}elseif (!preg_match($re , $email)) {
				echo "<li>invalid Email Address</li>" ;
			}elseif ($eemails != -1) {
				echo "<li>Email Address Already Exist , use another email</li>" ;
			}

			if (empty($imagename)) {
				echo "<li>Select an Image</li>" ;
			}elseif ($img_count != 0) {
				echo "<li>Image Already Exist in Database</li>" ;
			}elseif ($_FILES["image"]["size"] > 2000000) {
   				 echo "<li>Sorry, your file is too large.</li>";
   			}elseif($ext == 'false'){
				echo "<li>Please Select .png/.jpg/.gif/.btm format image</li>";
			}



			echo"</ul>";


echo "	  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								    <span aria-hidden='true'>&times;</span>
								  </button>
								</div>";

		}elseif (isset($name) && isset($pass) ) {
			$record_query = "SELECT * FROM admin WHERE id =  $safe_selected_admin LIMIT 1";
			$records = mysqli_query($conn , $record_query);
			$record_set = mysqli_fetch_assoc($records);
				unlink($record_set['image']);
			 move_uploaded_file($temp_name, $target_path);

			$pass = md5($pass);
		$query = "UPDATE admin SET username = '{$name}' , password = '{$pass}' ,email='{$email}', image = '{$target_path}' WHERE id = $safe_selected_admin";
		if (!mysqli_query($conn , $query)) {
			echo "error:" . $query . "<br>". mysqli_error($conn);
		}else {
			$_SESSION['message'] = ' update success';
			header("location:manage_admin.php");
		}}
	}
?>


		<?php
				if (isset($_SESSION['message'])) {
					message();
				}
			?>
		<?php
			$record_query = "SELECT * FROM admin WHERE id =  $safe_selected_admin LIMIT 1";
			$records = mysqli_query($conn , $record_query);
			$record_set = mysqli_fetch_assoc($records);
		?>
		<p class="h2">Add New admin</p>
		<form action="" method="post" class="w-50 mx-auto my-3" enctype="multipart/form-data">
			<div class="form-group">
				<label for="name">admin Name:	</label>
				<input type="text" name="name" class="form-control" value="<?php echo htmlentities($record_set['username']) ?>" id="name" />
			</div>
			<div class="form-group">
				<label for="password">admin password:	</label>
				<input type="password" name="pass" class="form-control" placeholder="Enter admin password" id="password" />
			</div>
			<div class="form-group">
				<label for="email">admin Email:	</label>
				<input type="email" name="email" class="form-control" value="<?php echo htmlentities($record_set['email']) ?>" placeholder="Enter email address" id="email" />
			</div>
			<div class="form-group">
				 <label for="image">Choose file</label>
			    <input type="file" class="form-control" name="image" id="image" >

		    </div>



				<div class="form-group my-3">
					<input type="submit" value="create" name="edit_admin" class="btn btn-success text-white" >
					<a href="manage_admin.php" class="btn btn-primary">Cancel</a>
				</div>



		</form>



</div></div>





<?php
	include '../includes/layout/footer.php';
?>