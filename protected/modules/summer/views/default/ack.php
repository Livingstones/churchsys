
<h1>暑期活動2012 -- 已經報名</h1>
<div class="view">

	<b><?php echo CHtml::encode($participant->getAttributeLabel('activity_id')); ?>:</b>
	<?php foreach ($activity_id as $id) : ?>
		<?php $activity = SummerActivity::model()->find('id=?', array($id)); ?>
		<?php echo $activity->activity_name . ', '; ?>
	<?php endforeach; ?>
	<br />

	<b><?php echo CHtml::encode($participant->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($participant->name); ?>
	<br />

	<b><?php echo CHtml::encode($participant->getAttributeLabel('age')); ?>:</b>
	<?php echo CHtml::encode($participant->age); ?>
	<br />

	<b><?php echo CHtml::encode($participant->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($participant->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($participant->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($participant->email); ?>
	<br />

	<b><?php echo CHtml::encode($participant->getAttributeLabel('school')); ?>:</b>
	<?php echo CHtml::encode($participant->school); ?>
	<br />

	<a href="index.php?r=summer">確定</a>

</div>