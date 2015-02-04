
<h1 style="float: left; width: 400px;">暑期活動2012</h1>
<sub>(<a href="#application">我要報名</a>)</sub>
<div style="clear: both"></div>
<div style="border: solid 1px #000000; padding: 10px; width: 500px">
	<h2>
		<?php echo $model->activity_name; ?> 
		(<?php echo CHtml::link($model->participantCount,array('default/details','id'=>$model->id)); ?>)
	</h2>
	<p><?php echo nl2br($model->description); ?></p>
	<p>負責人：<?php echo $model->person_in_charge; ?></p>
</div>
<br/>

<div class="form" id="application">
<h1>已報名</h1>
<?php foreach ($participants as $participant) : ?>
	<?php echo $participant->name; ?><br/>
<?php endforeach; ?>
</div><!-- form -->

