<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remarks'); ?>
		<?php echo $form->textArea($model,'remarks',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'english_name'); ?>
		<?php echo $form->textField($model,'english_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo'); ?>
		<?php echo $form->textField($model,'photo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gender'); ?>
		<?php echo $form->textField($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'believe'); ?>
		<?php echo $form->textField($model,'believe',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'believe_date'); ?>
		<?php echo $form->textField($model,'believe_date',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'baptized'); ?>
		<?php echo $form->textField($model,'baptized',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'baptized_date'); ?>
		<?php echo $form->textField($model,'baptized_date',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_type'); ?>
		<?php echo $form->textField($model,'account_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'new_card'); ?>
		<?php echo $form->textField($model,'new_card'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'arrived_date'); ?>
		<?php echo $form->textField($model,'arrived_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modify_date'); ?>
		<?php echo $form->textField($model,'modify_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'creator_id'); ?>
		<?php echo $form->textField($model,'creator_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modifier_id'); ?>
		<?php echo $form->textField($model,'modifier_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address_district'); ?>
		<?php echo $form->textField($model,'address_district',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address_estate'); ?>
		<?php echo $form->textField($model,'address_estate',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address_house'); ?>
		<?php echo $form->textField($model,'address_house',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address_flat'); ?>
		<?php echo $form->textField($model,'address_flat',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact_home'); ?>
		<?php echo $form->textField($model,'contact_home',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact_mobile'); ?>
		<?php echo $form->textField($model,'contact_mobile',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact_office'); ?>
		<?php echo $form->textField($model,'contact_office',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact_others'); ?>
		<?php echo $form->textField($model,'contact_others',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->