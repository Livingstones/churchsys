<div id="new_friend_form" class="form">
	<fieldset>
		<legend>請輸入 新朋友 資料</legend>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'worship-attendance-new-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'member_name'); ?>
		<?php echo $form->textField($model,'member_name'); ?>
		<?php echo $form->error($model,'member_name'); ?>
		<?php echo $form->dropDownList($model,'member_gender', array(
				"2" => "男",
				"1" => "女",
			)); ?>
		<?php echo $form->error($model,'member_gender'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'member_remarks'); ?>
		<?php echo $form->textArea($model,'member_remarks'); ?>
		<?php echo $form->error($model,'member_remarks'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'member_group'); ?>
		<?php echo $form->dropDownList($model,'member_group', CHtml::listData(Group::model()->findAll(), 'id', 'name', 'period.name'), array('options' => array('70'=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'member_group'); ?>
	</div>
	
	<div class="row">
		<?php if (isset($_REQUEST['adminTake']) && !empty($_REQUEST['adminTake'])) : ?>
			<?php echo $form->labelEx($model,'worship_id'); ?>
			<?php echo $form->dropDownList($model, 'worship_id', CHTML::listData(Worship::model()->findAll(), "id", "name")); ?>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>'WorshipAttendanceNewForm[attendanceDate]',
                'value'=>date("Y-m-d"),
			    // additional javascript options for the date picker plugin
			    'options'=>array(
			        'showAnim'=>'fold',
			    	'dateFormat' => 'yy-mm-dd',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'height:15px;'
			    ),
			));?>
			<?php echo $form->hiddenField($model, 'adminTake', array("value"=>"true")); ?>
		<?php else: ?>
			<?php echo $form->hiddenField($model, 'worship_id', array("value"=>$worship_id)); ?>
		<?php endif; ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::ajaxSubmitButton(
			'送出',
			array('worshipAttendance/ajaxNewMember'),
			array(
				'update' => '#welcome_message',
			)
		); ?>
		<input type="button" id="btn_to_take_attendance" style="float:right;" value="會友簽到-->" />
	</div>
<?php $this->endWidget(); ?>
				
	</fieldset>

</div>
