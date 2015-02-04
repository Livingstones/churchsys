<?php
$this->breadcrumbs=array(
	'小組'=>array('index'),
	$model->name,
);

if (Yii::app()->user->checkAccess("manageGroup"))
{
	$this->menu=array(
		array('label'=>'小組列表', 'url'=>array('admin')),
		array('label'=>'新增小組', 'url'=>array('create')),
		array('label'=>'更改小組', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'小組出席管理', 'url'=>array('groupAttendance/view', 'id'=>$model->id)),
		//array('label'=>'刪除小組', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		//array('label'=>'小組管理', 'url'=>array('admin')),
	);
}
elseif (Yii::app()->user->checkAccess("manageOwnGroup", array("group"=>$model)))
{
	$this->menu=array(
		array('label'=>'更改小組', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'小組出席管理', 'url'=>array('groupAttendance/view', 'id'=>$model->id)),
	);
}
?>

<h1>小組資料 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'period.name',
		array(
            'label'=>'組長',
            'type'=>'raw',
            'value'=>CHtml::encode($model->leadersName),
        ),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'group-period-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'class' => 'CLinkColumn',
			'header' => '會友 (編號)',
			'labelExpression' => '$data->name . " (" . $data->code . ")"',
			'urlExpression' => 'Yii::app()->createUrl("/member/view&id=" . $data->id)',
		),
		'contact_mobile',
		array(
			'name' => 'birthday',
			'header' => '生日',
			'type' => 'raw',
			'value' => 'date("d/m", strtotime($data->birthday))',
			'filter' => '',
		),
		array(
			'name' => 'worshipAttendancesLastDate',
			'header' => '最後一次<br/>崇拜出席',
			'value' => 'empty($data->worshipAttendancesLastDate) ? "--" : $data->worshipAttendancesLastDate . " (" . $data->worshipAttendances[0]->worship->name . ")"',
			'filter' => '',
		),
		array(
			'name' => 'worshipAttendancesTwoMonthCount',
			'header' => '近兩個月<br/>崇拜次數',
			'type' => 'number',
			'value' => '$data->worshipAttendancesTwoMonthCount',
			'filter' => '',
		),
		array(
			'name' => 'groupAttendancesLastDate',
			'header' => '最後一次<br/>小組出席',
			'value' => 'empty($data->groupAttendancesLastDate) ? "--" : $data->groupAttendancesLastDate . " (" . $data->groupAttendances[0]->group->name . ")"',
			'filter' => '',
		),
		array(
			'name' => 'groupAttendancesTwoMonthCount',
			'header' => '近兩個月<br/>小組次數',
			'type' => 'number',
			'value' => '$data->groupAttendancesTwoMonthCount',
			'filter' => '',
		),
		array
		(
			'class'=>'CButtonColumn',
			'template' => '{view}',
			'buttons' => array(
				'view' => array
				(
					'url' => 'Yii::app()->createUrl("member/view", array("id"=>$data->id))',
				),
			),
		),
	)
)); ?>