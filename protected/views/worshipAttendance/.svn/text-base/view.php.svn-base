<?php
$this->breadcrumbs=array(
	'崇拜'=>array('index'),
	'崇拜出席',
);
?>

<h1>崇拜出席資料</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'worship-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'member_id',
			'header' => '會友 (編號)',
			'value' => '$data->member->name . " (" . $data->member->code . ")"',
		),
		array(
			'name' => 'worship_id',
			'header' => '崇拜',
			'value' => '$data->worship->name',
			'filter' => CHtml::listData(Worship::model()->findAll(), "id", "name"),
		),
		'attendance_date'
	),
)); ?>
