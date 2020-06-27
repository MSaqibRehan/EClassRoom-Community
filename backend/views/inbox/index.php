<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use common\models\User;
use common\models\Inbox;
use common\models\Student;
use common\models\StdEnrollment;
use common\models\Semester;
use common\models\Teacher;
use common\models\TeacherClassEnrollment;


/* @var $this yii\web\View */
/* @var $searchModel common\models\InboxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inbox';
$this->params['breadcrumbs'][] = $this->title;



?>
<?php 
        $session_id="";
        $semester_id="";
        $course_p_id= "";
    $usr_id= \Yii::$app->user->identity->id;
    $user_record=User::find()->where(['id'=>$usr_id])->one();
    if ($user_record->user_type=="student") {
        $student_table=Student::find()->where(['user_id'=>$usr_id])->one();
        $std_id=$student_table->std_id;
        $student_enrollment_table=StdEnrollment::find()->where(['std_id'=>$std_id])->one();
        $sem_id=$student_enrollment_table->semester_id;
        $semester_record=Semester::find()->where(['semester_id'=>$sem_id])->one();
        $session_id=$student_enrollment_table->session_id;
        $semester_id=$sem_id;
        $course_p_id=   $semester_record->course_p_id;
    }elseif($user_record->user_type=="teacher"){
        $teacher_table=Teacher::find()->where(['user_id'=>$usr_id])->one();
        $tec_id=$teacher_table->teacher_id;
        $teacher_enrollment_table=TeacherClassEnrollment::find()->where(['teacher_id'=>$tec_id])->one();
        $sem_id=$teacher_enrollment_table->semester_id;
        $semester_record=Semester::find()->where(['semester_id'=>$sem_id])->one();
        $session_id=$teacher_enrollment_table->session_id;
        $semester_id=$sem_id;
        $course_p_id=$semester_record->course_p_id;
    }
   

   // echo 'user_id : ' . $usr_id . ' <br> session_id : ' .$session_id . '<br> semester_id : ' . $semester_id . ' <br> course_p_id : ' . $course_p_id ;



?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary direct-chat direct-chat-primary" >
            <div class="box-header with-border" >
              <h3 class="box-title">Direct Chat</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages" style="height: 60vh;">
                <?php 
                    $inbox_record=Inbox::find()->where(['session_id'=>$session_id])->andwhere(['semester_id'=>$semester_id])->andwhere(['course_p_id'=>$course_p_id])->all();
                ?>

                <?php 
                    foreach ($inbox_record as $value) {
                        $iuser_id=$value->sender_name;
                        $iuser=User::find()->where(['id'=>$iuser_id])->one();
                        if ($value->sender_name==$usr_id) {
                            ?>
                            <!-- Message to the right -->
                            <div class="direct-chat-msg right">
                              <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-right"><?= $iuser->username ?></span>
                                <span class="direct-chat-timestamp pull-left"><?= $value->created_at ?></span>
                              </div>
                              <!-- /.direct-chat-info -->
                             <!-- /.direct-chat-img -->
                              <div class="direct-chat-text">
                                <?= $value->message ?>
                              </div>
                              <!-- /.direct-chat-text -->
                            </div>
                            <?php
                        }else{
                            ?>
                        <!-- Message. Default to the left -->
                                <div class="direct-chat-msg">
                                  <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left"><?= $iuser->username ?></span>
                                    <span class="direct-chat-timestamp pull-right"><?= $value->created_at ?></span>
                                  </div>
                                  <!-- /.direct-chat-info -->
                                  <!-- /.direct-chat-img -->
                                  <div class="direct-chat-text">
                                    <?= $value->message ?>
                                  </div>
                                  <!-- /.direct-chat-text -->
                                </div>
                            <?php
                        }
                ?>
 
                <?php
                        
                    }
                ?>

<!-- ======================================= -->
                       
                        <!-- /.direct-chat-msg -->

                        
                        <!-- /.direct-chat-msg -->

<!-- ==================================== -->

              </div>
              <!--/.direct-chat-messages-->

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <form action="" method="post">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                <input type="hidden" name="session" id="session" value="<?php echo $session_id; ?>">
                <input type="hidden" name="semester" id="semester" value="<?php echo $semester_id; ?>">
                <input type="hidden" name="course" id="course" value="<?php echo $course_p_id; ?>">
                <input type="hidden" name="user" id="user" value="<?php echo $usr_id; ?>">
                <div class="input-group">
                  <input type="text" name="message" id="message" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                        <button type="button" id="sendmessage" class="btn btn-primary btn-flat">Send</button>
                      </span>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $('#sendmessage').click(function(e){  
        e.preventDefault();
        var message = $('#message').val();
        if(message == ''){
            $('#message').focus();
            return false;
        }
        var user=$('#user').val();
        var session=$('#session').val();
        var semester=$('#semester').val();
        var course=$('#course').val();

        $.ajax({
            url : "../send-message",
            method:"POST",
            data:{ message:message, user:user ,session:session ,semester:semester ,course:course},           
            success:function(data){
                console.log(data);
                $('#message').val("");

            }
        });
    });
</script>
