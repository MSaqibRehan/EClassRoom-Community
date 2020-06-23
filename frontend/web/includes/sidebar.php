<?php 
	
	include 'config.php';
	
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
<div class="col-3 sidebar bg-info py-3">
	<form action="content_search.php" method="GET">
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
						   			}  ?>" style="font-size: 18px;" href="../public/manage_content.php?subject=<?php echo urlencode($subject_id); ?>"> <i class="fas fa-list-ul fa-1x pr-2"></i><?php echo htmlentities($subject_set['subject_name']); ?></a>
	    
	    <?php
			$page_query = "SELECT * FROM pages WHERE subject_id = $subject_id ";
			$page = mysqli_query($conn , $page_query);
			
			while ($page_set = mysqli_fetch_assoc($page)) {
				$page_id = mysqli_real_escape_string($conn , $page_set['id']);
				echo "<ul class='list-unstyled pl-3'>";
				echo '<li>';
		?>
		
		<a class='text-dark' style="font-size: 18px;" href="../public/manage_content.php?page=<?php echo urlencode($page_id); ?>"><i class="fas fa-angle-double-right fa-xs pr-2"></i> <?php echo htmlentities($page_set['page_name']); ?></a>
	    
	    <?php
	     echo "</li>";  
			  echo '</ul>';
			 
			}
			

	}echo "</li>";
	echo "</ul>";
	?>
		<a href="new_subject.php" class="btn btn-primary mt-4">+ Create subject</a>


</div>