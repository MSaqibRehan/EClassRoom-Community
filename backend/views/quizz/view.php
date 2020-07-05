<?php
use yii\helpers\Url;
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
use common\models\AssignmentSubmit;
use common\models\AssignmentRemarks;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AssignmentSubmitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quiz';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php 
    $id=$model->quizz_id;
    $quizz=Quizz::find()->where(['quizz_id'=>$id])->one();
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
    $q_key_count = \common\models\QuizKey::find()
                                        ->where(['quiz_id'=>$id])
                                        ->count();
    $q_key = \common\models\QuizKey::find()
                                        ->where(['quiz_id'=>$id])
                                        ->one();
    
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
                <td>  <a href="./download-file?file=<?php echo urlencode($quizz->quizz_file);  ?>" target="_blank" title="Quiz file" style="font-size: 20px;font-weight: bold;" > <?php echo $quizz->quizz_file;  ?> </a></td>
                <?php if ($q_key_count>0): ?>
                    <th>Quiz File</th>
                    <td>  <a href="./download-file?file=<?php echo urlencode($q_key->quiz_key);  ?>" class="text-info" target="_blank" title="Quiz key file" style="font-size: 20px;font-weight: bold;" > <?php echo $q_key->quiz_key;  ?> </a></td>
                <?php endif ?>
                
                
            </tr>
            <tr>
                <td colspan="4 ">
                    <?php if ($q_key_count>0): ?>
                        <?php $q_id=$q_key->quiz_key_id; ?>

                        
                        <?= Html::a('Delete Quiz Key', ['./quiz-key-delete?id='.$q_id],
                        ['role'=>'modal-remote','disabled','target'=>'_blank','title'=> 'Update Quiz Key file','class'=>'btn btn-danger pull-right']) ?>
                        <?= Html::a('Update Quiz Key', ['./quiz-key-update?id='.$q_id.'&action=update'],
                        ['role'=>'modal-remote','disabled','target'=>'_blank','title'=> 'Update Quiz Key file','class'=>'btn btn-warning pull-right']) ?>
                    <?php endif ?>
                    <?php if ($q_key_count==0): ?>
                        <?= Html::a('Upload Key File', ['./upload-key?id='.$id.'&action=add'],
                             ['role'=>'modal-remote','disabled','target'=>'_blank','title'=> 'Upload Key File','class'=>'btn btn-primary pull-right']) ?>
                    <?php endif ?>

                    
                </td>
            </tr>
        </table>
        
    </div>
</div>
<?php 
    $stds=StdEnrollment::find()->where(['session_id'=>$id])->andwhere(['semester_id'=>$quizz->semester_id])->all();
     
?>

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Students List</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                    <table class="table table-bordered table-inverse">
                        <tr>
                            <th>Student Name</th>
                            <th>Student Registration No</th>
                            <th>Marks</th>
                            <th>Mark Assignment</th>

                        </tr>
                        <?php foreach ($stds as $value): ?> 
                            <?php 
                                $student=Student::find()->where(['std_id'=>$value->std_id])->one();
                                $std_id=$student->std_id;
                                $count = \common\models\QuizzRemarks::find()
                                        ->where(['std_id'=>$std_id])
                                        ->andwhere(['quizz_id'=>$id])
                                        ->count();
                                $q_rem_rec =\common\models\QuizzRemarks::find()
                                        ->where(['std_id'=>$std_id])
                                        ->andwhere(['quizz_id'=>$id])
                                        ->one();
                            ?>
                            
                                <tr>
                                    <td><?= $student->std_name ?></td>
                                    <td> <?= $student->std_reg_no  ?></td>
                                    <td>
                                        <?php 
                                            if ($count>0) {
                                                echo $q_rem_rec->obt_marks;
                                            }else{
                                                echo "Not Marked";
                                            }
                                         ?>
                                    </td>
                                    <td>
                                        <?php if ($count>0): ?>
                                            <?php $q_rem_id=$q_rem_rec->quizz_remark_id;  ?>
                                            
                                            <?= Html::a('Update Marks', ['./mark-quiz-update?id='.$q_rem_id.'&std='.$std_id.'&action=update'],
                                            ['role'=>'modal-remote','disabled','target'=>'_blank','title'=> 'Create new Quizz Remarks','class'=>'btn btn-warning']) ?>
                                        <?php endif ?>
                                        <?php if ($count==0): ?>
                                            <?= Html::a('Mark Quiz', ['./mark-quiz?id='.$id.'&std='.$std_id.'&action=add'],
                                             ['role'=>'modal-remote','disabled','target'=>'_blank','title'=> 'Create new Quizz Remarks','class'=>'btn btn-primary']) ?>
                                        <?php endif ?>

                                        
                                        
                                    </td>
                                </tr>
                           
                        <?php endforeach ?>
                    </table>
              </div>

              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
    </div>
</div>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
