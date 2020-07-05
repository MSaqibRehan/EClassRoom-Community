<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style type="text/css" >
    	.login-page{
    		background:url('uploads/login.jpg') no-repeat center center fixed; 
    		background-size: cover;
    	}
    	.login-box-body{
			background-color: #cce6ff;
			border-bottom-right-radius:  20px;
    		border-bottom-left-radius:  20px;
    	}
    	.login-logo{
    		background-color: #cce6ff;
    		margin-bottom: 0px;
    		border-top-right-radius:  20px;
    		border-top-left-radius:  20px;
    		padding: 30px 20px;
    	}
    	#loginform-username,#loginform-password{
    		border-radius: 10px;
    		background-color: #fff;
    	}
    	#loginbtn{
    		border-radius: 10px;
    	}
    	.login-box{
    		margin-top:70px;
    		border-radius: 20px;
    	}
    </style>
</head>
<body class="login-page pull-left col-sm-offset-2" >

<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
