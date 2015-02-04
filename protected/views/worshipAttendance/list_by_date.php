<?php
$this->breadcrumbs=array(
	'崇拜'=>array('index'),
	'崇拜出席資料'=>array('worshipAttendance/listByWorship'),
	$worship_date
);
?>

<h1>崇拜出席資料 (<?php echo $worship_date; ?>)</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'worship-grid',
	'dataProvider'=>$model->searchByDate(),
	'filter'=>Member::model(),
	'columns'=>array(
		array(
			'class' => 'CLinkColumn',
			'header' => '會友 (編號)',
			'labelExpression' => '$data->name . " (" . $data->code . ")"',
			'urlExpression' => 'Yii::app()->createUrl("/member/view&id=" . $data->id)',
		),
		array(
			'name' => 'account_type',
			'header' => '類別',
			'value' => '$data->getAccountTypeList($data->account_type)',
			'filter' => Member::model()->getAccountTypeList(),
		),
		array(
			'name' => 'assignedGroups',
			'header' => '小組 (時段)',
			'value' => '$data->groupNames',
			'filter' => CHtml::listData(Group::model()->findAll(), "id", "name", "period.name"),
		),
		array(
			'name' => 'worship',
			'header' => '崇拜',
			'value' => '$data->worshipAttendances[0]->worship->name',
			'filter' => '',
		),
		array(
			'name' => 'worshipAttendanceDate',
			'header' => '簽到時間',
			'value' => '$data->worshipAttendancesLastDate',
			'filter' => '',
		),
		array(
			'name' => 'worshipAttendancesTwoMonthCount',
			'header' => '近兩個月出席次數',
			'type' => 'number',
			'value' => '$data->worshipAttendancesTwoMonthCount',
			'filter' => '',
		),
		array(
			'name' => 'worshipAttendancesSixMonthCount',
			'header' => '近六個月出席次數',
			'type' => 'number',
			'value' => '$data->worshipAttendancesSixMonthCount',
			'filter' => '',
		),
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}',
		),
	),
)); ?>