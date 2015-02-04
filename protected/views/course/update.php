<?php
$this->breadcrumbs=array(
	'課程'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'更改',
);

$this->menu=array(
	array('label'=>'新增課程', 'url'=>array('create')),
	array('label'=>'課程資料', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'課程列表', 'url'=>array('admin')),
);
?>

<h1>更改 課程 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>