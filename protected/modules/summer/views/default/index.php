
<h1 style="float: left; width: 400px;">暑期活動2012</h1>
<sub>(<a href="#application">我要報名</a>)</sub>
<div style="clear: both"></div>
<?php foreach ($models as $model) : ?>

<div style="border: solid 1px #000000; padding: 10px; width: 500px">
	<h2>
		<?php echo $model->activity_name; ?> 
		(<?php echo CHtml::link($model->participantCount,array('default/details','id'=>$model->id)); ?>)
	</h2>
	<p><?php echo nl2br($model->description); ?></p>
	<p>負責人：<?php echo $model->person_in_charge; ?></p>
</div>
<br/>
<?php endforeach; ?>

<div class="form" id="application">
<h1>我要報名</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'summer-activity-participant-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span> 必須填寫。</p>

	<?php echo $form->errorSummary($participant); ?>

	<div class="row">
		<?php echo $form->labelEx($participant,'activity_id'); ?>
		<?php echo $form->checkBoxList($participant,'activity_id',CHtml::listData($models, "id", "activity_name"),array('separator'=>'','template'=>'<div>{input}&nbsp;{label}</div>')); ?>
		<?php echo $form->error($participant,'activity_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($participant,'name'); ?>
		<?php echo $form->textField($participant,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($participant,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($participant,'age'); ?>
		<?php echo $form->textField($participant,'age',array('size'=>60,'maxlength'=>2)); ?>
		<?php echo $form->error($participant,'age'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($participant,'mobile'); ?>
		<?php echo $form->textField($participant,'mobile',array('size'=>60,'maxlength'=>20)); ?>
		<?php echo $form->error($participant,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($participant,'email'); ?>
		<?php echo $form->textField($participant,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($participant,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($participant,'school'); ?>
		<?php echo $form->textField($participant,'school',array('size'=>60,'maxlength'=>20)); ?>
		<?php echo $form->error($participant,'school'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

