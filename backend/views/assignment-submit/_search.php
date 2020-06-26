<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AssignmentSubmitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignment-submit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'assign_sub_id') ?>

    <?= $form->field($model, 'assign_id') ?>

    <?= $form->field($model, 'std_id') ?>

    <?= $form->field($model, 'attach_file') ?>

    <?= $form->field($model, 'submit_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
