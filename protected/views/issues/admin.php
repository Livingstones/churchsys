<?php
$this->breadcrumbs=array(
	'問題'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'新增問題', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('issues-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>問題管理</h1>

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
	'id'=>'issues-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class' => 'CLinkColumn',
			'header' => '主題',
			'labelExpression' => '$data->title',
			'urlExpression' => 'Yii::app()->createUrl("/issues/view", array("id"=>$data->id))',
		),
		array(
			'name' => 'description',
			'value' => '(50 < strlen($data->description)) ? substr($data->description, 0, 50) . "..." : $data->description',
		),
		array(
			'name' => 'status',
			'value' => '$data->getStatusList($data->status)',
			'filter' => $model->getStatusList(),
		),
		array(
			'name' => 'priority',
			'value' => '$data->getPriorityList($data->priority)',
			'filter' => $model->getPriorityList(),
		),
		array(
			'name' => 'creator',
			'value' => '($data->creator < 1000) ? User::model()->findByPk($data->creator)->username : Member::model()->findByPk($data->creator)->name',
			'filter' => "",
        ),
		array(
			'name' => 'countReplys',
			'value' => '$data->countReplys',
			'filter' => "",
        ),
		'create_date',
	),
)); ?>
