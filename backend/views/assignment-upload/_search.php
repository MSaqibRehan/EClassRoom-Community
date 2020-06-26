<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AssignmentUploadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignment-upload-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'assign_id') ?>

    <?= $form->field($model, 'session_id') ?>

    <?= $form->field($model, 'semester_id') ?>

    <?= $form->field($model, 'sem_sub_id') ?>

    <?= $form->field($model, 'uploaded_by') ?>

    <?php // echo $form->field($model, 'assign_no') ?>

    <?php // echo $form->field($model, 'assign_title') ?>

    <?php // echo $form->field($model, 'assign_file') ?>

    <?php // echo $form->field($model, 'assign_note') ?>

    <?php // echo $form->field($model, 'due_date') ?>

    <?php // echo $form->field($model, 'total_marks') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
