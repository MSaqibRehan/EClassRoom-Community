<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Inbox */
?>
<div class="inbox-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'inbox_id',
            'course_p_id',
            'session_id',
            'semester_id',
            'sender_name',
            'message:ntext',
            'created_at',
        ],
    ]) ?>

</div>
