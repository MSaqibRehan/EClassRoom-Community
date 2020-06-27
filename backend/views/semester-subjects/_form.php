<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\SemesterSubjects;
use common\models\Semester;
use common\models\CourseProgram;
use common\models\Session;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\SemesterSubjects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="semester-subjects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_p_id')->dropDownList(
        ArrayHelper::map(CourseProgram::find()->all(),'cp_id','cp_name'),
        ['prompt'=>'Select Course Program ...',
        'onchange'=>'
        $.post("./semsub?id="+$(this).val(), function( data ) {
        $( "select#semsub" ).html( data );
        });
        ']
    )?>

    <?= $form->field($model, 'semester_id')->dropDownList(
        ArrayHelper::map(Semester::find()->all(),'semester_id','semester_no'),
        ['prompt'=>'Select Semester ...','id'=>'semsub']
    )?>

    <?= $form->field($model, 'subject_no')->textInput() ?>

    <?= $form->field($model, 'subject_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject__code')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
