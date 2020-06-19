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

	<div class="col-12 mx-auto py-5" style="background: url(images/transparent.png);" >
		<?php
				if (isset($_SESSION['message'])) {
					message();
				}
			?>

		<div class="w-50 mx-auto mt-3 ">
			<p class="h1 text-white ">Content Management</p>
			<a href="manage_content.php" class="btn btn-lg btn-primary w-100 hvr-shaddow">Manage Content</a>
			<a href="manage_admin.php" class="btn btn-lg btn-primary w-100 my-3 hvr-shaddow">Manage admins</a>
			<a href="logout.php" class="btn btn-lg btn-danger w-100 hvr-shaddow">LOGOUT</a>
		</div>
	</div>

</div>

<?php
	include '../includes/layout/footer.php';
?>