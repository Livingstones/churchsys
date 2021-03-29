<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hymn-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><span class="required">*</span> 此欄位必須填寫。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->dropDownList($model, 'category', $model->getCategoryList()); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>
		<?php echo $form->dropDownList($model, 'language', $model->getLanguageList()); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lyric'); ?>
		<?php echo $form->textarea($model, 'lyric'); ?>
		<?php echo $form->error($model,'lyric'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'composer'); ?>
		<?php echo $form->textField($model,'composer',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'composer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lyricist'); ?>
		<?php echo $form->textField($model,'lyricist',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'lyricist'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'producer'); ?>
		<?php echo $form->textField($model,'producer',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'producer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notation'); ?>
        <?php echo $form->hiddenField($model, 'notation'); ?>
		<?php echo $form->fileField($model, 'notation-new'); ?>
<?php if (!empty($model->notation)) : ?>
		<a href="<?php echo $this->createUrl("file/download", array("p"=>"hymn/notation/" . $model->notation)); ?>" target="_blank">下載</a>
<?php endif; ?>
		<?php echo $form->error($model,'notation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'midi'); ?>
        <?php echo $form->hiddenField($model, 'midi'); ?>
		<?php echo $form->fileField($model, 'midi-new'); ?>
<?php if (!empty($model->midi)) : ?>
		<a href="<?php echo $this->createUrl("file/download", array("p"=>"hymn/midi/" . $model->midi)); ?>" target="_blank">下載</a>
<?php endif; ?>
		<?php echo $form->error($model,'midi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'powerpoint'); ?>
        <?php echo $form->hiddenField($model, 'powerpoint'); ?>
		<?php echo $form->fileField($model, 'powerpoint-new'); ?>
<?php if (!empty($model->powerpoint)) : ?>
		<a href="<?php echo $this->createUrl("file/download", array("p"=>"hymn/powerpoint/" . $model->powerpoint)); ?>" target="_blank">下載</a>
<?php endif; ?>
		<?php echo $form->error($model,'powerpoint'); ?>
	</div>
	
	<div class="row">
		<label for="hymnTags">標籤</label>
		<input type="text" id="hymnTags" name="hymnTags" value="<?php echo $model->showTags(); ?>" /> 
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '建立' : '儲存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->