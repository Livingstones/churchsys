<?php
Yii::import('zii.widgets.grid.CGridColumn');

$this->breadcrumbs=array(
	'小組'=>array('index'),
	'管理',
);

$this->menu=array(
	//array('label'=>'小組列表', 'url'=>array('index')),
	array('label'=>'新增小組', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('group-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>小組管理</h1>

<p>
你可以加入一個符號來作比較的搜尋 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
或 <b>=</b>) 
</p>

<?php echo CHtml::link('進階搜尋','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'group-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
			'class' => 'CLinkColumn',
			'header' => '組別名稱',
			'labelExpression' => '$data->name',
			'urlExpression' => 'Yii::app()->createUrl("/group/view&id=" . $data->id)',
		),
		array(
			'name' => 'period_id',
			'header' => '時段',
			'value' => '$data->period->name',
			'filter' => CHtml::listData(GroupPeriod::model()->findAll(), "id", "name"),
		),
		'membersCount',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
