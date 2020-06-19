<?php
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Teacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'teacher_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teacher_father')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teacher_mobile_no')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '+99-999-9999999', ]) ?>

    <?= $form->field($model, 'teacher_gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', ], ['prompt' => 'Select gender ...']) ?>
    
    <?php  
    echo '<label>Date of Birth</label>';
    echo DatePicker::widget([
    'model' => $model, 
    'attribute' => 'teacher_dob',
    'options' => ['placeholder' => 'Select date ...'],
    'convertFormat' => false,
    'pluginOptions' => [        
        'format' => 'yyyy-m-d',
        'autoclose'=>true,
        'todayHighlight' => true
    ]
    ]);
    ?>
    <br>

    <?= $form->field($model, 'teacher_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => 'Select Status ...']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
