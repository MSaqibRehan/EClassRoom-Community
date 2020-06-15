<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SemesterSubjects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="semester-subjects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subj_1_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subj_1_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subj_2_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subj_2_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subj_3_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subj_3_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subj_4_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subj_4_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subj_5_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subj_5_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subj_6_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subj_6_description')->textInput(['maxlength' => true]) ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
