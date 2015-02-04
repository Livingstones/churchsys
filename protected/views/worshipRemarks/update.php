<?php
$this->breadcrumbs=array(
	'Worship Remarks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WorshipRemarks', 'url'=>array('index')),
	array('label'=>'Create WorshipRemarks', 'url'=>array('create')),
	array('label'=>'View WorshipRemarks', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WorshipRemarks', 'url'=>array('admin')),
);
?>

<h1>Update WorshipRemarks <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>