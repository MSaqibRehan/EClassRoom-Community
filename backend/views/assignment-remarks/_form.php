<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AssignmentRemarks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignment-remarks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'assign_id')->textInput() ?>

    <?= $form->field($model, 'assign_sub_id')->textInput() ?>

    <?= $form->field($model, 'obt_marks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
