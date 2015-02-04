<?php
$this->breadcrumbs=array(
	'課程'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'課程列表', 'url'=>array('index')),
	array('label'=>'新增課程', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('course-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理 課程</h1>

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
	'id'=>'course-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class' => 'CLinkColumn',
			'header' => '編號',
			'labelExpression' => '$data->code',
			'urlExpression' => 'Yii::app()->createUrl("/course/view&id=" . $data->id)',
		),
		'name',
		'start_date',
		'end_date',
		'lesson_time',
		/*
		'venue',
		'teacher',
		'state',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
