<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

if( Yii::app()->user->checkAccess(Rights::module()->superuserName))
{
	$this->menu=array(
		array('label'=>'List User', 'url'=>array('index')),
		array('label'=>'Create User', 'url'=>array('create')),
		array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage User', 'url'=>array('admin')),
	);
}
?>

<?php
	foreach(Yii::app()->user->getFlashes() as $key => $message) {
		if ($key=='counters') {continue;}
		//echo "<div class='flash-{$key}'>{$message}</div>";
		echo "<div class='flash-success'>{$message}</div>";
	}

	Yii::app()->clientScript->registerScript(
		'myHideEffect',
		'$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
		CClientScript::POS_READY
	);
?>


<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'email',
	),
)); ?>
