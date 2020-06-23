<?php
	include '../includes/layout/header.php';
	include '../includes/config.php';
	include '../includes/sessions.php';
?>
<?php
	if (isset($_GET['admin'])) {
		$selected_admin = $_GET['admin'];
		$safe_selected_admin = mysqli_real_escape_string($conn , $selected_admin);

	}
?>
<?php
	if(!isset($_SESSION["login_user"])){
		header("Location:login.php");
	}
 ?>
<?php
    function GetImageExtension($imagetype)
    {
       if(empty($imagetype)) return 'false';
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return 'false';
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
	if (isset($_POST['new_admin'])) {
		$name = mysqli_real_escape_string($conn , $_POST['name']);
		$pass = mysqli_real_escape_string($conn , $_POST['pass']);
		$email = mysqli_real_escape_string($conn , $_POST['email']);
		$file_name=$_FILES["image"]["name"];
		$temp_name=$_FILES["image"]["tmp_name"];
	    $imgtype=$_FILES["image"]["type"];
    	$ext= GetImageExtension($imgtype);
    	$imagename=$_FILES["image"]["name"];
    	$img_size = $_FILES["image"]["size"];
    	$target_path = "images/".$imagename;
    	$re ="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";


		$record_query = "SELECT * FROM admin";
		$record = mysqli_query($conn , $record_query);
		$countset = -1;
		$img_count = -1;
		$mail_count = -1;
		while($record_set = mysqli_fetch_assoc($record)){
				if ($name == $record_set['username']) {
					$countset++;
				}
				if ($target_path == $record_set['image']) {
					$img_count++;
				}
				if ($email == $record_set['email']) {
					$mail_count++;
				}
			}
			$lengthpass = -1;
			$lengthpass = strlen($pass);
			$length = strlen($name);
		if (empty($name) || empty($pass) || (!preg_match("/^[a-zA-Z0-9]+$/" , $name)) || $length >=40 || $lengthpass <5 || $countset != -1 || $img_count != -1 || empty($imagename) ||  $img_size > 2000000 || $ext == 'false' || empty($email) || $mail_count != -1 || (!preg_match($re , $email))) {
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
			}elseif($countset != -1){
				echo "<li>Username already exist</li>" ;
			}

			if (empty($pass) || $lengthpass == -1){
				echo "<li>Enter Password</li>";
			}	elseif($lengthpass < 5){
					echo "<li>Password must be atleat five characters</li>" ;
			}
			if (empty($email)) {
				echo "<li>Enter Email Address</li>" ;
			}elseif ($mail_count != -1) {
				echo "<li>Email Address Already Exist , use another email</li>" ;
			}elseif (!preg_match($re , $email)) {
				echo "<li>invalid Email Address</li>" ;
			}
			if (empty($imagename)) {
				echo "<li>Select an Image</li>" ;
			}else
			if ($img_count != -1) {
				echo "<li>Image Already Exist in Database</li>" ;
			}elseif ($img_size > 2000000) {
   				 echo "<li>Sorry, your file is too large.</li>";

			}elseif($ext == 'false'){
				echo "<li>Please Select .png/.jpg/.gif/.btm format image</li>";
			}






			echo"</ul>";


echo "	  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								    <span aria-hidden='true'>&times;</span>
								  </button>
								</div>";

		}elseif (isset($name) && isset($pass) && move_uploaded_file($temp_name, $target_path)) {

		$pass = md5($pass);
		$query = "INSERT INTO admin (username , password ,email, image ) VALUES ('{$name}' , '{$pass}' ,'{$email}', '{$target_path}' )";
		if (!mysqli_query($conn , $query)) {
			echo "error:" . $query . "<br>". mysqli_error($conn);
		}else {
			$_SESSION['message'] = 'admin created success';
			header("location:manage_admin.php");
		}}
	}
?>
		<p class="h2">Add New admin</p>
		<form action="" method="post" class="w-50 mx-auto my-3" enctype="multipart/form-data">
			<div class="form-group">
				<label for="name">admin Name:	</label>
				<input type="text" name="name" class="form-control" placeholder="Enter admin name" id="name" />
			</div>
			<div class="form-group">
				<label for="pass">admin password:	</label>
				<input type="password" name="pass" class="form-control" placeholder="Enter admin password" id="pass" />
			</div>
			<div class="form-group">
				<label for="email">admin Email:	</label>
				<input type="email" name="email" class="form-control" placeholder="Enter email address" id="email" />
			</div>
			<div class="form-group">
				 <label for="image">Choose file</label>
			    <input type="file" class="form-control" name="image" id="image" >

		    </div>



				<div class="form-group my-3">
					<input type="submit" value="create" name="new_admin" class="btn btn-success text-white" >
					<a href="manage_admin.php" class="btn btn-primary">Cancel</a>
				</div>



		</form>



</div></div>




<script>
 // $(document).ready(function(){
 //      $('#insert').click(function(){
 //           var image_name = $('#image').val();
 //           if(image_name == '')
 //           {
 //                alert("Please Select Image");
 //                return false;
 //           }
 //           else
 //           {
 //                var extension = $('#image').val().split('.').pop().toLowerCase();
 //                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
 //                {
 //                     alert('Invalid Image File');
 //                     $('#image').val('');
 //                     return false;
 //                }
 //           }
 //      });
 // });
 </script>

<?php
	include '../includes/layout/footer.php';
?>