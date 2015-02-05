<?php
$this->breadcrumbs=array(
	'詩歌'=>array('index'),
	$model->name,
);


if (Yii::app()->user->checkAccess('manageHymn')) {
    $this->menu=array(
        array('label'=>'詩歌列表', 'url'=>array('index')),
        array('label'=>'新增詩歌', 'url'=>array('create')),
        array('label'=>'更改詩歌', 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>'刪除詩歌', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    );
} else {
    $this->menu = array(
        array('label'=>'詩歌列表', 'url'=>array('index'))
    );
}
?>

<h1>詩歌資料 #<?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
        array(
            'label'=>'category',
            'value'=>$model->getCategoryList($model->category),
        ),
        array(
            'label'=>'標籤',
            'type'=>'raw',
            'value'=>$model->showTags(true),
        ),
        array(
            'label'=>'language',
            'value'=>$model->getLanguageList($model->language),
        ),
		'composer',
		'lyricist',
		'producer',
        array(
            'label'=>'歌譜',
            'type'=>'raw',
            'value'=>$model->notation ? CHtml::link("下載", $this->createUrl("file/download", array("p"=>"/hymn/notation/" . $model->notation))) : "Not Set",
        ),
        array(
            'label'=>'midi',
            'type'=>'raw',
            'value'=>$model->midi ? CHtml::link("下載", $this->createUrl("file/midi", array("p"=>"/hymn/midi/" . $model->midi))) : "Not Set",
        ),
        array(
            'label'=>'PowerPoint',
            'type'=>'raw',
            'value'=>$model->powerpoint ? CHtml::link("下載", $this->createUrl("file/download", array("p"=>"/hymn/powerpoint/" . $model->powerpoint))) : "Not Set",
        ),
        array(
            'label'=>'歌詞',
            'type'=>'raw',
            'value'=>str_replace("\n", "<br/>", $model->lyric),
        ),
	),
)); ?>
