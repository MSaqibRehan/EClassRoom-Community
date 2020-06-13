<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
?>
<div class="student-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'std_id',
            'user_id',
            'std_reg_no',
            'std_name',
            'std_father_name',
            'std_gender',
            'std_dob',
            'std_address:ntext',
            'std_mobile_no',
            'status',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
