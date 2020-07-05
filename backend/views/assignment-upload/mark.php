<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
use common\models\AssignmentUpload;
use common\models\AssignmentSubmit;
use common\models\AssignmentRemarks;

/* @var $this yii\web\View */
/* @var $model common\models\AssignmentRemarks */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Mark Assignment';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
    $asid=$_GET['id'];
    $assign_submit=AssignmentSubmit::find()->where(['assign_sub_id'=>$asid])->one();
    $id=$assign_submit->assign_id;
    $assign_upload=AssignmentUpload::find()->where(['assign_id'=>$id])->one();
    $course_program = CourseProgram::find()->where(['cp_id'=>$assign_upload->c_p_id])->one();
    $session = Session::find()->where(['session_id'=>$assign_upload->session_id])->one();
    $semester = Semester::find()->where(['semester_id'=>$assign_upload->semester_id])->one();
    $semester_subjects = SemesterSubjects::find()->where(['sem_subj_id'=>$assign_upload->sem_sub_id])->one();
    date_default_timezone_set("Asia/Karachi");
        $date =  date("Y-m-d H:i:s");
    // echo $assign_upload->assign_id ."<br>";  
    // echo $assign_upload->session_id ."<br>";
    // echo $assign_upload->semester_id ."<br>";
    // echo $assign_upload->sem_sub_id ."<br>";
    // echo $assign_upload->uploaded_by ."<br>";
    // echo $assign_upload->c_p_id ."<br>";
    // echo $assign_upload->assign_no ."<br>";
    // echo $assign_upload->assign_title ."<br>";
    // echo $assign_upload->assign_file ."<br>";
    // echo $assign_upload->assign_note ."<br>";
    // echo $assign_upload->due_date ."<br>";
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
                <th>Assignment Title</th>
                <td><?= $assign_upload->assign_title ?></td>
                <th>Total Marks</th>
                <td><?= $assign_upload->total_marks ?></td>
            </tr>
            <tr>
                <th>Semester</th>
                <td><?= $semester->semester_no ?></td>
                <th>Subject</th>
                <td><?= $semester_subjects->subject_title ?></td>
            </tr>
            <tr>
                <th>Assignment File</th>
                <td >  <a href="download-file?file=<?php echo urlencode($assign_upload->assign_file);  ?>" target="_blank" title="Assignment" style="font-size: 20px;font-weight: bold;" > <?php echo $assign_upload->assign_file;  ?> </a></td>
                <th>Due Date</th>
                <td><?= $assign_upload->due_date ?></td>
                
            </tr>
        </table>
        
    </div>
</div>
<fieldset class="col-md-8">
    <legend class="text-success">Mark Assignment</legend>
        <div class="assignment-remarks-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'assign_id')->hiddenInput(['value'=>$id])->label(false) ?>

            <?= $form->field($model, 'assign_sub_id')->hiddenInput(['value'=>$assign_submit->assign_sub_id])->label(false) ?>

            <?= $form->field($model, 'obt_marks')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'created_at')->hiddenInput(['value'=>$date])->label(false) ?>

          
            <?php if (!Yii::$app->request->isAjax){ ?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Mark Assignment' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            <?php } ?>

            <?php ActiveForm::end(); ?>
            
        </div>
</fieldset>


