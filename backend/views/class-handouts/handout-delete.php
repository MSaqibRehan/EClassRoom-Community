
<?php 
	if (isset($_GET['handout_id']) && isset($_GET['teacher_id'])) {
	$handout_id = $_GET['handout_id'];
	$teacher_id = $_GET['teacher_id'];

	$handoutData = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE handout_id = '$handout_id'")->queryAll();
	$subject_id = $handoutData[0]['sem_sub_id'];

 // starting of transaction handling
    $transaction = \Yii::$app->db->beginTransaction();
    try {
    	\Yii::$app->db->createCommand()->delete('class_handouts', ['handout_id' => $handout_id])->execute();
      // $deleteHandout = Yii::$app->db->createCommand("DELETE FROM class_handouts WHERE handout_id = '$handout_id'")->queryAll();
        // transaction commit
        $transaction->commit();
        \Yii::$app->getSession()->setFlash('success', '<strong>Success!</strong> Class Handout has been Deleted.');
        \Yii::$app->response->redirect(['./handouts-detail-view','subject_id' => $subject_id,'teacher_id' => $teacher_id]);
    } // closing of try block 
    catch (Exception $e) {
    	echo $e;
      // transaction rollback
            $transaction->rollback();
    } // closing of catch block
    // closing of transaction handling
}
?>