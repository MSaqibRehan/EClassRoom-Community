<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CourseProgram;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model common\models\Semester */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="semester-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_p_id')->dropDownList(
                ArrayHelper::map(CourseProgram::find()->all(),'cp_id','cp_name'),
                ['prompt'=>'Select Course Program ...',]
    )?>

    <?= $form->field($model, 'semester_no')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
