<?php
$this->breadcrumbs=array(
	'崇拜'=>array('index'),
	'會友出席資料',
);
?>

<h1>會友出席資料</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'worship-grid',
	'dataProvider'=>$model->searchByMember(),
	'filter'=>Member::model(),
	'columns'=>array(
/**
		array(
            'name' => '$data->code',
			'class' => 'CLinkColumn',
			'header' => '會友 (編號)',
			'labelExpression' => '$data->name . " (" . $data->code . ")"',
			'urlExpression' => 'Yii::app()->createUrl("/member/view&id=" . $data->id)',
		),
*/
        array(
            'name' => 'code',
			'header' => '會友 (編號)',
            'type' => 'raw',
            'value' => 'CHtml::link($data->name . " (" . $data->code . ")", array("/member/view", "id"=>$data->id))',
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
			'name' => 'worshipAttendancesLastDate',
			'header' => '最後一次出席',
			'value' => 'empty($data->worshipAttendancesLastDate) ? "--" : $data->worshipAttendancesLastDate . " (" . $data->worshipAttendances[0]->worship->name . ")"',
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
			'name' => 'worshipAttendancesYearCount',
			'header' => '近一年出席次數',
			'type' => 'number',
			'value' => '$data->worshipAttendancesYearCount',
			'filter' => '',
		),
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}',
		),
	),
)); ?>
