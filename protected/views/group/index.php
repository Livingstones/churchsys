<?php
$this->breadcrumbs=array(
	'小組',
);

$this->menu=array(
	array('label'=>'新增小組', 'url'=>array('create')),
	array('label'=>'小組列表', 'url'=>array('admin')),
);
?>

<h1>Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
