<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lyric')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('composer')); ?>:</b>
	<?php echo CHtml::encode($data->composer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lyricist')); ?>:</b>
	<?php echo CHtml::encode($data->lyricist); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producer')); ?>:</b>
	<?php echo CHtml::encode($data->producer); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('notation')); ?>:</b>
	<?php echo CHtml::encode($data->notation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('midi')); ?>:</b>
	<?php echo CHtml::encode($data->midi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('powerpoint')); ?>:</b>
	<?php echo CHtml::encode($data->powerpoint); ?>
	<br />

	*/ ?>

</div>