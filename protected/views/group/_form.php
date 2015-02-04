<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'group-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span> 此欄位必須填寫。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'period_id'); ?>
		<?php echo $form->dropDownList($model,'period_id', CHtml::listData(GroupPeriod::model()->findAll(), "id", "name")); ?>
		<?php echo $form->error($model,'period_id'); ?>
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
					<td><?php echo date("d/m", strtotime($member->birthday)); ?></td>
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
					<th>聯絡電話</th>
					<th>生日日期</th>
					<th>性別</th>
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
						<input type="text" name="new_mobile_<?php echo $i; ?>" size="10" />
					</td>
					<td>
						<input type="text" name="new_birthday_<?php echo $i; ?>" size="10" /> <sub>(eg. 1983-04-23)</sub>
					</td>
					<td>
						<input type="radio" name="new_gender_<?php echo $i; ?>" value="2"/>男
						<input type="radio" name="new_gender_<?php echo $i; ?>" value="1"/>女
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