<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Semester */
?>
<div class="semester-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'semester_id',
            'course_p_id',
            'semester_no',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
