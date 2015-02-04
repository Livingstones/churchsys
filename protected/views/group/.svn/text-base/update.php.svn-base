<?php
$this->breadcrumbs=array(
	'小組'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'更改',
);

if (Yii::app()->user->checkAccess("manageGroup"))
{
	$this->menu=array(
		array('label'=>'小組列表', 'url'=>array('admin')),
		array('label'=>'新增小組', 'url'=>array('create')),
		array('label'=>'小組資料', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'小組出席管理', 'url'=>array('groupAttendance/view', 'id'=>$model->id)),
		//array('label'=>'小組管理', 'url'=>array('admin')),
	);
}
elseif (Yii::app()->user->checkAccess("manageOwnGroup", array("group"=>$model)))
{
	$this->menu=array(
		array('label'=>'小組資料', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'更改小組出席', 'url'=>array('groupAttendance/update', 'group_id'=>$model->id)),
	);
}
?>

<h1>更改小組 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>