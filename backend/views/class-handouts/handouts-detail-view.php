<?php 
if(isset($_GET['subject_id']) && isset($_GET['teacher_id'])){
	$subject_id = $_GET['subject_id'];
	$teacher_id = $_GET['teacher_id'];
// $semesterSubjects = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id'")->queryAll();
// $countSubjects = count($semesterSubjects);
// $subjectID = $semesterSubjects[0]['sem_subj_id'];
	
	$teacherEnroll = Yii::$app->db->createCommand("SELECT * FROM teacher_class_enrollment WHERE teacher_id = '$teacher_id' AND  sem_sub_id = '$subject_id'")->queryAll();
	$semester_id = $teacherEnroll[0]['semester_id'];
	$session_id = $teacherEnroll[0]['session_id'];

	$semesterData = Yii::$app->db->createCommand("SELECT * FROM semester WHERE semester_id = '$semester_id'")->queryAll();
	$course_p_id = $semesterData[0]['course_p_id'];
 ?>
<?php 

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Class Handouts</title>
</head>
<body>
	<?php $this->title = 'Class Handouts';
		  $this->params['breadcrumbs'][] = $this->title; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
				</div>
				<div class="callout callout-info">
		        <label style="font-size: 20px; padding-right: 20px;"><b>Add New Handout:</b></label>
		        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-default"><b><i class="fa fa-plus" aria-hidden="true"></i> Add Handout
              </b></button>
		        </div>
			</div>			
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-body" style="padding:20px;">
						<?php
							$week1Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '1'")->queryAll();
							$countweek1Data = count($week1Data);
							if (!empty($countweek1Data)) {					
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 1</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek1Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week1Data[$i]['lecture'];?></td>
					              			<td><?=$week1Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week1Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week1Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week1Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week1Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week1Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->
					    
					<?php }
					$week2Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '2'")->queryAll();
								$countweek2Data = count($week2Data);
								if (!empty($countweek2Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 2</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek2Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week2Data[$i]['lecture'];?></td>
					              			<td><?=$week2Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week2Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week2Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week2Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week2Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week2Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

					    <?php }
					$week3Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '3'")->queryAll();
								$countweek3Data = count($week3Data);
								if (!empty($countweek3Data)) {

						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 3</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek3Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week3Data[$i]['lecture'];?></td>
					              			<td><?=$week3Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week3Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week3Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week3Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week3Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week3Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

					    <?php }
					$week4Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '4'")->queryAll();
								$countweek4Data = count($week4Data);
								if (!empty($countweek4Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 4</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek4Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week4Data[$i]['lecture'];?></td>
					              			<td><?=$week4Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week4Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week4Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week4Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week4Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week4Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

				<?php }
					$week5Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '5'")->queryAll();
								$countweek5Data = count($week5Data);
								if (!empty($countweek5Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 5</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek5Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week5Data[$i]['lecture'];?></td>
					              			<td><?=$week5Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week5Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week5Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week5Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week5Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week5Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

					    <?php }
					$week6Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '6'")->queryAll();
								$countweek6Data = count($week6Data);
								if (!empty($countweek6Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 6</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek6Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week6Data[$i]['lecture'];?></td>
					              			<td><?=$week6Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week6Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week6Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week6Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week6Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week6Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

					    <?php }
					$week7Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '7'")->queryAll();
								$countweek7Data = count($week7Data);
								if (!empty($countweek7Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 7</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek7Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week7Data[$i]['lecture'];?></td>
					              			<td><?=$week7Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week7Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week7Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week7Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week7Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week7Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

					    <?php }
					$week8Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '8'")->queryAll();
								$countweek8Data = count($week8Data);
								if (!empty($countweek8Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 8</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					           <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek8Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week8Data[$i]['lecture'];?></td>
					              			<td><?=$week8Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week8Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week8Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week8Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week8Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week8Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

					    <?php }
					$week9Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '9'")->queryAll();
								$countweek9Data = count($week9Data);
								if (!empty($countweek9Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 9</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek9Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week9Data[$i]['lecture'];?></td>
					              			<td><?=$week9Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week9Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week9Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week9Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week9Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week9Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

					    <?php }
					$week10Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '10'")->queryAll();
								$countweek10Data = count($week10Data);
								if (!empty($countweek10Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 10</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek10Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week10Data[$i]['lecture'];?></td>
					              			<td><?=$week10Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week10Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week10Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week10Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week10Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week10Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

					    <?php }
					$week11Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '11'")->queryAll();
								$countweek11Data = count($week11Data);
								if (!empty($countweek11Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 11</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek11Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week11Data[$i]['lecture'];?></td>
					              			<td><?=$week11Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week11Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week11Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week11Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week11Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week11Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

					    <?php }
					$week12Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '12'")->queryAll();
								$countweek12Data = count($week12Data);
								if (!empty($countweek12Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 12</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					           <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek12Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week12Data[$i]['lecture'];?></td>
					              			<td><?=$week12Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week12Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week12Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week12Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week12Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week12Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

					    <?php }
					$week13Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '13'")->queryAll();
								$countweek13Data = count($week13Data);
								if (!empty($countweek13Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 13</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek13Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week13Data[$i]['lecture'];?></td>
					              			<td><?=$week13Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week13Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week13Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week13Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week13Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week13Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

					    <?php }
					$week14Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '14'")->queryAll();
								$countweek14Data = count($week14Data);
								if (!empty($countweek14Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 14</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					           <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek14Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week14Data[$i]['lecture'];?></td>
					              			<td><?=$week14Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week14Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week14Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week14Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week14Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week14Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

					    <?php }
					$week15Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '15'")->queryAll();
								$countweek15Data = count($week15Data);
								if (!empty($countweek15Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 15</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek15Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week15Data[$i]['lecture'];?></td>
					              			<td><?=$week15Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week15Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week15Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week15Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week15Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week15Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->

					    <?php }
					$week16Data = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id' AND week = '16'")->queryAll();
								$countweek16Data = count($week16Data);
								if (!empty($countweek16Data)) {
						 ?>
						<div class="col-md-12">
					        <div class="box box-primary box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Week 16</h3>
									
					              <div class="box-tools">
					                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					                </button>
					              </div>
					              <!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					           <div class="box-body">					            			              
					              <table class="table table-striped table-hover">
					              	<thead>
					              		<tr>
					              			<th>Lecture No#</th>
					              			<th>Topic</th>
					              			<th>File</th>
					              			<th>Description</th>
					              			<th>Action</th>
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek16Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week16Data[$i]['lecture'];?></td>
					              			<td><?=$week16Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week16Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week16Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week16Data[$i]['description'];?></td>
					              			<td><a href="handout-update?handout_id=<?=$week16Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-primary"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit</b></a>
					              			<a href="handout-delete?handout_id=<?=$week16Data[$i]['handout_id'];?>&teacher_id=<?=$teacher_id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
					              		</tr>
					              		 <?php } ?>
					              	</tbody>
					              </table>					         
					            </div>
					            <!-- /.box-body -->
					        </div>
					        <!-- /.box -->
					    </div>
					    <!-- /.col -->
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php } ?>

<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Handout:</h4>
              </div>
              <div class="modal-body">

    
              	<!-- Form -->
                <form action="" method="POST"  enctype="multipart/form-data" accept-charset="utf-8">

					<input type="hidden" name="course_p_id" id="course_p_id" value="<?=$course_p_id; ?>">
					<input type="hidden" name="session_id" id="session_id" value="<?=$session_id; ?>">
					<input type="hidden" name="semester_id" id="semester_id" value="<?=$semester_id; ?>">
					<input type="hidden" name="sem_sub_id" id="sem_sub_id" value="<?=$subject_id; ?>">
					<input type="hidden" name="teacher_id" id="sem_sub_id" value="<?=$teacher_id; ?>">

					<div class="form-group">
					  <label for="week">Select Week:</label>
					  <select class="form-control" id="week" name="week" required>
					    <option>Select Week No...</option>
					    <option value="1">1</option>
					    <option value="2">2</option>
					    <option value="3">3</option>
					    <option value="4">4</option>
					    <option value="5">5</option>
					    <option value="6">6</option>
					    <option value="7">7</option>
					    <option value="8">8</option>
					    <option value="9">9</option>
					    <option value="10">10</option>
					    <option value="11">11</option>
					    <option value="12">12</option>
					    <option value="13">13</option>
					    <option value="14">14</option>
					    <option value="15">15</option>
					    <option value="16">16</option>
					  </select>
					</div>

					<div class="form-group">
					  <label for="lecture">Select Lecture No#:</label>
					  <select class="form-control" id="lecture" name="lecture" required>
					    <option>Select Lecture No...</option>
					    <option value="1">1</option>
					    <option value="2">2</option>
					    <option value="3">3</option>
					  </select>
					</div>

					<div class="form-group">
						<label>Topic:</label>
						<input type="text" name="topic" id="topic" required class="form-control" placeholder="Enter topic here...">
					</div>

					<div class="form-group">
						<label>Upload File:</label>
						<input type="file" name="file" id="file" required class="form-control">
					</div>

					<div class="form-group">
					  <label for="comment">Description:</label>
					  <textarea class="form-control" rows="5" name="description" id="description"></textarea>
					</div>                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name="modal_submit" class="btn btn-success" id="modal_submit">Save Handout</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

<?php 

	if (isset($_POST['modal_submit'])) {	

	$teacher_id			= $_POST['teacher_id'];
	$course_p_id		= $_POST['course_p_id'];
	$session_id			= $_POST['session_id'];
	$semester_id		= $_POST['semester_id'];
	$sem_sub_id			= $_POST['sem_sub_id'];
	$week 				= $_POST['week'];
	$lecture			= $_POST['lecture'];
	$topic 				= $_POST['topic'];
	$description 		= $_POST['description'];
	$created_by 		= Yii::$app->user->identity->id;
	
	date_default_timezone_set("Asia/Karachi");
	$created_at =  date("Y-m-d H:i:s");

      $file_name = $_FILES['file']['name'];
      $tmp_name = $_FILES['file']['tmp_name'];
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
      $insertHandout = Yii::$app->db->createCommand()->insert('class_handouts',[
              'course_p_id'       => $course_p_id,
              'session_id'        => $session_id,
              'semester_id'       => $semester_id,
              'sem_sub_id'        => $sem_sub_id,
              'week'              => $week,
              'lecture'           => $lecture,
              'file'              => $DBpath,
              'topic'             => $topic,
              'description'       => $description,
              'created_by'        => $created_by,
              'created_at'        => $created_at,
      ])->execute();
        // transaction commit
        $transaction->commit();
        \Yii::$app->getSession()->setFlash('success', '<strong>Success!</strong> Class Handout has been added.');
        \Yii::$app->response->redirect(['./handouts-detail-view','subject_id' => $sem_sub_id,'teacher_id' => $teacher_id]);
    } // closing of try block 
    catch (Exception $e) {
    	echo $e;
      // transaction rollback
            $transaction->rollback();
    } // closing of catch block
    // closing of transaction handling
 }
 ?>

