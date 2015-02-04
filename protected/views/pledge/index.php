<?php
$this->breadcrumbs=array(
	'誓約',
);

$this->menu=array(
	array('label'=>'新增誓約', 'url'=>array('create')),
	array('label'=>'誓約管理', 'url'=>array('admin')),
);
?>

<h1>Pledges</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
