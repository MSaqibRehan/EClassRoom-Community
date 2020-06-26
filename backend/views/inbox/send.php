<?php 
	use yii\db\query;
?>
<?php 

$connection = Yii::$app->db;
	$user=$_POST['user'];
	$semester=$_POST['semester'];
	$session=$_POST['session'];
	$course=$_POST['course'];
	$message=$_POST['message'];
		date_default_timezone_set("Asia/Karachi");
		$date =  date("Y-m-d H:i:s");
		$query=$connection->createCommand()->insert('inbox', [
				    'course_p_id' => $course,
				    'session_id' => $session,
				    'semester_id' => $semester,
				    'sender_name' => $user,
				    'message' => $message,
				    'created_at' => $date,
				])->execute();
			if($query){
				echo 'Message Sent';
			}else{
				echo 'Something Went Wrong';
			}

?>