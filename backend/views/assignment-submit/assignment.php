 <?php
use yii\helpers\Url;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use common\models\User;
use common\models\Inbox;
use common\models\Student;
use common\models\StdEnrollment;
use common\models\Semester;
use common\models\SemesterSubjects;
use common\models\Teacher;
use common\models\TeacherClassEnrollment;
use common\models\AssignmentUpload;
use common\models\AssignmentSubmit;
use common\models\AssignmentRemarks;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AssignmentSubmitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assignment';
$this->params['breadcrumbs'][] = $this->title;

AppAsset::register($this);

?>
 <?php 
 	if (isset($_GET['assign']) && isset($_GET['std'])) {
 		$assign_id=$_GET['assign'];
 		$std_id=$_GET['std'];
 		
 	}
 	// echo "assign_id : ".$assign_id . " std_id : " . $std_id;
 ?>
 <?php
 	$assign=AssignmentUpload::find()->where(['assign_id'=>$assign_id])->one(); 
    $assignment_submit=AssignmentSubmit::find()->where(['assign_id'=>$assign_id])->andwhere(['std_id'=>$std_id])->one();
    if (empty($assignment_submit) || !$assignment_submit){
        $status="Not Submitted";
    }else{
        $assign_rem=AssignmentRemarks::find()->where(['assign_id'=>$assign->assign_id])->andwhere(['assign_sub_id'=>$assignment_submit->assign_sub_id])->one();
        if (empty($assign_rem) || !$assign_rem){
            $status="Submitted for Grading";
        }else{
            $status="Graded";
            $t_marks=$assign->total_marks;
            $o_marks=$assign_rem->obt_marks;
            $marks= " " . $o_marks . " / ". $t_marks;
        }
        
    }
    $assign=AssignmentUpload::find()->where(['assign_id'=>$assign_id])->one();
 ?>

 <div class="row" style="margin-bottom: 10vh;">
 	<div class="col-md-12">
 		<a href="download-file?file=<?php echo urlencode($assign->assign_file);  ?>" target="_blank" title="Assignment" style="font-size: 20px;font-weight: bold;" > <?php echo $assign->assign_title;  ?> </a>
 	</div>
 </div>
<table class="table table-active table-striped table-inverse">
		<tbody>
			<tr class="">
				<th>Submission status</th>
				<td class="<?php if($status=='Not Submitted'){echo 'bg-warning';}elseif($status=='Submitted for Grading'){echo 'bg-success';} ?>" ><?= $status ?></td>
			</tr>
			<tr>
				<th>Grading status</th>
				<td> <?php if($status=='Not Submitted'){echo 'Assignment Pending';}elseif($status=='Submitted for Grading'){echo 'Not Graded';}elseif($status=='Graded'){echo 'You Got  : ' . $marks ;}   ?></td>
			</tr>
			<?php if ($status=='Graded'): ?>
				<tr style="background-color: lightgreen">
					<td>Remarks </td>
					<td><?= $assign_rem->remarks ?></td>
				</tr>
			<?php endif ?>
			<tr class="">
				<th>Due date</th>
				<td><?php echo $assign->due_date; ?></td>
			</tr>
			<tr class="">
				<th>Last modified</th>
				<td><?php if ($assignment_submit) {
					echo $assignment_submit->submit_date;
				}  ?></td>
			</tr>
			<tr class="">
				<th>File submissions</th>
				<td><div class="box py-3">
						<div>
							<ul>
								<li>
									<div>
										<div >
											<a target="_blank" <?php if($status=='Not Submitted'){echo 'disabled';} ?> href="<?php if($status=='Submitted for Grading' || $status=='Graded'){echo 'download-file?file='.$assignment_submit->attach_file;}else{echo "#";} ?>">
												<?php if($status=='Submitted for Grading' || $status=='Graded'){echo $assignment_submit->attach_file;}else{
												echo "not submitted yet";
											} ?> 
											</a>   
										</div>
										<div><?php if($status=='Submitted for Grading' || $status=='Graded'){echo $assignment_submit->submit_date;}else{
												echo "";
											} ?></div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</td>
			</tr>

		</tbody>
	</table>
<?php 
if($status=='Submitted for Grading'){
 ?>
	<div class="row">
		<div class="col-md-12">
			<div style="text-align: center;">
				
				<a href="./delete-assignment?id=<?php echo urlencode($assignment_submit->assign_sub_id); ?>" class="btn btn-danger btn-lg" title="">Delete Submission</a>
			</div>
		</div>
	</div>

<?php 
}elseif($status=='Not Submitted'){
?>
	<div class="row">
		<div class="col-md-12">
			<div style="text-align: center;">
				<a href="./submission?id=<?php echo urlencode($assign_id); ?>" class="btn btn-primary btn-lg" title="">Add Submission</a>
			</div>
		</div>
	</div>


 <?php 
}
	
 ?>
