<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CourseProgram;
use common\models\Session;
use common\models\Semester;
use common\models\SemesterSubjects;
use common\models\Teacher;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Announcement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="announcement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_p_id')->dropDownList(
                ArrayHelper::map(CourseProgram::find()->all(),'cp_id','cp_name'),
                ['prompt'=>'Select Course Program ...',]
    )?>

    <?= $form->field($model, 'session_id')->dropDownList(
                ArrayHelper::map(Session::find()->all(),'session_id','session_duration'),
                ['prompt'=>'Select Session Duration ...',]
    )?>

    <?= $form->field($model, 'semester_id')->dropDownList(
                ArrayHelper::map(Semester::find()->all(),'semester_id','semester_no'),
                ['prompt'=>'Select Semester No ...',]
    )?>

    <?= $form->field($model, 'sem_sub_id')->dropDownList(
                ArrayHelper::map(SemesterSubjects::find()->all(),'sem_subj_id','subject_title'),
                ['prompt'=>'Select Semester Subject ...',]
    )?>

    <?= $form->field($model, 'teacher_id')->dropDownList(
                ArrayHelper::map(Teacher::find()->all(),'teacher_id','teacher_name'),
                ['prompt'=>'Select Teacher ...',]
    )?>

    <?= $form->field($model, 'announcement')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => 'Select Status ....']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
