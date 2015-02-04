<?php
$this->breadcrumbs=array(
	'誓約'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'更改',
);

$this->menu=array(
	array('label'=>'誓約列表', 'url'=>array('index')),
	array('label'=>'新增誓約', 'url'=>array('create')),
	array('label'=>'誓約資料', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'誓約管理', 'url'=>array('admin')),
);
?>

<h1>更改誓約 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>