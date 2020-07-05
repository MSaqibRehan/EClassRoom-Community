<?php 
	use yii\helpers\Url;
	use common\models\AssignmentSubmit;
	use common\models\Student;

?>
<?php 
	if (isset($_GET['id'])) {
 		$assign_id=$_GET['id'];

 		
 	}

?>


<?php 

		$usr_id= \Yii::$app->user->identity->id;
		$student_table=Student::find()->where(['user_id'=>$usr_id])->one();
        $std_id=$student_table->std_id;
		$connection = Yii::$app->db;
		$query=AssignmentSubmit::find()->where(['assign_sub_id'=>$assign_id])->one();
	            if($query)
	            { 
	            	unlink("uploads/".$query->attach_file);
	                $query->delete();
	            }
			  
		if ($query) {
			
			header("Location: ./assignment?assign=" . $query->assign_id."&std=".$std_id);
			exit;
		}else{
			
			die;
		}
?>