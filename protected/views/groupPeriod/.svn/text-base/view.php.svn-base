<?php
$this->breadcrumbs=array(
	'小組時段'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'小組時段列表', 'url'=>array('admin')),
	array('label'=>'新增小組時段', 'url'=>array('create')),
	array('label'=>'更改小組時段', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'刪除小組時段', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>小組時段 資料#<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'group-period-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'class' => 'CLinkColumn',
			'header' => '小組',
			'labelExpression' => '$data->name',
			'urlExpression' => 'Yii::app()->createUrl("/group/view&id=" . $data->id)',
		),
		'membersCount',
		array
		(
			'class'=>'CButtonColumn',
			'template' => '{view}',
			'buttons' => array(
				'view' => array
				(
					'url' => 'Yii::app()->createUrl("group/view", array("id"=>$data->id))',
				),
			),
		),
	)
)); ?>