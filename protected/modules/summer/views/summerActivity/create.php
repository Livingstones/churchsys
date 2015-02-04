<?php
$this->breadcrumbs=array(
	'Summer Activities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SummerActivity', 'url'=>array('index')),
	array('label'=>'Manage SummerActivity', 'url'=>array('admin')),
);
?>

<h1>Create SummerActivity</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>