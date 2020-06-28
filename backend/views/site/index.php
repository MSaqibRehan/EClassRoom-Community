<?php

/* @var $this yii\web\View */

$this->title = 'IUB E-Classroom & Community';
?>
<?php $announcementData = Yii::$app->db->createCommand("SELECT * FROM announcement WHERE status = 'Active'")->queryAll();
                        //$msg = $message[0]['announcement']; 
    $countannouncementData = count($announcementData);
    for ($i = 0; $i < $countannouncementData; $i++) {
        $msg = $announcementData[$i]['announcement'];
        $created_at = $announcementData[$i]['created_at'];
        $teacher_id = $announcementData[$i]['teacher_id'];
        $teacherName = Yii::$app->db->createCommand("SELECT teacher_name FROM teacher WHERE teacher_id = '$teacher_id'")->queryAll();
        $teacher_name = $teacherName[0]['teacher_name'];

?>
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua callout-warning">
            <span class="info-box-icon"><i class="fa fa-microphone"></i></span>
            <div class="info-box-content">
              <h4 style="float: left;">Announcement by Teacher: <i style="font-size: 22px;"><?=$teacher_name; ?></i> !</h4>  
              <h4 style="float:right">
                <?php
                echo $created_at;
                ?> 
              </h4>  
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
<?php } ?>