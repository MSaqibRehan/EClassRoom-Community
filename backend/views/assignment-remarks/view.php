<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AssignmentRemarks */
?>
<div class="assignment-remarks-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'assign_remark_id',
            'assign_id',
            'assign_sub_id',
            'obt_marks',
            'remarks:ntext',
            'created_at',
        ],
    ]) ?>

</div>
