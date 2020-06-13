<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CourseProgram */
?>
<div class="course-program-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cp_id',
            'cp_name',
            'no_of_semesters',
            'status',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
