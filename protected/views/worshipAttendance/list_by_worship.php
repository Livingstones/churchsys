<?php
$this->breadcrumbs=array(
	'崇拜'=>array('index'),
	'崇拜出席資料',
);
?>

<h1>崇拜出席資料</h1>

<?php 
	$columns = array(
		array(
			'class' => 'CLinkColumn',
			'header' => '日期',
			'labelExpression' => 'DATE("Y-m-d", strtotime($data["attendance_date"]))',
			'urlExpression' => 'Yii::app()->createUrl("/worshipAttendance/listByDate&date=" . DATE("Y-m-d", strtotime($data["attendance_date"])))',
		));
	$worship_list = Worship::model()->findAll('state=1');
	
	foreach ($worship_list as $worship)
	{
		array_push($columns, array(
			'class' => 'CLinkColumn',
//			'name' => 'w'.$worship->id,
			'header' => $worship->name,
			'labelExpression' => '$data->w'.$worship->id,
			'urlExpression' => 'Yii::app()->createUrl("/worshipAttendance/listByWorshipWeek&weekno=" . DATE("W", strtotime($data["attendance_date"])) . "&worship_id=' . $worship->id . '&year=" . DATE("Y", strtotime($data["attendance_date"])))',
		));
	}
	
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'worship-grid',
		'dataProvider'=>$model->searchByWorship(),
		'columns'=>$columns
	));
?>
