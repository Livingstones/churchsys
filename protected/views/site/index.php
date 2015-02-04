<?php $this->pageTitle=Yii::app()->name; ?>
<?php if (count($dataProviders) > 0) : ?>
<?php foreach ($dataProviders as $data) : ?>
	<h2><?php echo CHtml::link($data["group"]->name, array("group/view", "id"=>$data["group"]->id)) . " (時段：" . $data["group"]->period->name . ")"; ?></h2>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'group-period-grid',
		'dataProvider'=>$data["dataProvider"],
		'columns'=>array(
			array(
				'class' => 'CLinkColumn',
				'header' => '會友(編號)',
				'labelExpression' => '$data->name . "(" . $data->code . ")"',
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
<?php endforeach; ?>
<?php endif; ?>


<?php if (Yii::app()->user->checkAccess('manageIssues')) : ?>
<h2><?php echo CHtml::link("問題列表", array("issues/admin")); ?></h2>
<?php 
$issueModel = Issues::model();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'issues-grid',
	'dataProvider'=>$issueModel->search(),
	'filter'=>$issueModel,
	'columns'=>array(
		'id',
		array(
			'class' => 'CLinkColumn',
			'header' => '主題',
			'labelExpression' => '$data->title',
			'urlExpression' => 'Yii::app()->createUrl("/issues/view&id=" . $data->id)',
		),
		'description',
		array(
			'name' => 'status',
			'value' => '$data->getStatusList($data->status)',
			'filter' => $issueModel->getStatusList(),
		),
		array(
			'name' => 'priority',
			'value' => '$data->getPriorityList($data->priority)',
			'filter' => $issueModel->getPriorityList(),
		),
		array(
			'name' => 'creator',
			'value' => '($data->creator < 1000) ? User::model()->findByPk($data->creator)->username : Member::model()->findByPk($data->creator)->name',
			'filter' => "",
        ),
		array(
			'name' => 'countReplys',
			'value' => '$data->countReplys',
			'filter' => "",
        ),
		'modify_date',
		'create_date',
	),
)); ?>
<?php endif; ?>