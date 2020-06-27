<?php
use yii\helpers\Html;
use common\models\Assignment;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AssignmentSubmit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignment-submit-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'assign_id')->dropDownList(
                ArrayHelper::map(Assignment::find()->all(),'assign_id','assign_title'),
                ['prompt'=>'Select Assignment ...',]
    )?>

    <?= $form->field($model, 'std_id')->textInput() ?>

    <?= $form->field($model, 'attach_file')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'submit_date')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Unmarked' => 'Unmarked', 'Marked' => 'Marked', ], ['prompt' => '']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
