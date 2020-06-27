<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Quizz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quizz-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_p_id')->textInput() ?>

    <?= $form->field($model, 'session_id')->textInput() ?>

    <?= $form->field($model, 'semester_id')->textInput() ?>

    <?= $form->field($model, 'sem_sub_id')->textInput() ?>

    <?= $form->field($model, 'uploaded_by')->textInput() ?>

    <?= $form->field($model, 'quizz_no')->textInput() ?>

    <?= $form->field($model, 'quizz_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quizz_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quizz_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'total_marks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Closed' => 'Closed', ], ['prompt' => 'Select Status...']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
