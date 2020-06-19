<?php include '../includes/sessions.php'; ?>
<?php
session_destroy();
header("location:login.php")
?>