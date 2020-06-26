<?php

use yii\widgets\DetailView;
use common\models\CourseProgram;
/* @var $this yii\web\View */
/* @var $model common\models\Announcement */
?>
<div class="announcement-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'announce_id',
            //'course_p_id',
            'courseP.cp_name',
            'session.session_duration',
            'semester.semester_no',
            'semSub.subject_title',
            'teacher.teacher_name',
            'announcement:ntext',
            'status',
            'created_at',
        ],
    ]) ?>

</div>
