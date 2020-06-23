<?php
	include 'includes/config.php';
	include 'includes/sessions.php';
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

	}
?>

<?php
	if (isset($safe_selected_admin)) {
			$record_query = "SELECT * FROM admin WHERE id = $selected_admin";
		$record = mysqli_query($conn , $record_query);
		$record_set = mysqli_fetch_assoc($record);

		if ($_SESSION['login_user'] == $record_set['name']) {

			$_SESSION['message'] = "you cannot delete the logged in account";
			header("location:manageadmins.php");

		}else{
		$query = "DELETE FROM admin WHERE id = $safe_selected_admin";
		if (!mysqli_query($conn , $query)) {
			echo 'query failed';
		}else {
			$_SESSION['message'] = 'Admin Deleted';
			header("location:manageadmins.php");
		}}
	}
?>