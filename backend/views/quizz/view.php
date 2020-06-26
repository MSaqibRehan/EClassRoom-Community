<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Quizz */
?>
<div class="quizz-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'quizz_id',
            'course_p_id',
            'session_id',
            'semester_id',
            'sem_sub_id',
            'uploaded_by',
            'quizz_no',
            'quizz_title',
            'quizz_file',
            'quizz_note:ntext',
            'total_marks',
            'status',
            'created_at',
        ],
    ]) ?>

</div>
