
<div id="course_attendance" class="form">
	<div id="course-attendance-grid" class="grid-view">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'course-attendance-form',
    'enableAjaxValidation'=>false,
)); ?>
	<table class="items">
		<thead>
		<tr>
			<th>姓名</th>
			<th>小組</th>
<?php foreach ($date_list as $date) : ?>
			<th class="button-column">
<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'NewLesson',
    'value'=> $date,
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
<?php endforeach; ?>
			<th class="button-column">
			</th>
		</tr>
		</thead>
		<tbody>
<?php foreach ($coursemember_list as $coursemember) : ?>
<?php $member = $coursemember->member;?>
		<tr>
			<td><?php echo $member->name . " (" . $member->code . ")"; ?></td>
			<td><?php echo $member->group->name . " (" . $member->group->period->name . ")"; ?></td>
<?php foreach ($date_list as $date) : ?>
<?php $course_attendance = $data_list[$coursemember->member_id][$date]; ?>
			<td>
				<?php echo $course_attendance->state; ?>
				<?php echo CHtml::activeCheckBox($form, $coursemember->member_id . "_" . $date, array("value"=>1, "checked"=>($course_attendance->state))); ?>
			</td>
<?php endforeach ?>
			<td></td>
		</tr>
<?php endforeach ?>
		</tbody>
	</table>
<?php $this->endWidget(); ?>
	</div>
	
	
	<fieldset>
		<legend>新增課堂</legend>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'new-course-member-form',
    'enableAjaxValidation'=>false,
)); ?>
    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <label>課堂日期</label>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'newLessonDate',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
    	'dateFormat' => 'yy-mm-dd',
    ),
    'htmlOptions'=>array(
        'style'=>'height:15px;',
        'size' => '10',
    ),
));?>
    </div>

    <div class="row buttons">
			<?php echo CHtml::ajaxSubmitButton(
				'新增',
				$this->createUrl('course/addNewLesson',array("course_id"=>$model->course_id)),
				array(
					'update' => '#course_attendance',
					'beforeSend' => 'function(){$("#content-box").addClass("loading");}',
				    'complete' => 'function(){$("#content-box").removeClass("loading");}',
				)
			); ?>
    </div>
<?php $this->endWidget(); ?>
</div>
	</fieldset>
</div>