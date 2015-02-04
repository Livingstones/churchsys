<?php
$this->breadcrumbs=array(
	'會友'=>array('index'),
	'合併重覆會友',
);

$panels = array();
?>

<h1>合併重覆會友(只限臨時會友)</h1>

<?php foreach ($duplicate_members as $members) : ?>
	<?php echo CHtml::link($members[0]->name . ' - (' . count($members) . ' contacts)', $this->createUrl('merge', array("id"=>$members[0]->id)))?><br/>
<?php endforeach; ?>
