<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QuizzSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quizz-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'quizz_id') ?>

    <?= $form->field($model, 'course_p_id') ?>

    <?= $form->field($model, 'session_id') ?>

    <?= $form->field($model, 'semester_id') ?>

    <?= $form->field($model, 'sem_sub_id') ?>

    <?php // echo $form->field($model, 'uploaded_by') ?>

    <?php // echo $form->field($model, 'quizz_no') ?>

    <?php // echo $form->field($model, 'quizz_title') ?>

    <?php // echo $form->field($model, 'quizz_file') ?>

    <?php // echo $form->field($model, 'quizz_note') ?>

    <?php // echo $form->field($model, 'total_marks') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
