<?php 
if(isset($_GET['subject_id'])){
	$subject_id = $_GET['subject_id'];
// $semesterSubjects = Yii::$app->db->createCommand("SELECT * FROM class_handouts WHERE sem_sub_id = '$subject_id'")->queryAll();
// $countSubjects = count($semesterSubjects);
// $subjectID = $semesterSubjects[0]['sem_subj_id'];
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek1Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week1Data[$i]['lecture'];?></td>
					              			<td><?=$week1Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week1Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week1Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week1Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek2Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week2Data[$i]['lecture'];?></td>
					              			<td><?=$week2Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week2Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week2Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week2Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek3Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week3Data[$i]['lecture'];?></td>
					              			<td><?=$week3Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week3Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week3Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week3Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek4Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week4Data[$i]['lecture'];?></td>
					              			<td><?=$week4Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week4Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week4Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week4Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek5Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week5Data[$i]['lecture'];?></td>
					              			<td><?=$week5Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week5Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week5Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week5Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek6Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week6Data[$i]['lecture'];?></td>
					              			<td><?=$week6Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week6Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week6Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week6Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek7Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week7Data[$i]['lecture'];?></td>
					              			<td><?=$week7Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week7Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week7Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week7Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek8Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week8Data[$i]['lecture'];?></td>
					              			<td><?=$week8Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week8Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week8Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week8Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek9Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week9Data[$i]['lecture'];?></td>
					              			<td><?=$week9Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week9Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week9Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week9Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek10Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week10Data[$i]['lecture'];?></td>
					              			<td><?=$week10Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week10Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week10Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week10Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek11Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week11Data[$i]['lecture'];?></td>
					              			<td><?=$week11Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week11Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week11Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week11Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek12Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week12Data[$i]['lecture'];?></td>
					              			<td><?=$week12Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week12Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week12Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week12Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek13Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week13Data[$i]['lecture'];?></td>
					              			<td><?=$week13Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week13Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week13Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week13Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek14Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week14Data[$i]['lecture'];?></td>
					              			<td><?=$week14Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week14Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week14Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week14Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek15Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week15Data[$i]['lecture'];?></td>
					              			<td><?=$week15Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week15Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week15Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week15Data[$i]['description'];?></td>
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
					              		</tr>
					              	</thead>
					              	<tbody>
					              		<?php for ($i = 0; $i < $countweek16Data; $i++) { ?>	
					              		<tr>
					              			<td><?=$week16Data[$i]['lecture'];?></td>
					              			<td><?=$week16Data[$i]['topic'];?></td>
					              			<td><a href="download-file?file=<?php echo urlencode($week16Data[$i]['file']);  ?>" target="_blank" title="Handout" style="font-size: 20px;font-weight: bold;" > <?php echo $week16Data[$i]['file'];  ?> </a></td>
					              			<td><?=$week16Data[$i]['description'];?></td>
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