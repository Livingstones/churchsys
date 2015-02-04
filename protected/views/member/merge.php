<?php
$this->breadcrumbs=array(
	'會友'=>array('index'),
	'合併重覆會友'=>array('duplicate'),
	'合併 ' . $duplicate_members[0]->name
);
?>

<h1>合併者資料</h1>
<?php foreach ($duplicate_members as $member) : ?>
	<div style="float: left; width: 45%;">
	<?php echo $this->renderPartial("_view", array("model"=>$member)); ?>
	</div>
<?php endforeach; ?>
<div style="clear: both;"></div>

<h1>合併為</h1>
<div>
	<?php echo $this->renderPartial("_form", array("model"=>$merged_member)); ?>
</div>