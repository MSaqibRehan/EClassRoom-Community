<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    //     [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'quizz_id',
    // ],
    [ 
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'course_p_id',
        'value'=>'courseP.cp_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'session_id',
        'value'=>'session.session_duration',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'semester_id',
        'value'=>'semester.semester_no',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'sem_sub_id',
        'value'=>'semSub.subject_title',
    ],
    // [ 
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'uploaded_by',
    //     'value'=>'uploadedBy.teacher_name',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'quizz_no',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'quizz_title',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'quizz_file',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'quizz_note',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'total_marks',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   