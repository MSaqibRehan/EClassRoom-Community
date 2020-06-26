<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AssignmentUpload */
?>
<div class="assignment-upload-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'assign_id',
            'session_id',
            'semester_id',
            'sem_sub_id',
            'uploaded_by',
            'assign_no',
            'assign_title',
            'assign_file',
            'assign_note:ntext',
            'due_date',
            'total_marks',
            'status',
            'created_at',
        ],
    ]) ?>

</div>
