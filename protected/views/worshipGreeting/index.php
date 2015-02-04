<?php
$this->breadcrumbs=array(
	'歡迎詞',
);

$this->menu=array(
	array('label'=>'新增歡迎詞', 'url'=>array('create')),
);
?>

<h1>歡迎詞</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
