<div id="take_attendance_form" class="form">
	<fieldset>

		<legend>請輸入 會友編號/姓名</legend>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'worship-attendance-take-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'member_code'); ?>
		<?php $this->widget('CAutoComplete',
          array(
             'name'=>'WorshipAttendanceTakeForm[member_code]', 
             'url'=>array('member/autoComplete'), 
             'max'=>10,
             'minChars'=>1, 
             'delay'=>500,
             'matchCase'=>false,
             'htmlOptions'=>array('size'=>'40'), 
          	 'selectFirst'=>false,
             'methodChain'=>".result(function(event,item){\$(\"#WorshipAttendanceTakeForm_member_code\").val(item[1]);})",
             )); ?>
		<?php echo $form->error($model,'member_code'); ?>
	</div>
	
	<div class="row">
		<?php if (isset($_REQUEST['adminTake']) && !empty($_REQUEST['adminTake'])) : ?>
			<?php echo $form->labelEx($model,'worship_id'); ?>
			<?php echo $form->dropDownList($model, 'worship_id', CHTML::listData(Worship::model()->findAll(), "id", "name")); ?>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>'WorshipAttendanceTakeForm[attendanceDate]',
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
			array('worshipAttendance/ajaxTake'),
			array(
				'update' => '#welcome_message',
			)
		); ?>
		<input type="button" id="btn_to_new_friend" style="float:right;" value="新朋友簽到-->" />
	</div>
<?php $this->endWidget(); ?>
	</fieldset>
</div>