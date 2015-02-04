<?php
$this->breadcrumbs=array(
	'問題'=>array('index'),
	'新增',
);

$this->menu=array(
	array('label'=>'問題列表', 'url'=>array('index')),
);
?>

<h1>新增 問題</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>