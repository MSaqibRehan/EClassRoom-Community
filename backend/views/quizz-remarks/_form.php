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
use common\models\Quizz;
use common\models\AssignmentSubmit;
use common\models\QuizzRemarks;

/* @var $this yii\web\View */
/* @var $model common\models\QuizzRemarks */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Mark Quiz';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
    if (isset($_GET['id']) ) {
        $quizz_id=$_GET['id'];
    }
    if (isset($_GET['std']) ) {
        $std_id=$_GET['std'];
    }
    if (isset($_GET['action']) ) {
        $action=$_GET['action'];
    }
    if ($action=="update") {
        $quizz_remm=QuizzRemarks::find()->where(['quizz_remark_id'=>$quizz_id])->one();
        $quizz=Quizz::find()->where(['quizz_id'=>$quizz_remm->quizz_id])->one();
    }elseif($action=="add"){ 
        $quizz=Quizz::find()->where(['quizz_id'=>$quizz_id])->one();
        
    }
    $id=$quizz->quizz_id;

    // echo "std " .$std_id ." quizz " .$quizz_id ;
    date_default_timezone_set("Asia/Karachi");
        $date =  date("Y-m-d H:i:s");

    
    $course_program = CourseProgram::find()->where(['cp_id'=>$quizz->course_p_id])->one();
    $session = Session::find()->where(['session_id'=>$quizz->session_id])->one();
    $semester = Semester::find()->where(['semester_id'=>$quizz->semester_id])->one();
    $semester_subjects = SemesterSubjects::find()->where(['sem_subj_id'=>$quizz->sem_sub_id])->one();
    $student=Student::find()->where(['std_id'=>$std_id])->one();
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
                    <td  >  <a href="../download-file?file=<?php echo urlencode($quizz->quizz_file);  ?>" target="_blank" title="Assignment" style="font-size: 20px;font-weight: bold;" > <?php echo $quizz->quizz_file;  ?> </a></td>
                    <th>Student Name</th>
                    <td><?= $student->std_name ?></td>
                    
                    
                </tr>
            </table>
            
        </div>
    </div>

<fieldset>
    <legend>Marks Report</legend>
    <div class="quizz-remarks-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'quizz_id')->hiddenInput(['value'=>$id])->label(false) ?>

        <?= $form->field($model, 'std_id')->hiddenInput(['value'=>$std_id])->label(false) ?>
        <?= $form->field($model, 'obt_marks')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>    

        <?= $form->field($model, 'created_at')->hiddenInput(['value'=>$date])->label(false) ?>

      
        <?php if (!Yii::$app->request->isAjax){ ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Mark Quiz' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        <?php } ?>

        <?php ActiveForm::end(); ?>
        
    </div>
</fieldset>

