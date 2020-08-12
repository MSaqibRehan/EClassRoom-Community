
<?php 
	if (isset($_GET['handout_id']) && isset($_GET['teacher_id'])) {
	$handout_id = $_GET['handout_id'];
	$teacher_id = $_GET['teacher_id'];

	$handoutData = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE handout_id = '$handout_id'")->queryAll();
	$subject_id = $handoutData[0]['sem_sub_id'];
	$week = $handoutData[0]['week'];
	$lecture = $handoutData[0]['lecture'];
	$topic = $handoutData[0]['topic'];
	$file = $handoutData[0]['file'];
	$description = $handoutData[0]['description'];


?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Update Handout</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php $this->title = 'Update Handout';
		  				  $this->params['breadcrumbs'][] = $this->title; ?>            

    
              	<!-- Form -->
                <form action="" method="POST"  enctype="multipart/form-data" accept-charset="utf-8">

					<div class="form-group">
					  <label for="week">Select Week:</label>
					  <select class="form-control" id="week" name="week" value="<?=$week;?>" required>
					    <option>Select Week No...</option>
					    <option value="1" <?php if ($week==1) {echo 'selected';} ?>>1</option>
					    <option value="2"<?php if ($week==2) {echo 'selected';} ?>>2</option>
					    <option value="3"<?php if ($week==3) {echo 'selected';} ?>>3</option>
					    <option value="4"<?php if ($week==4) {echo 'selected';} ?>>4</option>
					    <option value="5"<?php if ($week==5) {echo 'selected';} ?>>5</option>
					    <option value="6"<?php if ($week==6) {echo 'selected';} ?>>6</option>
					    <option value="7"<?php if ($week==7) {echo 'selected';} ?>>7</option>
					    <option value="8"<?php if ($week==8) {echo 'selected';} ?>>8</option>
					    <option value="9"<?php if ($week==9) {echo 'selected';} ?>>9</option>
					    <option value="10"<?php if ($week==10) {echo 'selected';} ?>>10</option>
					    <option value="11"<?php if ($week==11) {echo 'selected';} ?>>11</option>
					    <option value="12"<?php if ($week==12) {echo 'selected';} ?>>12</option>
					    <option value="13"<?php if ($week==13) {echo 'selected';} ?>>13</option>
					    <option value="14"<?php if ($week==14) {echo 'selected';} ?>>14</option>
					    <option value="15"<?php if ($week==15) {echo 'selected';} ?>>15</option>
					    <option value="16"<?php if ($week==16) {echo 'selected';} ?>>16</option>
					  </select>
					</div>

					<div class="form-group">
					  <label for="lecture">Select Lecture No#:</label>
					  <select class="form-control" id="lecture" name="lecture" required>
					    <option>Select Lecture No...</option>
					    <option value="1" <?php if ($lecture==1) {echo 'selected';} ?>>1</option>
					    <option value="2" <?php if ($lecture==2) {echo 'selected';} ?>>2</option>
					    <option value="3" <?php if ($lecture==3) {echo 'selected';} ?>>3</option>
					  </select>
					</div>

					<div class="form-group">
						<label>Topic:</label>
						<input type="text" name="topic" id="topic" value="<?=$topic;?>" required class="form-control" placeholder="Enter topic here...">
					</div>
					

					<div class="form-group">
						<label>Previous File:</label>&ensp;
						<a href="download-file?file=<?php echo urlencode($file);?>" target="_blank" title="Handout" style="font-size: 18px;font-weight: bold;"> <?php echo $file;?> </a>
					</div>

					<div class="form-group">
						<label>Upload New File:</label>
						<input type="file" name="new_file" id="new_file" class="form-control">
					</div>

					<div class="form-group">
					  <label for="comment">Description:</label>
					  <textarea class="form-control" rows="5" value="<?=$description;?>" name="description" id="description"><?=$description;?></textarea>
					</div>   

					<input type="hidden" name="handout_id" id="handout_id" value="<?=$handout_id; ?>">
					<input type="hidden" name="teacher_id" id="teacher_id" value="<?=$teacher_id; ?>">
					<input type="hidden" name="sem_sub_id" id="sem_sub_id" value="<?=$subject_id; ?>">		

	                <a href="./handouts-detail-view?subject_id=<?=$subject_id;?>&teacher_id=<?=$teacher_id;?>" class="btn btn-danger pull-left">Back</a>&ensp;
	                <button type="submit" name="update_handout" class="btn btn-success" id="update_handout">Save Handout</button>
              
              </form>
				</div>				
			</div>		
		</div>
	</body>
	</html>
<?php	
	}
 ?>

<?php 

	if (isset($_POST['update_handout'])) {	

	$handout_id			= $_POST['handout_id'];
	$teacher_id			= $_POST['teacher_id'];
	$sem_sub_id			= $_POST['sem_sub_id'];
	$week 				= $_POST['week'];
	$lecture			= $_POST['lecture'];
	$topic 				= $_POST['topic'];
	$description 		= $_POST['description'];
	$created_by 		= Yii::$app->user->identity->id;
	
	date_default_timezone_set("Asia/Karachi");
	$created_at =  date("Y-m-d H:i:s");

	$file_name = $_FILES['new_file']['name'];

	if (!empty($file_name)) {

	  $file_name = $_FILES['new_file']['name'];
      $tmp_name = $_FILES['new_file']['tmp_name'];
      $ext = pathinfo($file_name, PATHINFO_EXTENSION);
      $filefullname = $topic . ' week ' . $week . ' lecture ' . $lecture;
      $name=str_replace(" ", "_", $filefullname);
      $path = "uploads/".$name.' . '.$ext;
      $fullpath=str_replace(" ", "", $path);

      move_uploaded_file($tmp_name, $fullpath);

      $dbpath = $name.' . '.$ext;
      $DBpath=str_replace(" ", "", $dbpath);

	 // starting of transaction handling
    $transaction = \Yii::$app->db->beginTransaction();
    try {
      $insertHandout = Yii::$app->db->createCommand()->update('class_handouts',[          
              'week'              => $week,
              'lecture'           => $lecture,
              'file'              => $DBpath,
              'topic'             => $topic,
              'description'       => $description,
              'created_by'        => $created_by,
              'created_at'        => $created_at,
      ],
  		['handout_id' => $handout_id])->execute();
        // transaction commit
        $transaction->commit();
        \Yii::$app->getSession()->setFlash('success', '<strong>Success!</strong> Class Handout has been Updated.');
        \Yii::$app->response->redirect(['./handouts-detail-view','subject_id' => $sem_sub_id,'teacher_id' => $teacher_id]);
    } // closing of try block 
    catch (Exception $e) {
    	echo $e;
      // transaction rollback
            $transaction->rollback();
    } // closing of catch block
    // closing of transaction handling
 }else {
 	
	 // starting of transaction handling
    $transaction = \Yii::$app->db->beginTransaction();
    try {
      $insertHandout = Yii::$app->db->createCommand()->update('class_handouts',[          
              'week'              => $week,
              'lecture'           => $lecture,
              'topic'             => $topic,
              'description'       => $description,
              'created_by'        => $created_by,
              'created_at'        => $created_at,
      ],
  		['handout_id' => $handout_id])->execute();
        // transaction commit
        $transaction->commit();
        \Yii::$app->getSession()->setFlash('success', '<strong>Success!</strong> Class Handout has been Updated.');
        \Yii::$app->response->redirect(['./handouts-detail-view','subject_id' => $sem_sub_id,'teacher_id' => $teacher_id]);
    } // closing of try block 
    catch (Exception $e) {
    	echo $e;
      // transaction rollback
            $transaction->rollback();
    } // closing of catch block
    // closing of transaction handling
  }
}

 ?>