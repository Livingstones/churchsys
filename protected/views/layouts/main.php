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
				<span class="title"><?php echo CHtml::encode(Yii::app()->name); ?></span>
			</div>
		</div>
	</div><!-- header -->
	<div id="header-box">
		<div id="myslidemenu" class="jqueryslidemenu">
			<?php $this->widget('zii.widgets.CMenu', array(
			    'items'=>array(
			        array('label'=>'首頁', 'url'=>array('/site/index')),
			        array('label'=>'簽到系統', 'url'=>array('/worshipAttendance/take'), 'visible'=>Yii::app()->user->checkAccess('operateWorship')),
			        array('label'=>'崇拜資料', 'url'=>array('/worship/admin'), 'visible'=>Yii::app()->user->checkAccess('manageWorship'), 'items'=>array(
			            array('label'=>'會友出席資料', 'url'=>array('/worshipAttendance/listByMember'), 'visible'=>Yii::app()->user->checkAccess('manageWorship')),
			            array('label'=>'崇拜出席資料', 'url'=>array('/worshipAttendance/listByWorship'), 'visible'=>Yii::app()->user->checkAccess('manageWorship')),
			            array('label'=>'崇拜資料', 'url'=>array('/worship/admin'), 'visible'=>Yii::app()->user->checkAccess('manageWorship')),
			            array('label'=>'歡迎詞', 'url'=>array('/worshipGreeting/index'), 'visible'=>Yii::app()->user->checkAccess('manageWorship')),
			            array('label'=>'崇拜報告', 'url'=>array('/worship/report'), 'visible'=>Yii::app()->user->checkAccess('manageWorship')),
			        )),
			        array('label'=>'小組', 'url'=>array('/group/viewOwn'), 'visible'=>(Yii::app()->user->checkAccess('manageGroup') || GroupMember::model()->count("member_id=:member_id AND member_type=:member_type", array(":member_id"=>Yii::app()->user->id, ":member_type"=>GroupMember::MEMBER_TYPE_LEADER))), 'items'=>array(
			            array('label'=>'小組時段', 'url'=>array('/groupPeriod/admin'), 'visible'=>Yii::app()->user->checkAccess('manageGroupPeriod')),
			            array('label'=>'小組資料', 'url'=>array('/group/viewOwn'), 'visible'=>Yii::app()->user->checkAccess('manageGroup') || GroupMember::model()->count("member_id=:member_id AND member_type=:member_type", array(":member_id"=>Yii::app()->user->id, ":member_type"=>GroupMember::MEMBER_TYPE_LEADER))),
			        )),
			        array('label'=>'會友', 'url'=>array('/member/admin'), 'visible'=>Yii::app()->user->checkAccess('manageMember'), 'items'=>array(
			            array('label'=>'會友資料', 'url'=>array('/member/admin'), 'visible'=>Yii::app()->user->checkAccess('manageMember')),			            
			            array('label'=>'合併重覆會友', 'url'=>array('member/duplicate'), 'visible'=>Yii::app()->user->checkAccess('manageMember')),			            
			        )),
			        array('label'=>'誓約', 'url'=>array('/pledge/admin'), 'visible'=>Yii::app()->user->checkAccess('managePledge'), 'items'=>array(
			            array('label'=>'誓約資料', 'url'=>array('/pledge/admin'), 'visible'=>Yii::app()->user->checkAccess('managePledge')),
			        )),
			        array('label'=>'課程', 'url'=>array('/course/admin'), 'visible'=>Yii::app()->user->checkAccess('manageCourse'), 'items'=>array(
			            array('label'=>'課程資料', 'url'=>array('/course/admin'), 'visible'=>Yii::app()->user->checkAccess('manageCourse')),
			        )),
			        array('label'=>'詩歌庫', 'url'=>array('/hymn/admin'), 'visible'=>Yii::app()->user->checkAccess('manageHymn') || Yii::app()->user->checkAccess('operateHymn'), 'items'=>array(
			            array('label'=>'詩歌資料', 'url'=>array('/hymn/admin'), 'visible'=>Yii::app()->user->checkAccess('manageHymn') || Yii::app()->user->checkAccess('operateHymn')),
			        )),
			        array('label'=>'問題回報', 'url'=>array('/issues/index'), 'visible'=>!Yii::app()->user->isGuest),
			    	array('label'=>'更新帳戶', 'url'=>array('/user/updateAccount'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'權限設定', 'url'=>array('/rights'), 'visible'=>Yii::app()->user->checkAccess(Rights::module()->superuserName)),
			    	array('label'=>'登出', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			    ),
			));
			?>
		</div>
		<div class="clr"></div>
	</div>
	
	<div id="content-box">
		<div id="breadcrumbs">
<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
		'homeLink'=>'<a href="index.php?r=Site/index">首頁</a>'
	)); ?>
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
