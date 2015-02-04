<?php
$this->breadcrumbs=array(
	'問題'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'更改',
);

$this->menu=array(
	array('label'=>'問題列表', 'url'=>array('index')),
	array('label'=>'新增問題', 'url'=>array('create')),
	array('label'=>'問題資料', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>更改 問題 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>