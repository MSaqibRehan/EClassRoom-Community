<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StdEnrollment */
?>
<div class="std-enrollment-view">
 <?php
    $created_by = $model->created_by; // get the created_by (id)
    $updated_by = $model->updated_by;  // get the updated_by (id)

    // query to get the username by created_by (id) from table user
    $createdBy = Yii::$app->db->createCommand("SELECT username FROM user WHERE id = '$created_by'")->queryAll();
    if (!empty($createdBy)) {
        $createdBy = $createdBy[0]['username'];
        // $createdBy = $createdBy;
    }

    // query to get the username by updated_by (id) from table user
    $updatedBy = Yii::$app->db->createCommand("SELECT username FROM user WHERE id = '$updated_by'")->queryAll();
    if (!empty($updatedBy)) {
        $updatedBy = $updatedBy[0]['username'];
        //$updatedBy = "<span class='label label-default'>$updatedBy</span>";
    }
    else{
        $updatedBy = "<span class='label label-danger'>Not Updated</span>";
    }
    
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'std_enrol_id',
            'std.std_name',
            'session.session_duration',
            'semester.semester_no',
            //'created_by',
            'created_at',
            //'updated_by',
            'updated_at',
            [
             'attribute' => 'created_by',
             'format'=>'raw',
             'value'=> $createdBy,
            ],  
            [
             'attribute' => 'updated_by',
             'format'=>'raw',
             'value'=>  $updatedBy,
            ],
        ],
    ]) ?>

</div>
