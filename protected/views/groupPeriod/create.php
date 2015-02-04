<?php
$this->breadcrumbs=array(
	'小組時段'=>array('index'),
	'新增',
);

$this->menu=array(
	array('label'=>'小組時段列表', 'url'=>array('index')),
	array('label'=>'小組時段管理', 'url'=>array('admin')),
);
?>

<h1>新增小組時段</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>