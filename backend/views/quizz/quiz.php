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
use common\models\Quizz;
use common\models\QuizzRemarks;
use common\models\QuizKey;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AssignmentSubmitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quiz';
$this->params['breadcrumbs'][] = $this->title;

AppAsset::register($this);

?>
<?php 
    $usr_id= \Yii::$app->user->identity->id;
    $user_record=User::find()->where(['id'=>$usr_id])->one();
        $student_table=Student::find()->where(['user_id'=>$usr_id])->one();
        $std_id=$student_table->std_id;
        $student_enrollment_table=StdEnrollment::find()->where(['std_id'=>$std_id])->one();
        $sem_id=$student_enrollment_table->semester_id;
        $semester_record=Semester::find()->where(['semester_id'=>$sem_id])->one();
        $session_id=$student_enrollment_table->session_id;
        $semester_id=$sem_id;
        $course_p_id=   $semester_record->course_p_id;

        $subjects=SemesterSubjects::find()->where(['semester_id'=>$semester_id])->andwhere(['course_p_id'=>$course_p_id])->all();
?>

<div class="row">
    <div class="col-md-12">
        <?php foreach ($subjects as $subject): ?>
            <h3 style="border-bottom: 2px dashed green">Quiz for Subject :<span class="text-success h2"><?= $subject->subject_title;    ?></span> </h3>
            <?php 
                $quizz=Quizz::find()->where(['semester_id'=>$semester_id])->andwhere(['course_p_id'=>$course_p_id])->andwhere(['sem_sub_id'=>$subject->sem_subj_id])->andwhere(['session_id'=>$session_id])->all();
            ?>
            <?php if (empty($quizz) || !$quizz){ ?>
                <div class="row">
                    <div class="col-md-12 bg-info">
                        <h3 class="text-center">No Quiz for this subject</h3>
                    </div>
                </div>
            <?php 
                }else 
                {
                    ?>
                    <table class="table table-responsive table-hover text-center ">
                            <thead>
                                <tr class="bg-info">
                                    <th>Quiz Title</th>
                                    <th>Total Marks</th>
                                    <th>Obtained Marks</th>
                                    <th>Remarks</th>
                                    <th>Quiz File</th>
                                    <th>Key File</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php
                    foreach ($quizz as $quiz) 
                    {
                ?>
                        
                            <?php 
                                $quiz_key=QuizKey::find()->where(['quiz_id'=>$quiz->quizz_id])->one();
                                if (empty($quiz_key) || !$quiz_key){
                                    $keystatus="Key Not Uploaded";
                                }else{
                                	$keystatus="<a href='./download-file?file=$quiz_key->quiz_key' title=''>$quiz_key->quiz_key</a>";
                                }
                                $quiz_rem	=QuizzRemarks::find()->where(['quizz_id'=>$quiz->quizz_id])->andwhere(['std_id'=>$std_id])->one();
                                if (empty($quiz_rem	) || !$quiz_rem	){
                                    $grades="Not Graded";
                                    $remarks = "Not Graded";
                                }else{
                                    $grades=$quiz_rem	->obt_marks;
                                    $remarks = $quiz_rem	->remarks;
                                }
                                    
                                
                             ?>
                            
                                <tr>

                                    <td><?= $quiz->quizz_title ?></td>
                                    <td><?= $quiz->total_marks ?></td>
                                    <td><?= $grades ?></td>
                                    <td><?= $remarks ?></td>
                                    <td><a href="download-file?file=<?php echo urlencode($quiz->quizz_file);  ?>" target="_blank" title="Assignment" style="font-size: 20px;font-weight: bold;" > <?php echo $quiz->quizz_file;  ?> </a></td>
                                    <td><?= $keystatus ?></td>
                                </tr>
                           

                <?php
                    } 
                    ?>
                     </tbody>
                        </table>

                    <?php
                }
            ?>
            
        <?php endforeach ?>
        
    </div>
</div>
