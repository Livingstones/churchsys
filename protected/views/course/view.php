<?php
$this->breadcrumbs=array(
	'課程'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'課程出席表', 'url'=>array('courseAttendance/view', 'id'=>$model->id)),
	array('label'=>'新增課程', 'url'=>array('create')),
	array('label'=>'更改課程', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'刪除課程', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'課程列表', 'url'=>array('admin')),
);
?>

<h1>課程資料 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'name',
		'start_date',
		'end_date',
		'lesson_time',
		'venue',
		'teacher',
		'state',
	),
)); ?>

<h1>會友資料</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'course-period-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'class' => 'CLinkColumn',
			'header' => '會友 (編號)',
			'labelExpression' => '$data->member->name . " (" . $data->member->code . ")"',
			'urlExpression' => 'Yii::app()->createUrl("/member/view&id=" . $data->member->id)',
		),
		'member.contact_mobile',
		array(
			'name' => 'member.birthday',
			'header' => '生日',
			'type' => 'raw',
			'value' => 'date("d/m", strtotime($data->member->birthday))',
			'filter' => '',
		),
		array(
			'name' => 'worshipAttendancesLastDate',
			'header' => '最後一次<br/>崇拜出席',
			'value' => 'empty($data->member->worshipAttendancesLastDate) ? "--" : $data->member->worshipAttendancesLastDate . " (" . $data->member->worshipAttendances[0]->worship->name . ")"',
			'filter' => '',
		),
		array(
			'name' => 'worshipAttendancesTwoMonthCount',
			'header' => '近兩個月<br/>崇拜次數',
			'type' => 'number',
			'value' => '$data->member->worshipAttendancesTwoMonthCount',
			'filter' => '',
		),
		array(
			'name' => 'groupAttendancesLastDate',
			'header' => '最後一次<br/>小組出席',
			'value' => 'empty($data->member->groupAttendancesLastDate) ? "--" : $data->member->groupAttendancesLastDate . " (" . $data->member->groupAttendances[0]->group->name . ")"',
			'filter' => '',
		),
		array(
			'name' => 'groupAttendancesTwoMonthCount',
			'header' => '近兩個月<br/>小組次數',
			'type' => 'number',
			'value' => '$data->member->groupAttendancesTwoMonthCount',
			'filter' => '',
		),
		array
		(
			'class'=>'CButtonColumn',
			'template' => '{view}',
			'buttons' => array(
				'view' => array
				(
					'url' => 'Yii::app()->createUrl("member/view", array("id"=>$data->member->id))',
				),
			),
		),
	)
)); ?>
