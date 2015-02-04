<?php
$this->breadcrumbs=array(
	'詩歌'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'更改',
);

$this->menu=array(
	array('label'=>'詩歌列表', 'url'=>array('index')),
	array('label'=>'新增詩歌', 'url'=>array('create')),
	array('label'=>'詩歌資料', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>更改 詩歌 <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>