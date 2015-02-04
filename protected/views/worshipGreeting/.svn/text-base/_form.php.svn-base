<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'worship-greeting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span> 此欄位必須填寫。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'member_id'); ?>
		<?php $this->widget('CAutoComplete',
          array(
             'name'=>'member_name', 
             'url'=>array('member/memberIdAutoComplete'), 
             'max'=>10,
             'minChars'=>1, 
             'delay'=>500,
             'matchCase'=>false,
             'htmlOptions'=>array('size'=>'40'), 
             'methodChain'=>".result(function(event,item){\$(\"#WorshipGreeting_member_id\").val(item[1]);})",
             )); ?>
		<?php echo $form->hiddenField($model,'member_id'); ?>
		<?php echo $form->error($model,'member_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expiry_date'); ?>
		<?php echo $form->textField($model,'expiry_date'); ?>
		<?php echo $form->error($model,'expiry_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '建立' : '儲存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->