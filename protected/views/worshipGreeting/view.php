<?php
$this->breadcrumbs=array(
	'歡迎詞'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'歡迎詞列表', 'url'=>array('index')),
	array('label'=>'新增歡迎詞', 'url'=>array('create')),
	array('label'=>'更改歡迎詞', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'刪除歡迎詞', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>歡迎詞 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label' => '會友 (編號)',
			'value' => $model->member->name . " (" . $model->member->code . ")",
		),
		'message',
		'expiry_date',
	),
)); ?>
