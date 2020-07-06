<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ClassHandouts */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $this->title = 'Add Class Handout';
      $this->params['breadcrumbs'][] = $this->title; ?>
<div class="class-handouts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_p_id')->hiddenInput() ?>

    <?= $form->field($model, 'session_id')->hiddenInput() ?>

    <?= $form->field($model, 'semester_id')->hiddenInput() ?>

    <?= $form->field($model, 'sem_sub_id')->hiddenInput() ?>

    <?= $form->field($model, 'week')->textInput() ?>

    <?= $form->field($model, 'lecture')->textInput() ?>

    <?= $form->field($model, 'topic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
