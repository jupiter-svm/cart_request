<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui/jquery-ui.min.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
        
        <?php if($this->getSetting()->show_header): ?>
            <div id="header">
                    <div id="logo"><?php echo $this->getSetting()->site_name; ?></div>
            </div><!-- header -->
        <?php endif; ?>

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
                        'encodeLabel'=>false, //Для того, чтобы можно было вставлять ссылки в label. Пока не используется и не работает соответственно
			'items'=>array(
				array('label'=>'Главная', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Заявки', 'url'=>array('/request'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Ассортимент', 'url'=>array('/cartridge'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Инструкции', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Обратная связь', 'url'=>array('/site/contact')),
				array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                array('label'=>'Учётные данные', 'url'=>array('/user'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Админцентр', 'url'=>array('/admin'), 'visible'=>Yii::app()->user->role==2),
				array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)				
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<!-- Чиков Андрей Викторович<br/> -->
                <b><?=CHtml::link('Ростелеком', 'http://my.rt.ru'); ?><b><br/>
		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
