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
use common\models\Session;
use common\models\SemesterSubjects;
use common\models\CourseProgram;
use common\models\Teacher;
use common\models\TeacherClassEnrollment;
use common\models\AssignmentUpload;
use common\models\AssignmentSubmit;
use common\models\AssignmentRemarks;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AssignmentSubmitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mark Assignment';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php 
    $id=$model->assign_id;
    $assign_upload=AssignmentUpload::find()->where(['assign_id'=>$id])->one();
    $course_program = CourseProgram::find()->where(['cp_id'=>$assign_upload->c_p_id])->one();
    $session = Session::find()->where(['session_id'=>$assign_upload->session_id])->one();
    $semester = Semester::find()->where(['semester_id'=>$assign_upload->semester_id])->one();
    $semester_subjects = SemesterSubjects::find()->where(['sem_subj_id'=>$assign_upload->sem_sub_id])->one();
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
                <th>Assignment File</th>
                <td >  <a href="download-file?file=<?php echo urlencode($assign_upload->assign_file);  ?>" target="_blank" title="Assignment" style="font-size: 20px;font-weight: bold;" > <?php echo $assign_upload->assign_file;  ?> </a></td>
                <th>Due Date</th>
                <td><?= $assign_upload->due_date ?></td>
                
            </tr>
        </table>
        
    </div>
</div>
<?php 
    $assignment_submit=AssignmentSubmit::find()->where(['assign_id'=>$id])->all();

?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Submitted Assignments</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                    <table class="table table-bordered table-inverse">
                        <tr>
                            <th>Student Name</th>
                            <th>Submitted File</th>
                            <th>Submission Date</th>
                            <th>Marks</th>
                            <th>Mark Assignment</th>

                        </tr>
                        <?php foreach ($assignment_submit as $value): ?> 
                            <?php 
                                $student=Student::find()->where(['std_id'=>$value->std_id])->one();
                               $count= \common\models\AssignmentRemarks::find()
                                            ->where(['assign_id'=>$value->assign_id])
                                            ->andwhere(['assign_sub_id'=>$value->assign_sub_id])
                                            ->count();
                                $assign_rem =\common\models\AssignmentRemarks::find()
                                            ->where(['assign_id'=>$value->assign_id])
                                            ->andwhere(['assign_sub_id'=>$value->assign_sub_id])
                                            ->one();
                                // $assign_rem=AssignmentSubmit::find()->where(['assign_id'=>$value->assign_id])->andwhere(['assign_sub_id'=>$value->assign_sub_id])->one();
                            ?>
                            
                                <tr> 
                                    <td><?= $student->std_name ?></td>
                                    <td> <a href="download-file?file=<?php echo urlencode($value->attach_file);  ?>" target="_blank" title="Assignment" style="font-size: 15px;font-weight: bold;" > <?php echo $value->attach_file;  ?> </a></td>
                                    <td><?= $value->submit_date ?></td>
                                    <td>
                                        <?php 
                                            if ($count>0) {
                                                echo $assign_rem->obt_marks;
                                            }else{
                                                echo "Not Marked";
                                            }
                                         ?>
                                    </td>
                                    <td>
                                        <?php $id=$value->assign_sub_id; ?>
                                        <?php if ($count>0): ?>
                                            <?php $ass_rem_id=$assign_rem->assign_remark_id;  ?>                                            
                                            <?= Html::a('Update Marks', ['./mark-update?id='.$ass_rem_id.'&action=update'],
                                            ['role'=>'modal-remote','target'=>'_blank','title'=> 'Create new Quizz Remarks','class'=>'btn btn-warning']) ?>
                                        <?php endif ?>
                                        <?php if ($count==0): ?>
                                            <?php $id=$value->assign_sub_id; ?>
                                            <?= Html::a('Mark Assignment', ['./mark-assignment?id='.$id.'&action=add'],
                                                ['role'=>'modal-remote','target'=>'_blank','title'=> 'Mark Assignment','class'=>'btn btn-primary ']) ?>
                                        <?php endif ?>

                                        
                                        

                                       
                                </tr>
                           
                        <?php endforeach ?>
                    </table>
              </div>
              <!-- /.tab-pane -->
            
              <!-- /.tab-pane -->
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
    </div>
</div>