<?php
$this->breadcrumbs=array(
	'會友'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'新增會友', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('member-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>會友管理</h1>

<p>
你可以加入一個符號來作比較的搜尋 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
或 <b>=</b>)
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'member-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name' => 'code',
			'header' => '會友 (編號)',
            'type' => 'raw',
            'value' => 'CHtml::link($data->name . " (" . $data->code . ")", array("/member/view", "id"=>$data->id))',
        ),
		'name',
		array(
			'name' => 'account_type',
			'value' => '$data->getAccountTypeList($data->account_type)',
			'filter' => $model->getAccountTypeList(),
		),
		array(
			'name' => 'assignedGroups',
			'header' => '小組 (時段)',
			'type' => 'html',
			'value' => '$data->groupNames',
			'filter' => CHtml::listData(Group::model()->findAll(), "id", "name", "period.name"),
		),
		array(
			'name' => 'birthday',
			'value' => 'date("d/m", strtotime($data->birthday))',
			'filter' => "",
		),
		/*
		'remarks',
		'english_name',
		'photo',
		'gender',
		'birthday',
		'email',
		'believe',
		'believe_date',
		'baptized',
		'baptized_date',
		'new_card',
		'arrived_date',
		'create_date',
		'modify_date',
		'creator_id',
		'modifier_id',
		'address_district',
		'address_estate',
		'address_house',
		'address_flat',
		'contact_home',
		'contact_mobile',
		'contact_office',
		'contact_others',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
