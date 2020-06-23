<?php
  include 'includes/config.php';
  include 'includes/sessions.php';
?>
<?php 
   if (!isset($_SESSION['login_user'])) {
     $_SESSION['message'] = "<li class='text-danger font-weight-bold'>Login required!</li>";
     header("location:login.php");
   }
?>

<?php 
  if (isset($_GET['post'])) {
    $post_id = $_GET['post'];
    $safe_post_id = mysqli_real_escape_string($conn , $post_id);
  }
 
?>
<?php 
	if (isset($safe_post_id)) {
		 $record_query = "SELECT * FROM posts WHERE id = {$post_id}";
              $record = mysqli_query($conn , $record_query);
              $record_set = mysqli_fetch_assoc($record);
		$query = "DELETE FROM posts WHERE id = $safe_post_id";

		unlink($record_set['image']);
		if(mysqli_query($conn , $query) && mysqli_query($conn , "DELETE FROM comment WHERE post_id = {$safe_post_id}")){
			$_SESSION['message'] = "Post Deleted";
			header("location:dashboard.php");

		}else {
			$_SESSION['message'] = mysqli_error($conn);
			header("location:dashboard.php");
		}
	}
?>