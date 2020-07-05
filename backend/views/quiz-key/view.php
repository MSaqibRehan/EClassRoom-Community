<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\QuizKey */
?>
<div class="quiz-key-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'quiz_key_id',
            'quiz_id',
            'quiz_key',
        ],
    ]) ?>

</div>
