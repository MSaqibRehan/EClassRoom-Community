
<?php 
$username = 'root';
$password = '';
$host = 'localhost';
$db = 'eclass';

$conn = mysqli_connect($host , $username , $password , $db);
if(!$conn){
	die ("CONNECTION TO DB FAILED");
}
?>