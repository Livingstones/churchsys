<?php
$this->breadcrumbs=array(
	'Worship Remarks',
);

$this->menu=array(
	array('label'=>'Create WorshipRemarks', 'url'=>array('create')),
	array('label'=>'Manage WorshipRemarks', 'url'=>array('admin')),
);
?>

<h1>Worship Remarks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
