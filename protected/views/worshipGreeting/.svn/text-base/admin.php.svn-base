<?php
$this->breadcrumbs=array(
	'歡迎詞'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'歡迎詞列表', 'url'=>array('index')),
	array('label'=>'新增歡迎詞', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('worship-greeting-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理 歡迎詞</h1>

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
	'id'=>'worship-greeting-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'member_id',
			'header' => '會友 (編號)',
			'value' => '$data->member->name . " (" . $data->member->code . ")"',
		),
		'message',
		'expiry_date',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
