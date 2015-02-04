<?php
$this->breadcrumbs=array(
	'Summer Activities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SummerActivity', 'url'=>array('index')),
	array('label'=>'Create SummerActivity', 'url'=>array('create')),
	array('label'=>'Update SummerActivity', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SummerActivity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SummerActivity', 'url'=>array('admin')),
);
?>

<h1>View SummerActivity #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'activity_name',
		'description',
		'person_in_charge',
	),
)); ?>
