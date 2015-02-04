<?php
$this->breadcrumbs=array(
	'誓約'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'誓約列表', 'url'=>array('index')),
	array('label'=>'新增誓約', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pledge-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>誓約管理</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pledge-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class' => 'CLinkColumn',
			'header' => '誓約',
			'labelExpression' => '$data->code . " - " . $data->name',
			'urlExpression' => 'Yii::app()->createUrl("/pledge/view&id=" . $data->id)',
		),
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
