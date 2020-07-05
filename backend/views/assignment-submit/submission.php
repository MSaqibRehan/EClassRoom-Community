 <?php
 use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\assets\AppAsset;
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
 	if (isset($_GET['id'])) {
 		$assign_id=$_GET['id'];

 		
 	}
 	// echo "assign_id : ".$assign_id ;
 	
 ?>
 <?php 
    $assignment_submit=AssignmentSubmit::find()->where(['assign_id'=>$assign_id])->one();
    if (empty($assignment_submit) || !$assignment_submit){
        $status="Not Submitted";
    }else{
        $assign_rem=AssignmentRemarks::find()->where(['assign_id'=>$assign->assign_id])->andwhere(['assign_sub_id'=>$assignment_submit->assign_sub_id])->one();
        if (empty($assign_rem) || !$assign_rem){
            $status="Submitted for Grading";
        }else{
            $status="Graded";
        }
        
    }
    $assign=AssignmentUpload::find()->where(['assign_id'=>$assign_id])->one();
 ?>

		<div class="row" style="margin-bottom: 10vh;">
		 	<div class="col-md-12">
		 		<a href="download-file?file=<?php echo urlencode($assign->assign_file);  ?>" target="_blank" title="Assignment" style="font-size: 20px;font-weight: bold;" > <?php echo $assign->assign_title;  ?> </a>
		 	</div>
		 </div>

		 <div class="row">
		 	<div class="col-md-12">
		 		<p class="h2">Upload Your Assignment</p>
		 	</div>
		 </div>

		 <div class="row">
		 	<div class="col-md-8 col-md-offset-2">
		 		<div class="assignment-submit-form">

				    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

				    <?= $form->field($model, 'assign_id')->hiddenInput(['value' => $assign_id])->label(false);?>


				    <?= $form->field($model, 'attach_file')->fileInput(['maxlength' => true]) ?>

				    <?= $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

					<?php if (!Yii::$app->request->isAjax){ ?>
					  	<div class="form-group">
					        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					    </div>
					<?php } ?>

				    <?php ActiveForm::end(); ?>
				    
				</div>
		 	</div>
		 </div>


		

		