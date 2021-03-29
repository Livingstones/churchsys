<?php
$path = Yii::app()->params['upload_dir'] . '/file/member/' . $model->code . ".jpg";
$type = pathinfo($path, PATHINFO_EXTENSION);
$image = file_exists($path) ? 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($path)) : "images/anonymous.gif";
?>
<img src="<?php echo $image; ?>" width="200"/>
<h1><?php echo $model->name; ?> (<?php echo $model->code; ?>)</h1>
<fieldset>
	<legend>個人資料</legend>
	
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'code',
		'name',
		'english_name',
		array(
            'label'=>'會友類別',
            'type'=>'raw',
            'value'=>$model->getAccountTypeList($model->account_type),
        ),
        array(
            'label'=>'小組(時段)',
            'type'=>'raw',
            'value'=>$model->groupNames,
        ),
		'email',
		'remarks',
		array(
            'label'=>'性別',
            'type'=>'raw',
            'value'=>$model->getGenderList($model->gender),
        ),
		array(
			'label' => '生日',
			'type' => 'raw',
			'value' => ($model->birthday !== '0000-00-00' ? date("d/m/Y", strtotime($model->birthday)) : '--'),
		),
	),
)); ?>
</fieldset>
<fieldset>
	<legend>信仰狀況</legend>
	
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'believe',
		'believe_date',
		'baptized',
		'baptized_date',
		'new_card',
		'arrived_date',
	),
)); ?>
</fieldset>
<fieldset>
	<legend>聯絡資料</legend>
	
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'contact_home',
		'contact_mobile',
		'contact_office',
		'contact_others',
		'address_district',
		'address_estate',
		'address_house',
		'address_flat',
	),
)); ?>
</fieldset>
<fieldset>
	<legend>崇拜出席情況</legend>
	
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'worshipAttendancesLastDate',
		'worshipAttendancesTwoMonthCount',
		'worshipAttendancesSixMonthCount',
		'worshipAttendancesYearCount',
	),
)); ?>
</fieldset>
