<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'issues-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span> 此欄位必須填寫。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
<?php if (Yii::app()->user->checkAccess('manageIssues')) : ?>
		<?php echo $form->dropDownList($model, 'status', $model->getStatusList()); ?>
<?php else : ?>
		<?php echo $form->hiddenField($model, 'status', array("value"=>Issues::STATUS_NEW)); ?>
		<?php echo $model->getStatusList(Issues::STATUS_NEW); ?>
<?php endif; ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->dropDownList($model, 'priority', $model->getPriorityList()); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '建立' : '儲存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->