<?php
$this->breadcrumbs=array(
	'會友',
);

$this->menu=array(
	array('label'=>'新增會友', 'url'=>array('create')),
	array('label'=>'會友管理', 'url'=>array('admin')),
);
?>

<h1>會友</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
