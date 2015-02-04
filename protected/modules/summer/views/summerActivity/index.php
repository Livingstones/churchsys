<?php
$this->breadcrumbs=array(
	'Summer Activities',
);

$this->menu=array(
	array('label'=>'Create SummerActivity', 'url'=>array('create')),
	array('label'=>'Manage SummerActivity', 'url'=>array('admin')),
);
?>

<h1>Summer Activities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
