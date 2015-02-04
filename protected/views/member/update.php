<?php
$this->breadcrumbs=array(
	'會友'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'更改',
);

$this->menu=array(
	array('label'=>'會友列表', 'url'=>array('index')),
	array('label'=>'新增會友', 'url'=>array('create')),
	array('label'=>'會友資料', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1><?php echo isset($_REQUEST["toMember"]) ? "轉至會友" : "更改會友"; ?> <?php echo $model->name; ?> (<?php echo $model->code; ?>)</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'nextCode'=>$nextCode)); ?>