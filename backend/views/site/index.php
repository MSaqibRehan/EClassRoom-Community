<?php

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
          <?php $announcementData = Yii::$app->db->createCommand("SELECT * FROM announcement WHERE status = 'Active'")->queryAll();
          
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