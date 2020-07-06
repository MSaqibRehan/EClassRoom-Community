<?php 
$user_id = Yii::$app->user->identity->id;
$userData = Yii::$app->db->createCommand("SELECT user_type FROM user WHERE id = '$user_id'")->queryAll();
$userType = $userData[0]['user_type'];

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Class Handouts</title>
</head>
<body>
	<?php $this->title = 'Class Handouts';
		  $this->params['breadcrumbs'][] = $this->title; 
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-body" style="padding:20px;">
						<div class="row" style="padding:10px;margin-bottom:10px;">
			              <div class="col-md-12">
			                  <h2 style="font-family:serif; color:#607D8B; margin:0px; padding:0px; font-size:30px;"><i class="glyphicon glyphicon-book"></i>  Subjects</h2>
			              </div>
			          </div>
						<?php if ($userType == 'teacher' || $userType == 'Teacher') {
							$teacherData = Yii::$app->db->createCommand("SELECT * FROM teacher WHERE user_id = '$user_id'")->queryAll();
							$teacher_id = $teacherData[0]['teacher_id'];
							$teacher_name = $teacherData[0]['teacher_name'];

							$teacherEnroll = Yii::$app->db->createCommand("SELECT * FROM teacher_class_enrollment WHERE teacher_id = '$teacher_id'")->queryAll();
							$countTeacherEnroll = count($teacherEnroll);
							for ($i = 0; $i < $countTeacherEnroll; $i++) {
								$sem_sub_id = $teacherEnroll[$i]['sem_sub_id'];

								$semesterSubjects = Yii::$app->db->createCommand("SELECT * FROM semester_subjects WHERE sem_subj_id = '$sem_sub_id'")->queryAll();
								$subject_id = $semesterSubjects[0]['sem_subj_id'];
								$subject_title = $semesterSubjects[0]['subject_title'];
							
							
						 ?>
						<div class="col-md-4">
			             <a href="./handouts-detail-view?subject_id=<?=$subject_id;?>&teacher_id=<?=$teacher_id;?>">
			               <div class="panel panel-default" style="box-shadow:0px 0px 15px 0px #00A3CB;">
			                 <div class="panel-body" style="text-align: center;padding:30px;">
			                   <h3><i class="fa fa-book"></i> <?=$subject_title; ?></h3><br>
			                   <b style="background-color:grey;color:white;padding:10px;border-radius: 20px;font-family:arial;">Teacher: <i><?=$teacher_name; ?></i></b>
			                 </div>
			               </div>
			             </a>
			           </div>
			           <?php   }
			       			  } ?>

			       			  <?php if ($userType == 'student' || $userType == 'Student') {
							$stdData = Yii::$app->db->createCommand("SELECT * FROM student WHERE user_id = '$user_id'")->queryAll();
							$std_id = $stdData[0]['std_id'];

							$stdEnroll = Yii::$app->db->createCommand("SELECT * FROM std_enrollment WHERE std_id = '$std_id'")->queryAll();
							$semester_id = $stdEnroll[0]['semester_id'];

							$semesterSubjects = Yii::$app->db->createCommand("SELECT * FROM semester_subjects WHERE semester_id = '$semester_id'")->queryAll();
							$countsemesterSubjects = count($semesterSubjects);

							for ($i = 0; $i < $countsemesterSubjects; $i++) {								
								$subject_id = $semesterSubjects[$i]['sem_subj_id'];
								$subject_title = $semesterSubjects[$i]['subject_title'];

								$teacherEnroll = Yii::$app->db->createCommand("SELECT teacher_id FROM teacher_class_enrollment WHERE sem_sub_id = '$subject_id'")->queryAll();
								$teacher_id = $teacherEnroll[0]['teacher_id'];

								$teacherData = Yii::$app->db->createCommand("SELECT teacher_name FROM teacher WHERE teacher_id = '$teacher_id'")->queryAll();
								$teacher_name = $teacherData[0]['teacher_name'];
							
						 ?>
						<div class="col-md-4">
			             <a href="./handouts-std-view?subject_id=<?=$subject_id;?>">
			               <div class="panel panel-default" style="box-shadow:0px 0px 15px 0px #00A3CB;">
			                 <div class="panel-body" style="text-align: center;padding:30px;">
			                   <h3><i class="fa fa-book"></i> <?=$subject_title; ?></h3><br>
			                   <b style="background-color:grey;color:white;padding:10px;border-radius: 20px;font-family:arial;">Teacher: <i><?=$teacher_name; ?></i></b>
			                 </div>
			               </div>
			             </a>
			           </div>
			           <?php   }
			       			  } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>