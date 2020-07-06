<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
     'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'backup' => [
            'class' => 'spanjeta\modules\backup\Module',
        ], 
    ],
    'components' => [
        'request' => [
             'class' => 'common\components\Request',
            'web'=> '/backend/web',
            'adminUrl' => '/admin',
            'csrfParam' => '_csrf-backend',

        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'eClassroom & Community',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                   '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                ],
            ],
        ],
         'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                
                'admin'  => 'admin',
                'user'   => 'admin/user/index',
                'login'  => 'site/login',
                'logout' => 'site/login',
                'home' => 'site/index',
                'passwords'      => 'site/passwords',
                'user-profile'   => 'site/user-profile',
                'update-profile' => 'site/update-profile',
                //student
                'student' => 'student/index',
                'create-student' => 'student/create',
                //tracher
                'teacher' => 'teacher/index',
                'create-teacher' => 'teacher/create',
                'find-sub' => 'teacher/subs',

                // sem subjs
                'semester-subject' =>'semester-subjects/index',
                'semsub'        => 'semester-subjects/semsub',

                // inbox
                'inbox'     => 'inbox/index',
                'send-message'=> 'inbox/send',

                // class handouts
                'class-handouts-view'     => 'class-handouts/index',
                'create'     => 'class-handouts/create',
                'handouts-detail-view' => 'class-handouts/handouts-detail-view',
                'handouts-std-view' => 'class-handouts/handouts-std-view',
            ],
        ],
        
    ],
    'params' => $params,
];
