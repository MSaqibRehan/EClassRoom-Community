<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ClassHandouts */
?>
<div class="class-handouts-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'handout_id',
            'course_p_id',
            'session_id',
            'semester_id',
            'sem_sub_id',
            'week',
            'lecture',
            'topic',
            'file',
            'description:ntext',
            'created_by',
            'created_at',
        ],
    ]) ?>

</div>
