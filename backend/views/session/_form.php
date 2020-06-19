<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Session */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="session-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'session_duration')->textInput(['maxlength' => true]) ?>

    <?php  
    echo '<label>Session Start Date</label>';
    echo DatePicker::widget([
    'model' => $model, 
    'attribute' => 'session_start_date',
    'options' => ['placeholder' => 'Select start date ...'],
    'convertFormat' => false,
    'pluginOptions' => [        
        'format' => 'yyyy-m-d',
        'autoclose'=>true,
        'todayHighlight' => true
    ]
    ]);
    ?>

    <?php  
    echo '<label>Session End Date</label>';
    echo DatePicker::widget([
    'model' => $model, 
    'attribute' => 'session_end_date',
    'options' => ['placeholder' => 'Select end date ...'],
    'convertFormat' => false,
    'pluginOptions' => [        
        'format' => 'yy-m-d',
        'autoclose'=>true,
        'todayHighlight' => true
    ]
    ]);
    ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
