<?php
$user_id = Yii::$app->user->identity->id;
$userData = Yii::$app->db->createCommand("SELECT user_type FROM user WHERE id = '$user_id'")->queryAll();
$userType = $userData[0]['user_type'];

/* @var $this yii\web\View */

$this->title = 'IUB E-Classroom & Community';
?>


<div class="box box-danger" style="border-top:3px solid #607D8B;">
        <div class="box-body">
          <div class="row" style="padding:10px;margin-bottom:10px;">
              <div class="col-md-12">
                  <h2 style="font-family:serif; color:#607D8B; margin:0px; padding:0px; font-size:30px;"><i class="glyphicon glyphicon-dashboard"></i>  Dashboard</h2>
                  <h4 style="float:right; margin-top : -25px; color:#607D8B;">
                    <span id="hr"></span>
                    <span id="min"></span>
                    <span id="sec"></span> :
                    <?php echo date('l d-M-Y');?> 
                  </h4>
              </div>
          </div>

          <?php 
            if ($userType == 'teacher' || $userType == 'Teacher') {
              $teacherData = Yii::$app->db->createCommand("SELECT * FROM teacher WHERE user_id = '$user_id'")->queryAll();
              $teacher_id   = $teacherData[0]['teacher_id'];
              $teacher_name = $teacherData[0]['teacher_name'];

              $announcementData = Yii::$app->db->createCommand("SELECT * FROM announcement WHERE teacher_id = '$teacher_id' AND status = 'Active'")->queryAll();
              $countannouncementData = count($announcementData);
              for ($i = 0; $i < $countannouncementData; $i++) {
                  $course_p_id    = $announcementData[$i]['course_p_id'];
                  $session_id     = $announcementData[$i]['session_id'];
                  $semester_id    = $announcementData[$i]['semester_id'];
                  $sem_sub_id     = $announcementData[$i]['sem_sub_id'];
                  $msg            = $announcementData[$i]['announcement'];
                  $created_at     = $announcementData[$i]['created_at'];

                  $courseData = Yii::$app->db->createCommand("SELECT cp_name FROM course_program WHERE cp_id = '$course_p_id'")->queryAll();
                  $cp_name = $courseData[0]['cp_name'];

                  $sessionData = Yii::$app->db->createCommand("SELECT * FROM session WHERE session_id = '$session_id'")->queryAll();
                  $session_duration = $sessionData[0]['session_duration'];
                  $intake = $sessionData[0]['intake'];

                  $semesterData = Yii::$app->db->createCommand("SELECT * FROM semester WHERE semester_id = '$semester_id'")->queryAll();
                  $semester_no  = $semesterData[0]['semester_no'];
                  $class_time   = $semesterData[0]['class_time'];

                  $subjectData = Yii::$app->db->createCommand("SELECT subject_title FROM semester_subjects WHERE sem_subj_id = '$sem_sub_id'")->queryAll();
                  $subject_title = $subjectData[0]['subject_title'];

           ?>

          <div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua callout-warning">
                <span class="info-box-icon"><i class="fa fa-microphone"></i></span>
                <div class="info-box-content">
                  <h4 style="float: left;"><?=$cp_name;?> - <?=$semester_no;?> <i><?=$class_time;?></i> (<?=$intake;?> - <?=$session_duration;?>)</h4>
                  <center><h4>Subject: <i><?=$subject_title;?></i></h4></center>
                  <h4 style="float:right">
                    <?php echo $created_at;?> 
                  </h4>  
                  <h4 style="float: left;">Announcement by Teacher: <i style="font-size: 22px;"><?=$teacher_name; ?></i> !</h4>  
                  <h4 style="float:right">Announcement Date:&ensp;</h4>  
                  <br><br>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                    <span class="progress-description" style="font-size: 22px;">
                        <marquee onmouseover="this.stop();" onmouseout="this.start();">
                          <?php                         
                            echo $msg;
                          ?>
                        </marquee>
                    </span>
                </div>
              </div>
            </div>
          </div>

    <?php }
    } ?>
          <?php 
          if ($userType == 'student' || $userType == 'Student') {
              $stdData = Yii::$app->db->createCommand("SELECT * FROM student WHERE user_id = '$user_id'")->queryAll();
              $std_id = $stdData[0]['std_id'];

              $stdEnroll = Yii::$app->db->createCommand("SELECT * FROM std_enrollment WHERE std_id = '$std_id'")->queryAll();
              $semester_id = $stdEnroll[0]['semester_id'];

              $announcementData = Yii::$app->db->createCommand("SELECT * FROM announcement WHERE semester_id = '$semester_id' AND status = 'Active'")->queryAll();          
              $countannouncementData = count($announcementData);

              for ($i = 0; $i < $countannouncementData; $i++) {
                 $course_p_id   = $announcementData[$i]['course_p_id'];
                  $session_id   = $announcementData[$i]['session_id'];
                  $semester_id  = $announcementData[$i]['semester_id'];
                  $sem_sub_id   = $announcementData[$i]['sem_sub_id'];
                  $msg          = $announcementData[$i]['announcement'];
                  $created_at   = $announcementData[$i]['created_at'];
                  $teacher_id   = $announcementData[$i]['teacher_id'];

                  $courseData = Yii::$app->db->createCommand("SELECT cp_name FROM course_program WHERE cp_id = '$course_p_id'")->queryAll();
                  $cp_name = $courseData[0]['cp_name'];

                  $sessionData = Yii::$app->db->createCommand("SELECT * FROM session WHERE session_id = '$session_id'")->queryAll();
                  $session_duration = $sessionData[0]['session_duration'];
                  $intake = $sessionData[0]['intake'];

                  $semesterData = Yii::$app->db->createCommand("SELECT * FROM semester WHERE semester_id = '$semester_id'")->queryAll();
                  $semester_no = $semesterData[0]['semester_no'];
                  $class_time = $semesterData[0]['class_time'];

                  $subjectData = Yii::$app->db->createCommand("SELECT subject_title FROM semester_subjects WHERE sem_subj_id = '$sem_sub_id'")->queryAll();
                  $subject_title = $subjectData[0]['subject_title'];

                  $teacherName = Yii::$app->db->createCommand("SELECT teacher_name FROM teacher WHERE teacher_id = '$teacher_id'")->queryAll();
                  $teacher_name = $teacherName[0]['teacher_name'];

          ?>
        <div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua callout-warning">
                <span class="info-box-icon"><i class="fa fa-microphone"></i></span>
                <div class="info-box-content">
                  <h4 style="float: left;"><?=$cp_name;?> - <?=$semester_no;?> <i><?=$class_time;?></i> (<?=$intake;?> - <?=$session_duration;?>)</h4>
                  <center><h4>Subject: <i><?=$subject_title;?></i></h4></center>
                  <h4 style="float:right">
                    <?php echo $created_at;?> 
                  </h4>  
                  <h4 style="float: left;">Announcement by Teacher: <i style="font-size: 22px;"><?=$teacher_name; ?></i> !</h4>  
                  <h4 style="float:right">Announcement Date:&ensp;</h4>  
                  <br><br>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                    <span class="progress-description" style="font-size: 22px;">
                        <marquee onmouseover="this.stop();" onmouseout="this.start();">
                          <?php                         
                            echo $msg;
                          ?>
                        </marquee>
                    </span>
                </div>
              </div>
            </div>
          </div>
  <?php } 
  }?>
          </div>
        </div>
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
  });
</script>
<script type="text/javascript">
  function clock() {
      const fullDate = new Date();
      let hours = fullDate.getHours();
      let mins = fullDate.getMinutes();
      let secs = fullDate.getSeconds();
      if (hours>12) {
        var am = "PM"
        hours=hours-12;
      }
      else{
        var am = "AM";
      }
      if (hours < 12) {
          hours = "0" + hours;
      }
      if (mins < 12) {
          mins = "0" + mins;
      }
      if (secs < 10) {
          secs = "0" + secs;
      }
      document.getElementById('hr').innerHTML = hours+':';
      document.getElementById('min').innerHTML = mins+':';
      document.getElementById('sec').innerHTML = secs+' '+am;
  }
  setInterval(clock, 1000)
</script>