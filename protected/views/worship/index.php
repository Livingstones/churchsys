<?php
$this->breadcrumbs=array(
	'崇拜',
);

$this->menu=array(
	array('label'=>'新增崇拜', 'url'=>array('create')),
	array('label'=>'崇拜管理', 'url'=>array('admin')),
);
?>

<h1>崇拜</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
