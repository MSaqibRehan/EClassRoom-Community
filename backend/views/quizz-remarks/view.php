<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\QuizzRemarks */
?>
<div class="quizz-remarks-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'quizz_remark_id',
            'quizz_id',
            'std_id',
            'remarks:ntext',
            'obt_marks',
            'quizz_key',
            'created_at',
        ],
    ]) ?>

</div>
