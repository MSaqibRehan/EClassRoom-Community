<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Session */
?>
<div class="session-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'session_id',
            'session_duration',
            'session_start_date',
            'session_end_date',
            'status',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
