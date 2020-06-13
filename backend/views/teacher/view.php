<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Teacher */
?>
<div class="teacher-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'teacher_id',
            'user_id',
            'teacher_name',
            'teacher_father',
            'teacher_mobile_no',
            'teacher_gender',
            'teacher_dob',
            'teacher_address:ntext',
            'status',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
