  <?php 

	$course_p_id		= $_POST['course_p_id'];
	$session_id			= $_POST['session_id'];
	$semester_id		= $_POST['semester_id'];
	$sem_sub_id			= $_POST['sem_sub_id'];
	$week 				  = $_POST['week'];
	$lecture			  = $_POST['lecture'];
	$topic 				  = $_POST['topic'];
	$description 		= $_POST['description'];
	$created_by 		= Yii::$app->user->identity->id;
	
	date_default_timezone_set("Asia/Karachi");
	$created_at =  date("Y-m-d H:i:s");

      $file_name = $_FILES['file']['name'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
       move_uploaded_file($file_tmp,"uploads/".$file_name);

	 // starting of transaction handling
    $transaction = \Yii::$app->db->beginTransaction();
    try {
      $insertHandout = Yii::$app->db->createCommand()->insert('class_handouts',[
              'course_p_id'       => $course_p_id,
              'session_id'        => $session_id,
              'semester_id'       => $semester_id,
              'sem_sub_id'        => $sem_sub_id,
              'week'              => $week,
              'lecture'           => $lecture,
              'file'              => $file_name,
              'topic'             => $topic,
              'description'       => $description,
              'created_by'        => $created_by,
              'created_at'        => $created_at,
      ])->execute();
        // transaction commit
        $transaction->commit();
        echo json_encode(array("statusCode"=>200));
    } // closing of try block 
    catch (Exception $e) {
      // transaction rollback
      		echo json_encode(array("statusCode"=>201));
            $transaction->rollback();
    } // closing of catch block
    // closing of transaction handling
 ?>

 <?php
$url = \yii\helpers\Url::to("vendor/insert-handouts");
$script = <<< JS

$(document).ready(function() {
  $('#modal_submit').on('click', function() {
    var course_p_id   = $('#course_p_id').val();
    var session_id    = $('#session_id').val();
    var semester_id   = $('#semester_id').val();
    var sem_sub_id    = $('#sem_sub_id').val();
    var week      = $('#week').val();
    var lecture     = $('#lecture').val();
    var topic       = $('#topic').val();
    var file      = $('#file').val();
    var description   = $('#description').val();
    if(week != "" && lecture != "" && topic != ""){
      $.ajax({
        url: "$url",
        type: "POST",
        data: {
          course_p_id: course_p_id,
          session_id: session_id,
          semester_id: semester_id,
          sem_sub_id: sem_sub_id,
          week: week,
          lecture: lecture,
          topic: topic,
          file: file,
          description: description        
        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            $("#success").show();
            $('#success').html('Data added successfully !');            
          }
          else if(dataResult.statusCode==201){
             alert("Error occured !");
          }
          
        }
      });
    }
    else{
      alert('Please fill all the field !');
    }
  });
});

JS;
$this->registerJs($script);
?>
$file_name = UploadedFile::getInstance($_FILES,'file');
       saveAs('uploads/'.$file_name);