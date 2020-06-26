<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QuizzRemarksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quizz-remarks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'quizz_remark_id') ?>

    <?= $form->field($model, 'quizz_id') ?>

    <?= $form->field($model, 'std_id') ?>

    <?= $form->field($model, 'remarks') ?>

    <?= $form->field($model, 'obt_marks') ?>

    <?php // echo $form->field($model, 'quizz_key') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
