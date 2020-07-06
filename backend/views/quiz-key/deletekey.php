<?php 
	use yii\helpers\Url;
	use common\models\QuizKey;
	use common\models\Student;

?>
<?php 
	if (isset($_GET['id'])) {
 		$quiz_key_id=$_GET['id'];

 		
 	}

?>


<?php 

		$query=QuizKey::find()->where(['quiz_key_id'=>$quiz_key_id])->one();
	            if($query)
	            {
	            	unlink("uploads/".$query->quiz_key);
	                $query->delete();
	            }
			  
		if ($query) {
			
			header("Location: ./quiz-detail?id=" . $query->quiz_id);
			exit;
		}else{
			
			die;
		}
?>