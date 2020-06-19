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


	if (isset($_POST['edit_page'])) {
		$name = mysqli_real_escape_string($conn , $_POST['name']);
		$position = mysqli_real_escape_string($conn , $_POST['position']);
		$visible = mysqli_real_escape_string($conn , $_POST['visibility']);
		$content = mysqli_real_escape_string($conn , $_POST['content']);
if (empty($name)  || $position == (-1) || $visible == (-1) || !preg_match("/^[a-zA-Z 0-9]+$/" , $name)) {
			echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'  >
								  <strong>WARNIING!</strong><br>";
			echo "Complete the followings:";
			echo " <ul>";
			if (empty($page_name)) {
				echo "<li>Enter Page Name</li>" ;
			}
			elseif (!preg_match("/^[a-zA-Z 0-9]+$/" , $page_name)) {
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

		}elseif (isset($name) && isset($position) && isset($visible) && isset($content)) {
		$query = "UPDATE pages SET page_name = '{$name}' , position = {$position} , visible = {$visible} , content = '{$content}' WHERE id = $safe_selected_page";
		if (!mysqli_query($conn , $query)) {
			echo "error:" . $query . "<br>". mysqli_error($conn);
		}else {
			$_SESSION['message'] = ' update success';
			header("location:manage_content.php?page=". urlencode($safe_selected_page));
		}
	}}
?>


		<p class="h2">Add New Subject</p>
		<form action="" method="post" class="w-50 mx-auto my-3">
			<?php
					$page_query = "SELECT * FROM pages WHERE id = {$safe_selected_page} LIMIT 1" ;
					$pages = mysqli_query($conn , $page_query);
					$page_set = mysqli_fetch_assoc($pages);
				?>
			<div class="form-group">
				<label for="name">Subject Name:	</label>
				<input type="text" name="name" value="<?php echo $page_set['page_name']; ?>" class="form-control"  id="name" />
			</div>
			<div class="form-group">
								<label for="name">Subject Position:	</label>
				<select name="position" class="custom-select">

					<?php
					$page_query = "SELECT position FROM pages WHERE subject_id = {$page_set['subject_id']} ORDER BY position ASC" ;
					$pages = mysqli_query($conn , $page_query);

					if (!$pages) {
						echo mysqli_error($conn);

					}
					$count = mysqli_num_rows($pages);
						for($i=1 ; $i<=$count; $i++){
							echo "<option value='$i'";
							if ($page_set['position'] == $i) {
								echo 'selected';
							}
							echo ">$i</option>";
						}
					?>

				</select>
			</div>
			<div class="form-group">
				<label for="content">Content</label>
				<textarea rows="5" name="content" class="form-control"> <?php echo $page_set['content']; ?></textarea>

			</div>
			<input type="hidden" name="visibility" value="-1">
				<div class="custom-control custom-radio custom-control-inline">
      <input type="radio" class="custom-control-input" value="1" id="visible"  name="visibility" <?php if ($page_set['visible'] == 1) {echo 'checked';
      } ?> />
      <label class="custom-control-label" for="visible">Visible</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" class="custom-control-input" value="0" id="hidden" name="visibility" <?php if ($page_set['visible'] == 0) {echo 'checked';
      } ?> />
      <label class="custom-control-label" for="hidden">Hidden</label>
    </div>

				<div class="form-group my-3">
					<input type="submit" name="edit_page" class="btn btn-success text-white" >
					<a href="manage_content.php?page=<?php echo urlencode($safe_selected_page) ?>" class="btn btn-primary">Cancel</a>
				</div>



		</form>



</div></div>





<?php
	include '../includes/layout/footer.php';
?>