<?php
$this->breadcrumbs=array(
	'崇拜'=>array('index'),
	'新增',
);

$this->menu=array(
	array('label'=>'崇拜列表', 'url'=>array('index')),
);
?>

<h1>新增 崇拜</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>