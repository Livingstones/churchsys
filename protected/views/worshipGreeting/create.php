<?php
$this->breadcrumbs=array(
	'歡迎詞'=>array('index'),
	'新增',
);

$this->menu=array(
	array('label'=>'歡迎詞列表', 'url'=>array('index')),
);
?>

<h1>新增 歡迎詞</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>