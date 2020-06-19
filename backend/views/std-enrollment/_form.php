<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Student;
use common\models\Session;
use common\models\Semester;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\StdEnrollment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="std-enrollment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'std_id')->dropDownList(
                ArrayHelper::map(Student::find()->all(),'std_id','std_name'),
                ['prompt'=>'Select Student ...',]
    )?>

    <?= $form->field($model, 'session_id')->dropDownList(
                ArrayHelper::map(Session::find()->all(),'session_id','session_duration'),
                ['prompt'=>'Select Session Duration ...',]
    )?>

    <?= $form->field($model, 'semester_id')->dropDownList(
                ArrayHelper::map(Semester::find()->all(),'semester_id','semester_no'),
                ['prompt'=>'Select Semester No ...',]
    )?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
