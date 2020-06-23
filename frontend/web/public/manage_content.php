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



<div class="row" style="min-height: 500px;">

		<?php include '../includes/sidebar.php'; ?>


	<div class="col-9 content bg-light">
			<?php
				if (isset($_SESSION['message'])) {
					message();
				}
			?>

		<?php if (isset($safe_selected_subject)) {
			$query = "SELECT * FROM subjects WHERE id = $safe_selected_subject";
			$subjects = mysqli_query($conn , $query);
			$subject_set = mysqli_fetch_assoc($subjects);
				?>
			<p class="h3">Subject Name: <?php echo htmlentities($subject_set['subject_name']); ?></p>
			<p class="h5">position: <?php echo htmlentities($subject_set['position']); ?></p>
			<p class="h5">visibility: <?php echo htmlentities($subject_set['visible']); ?></p>
			<a class="btn btn-warning" href="edit_subject.php?subject=<?php echo urlencode($safe_selected_subject) ?>">Edit Subject</a>
			<a class="btn btn-danger" onclick="return confirm('ARE YOU SURE?');"  href="delete.php?subject=<?php echo urlencode($safe_selected_subject) ?>">Delete Subject</a>
			<br><hr>


			<p class="h3">Pages in Subject:-</p>
			<?php
				$page_query = "SELECT * FROM pages WHERE subject_id = $safe_selected_subject";
		$pages = mysqli_query($conn , $page_query);
			if (!$pages) {
				echo "error";

			}
			echo "<ul class='list-unstyled pl-3'>";
			while ($page_set = mysqli_fetch_assoc($pages)) {
				$page_id = mysqli_real_escape_string($conn , $page_set['id']);
				echo "<li> ";

				?>
				<a class="text-dark" href="manage_content.php?page=<?php echo urlencode($page_id) ?>"><i class="fas fa-angle-double-right fa-xs pr-2"></i><?php echo $page_set['page_name'] ;?></a>

				<?php
				echo "</li>";

			}
			echo "</ul>"

			?>
				<a class="btn btn-primary hvr-shrink" href="new_page.php?subject=<?php echo urlencode($safe_selected_subject) ?>"> + Add New page</a>



				<?php

		}elseif (isset($safe_selected_page)) {
			$query = "SELECT * FROM pages WHERE id = {$safe_selected_page}";
			$pages = mysqli_query($conn , $query);
			if (!$pages) {
				echo "error".mysqli_error($conn);

			}
			$page_set = mysqli_fetch_assoc($pages);
				?>
			<p class="h3">Page Name: <?php echo htmlentities($page_set['page_name']); ?></p>
			<p class="h5">position: <?php echo htmlentities($page_set['position']); ?></p>
			<p class="h5">visibility: <?php echo htmlentities($page_set['visible']); ?></p>
			<hr>
			<p class="h5">content: </p>
			<p><?php echo $page_set['content']; ?></p>
			<br><hr>
			<a class="btn btn-warning" href="edit_page.php?page=<?php echo urlencode($safe_selected_page) ?>">Edit page</a>
			<a class="btn btn-danger" onclick="return confirm('ARE YOU SURE?');" href="delete.php?page=<?php echo urlencode($safe_selected_page) ?>">Delete page</a>




			<?php

		}else {
			?>
			<div class="row">
				<div class="col-sm-7">
			
			<?php
			echo "<p class='h2 mx-auto'>select a page or subject</p>";
		?></div>
		<div class="col-sm-5 pt-3">
			
    </div>
    </div>
    <?php
		} ?>
	</div>


</div>




<?php
	include '../includes/layout/footer.php';
?>