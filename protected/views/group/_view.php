<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('period_id')); ?>:</b>
	<?php echo CHtml::encode($data->period->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leaders')); ?>:</b>
	<?php echo CHtml::encode($data->showLeadersName()); ?>
	<br />
</div>