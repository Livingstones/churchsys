<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worship_id')); ?>:</b>
	<?php echo CHtml::encode($data->worship_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worship_date')); ?>:</b>
	<?php echo CHtml::encode($data->worship_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
	<?php echo CHtml::encode($data->remarks); ?>
	<br />


</div>