<?php
$this->breadcrumbs=array(
	'崇拜'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'崇拜列表', 'url'=>array('index')),
	array('label'=>'新增崇拜', 'url'=>array('create')),
	array('label'=>'更改崇拜', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'刪除崇拜', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>崇拜 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'start_time',
		'end_time',
		'weekly',
		'remarks',
	),
)); ?>
