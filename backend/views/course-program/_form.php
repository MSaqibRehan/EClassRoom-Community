<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CourseProgram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-program-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cp_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_of_semesters')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => 'Select Status...']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
