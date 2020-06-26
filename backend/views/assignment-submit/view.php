<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AssignmentSubmit */
?>
<div class="assignment-submit-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'assign_sub_id',
            'assign_id',
            'std_id',
            'attach_file',
            'submit_date',
            'status',
        ],
    ]) ?>

</div>
