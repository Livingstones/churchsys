<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'summer-activity-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'activity_name'); ?>
		<?php echo $form->textField($model,'activity_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'activity_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'person_in_charge'); ?>
		<?php echo $form->textField($model,'person_in_charge',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'person_in_charge'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->