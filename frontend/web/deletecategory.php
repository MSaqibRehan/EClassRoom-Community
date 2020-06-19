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
  if (isset($_GET['category'])) {
    $category_id = $_GET['category'];
    $safe_category_id = mysqli_real_escape_string($conn , $category_id);
  }
 
?>
<?php 
	if (isset($safe_category_id)) {
		$query = "DELETE FROM category WHERE id = $safe_category_id";
		if(mysqli_query($conn , $query)){
			$_SESSION['message'] = "Category Deleted";
			header("location:categories.php");

		}else {
			$_SESSION['message'] = mysqli_error($conn);
			header("location:categories.php");
		}
	}
?>