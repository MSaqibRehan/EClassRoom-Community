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
            'subj_1_title',
            'subj_1_description',
            'subj_2_title',
            'subj_2_description',
            'subj_3_title',
            'subj_3_description',
            'subj_4_title',
            'subj_4_description',
            'subj_5_title',
            'subj_5_description',
            'subj_6_title',
            'subj_6_description',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
