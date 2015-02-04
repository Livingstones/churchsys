<?php
$this->breadcrumbs=array(
	'會友'=>array('index'),
	'新增',
);

$this->menu=array(
	array('label'=>'會友列表', 'url'=>array('index')),
);
?>

<h1>新增會友</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'nextCode'=>$nextCode)); ?>