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
<div class="row" style="min-height: 500px">

		<?php include '../includes/sidebar.php'; ?>

	<div class="col-9 bg-light" >


<?php
	if (isset($_POST['new_subject'])) {
		$name = mysqli_real_escape_string($conn , $_POST['name']);
		$position = mysqli_real_escape_string($conn , $_POST['position']);
		$visible = mysqli_real_escape_string($conn , $_POST['visibility']);

		if (empty($name) || empty($position) || empty($visible) || $position == (-1) || $visible == (-1) || !preg_match("/^[a-zA-Z 0-9]+$/" , $name)) {
			echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'  >
								  <strong>WARNIING!</strong><br>";
			echo "Complete the followings:";
			echo " <ul>";
			if (empty($name)) {
				echo "<li>Enter subject Name</li>" ;
			}
			elseif (!preg_match("/^[a-z A-Z0-9]+$/" , $name)) {
				echo "<li>No Special Characters are Allowed for name </li>";
			}
			if (empty($position) || $position == (-1)){
				echo "<li>Selecct a position</li>";
			}
			if ($visible == -1 ) {
					echo "<li>select visibility</li>";
			}






			echo"</ul>";


echo "	  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								    <span aria-hidden='true'>&times;</span>
								  </button>
								</div>";

		}elseif (isset($name) && isset($position) && isset($visible)) {

		$query = "INSERT INTO subjects (subject_name , position , visible) VALUES ('{$name}' , {$position} , {$visible})";
		if (!mysqli_query($conn , $query)) {
			echo "error:" . $query . "<br>". mysqli_error($conn);
		}else {
			$last_id = mysqli_insert_id($conn);
			$_SESSION['message'] = ' subject created success';
			header("location:manage_content.php?subject". urlencode($last_id));
		}
	}}
?>

		<p class="h2">Add New Subject</p>
		<form action="" method="post" class="w-50 mx-auto my-3">
			<div class="form-group">
				<label for="name">Subject Name:	</label>
				<input type="text" name="name" class="form-control" placeholder="Enter Subject name" id="name" />
			</div>
			<div class="form-group">
				<?php
					$subject_query = "SELECT position FROM subjects ORDER BY position ASC" ;
					$subject = mysqli_query($conn , $subject_query);
					$count = mysqli_num_rows($subject);
				?>
				<label for="name">Subject Position:	</label>
				<select name="position" class="custom-select">
					<option value="-1" selected>---Select Position---</option>
					<?php
						for($i=1 ; $i<=$count+1; $i++){
							echo "<option value='$i'>$i</option>";
						}
					?>

				</select>
			</div>
			<input type="hidden" name="visibility" value="-1">
				<div class="custom-control custom-radio custom-control-inline">
      <input type="radio" class="custom-control-input" value="1" id="visible" name="visibility">
      <label class="custom-control-label" for="visible">Visible</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" class="custom-control-input" value="0" id="hidden" name="visibility">
      <label class="custom-control-label" for="hidden">Hidden</label>
    </div>

				<div class="form-group my-3">
					<input type="submit" name="new_subject" class="btn btn-success text-white" >
					<a href="manage_content.php" class="btn btn-primary">Cancel</a>
				</div>



		</form>



</div></div>




<?php
	include '../includes/layout/footer.php';
?>