<?php
$this->breadcrumbs=array(
	'Worship Remarks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WorshipRemarks', 'url'=>array('index')),
	array('label'=>'Create WorshipRemarks', 'url'=>array('create')),
	array('label'=>'Update WorshipRemarks', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WorshipRemarks', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WorshipRemarks', 'url'=>array('admin')),
);
?>

<h1>View WorshipRemarks #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'worship_id',
		'worship_date',
		'remarks',
	),
)); ?>
