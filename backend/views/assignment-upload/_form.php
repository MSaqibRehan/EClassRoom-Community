<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Session;
use common\models\Semester;
use common\models\SemesterSubjects;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\AssignmentUpload */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignment-upload-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

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

    <?= $form->field($model, 'assign_no')->textInput() ?>

    <?= $form->field($model, 'assign_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assign_file')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assign_note')->textarea(['rows' => 6]) ?>

    <?php  
    echo '<label>Due Date</label>';
    echo DatePicker::widget([
    'model' => $model, 
    'attribute' => 'due_date',
    'options' => ['placeholder' => 'Select due date ...'],
    'convertFormat' => false,
    'pluginOptions' => [        
        'format' => 'yyyy-m-d',
        'autoclose'=>true,
        'todayHighlight' => true
    ]
    ]);
    ?>

    <?= $form->field($model, 'total_marks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Closed' => 'Closed', ], ['prompt' => 'Select Status....']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
