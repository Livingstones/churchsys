<?php
$this->breadcrumbs=array(
	'詩歌'=>array('index'),
	'管理',
);

if (Yii::app()->user->checkAccess('manageHymn')) {
    $this->menu=array(
        array('label'=>'新增詩歌', 'url'=>array('create')),
    );
} else {
    $this->menu = array();
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hymn-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理 詩歌</h1>

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
	'id'=>'hymn-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		array(
			'name' => 'category',
			'value' => '$data->getCategoryList($data->category)',
			'filter' => $model->getCategoryList(),
		),
		array(
			'name' => 'language',
			'value' => '$data->getLanguageList($data->language)',
			'filter' => $model->getLanguageList(),
		),
		array(
			'class' => 'CLinkColumn',
			'header' => '譜',
			'labelExpression' => '$data->notation ? "下載" : "Not Set"',
			'urlExpression' => '$data->notation ? Yii::app()->createUrl("file/download", array("p"=>"/hymn/notation/" . $data->notation)) : ""',
		),
		array(
			'class' => 'CLinkColumn',
			'header' => 'MP3/MIDI',
			'labelExpression' => '$data->midi ? "下載" : ""',
			'urlExpression' => '$data->midi ? Yii::app()->createUrl("file/download", array("p"=>"/hymn/midi/" . $data->midi)) : ""',
		),
		array(
			'class' => 'CLinkColumn',
			'header' => 'PowerPoint',
			'labelExpression' => '$data->powerpoint ? "下載" : "Not Set"',
			'urlExpression' => '$data->powerpoint ? Yii::app()->createUrl("file/download", array("p"=>"/hymn/powerpoint/" . $data->powerpoint)) : ""',
		),
		/*
		'notation',
		'midi',
		'powerpoint',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
