<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SemesterSubjects */
?>
<div class="semester-subjects-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sem_subj_id',
            'course_p_id',
            'semester_id',
            'subject_no',
            'subject_title',
            'subject_description',
            'subject__code',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
