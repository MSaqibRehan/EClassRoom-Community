<?php
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;
use common\models\Semester;
use common\models\SemesterSubjects;
use common\models\Session;
/* @var $this yii\web\View */
/* @var $model common\models\Teacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin(['id' => 'teacher-form']); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'teacher_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teacher_father')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'teacher_cnic')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '99999-9999999-9', ]) ?>

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


    <!-- ========================================= -->

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Teacher </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 6, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $tenmodel[0],
                'formId' => 'dynamic-form',
                 'id' => 'dynamic-form', 
                 'formId' => 'teacher-form',
                'formFields' => [
                    'session_id',
                    'semester_id',
                ],
            ]); ?>

            <div class="container-items" ><!-- widgetContainer -->
            <?php foreach ($tenmodel as $i => $tmodel): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Address</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($tmodel, "[{$i}]session_id")->dropDownList(
                                    ArrayHelper::map(Session::find()->all(),'session_id','session_duration'),
                                    ['prompt'=>'Select Session Duration ...',]
                                )?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($tmodel, "[{$i}]semester_id")->dropDownList(
                                    ArrayHelper::map(Semester::find()->all(),'semester_id','semester_no'),
                                    ['prompt'=>'Select Semester No ...',
                                'onchange'=>'
                                $.post("teacher/sem-sub&id="+$(this).val(), function( data ) {
                                $( "select#semsub" ).html( data );
                                });
                                ']);?>
                            </div>
                            <div class="col-sm-4">
                                <?php echo $form->field($tmodel, "[{$i}]sem_sub_id")
                                    ->dropDownList(
                                    ArrayHelper::map(SemesterSubjects::find()->all(),'sem_subj_id','subject_title'),
                                    ['prompt'=>'','id'=>'semsub']
                                );?>
                                
                            </div>
                        </div><!-- .row -->
                        
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    

    <!-- ================================================================= -->
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
