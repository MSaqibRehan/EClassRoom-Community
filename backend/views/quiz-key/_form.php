<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
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
use common\models\Session;
use common\models\SemesterSubjects;
use common\models\CourseProgram;
use common\models\Teacher;
use common\models\TeacherClassEnrollment;
use common\models\Quizz;
use common\models\QuizKey;
use common\models\AssignmentSubmit;
use common\models\AssignmentRemarks;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AssignmentSubmitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quiz Key';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php  
    $k_id=$_GET['id'];
    if (isset($_GET['action']) ) {
        $action=$_GET['action'];
    }
    if ($action=="update") {
        $quizz_key=QuizKey::find()->where(['quiz_key_id'=>$k_id])->one();
        $id=$quizz_key->quiz_id;
        $quizz=Quizz::find()->where(['quizz_id'=>$id])->one();
    }elseif($action=="add"){ 
        $quizz=Quizz::find()->where(['quizz_id'=>$k_id])->one();
        $id=$quizz->quizz_id;
    }
    
    
    $course_program = CourseProgram::find()->where(['cp_id'=>$quizz->course_p_id])->one();
    $session = Session::find()->where(['session_id'=>$quizz->session_id])->one();
    $semester = Semester::find()->where(['semester_id'=>$quizz->semester_id])->one();
    $semester_subjects = SemesterSubjects::find()->where(['sem_subj_id'=>$quizz->sem_sub_id])->one();
    // echo $quizz->assign_id ."<br>";
    // echo $quizz->session_id ."<br>";
    // echo $quizz->semester_id ."<br>";
    // echo $quizz->sem_sub_id ."<br>";
    // echo $quizz->uploaded_by ."<br>";
    // echo $quizz->c_p_id ."<br>";
    // echo $quizz->assign_no ."<br>";
    // echo $quizz->assign_title ."<br>";
    // echo $quizz->quizz_file ."<br>";
    // echo $quizz->assign_note ."<br>";
    // echo $quizz->due_date ."<br>";
?>

<div class="row">
    <div class="col-md-8">
        <table class="table table-responsive">
            <tr>
                <th>Course Program</th>
                <td><?= $course_program->cp_name ?></td>
                <th>Session</th>
                <td><?= $session->session_duration ?></td>
            </tr>
            <tr>
                <th>Semester</th>
                <td><?= $semester->semester_no ?></td>
                <th>Subject</th>
                <td><?= $semester_subjects->subject_title ?></td>
            </tr>
            <tr>
                <th>Quiz Title</th>
                <td><?= $quizz->quizz_title ?></td>
                <th>Total Marks</th>
                <td><?= $quizz->total_marks ?></td>
            </tr>
            <tr>
                <th>Semester</th>
                <td><?= $semester->semester_no ?></td>
                <th>Subject</th>
                <td><?= $semester_subjects->subject_title ?></td>
            </tr>
            <tr>
                <th>Quiz File</th>
                <td colspan="3" >  <a href="../download-file?file=<?php echo urlencode($quizz->quizz_file);  ?>" target="_blank" title="Assignment" style="font-size: 20px;font-weight: bold;" > <?php echo $quizz->quizz_file;  ?> </a></td>
                
                
            </tr>

        </table>
        
    </div>
</div>

<div class="quiz-key-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'quiz_id')->hiddenInput(['value'=>$id])->label(false) ?>

    <?= $form->field($model, 'quiz_key')->fileInput(['maxlength' => true,'class'=>'form-control']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Upload Key File' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
