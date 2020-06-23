<?php

	include '../includes/config.php';
	include '../includes/sessions.php';
?>
<?php
	if(!isset($_SESSION["login_user"])){
		header("Location:login.php");
	}
 ?>
<?php
	if (isset($_GET['subject'])) {
		$selected_subject = $_GET['subject'];
		$selected_page = null;
		$safe_selected_subject = mysqli_real_escape_string($conn , $selected_subject);
	}elseif (isset($_GET['page'])) {
		$selected_page = $_GET['page'];
		$selected_subject = null;
		$safe_selected_page = mysqli_real_escape_string($conn , $selected_page);
	}else{
		$selected_subject = null;
		$selected_page = null;
	}
?>

<?php
include '../includes/layout/header.php';
?>
<?php
	if (isset($safe_selected_subject)) {

?>
<div class="row" style="min-height: 400px;">

<div class="col-3 sidebar bg-info py-3">
<?php
	$subject_query = "SELECT * FROM subjects";
	$subject = mysqli_query($conn , $subject_query);

	echo "<ul >";

	while ($subject_set = mysqli_fetch_assoc($subject)) {
		$subject_id = mysqli_real_escape_string($conn , $subject_set['id']);
			echo '<li>';
		?>

		<a class='text-dark' style="font-size: 18px;" href="../public/manage_content.php?subject=<?php echo urlencode($subject_id); ?>"> <?php echo htmlentities($subject_set['subject_name']); ?></a>

	    <?php
			$page_query = "SELECT * FROM pages WHERE subject_id = $subject_id ";
			$page = mysqli_query($conn , $page_query);

			while ($page_set = mysqli_fetch_assoc($page)) {
				$page_id = mysqli_real_escape_string($conn , $page_set['id']);
				echo "<ul>";
				echo '<li>';
		?>

		<a class='text-dark' style="font-size: 18px;" href="../public/manage_content.php?page=<?php echo urlencode($page_id); ?>"> <?php echo htmlentities($page_set['page_name']); ?></a>

	    <?php
	     echo "</li>";
			  echo '</ul>';

			}


	}echo "</li>";
	echo "</ul>";
	?>
		<a href="new_subject.php" class="btn btn-primary mt-4">+ Create subject</a>

	<?php
?>

</div>

<div class="col-9 content bg-light">


<?php
		$page_query = "SELECT * FROM pages WHERE subject_id = $safe_selected_subject";
		$pages = mysqli_query($conn , $page_query);
		$count =mysqli_num_rows($pages);
		if ($count != 0) {
			echo 'you cannot delete subject';
			echo "<p class='h3'> Pages in this subject:-</p>";
			echo "<ul>";
			while ($page_set = mysqli_fetch_assoc($pages)) {
				$page_id = mysqli_real_escape_string($conn , $page_set['id']);
				echo "<li> ";

				?>
				<a href="manage_content.php?page=<?php echo urlencode($page_id) ?>"><?php echo $page_set['page_name'] ;?></a>

				<?php
				echo "</li>";

			}
			echo "</ul>"
		}else{
			$query = "DELETE FROM subjects WHERE id = $safe_selected_subject ";
			if (!mysqli_query($conn , $query)) {
				echo 'query failed';
			}else{
				$_SESSION['message'] = 'subject delete success';
				header("location:manage_content.php");

			}
		}
		?>
	</div></div>

	<?php
		include '../includes/layout/footer.php';
	?>

	<?php

	}elseif (isset($safe_selected_page)) {
		$query_get = "SELECT * FROM pages WHERE id = $safe_selected_page";
		$page = mysqli_query($conn , $query_get);
		$page_set = mysqli_fetch_assoc($page);

		$query = "DELETE FROM pages WHERE id = $safe_selected_page";
		if (!mysqli_query($conn , $query)) {
				echo 'query failed';
		}else {
			$_SESSION['message'] = 'page delete success';
				header("location:manage_content.php?subject=". urlencode($page_set['subject_id']));
		}
	}
?>