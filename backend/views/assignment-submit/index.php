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
<link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
            <h3 style="border-bottom: 2px dashed green">Assignment for Subject :<span class="text-success h2"><?= $subject->subject_title;    ?></span> </h3>
            <?php 
                $assinment=AssignmentUpload::find()->where(['semester_id'=>$semester_id])->andwhere(['c_p_id'=>$course_p_id])->andwhere(['sem_sub_id'=>$subject->sem_subj_id])->andwhere(['session_id'=>$session_id])->all();
            ?>
            <?php if (empty($assinment) || !$assinment){ ?>
                <div class="row">
                    <div class="col-md-12 bg-info">
                        <h3 class="text-center">No assignment for this subject</h3>
                    </div>
                </div>
            <?php 
                }else 
                {
                    ?>
                    <table class="table table-responsive table-hover text-center ">
                            <thead>
                                <tr class="bg-info">
                                    <th>Assignment No</th>
                                    <th>Assignment Title</th>
                                    <th>Total Marks</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php
                    foreach ($assinment as $assign) 
                    {
                ?>
                        
                            <?php 
                                $assignment_submit=AssignmentSubmit::find()->where(['assign_id'=>$assign->assign_id])->andwhere(['std_id'=>$std_id])->one();
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
                             ?>
                            
                                <tr>
                                    <td><?= $assign->assign_no ?> </td>
                                    <td><?= $assign->assign_title ?></td>
                                    <td><?= $assign->total_marks ?></td>
                                    <td><?= $assign->due_date ?></td>
                                    <td><?= $status ?></td>
                                    <td><a href="assignment?assign=<?php echo $assign->assign_id ?>&std=<?php echo $std_id ?>">View Assignment</a></td>
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
