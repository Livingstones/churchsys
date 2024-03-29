<?php
$this->breadcrumbs=array(
	$model->period->name => array('/groupPeriod/view', "id" => $model->period_id),
	$model->name => array('/group/view', "id" => $model->id),
	'小組出席管理',
);?>


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
            'value'=>CHtml::link(($model->leadersName),
                                 array('group/view','id'=>$model->id)),
        ),
	),
)); ?>

<h1>出席表 <sub>(最近十次)</sub></h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'group-attendance-form',
    'enableAjaxValidation'=>false,
)); ?>
<table>
	<thead>
		<tr>
			<th>會友</th>
<?php foreach ($dates as $date) : ?>
			<th><?php echo $date; ?>
				<input type="hidden" name="GroupAttendance[attendance][<?php echo $date; ?>][]" /></th>
<?php endforeach; ?>
			<th>新增:
<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'GroupAttendance[newDate]',
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
<?php foreach ($members as $member) : ?>
		<tr>
			<td>
				<a href="<?php echo Yii::app()->urlManager->createUrl('member/view', array("id" => $member->id)); ?>">
					<?php echo $member->name . "(" . $member->code . ")"; ?></a>
			</td>
<?php foreach ($dates as $date) : ?>
			<td>
				<input type="checkbox" name="GroupAttendance[attendance][<?php echo $date; ?>][<?php echo $member->id; ?>]" <?php echo $member->isAttendedGroup($model->id, $date) ? "checked='true'" : ""; ?> /></td>
<?php endforeach; ?>
			<td>
				<input type="checkbox" name="GroupAttendance[newAttendance][<?php echo $member->id; ?>]" /></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>


	<div class="row buttons">
		<?php echo CHtml::submitButton('儲存'); ?>
	</div>
<?php $this->endWidget(); ?>
</div>