<?php
$this->breadcrumbs=array(
	'問題'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'問題列表', 'url'=>array('index')),
	array('label'=>'新增問題', 'url'=>array('create')),
	array('label'=>'更改問題', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'刪除問題', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>問題詳細資料 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		array(
            'label'=>'內容',
            'type'=>'raw',
            'value'=>str_replace("\n", "<br/>", $model->description),
        ),
		array(
            'label'=>'狀態',
            'type'=>'raw',
            'value'=>$model->getStatusList($model->status),
        ),
		array(
            'label'=>'優先權',
            'type'=>'raw',
            'value'=>$model->getPriorityList($model->priority),
        ),
		array(
            'label'=>'建立者',
            'type'=>'raw',
			'value' => User::model()->findByPk($model->creator)->username,
        ),
		'modify_date',
		'create_date',
	),
)); ?>

<h1>回覆</h1>
<?php foreach ($model->issuesReplys as $key => $reply) : ?>
<div class="view">
	
	<sub style="float: right;"><?php echo CHtml::encode($reply->create_date); ?></sub>
	
	<b><?php echo CHtml::encode($reply->getAttributeLabel('creator')); ?>:</b>
	<?php echo CHtml::encode(User::model()->findByPk($reply->creator)->username); ?>
	<br />
	
	<b><?php echo CHtml::encode($reply->getAttributeLabel('reply')); ?>:</b>
	<?php echo str_replace("\n", "<br/>", $reply->reply); ?>
	<br />
	
</div>
<?php endforeach;?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'issues-reply-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($replyModel); ?>
	
	<div class="row">
		<?php echo $form->labelEx($replyModel,'reply'); ?>
		<?php echo $form->textArea($replyModel,'reply',array('cols'=>80, 'rows'=>10)); ?>
		<?php echo $form->error($replyModel,'reply'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('傳送'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div>
