<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Teacher;
use common\models\Session;
use common\models\Semester;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\TeacherClassEnrollment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-class-enrollment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'teacher_id')->dropDownList(
                ArrayHelper::map(Teacher::find()->all(),'teacher_id','teacher_name'),
                ['prompt'=>'Select Teacher ...',]
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
