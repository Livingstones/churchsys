<?php
$this->breadcrumbs=array(
	'詩歌',
);

$this->menu=array(
	array('label'=>'新增詩歌', 'url'=>array('create')),
	array('label'=>'詩歌列表', 'url'=>array('admin')),
);
?>

<h1>Hymns</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
