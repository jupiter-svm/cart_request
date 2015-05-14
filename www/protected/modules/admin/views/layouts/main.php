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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui/jquery-ui.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui/jquery-ui.min.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?php echo $sitename; ?>
<div class="container" id="page">

        <?php if($this->getSetting()->show_header): ?>
            <div id="header">
                    <div id="logo"><?php echo $this->getSetting()->site_name; ?></div>
            </div><!-- header -->
        <?php endif; ?>
        

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Админка', 'url'=>array('/admin')),
				array('label'=>'Заявки', 'url'=>array('/admin/request')),				
				array('label'=>'Ассортимент', 'url'=>array('/admin/cartridge')),				
				array('label'=>'Лимиты', 'url'=>array('/admin/limits')),				
				array('label'=>'Периоды', 'url'=>array('/admin/timeperiod')),				
				array('label'=>'Адреса', 'url'=>array('/admin/address')),				
				array('label'=>'Пользователи', 'url'=>array('/admin/user')),
                                array('label'=>'Свод', 'url'=>array('/admin/totalrequest')),						                             
				array('label'=>'Настройки', 'url'=>array('/admin/setting')),
                                array('label'=>'На сайт', 'url'=>array('/site/index'))
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
