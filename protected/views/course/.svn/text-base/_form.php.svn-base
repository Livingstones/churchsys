<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'course-form',
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note"><span class="required">*</span> 此欄位必須填寫。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'Course[start_date]',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
    	'dateFormat' => 'yy-mm-dd',
    ),
    'htmlOptions'=>array(
        'style'=>'height:15px;'
    ),
    'value'=>$model->start_date
));?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'Course[end_date]',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
    	'dateFormat' => 'yy-mm-dd',
    ),
    'htmlOptions'=>array(
        'style'=>'height:15px;'
    ),
    'value'=>$model->end_date
));?>
		<?php echo $form->error($model,'end_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lesson_time'); ?>
		<?php echo $form->textField($model,'lesson_time'); ?>
		<?php echo $form->error($model,'lesson_time'); ?>
		<sub>eg. 10:00 / 14:30</sub>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'venue'); ?>
		<?php echo $form->textField($model,'venue',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'venue'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teacher'); ?>
		<?php echo $form->textField($model,'teacher',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'teacher'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->dropDownList($model,'state',array('0'=>'未開始','1'=>'開始中','2'=>'已完成')); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>
	
	<div class="row">
		<label>會友</label>
		<table>
			<thead>
				<tr>
					<th>姓名</th>
					<th>聯絡電話</th>
					<th>生日日期</th>
					<th>刪除?</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($model->members as $member) : ?>
				<tr>
					<td><?php echo $member->name . "[" . $member->code . "]"; ?></td>
					<td><?php echo $member->contact_mobile; ?></td>
					<td><?php echo $member->birthday; ?></td>
					<td><input type="checkbox" name="delete[<?php echo $member->id; ?>]" /></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	
	
	<div class="row">
		<label>新增會友</label>
		<table>
			<thead>
				<tr>
					<th>姓名</th>
					<th>備註</th>
				</tr>
			</thead>
			<tbody>
			<?php for ($i=0; $i<10; $i++) : ?>
				<tr>
					<td>
						<?php $this->widget('CAutoComplete',
          array(
             'name'=>'new_member_name_' . $i, 
             'url'=>array('member/autoComplete'), 
             'max'=>10,
             'minChars'=>1, 
             'delay'=>500,
             'matchCase'=>false,
             'htmlOptions'=>array('size'=>'20'), 
             'methodChain'=>".result(function(event,item){\$(\"#new_member_code_" . $i . "\").val(item[1]);})",
             )); ?>
             			<input type="hidden" id="new_member_code_<?php echo $i; ?>" name="new_member_code_<?php echo $i; ?>" size="10" />
					</td>
					<td>
						<input type="text" name="new_remarks_<?php echo $i; ?>" size="20" />
					</td>
				</tr>
			<?php endfor; ?>
			</tbody>
		</table>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '建立' : '儲存'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
