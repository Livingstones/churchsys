<?php
$this->breadcrumbs=array(
	'小組'=>array('index'),
	'新增',
);

$this->menu=array(
	array('label'=>'小組列表', 'url'=>array('admin')),
	//array('label'=>'小組管理', 'url'=>array('admin')),
);
?>

<h1>新增 小組</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>