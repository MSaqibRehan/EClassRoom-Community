<?php 
 $user_id = Yii::$app->user->id;
 $user = Yii::$app->db->createCommand("SELECT user_type FROM user WHERE id = '$user_id'")->queryAll();
 $userType = $user[0]['user_type'];
 ?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo $userType; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

<?php 
    if ($userType == 'admin') {
     
 ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    // ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/home']],
                    ['label' => 'Student', 'icon' => 'address-card-o', 'url' => ['/student']],                   
                    ['label' => 'Student Enrollment', 'icon' => 'file-text-o', 'url' => ['/std-enrollment']],
                    ['label' => 'Teacher', 'icon' => 'user', 'url' => ['/teacher']],
                    ['label' => 'Teacher Class Enrollment', 'icon' => 'file-text', 'url' => ['/teacher-class-enrollment']],
                    ['label' => 'Announcements', 'icon' => 'microphone', 'url' => ['/announcement']],
                    ['label' => 'Assignment Upload', 'icon' => 'arrow-right', 'url' => ['/assignment-upload']],
                    ['label' => 'Assignment Submit', 'icon' => 'arrow-right', 'url' => ['/assignment-submit']],
                    ['label' => 'Assignment Remarks', 'icon' => 'arrow-right', 'url' => ['/assignment-remarks']],
                    ['label' => 'Inbox', 'icon' => 'arrow-right', 'url' => ['/inbox']],
                    ['label' => 'Quizz', 'icon' => 'arrow-right', 'url' => ['/quizz']],
                    ['label' => 'Quizz Remarks', 'icon' => 'arrow-right', 'url' => ['/quizz-remarks']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'System Settings',
                        'icon' => 'cogs',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Course Program', 'icon' => 'tasks', 'url' => ['/course-program'],],
                            ['label' => 'Session', 'icon' => 'calendar', 'url' => ['/session'],],
                            //['label' => 'Semester', 'icon' => 'braille', 'url' => ['/semester'],],
                            [
                                'label' => 'Semester',
                                'icon' => 'braille',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Semester No#', 'icon' => 'circle-o', 'url' => ['/semester'],],
                                    ['label' => 'Semester Subjects', 'icon' => 'list-alt', 'url' => ['/semester-subjects'],],
                                    // [
                                    //     'label' => 'Level Two',
                                    //     'icon' => 'circle-o',
                                    //     'url' => '#',
                                    //     'items' => [
                                    //         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                    //         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                    //     ],
                                    //  ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );   
    }
?>

<?php 
    if ($userType == 'teacher') {
     
 ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    // ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/home']],
                    ['label' => 'Student', 'icon' => 'address-card-o', 'url' => ['/student']],                   
                    ['label' => 'Student Enrollment', 'icon' => 'file-text-o', 'url' => ['/std-enrollment']],
                    ['label' => 'Teacher', 'icon' => 'user', 'url' => ['/teacher']],
                    ['label' => 'Teacher Class Enrollment', 'icon' => 'file-text', 'url' => ['/teacher-class-enrollment']],
                    ['label' => 'Announcements', 'icon' => 'microphone', 'url' => ['/announcement']],
                    ['label' => 'Class Handouts', 'icon' => 'file', 'url' => ['/class-handouts']],
                    ['label' => 'Assignment Upload', 'icon' => 'arrow-right', 'url' => ['/assignment-upload']],
                    ['label' => 'Assignment Submit', 'icon' => 'arrow-right', 'url' => ['/assignment-submit']],
                    ['label' => 'Assignment Remarks', 'icon' => 'arrow-right', 'url' => ['/assignment-remarks']],
                    ['label' => 'Inbox', 'icon' => 'arrow-right', 'url' => ['/inbox']],
                    ['label' => 'Quizz', 'icon' => 'arrow-right', 'url' => ['/quizz']],
                    ['label' => 'Quizz Remarks', 'icon' => 'arrow-right', 'url' => ['/quizz-remarks']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    // [
                    //     'label' => 'System Settings',
                    //     'icon' => 'cogs',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Course Program', 'icon' => 'tasks', 'url' => ['/course-program'],],
                    //         ['label' => 'Session', 'icon' => 'calendar', 'url' => ['/session'],],
                    //         //['label' => 'Semester', 'icon' => 'braille', 'url' => ['/semester'],],
                    //         [
                    //             'label' => 'Semester',
                    //             'icon' => 'braille',
                    //             'url' => '#',
                    //             'items' => [
                    //                 ['label' => 'Semester No#', 'icon' => 'circle-o', 'url' => ['/semester'],],
                    //                 ['label' => 'Semester Subjects', 'icon' => 'list-alt', 'url' => ['/semester-subjects'],],
                    //                 // [
                    //                 //     'label' => 'Level Two',
                    //                 //     'icon' => 'circle-o',
                    //                 //     'url' => '#',
                    //                 //     'items' => [
                    //                 //         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                 //         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                 //     ],
                    //                 //  ],
                    //             ],
                    //         ],
                    //     ],
                    // ],
                ],
            ]
        );   
    }
?>

<?php 
    if ($userType == 'student') {
     
 ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    // ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/home']],
                    //['label' => 'Student', 'icon' => 'address-card-o', 'url' => ['/student']],                   
                    //['label' => 'Student Enrollment', 'icon' => 'file-text-o', 'url' => ['/std-enrollment']],
                    //['label' => 'Teacher', 'icon' => 'user', 'url' => ['/teacher']],
                    //['label' => 'Teacher Class Enrollment', 'icon' => 'file-text', 'url' => ['/teacher-class-enrollment']],
                    //['label' => 'Announcements', 'icon' => 'microphone', 'url' => ['/announcement']],
                    ['label' => 'Class Handouts', 'icon' => 'file-pdf-o', 'url' => ['/class-handouts']],
                    //['label' => 'Assignment Upload', 'icon' => 'arrow-right', 'url' => ['/assignment-upload']],
                    ['label' => 'Assignment Submit', 'icon' => 'arrow-right', 'url' => ['/assignment-submit']],
                    ['label' => 'Assignment Remarks', 'icon' => 'arrow-right', 'url' => ['/assignment-remarks']],
                    ['label' => 'Inbox', 'icon' => 'arrow-right', 'url' => ['/inbox']],
                    ['label' => 'Quizz', 'icon' => 'arrow-right', 'url' => ['/quizz']],
                    ['label' => 'Quizz Remarks', 'icon' => 'arrow-right', 'url' => ['/quizz-remarks']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    // [
                    //     'label' => 'System Settings',
                    //     'icon' => 'cogs',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Course Program', 'icon' => 'tasks', 'url' => ['/course-program'],],
                    //         ['label' => 'Session', 'icon' => 'calendar', 'url' => ['/session'],],
                    //         //['label' => 'Semester', 'icon' => 'braille', 'url' => ['/semester'],],
                    //         [
                    //             'label' => 'Semester',
                    //             'icon' => 'braille',
                    //             'url' => '#',
                    //             'items' => [
                    //                 ['label' => 'Semester No#', 'icon' => 'circle-o', 'url' => ['/semester'],],
                    //                 ['label' => 'Semester Subjects', 'icon' => 'list-alt', 'url' => ['/semester-subjects'],],
                    //                 // [
                    //                 //     'label' => 'Level Two',
                    //                 //     'icon' => 'circle-o',
                    //                 //     'url' => '#',
                    //                 //     'items' => [
                    //                 //         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                 //         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                 //     ],
                    //                 //  ],
                    //             ],
                    //         ],
                    //     ],
                    // ],
                ],
            ]
        );   
    }
?>

    </section>

</aside>
