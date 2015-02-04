<?php 
	$today = time();
?> 
<div class="form">
<fieldset class="adminform">
	<legend>崇拜預備</legend>
	
	<ul class="report_list">
		<li>
<?php $form=$this->beginWidget('CActiveForm', array(
	'enableAjaxValidation'=>false,
	'action' => Yii::app()->urlManager->createUrl('worshipReport/ajaxNewMemberAttendanceFormReport'),
	'htmlOptions' => array('target'=>'_blank'),
)); ?>
			<?php echo CHtml::submitButton('臨時會友簽到表'); ?>
<?php $this->endWidget(); ?>
		</li>
		
		<li>
<?php $form=$this->beginWidget('CActiveForm', array(
	'enableAjaxValidation'=>false,
	'action' => Yii::app()->urlManager->createUrl('worshipReport/ajaxNewMembershipCardReport'),
	'htmlOptions' => array('target'=>'_blank'),
)); ?>
			<?php echo CHtml::submitButton('新增會友列表'); ?>
<?php $this->endWidget(); ?>
		</li>
	</ul>
</fieldset>
<fieldset class="adminform">
	<legend>每週報告</legend>
	
	<ul class="report_list">
		<li>
<?php $form=$this->beginWidget('CActiveForm', array(
	'enableAjaxValidation'=>false,
	'action' => Yii::app()->urlManager->createUrl('worshipReport/ajaxNewMemberReport'),
	'htmlOptions' => array('target'=>'_blank'),
)); ?>
			<?php echo CHtml::submitButton('新朋友報告'); ?>
			<select id="weekly_week_no" name="week_no">
			<?php for ($i=0; $i<52; $i++): ?>
				<?php $target = $today-($i*60*60*24*7); ?>
				<option value="<?php echo date("Y-W", $target);?>"><?php echo date("Y-m-d", $target-(60*60*24*(date("N", $target)-1))); ?> - <?php echo date("Y-m-d", $target+(60*60*24*(7-date("N", $target)))); ?></option>
			<?php endfor; ?>
			</select>
<?php $this->endWidget(); ?>
		</li>
	</ul>
</fieldset>
<fieldset class="adminform">
	<legend>出席報告</legend>
	
	
	<ul class="report_list">
		<li>
<?php $form=$this->beginWidget('CActiveForm', array(
	'enableAjaxValidation'=>false,
	'action' => Yii::app()->urlManager->createUrl('worshipReport/ajaxAttendanceReport'),
	'htmlOptions' => array('target'=>'_blank'),
)); ?>
			<?php echo CHtml::submitButton('出席報告'); ?>
	
			<select id="attendance_week_no" name="week_no">
			<?php for ($i=0; $i<52; $i++): ?>
				<?php $target = $today-($i*60*60*24*7); ?>
				<option value="<?php echo date("Y-W", $target);?>"><?php echo date("Y-m-d", $target-(60*60*24*(date("N", $target)-1))); ?> - <?php echo date("Y-m-d", $target+(60*60*24*(7-date("N", $target)))); ?></option>
			<?php endfor; ?>
			</select>
			<select id="attendance_group_period" name="group_period">
				<option value="">所有時段</option>
			<?php foreach ($group_period as $period): ?>
				<option value="<?php echo $period["id"]; ?>"><?php echo $period["name"]; ?></option>
			<?php endforeach; ?>
			</select>
			<select id="attendance_member_type" name="member_type">
				<option value="">所有會友</option>
				<option value="0">臨時會友</option>
				<option value="1">會友</option>
			</select>
<?php $this->endWidget(); ?>
		</li>
		
		<li>
<?php $form=$this->beginWidget('CActiveForm', array(
	'enableAjaxValidation'=>false,
	'action' => Yii::app()->urlManager->createUrl('worshipReport/ajaxAbsentReport'),
	'htmlOptions' => array('target'=>'_blank'),
)); ?>
			<?php echo CHtml::submitButton('缺席報告'); ?>
	
			<select id="absent_week_no" name="week_no">
			<?php for ($i=0; $i<52; $i++): ?>
				<?php $target = $today-($i*60*60*24*7); ?>
				<option value="<?php echo date("Y-W", $target) ;?>"><?php echo date("Y-m-d", $target-(60*60*24*(date("N", $target)-1))); ?> - <?php echo date("Y-m-d", $target+(60*60*24*(7-date("N", $target)))); ?></option>
			<?php endfor; ?>
			</select>
			<select id="absent_group_period" name="group_period">
				<option value="">所有時段</option>
			<?php foreach ($group_period as $period): ?>
				<option value="<?php echo $period["id"]; ?>"><?php echo $period["name"]; ?></option>
			<?php endforeach; ?>
			</select>
			<select id="absent_member_type" name="member_type">
				<option value="">所有會友</option>
				<option value="0">臨時會友</option>
				<option value="1">會友</option>
			</select>
			<select id="absent_boundary" name="boundary">
				<option value="3">最近三個月有出席崇拜</option>
				<option value="6">最近半年有出席崇拜</option>
				<option value="12">最近一年出席崇拜</option>
				<option value="">所有</option>
			</select>
<?php $this->endWidget(); ?>
		</li>
	</ul>
</fieldset>
<fieldset class="adminform">
	<legend>全年報告</legend>
	
	<ul class="report_list">
		<li>
<?php $form=$this->beginWidget('CActiveForm', array(
	'enableAjaxValidation'=>false,
	'action' => Yii::app()->urlManager->createUrl('worshipReport/ajaxAnnualReport'),
	'htmlOptions' => array('target'=>'_blank'),
)); ?>
			<?php echo CHtml::submitButton('全年崇拜出席報告'); ?>
			<select id="annual_year" name="year">
			<?php for ($i=date("Y"); $i>=2008; $i--): ?>
				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php endfor; ?>
			</select>
			年
<?php $this->endWidget(); ?>
		</li>
	</ul>
</fieldset>
<fieldset class="adminform">
	<legend>生日查詢</legend>
	
	
	<ul class="report_list">
		
		<li>
<?php $form=$this->beginWidget('CActiveForm', array(
	'enableAjaxValidation'=>false,
	'action' => Yii::app()->urlManager->createUrl('worshipReport/ajaxBirthdayReport'),
	'htmlOptions' => array('target'=>'_blank'),
)); ?>
			<?php echo CHtml::submitButton('生日查詢'); ?>
	
			<select id="birth_week_no" name="week_no">
			<?php for ($i=-1; $i<51; $i++): ?>
				<?php $target = $today-($i*60*60*24*7); ?>
				<option value="<?php echo date("Y-W", $target+(60*60*24*7)) ;?>"><?php echo date("Y-m-d", $target-(60*60*24*(date("N", $target)-1))); ?> - <?php echo date("Y-m-d", $target+(60*60*24*(7-date("N", $target)))); ?></option>
			<?php endfor; ?>
			</select>
			<select id="birth_boundary" name="boundary">
				<option value="3">最近三個月有出席崇拜</option>
				<option value="6">最近半年有出席崇拜</option>
				<option value="12">最近一年出席崇拜</option>
				<option value="">所有</option>
			</select>
<?php $this->endWidget(); ?>
		</li>
	</ul>
</fieldset>
</div>