
<?php 
$username = 'root';
$password = '';
$host = 'localhost';
$db = 'blog';

$conn = mysqli_connect($host , $username , $password , $db);
if(!$conn){
	die ("CONNECTION TO DB FAILED");
}
?>