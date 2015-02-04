<?php
$this->breadcrumbs=array(
	'崇拜'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'建立崇拜', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('worship-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>崇拜資料管理</h1>

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
	'id'=>'worship-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'start_time',
		'end_time',
		array(
			'name' => 'weekly',
			'value' => '$data->getWeeklyList($data->weekly)',
			'filter' => $model->getWeeklyList(),
		),
		'remarks',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
