<?php
$this->breadcrumbs=array(
	'Summer Activities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SummerActivity', 'url'=>array('index')),
	array('label'=>'Create SummerActivity', 'url'=>array('create')),
	array('label'=>'View SummerActivity', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SummerActivity', 'url'=>array('admin')),
);
?>

<h1>Update SummerActivity <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>