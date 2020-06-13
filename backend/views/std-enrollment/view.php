<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StdEnrollment */
?>
<div class="std-enrollment-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'std_enrol_id',
            'std_id',
            'session_id',
            'semester_id',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
