<?php
$this->breadcrumbs=array(
	$model->name => array('/course/view', "id" => $model->id),
	'課程出席管理',
);?>

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


<h1>出席表</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'course-attendance-form',
    'enableAjaxValidation'=>false,
)); ?>
<table>
	<thead>
		<tr>
			<th>會友</th>
<?php foreach ($dates as $date) : ?>
			<th><?php echo $date; ?>
				<input type="hidden" name="CourseAttendance[attendance][<?php echo $date; ?>][]" /></th>
<?php endforeach; ?>
			<th>新增:
<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'CourseAttendance[newDate]',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
    	'dateFormat' => 'yy-mm-dd',
    ),
    'htmlOptions'=>array(
        'style'=>'height:15px;'
    ),
));?>
			</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($coursemembers as $coursemember) : ?>
		<tr>
			<td>
				<a href="<?php echo Yii::app()->urlManager->createUrl('member/view', array("id" => $coursemember->member->id)); ?>">
					<?php echo $coursemember->member->name . "(" . $coursemember->member->code . ")"; ?></a>
			</td>
<?php foreach ($dates as $date) : ?>
			<td>
				<input type="checkbox" name="CourseAttendance[attendance][<?php echo $date; ?>][<?php echo $coursemember->member->id; ?>]" <?php echo $coursemember->member->isAttendedCourse($model->id, $date) ? "checked='true'" : ""; ?> /></td>
<?php endforeach; ?>
			<td>
				<input type="checkbox" name="CourseAttendance[newAttendance][<?php echo $coursemember->member->id; ?>]" /></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>


	<div class="row buttons">
		<?php echo CHtml::submitButton('儲存'); ?>
	</div>
<?php $this->endWidget(); ?>
</div>