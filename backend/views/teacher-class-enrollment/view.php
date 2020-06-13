<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TeacherClassEnrollment */
?>
<div class="teacher-class-enrollment-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tce_id',
            'teacher_id',
            'session_id',
            'semester_id',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
