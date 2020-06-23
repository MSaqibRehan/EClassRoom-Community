<?php
	include '../includes/layout/index_header.php';
	include '../includes/config.php';
	include '../includes/sessions.php';
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



<div class="row" style="min-height: 500px;">

		<div class="col-3 sidebar bg-info py-3">
	<form action="index_search.php" method="GET">
			<div class="input-group mb-3">
			  <input type="text" name="query" class="form-control" placeholder="Search">
			  <div class="input-group-append">
			    <input type="submit" name="submit" class=" btn btn-success" value="search">
			    
			  </div>
			</div>
    </form>
<?php 
	$subject_query = "SELECT * FROM subjects";
	$subject = mysqli_query($conn , $subject_query);

	echo "<ul class='list-unstyled pl-3'>";

	while ($subject_set = mysqli_fetch_assoc($subject)) {
		$subject_id = mysqli_real_escape_string($conn , $subject_set['id']);
			echo '<li>';
		?>
		
		<a class="text-dark <?php if ($subject_set['id'] == $safe_selected_subject) {
						   				echo ('font-weight-bold font-italic');
						   			}  ?>" style="font-size: 18px;" href="?subject=<?php echo urlencode($subject_id); ?>"> <i class="fas fa-list-ul fa-1x pr-2"></i><?php echo htmlentities($subject_set['subject_name']); ?></a>
	    
	    <?php
	    if (isset($safe_selected_page)) {
	    	$record = mysqli_query($conn , "SELECT * FROM pages WHERE id={$safe_selected_page}");
	    	$record_set = mysqli_fetch_assoc($record);
	    }
	    global $record_set;
if ( isset($safe_selected_subject) == $subject_id && $safe_selected_subject == $subject_id || $record_set['subject_id'] == $subject_id) {
			
				$page_query = "SELECT * FROM pages WHERE subject_id = $subject_id ";
					
			$page = mysqli_query($conn , $page_query);
			
			while ($page_set = mysqli_fetch_assoc($page)) {
				$page_id = mysqli_real_escape_string($conn , $page_set['id']);
				echo "<ul class='list-unstyled pl-3'>";
				echo '<li>';
		?>
		
		<a class='text-dark <?php if($safe_selected_page == $page_set["id"]){ echo "font-weight-bold font-italic";} ?>' style="font-size: 18px;" href="?page=<?php echo urlencode($page_id); ?>"><i class="fas fa-angle-double-right fa-xs pr-2"></i> <?php echo htmlentities($page_set['page_name']); ?></a>
	    
	    <?php
	     echo "</li>";  
			  echo '</ul>';
			 
			}
			
}

	}

	echo "</li>";
	echo "</ul>";
	?>



</div>


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
				<a class="text-dark" href="?page=<?php echo urlencode($page_id) ?>"><i class="fas fa-angle-double-right fa-xs pr-2"></i><?php echo $page_set['page_name'] ;?></a>

				<?php
				echo "</li>";

			}
			echo "</ul>"

			?>
				


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
			<p><?php echo htmlentities($page_set['content']); ?></p>
			<br><hr>
			




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