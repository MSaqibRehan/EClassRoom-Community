<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\models\Session;
use common\models\Semester;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Register Student';
$this->params['breadcrumbs'][] = $this->title;


?>
<style type="text/css">
    fieldset {
  display: block;
        margin: 20px 0px;
  padding-top: 1em;
  padding-bottom: 1em;
  padding-left: 0.75em;
  padding-right: 0.75em;
  border: 2px groove #3C8CBC;
}
legend {
    width:inherit; /* Or auto */
    padding:0 10px; /* To give a bit of padding on the left and right */
    border-bottom:none;
    font-size:30px;
    font-weight: bold;
    font-style: italic;
}
</style>
<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($umodel, 'user_type')->hiddenInput(['value' => 'student'])->label(false); ?>
    <fieldset>
  <legend>Student Details</legend>
    <div class="rows">
        <div class="col-md-6">
            <?= $form->field($model, 'std_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'std_father_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'std_cnic')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '99999-9999999-9', ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'std_reg_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'std_gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', ], ['prompt' => 'Select gender ...']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'std_mobile_no')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '+99-999-9999999', ]) ?>
        </div>
        <div class="col-md-6">
            <?php  
                echo '<label>Date of Birth</label>';
                echo DatePicker::widget([
                'model' => $model, 
                'attribute' => 'std_dob',
                'options' => ['placeholder' => 'Select date ...'],
                'convertFormat' => false,
                'pluginOptions' => [        
                    'format' => 'yy-m-d',
                    'autoclose'=>true,
                    'todayHighlight' => true
                ]
                ]);
                ?>
            
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'std_address')->textarea(['rows' => 6]) ?>
        </div>
    </div>
</fieldset>
   <!--  <?= $form->field($model, 'user_id')->textInput() ?> -->
<!--==================== User Login Details ===================  -->
    

                

                
    <fieldset>
        <legend>Student Login Details</legend>
        <div class="row">
            
            <div class="col-md-6">
                <?= $form->field($umodel, 'username')->textInput(['autofocus' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($umodel, 'password')->passwordInput() ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($umodel, 'email') ?>
            </div>
        </div>
    </fieldset>



    <!-- ==================== Std Enrollment ===================== -->

    <fieldset>
        <legend>Student Enrollment Details</legend>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($enmodel, 'session_id')->dropDownList(
                    ArrayHelper::map(Session::find()->all(),'session_id','session_duration'),
                    ['prompt'=>'Select Session Duration ...',]
                 )?>
            </div>
            <div class="col-md-6">
                <?= $form->field($enmodel, 'semester_id')->dropDownList(
                    ArrayHelper::map(Semester::find()->all(),'semester_id','semester_no'),
                    ['prompt'=>'Select Semester No ...',]
                )?>
            </div>
        </div>

    </fieldset>
    
    

    
    <br>
    

    

    <!-- ========================== -->

    

    

    <!-- =================== -->

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
