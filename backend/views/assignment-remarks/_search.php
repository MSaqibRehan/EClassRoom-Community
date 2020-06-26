<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AssignmentRemarksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignment-remarks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'assign_remark_id') ?>

    <?= $form->field($model, 'assign_id') ?>

    <?= $form->field($model, 'assign_sub_id') ?>

    <?= $form->field($model, 'obt_marks') ?>

    <?= $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
