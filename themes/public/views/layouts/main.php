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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rounded.css" />
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/js/jqueryslidemenu/jqueryslidemenu.css"); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/css/gridview.css"); ?>

<?php Yii::app()->clientScript->registerCoreScript("jquery"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/jqueryslidemenu/jqueryslidemenu.js"); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<div id="border-top" class="h_teal">
		<div>
			<div>
				<span class="title">基督教宣道會活石堂</span>
			</div>
		</div>
	</div><!-- header -->
	<div id="header-box">
		<div id="myslidemenu" class="jqueryslidemenu">
		</div>
		<div class="clr"></div>
	</div>
	
	<div id="content-box">
		<div id="breadcrumbs">
		</div>
		<div class="clr"></div>
		<div class="padding">
			<?php echo $content; ?>
		</div>
		<div id="loading-bar"><span>&nbsp;</span></div>
	</div>
	<div id="border-bottom"><div><div></div></div></div>
	
	<div id="footer">
		<p class="copyright">
			ChurchSys 教會系統易&copy;基督教宣道會活石堂
		</p>
	</div>

</body>
</html>
