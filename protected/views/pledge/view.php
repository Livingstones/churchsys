<?php
$this->breadcrumbs=array(
	'誓約'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'誓約列表', 'url'=>array('index')),
	array('label'=>'新增誓約', 'url'=>array('create')),
	array('label'=>'更改誓約', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'刪除誓約', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'你確定要刪除此誓約嗎?')),
	array('label'=>'誓約管理', 'url'=>array('admin')),
);
?>

<h1>誓約資料 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'name',
		'description',
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pledge-member-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => 'member',
			'header' => '會友 (編號)',
			'value' => '$data->member->name . " (" . $data->member->code . ")"',
		),
		array(
			'name' => 'group',
			'header' => '小組',
			'value' => '$data->member->groupNames',
		),
		'pledge_date',
		array
		(
			'class'=>'CButtonColumn',
			'template' => '{view}',
			'buttons' => array(
				'view' => array
				(
					'url' => 'Yii::app()->createUrl("member/view", array("id"=>$data->member_id))',
				),
			),
		),
	)
)); ?>