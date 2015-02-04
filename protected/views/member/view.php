<?php
$this->breadcrumbs=array(
	'會友'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'會友列表', 'url'=>array('index')),
	array('label'=>'新增會友', 'url'=>array('create')),
	array('label'=>'更改會友', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'刪除會友', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);

if ($model->account_type == Member::ACCOUNT_TYPE_NEW_MEMBER) {
	$this->menu[] = array('label'=>'轉至會友', 'url'=>array('update', 'id'=>$model->id, 'toMember'=>true));
}
?>
<?php echo $this->renderPartial("_view", array("model"=>$model)); ?>
