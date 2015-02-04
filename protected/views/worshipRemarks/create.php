<?php
$this->breadcrumbs=array(
	'Worship Remarks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WorshipRemarks', 'url'=>array('index')),
	array('label'=>'Manage WorshipRemarks', 'url'=>array('admin')),
);
?>

<h1>Create WorshipRemarks</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>