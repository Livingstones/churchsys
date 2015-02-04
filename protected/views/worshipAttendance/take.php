
<?php 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/jclock/jquery.jclock.js");
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/worship/takeAttendance.js"); 
?>

		<div id="toolbar-box">
   			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			<div class="m">
				<div class="header">
				<?php if (isset($_REQUEST['adminTake']) && !empty($_REQUEST['adminTake'])) : ?>
					簽到系統  (補誌)
				<?php else: ?>
					簽到系統 [<span id="current_worship"><?php echo $worship_name; ?></span> <?php echo date("Y-m-d"); ?> <span id="timer" rel="<?php echo time();?>"></span>]
				<?php endif; ?>
				</div>
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div>   		
		<div class="clr"></div>
		<div id="element-box">
			<div class="t">
		 		<div class="t">
					<div class="t"></div>
		 		</div>
			</div>
			<div class="m">
				<div style="width: 70%; float: left;">
					<div>
<?php echo $this->renderPartial('_take_attendance_form', array('model'=>$model, 'worship_id'=>$worship_id)); ?>
<?php echo $this->renderPartial('_new_friend_form', array('model'=>$model_new, 'worship_id'=>$worship_id)); ?>
						<div class="form">
							<fieldset>
								<legend>歡迎詞</legend>
								
								<div id="welcome_message" style="color: red; font-size: 36px;">
								</div>
							</fieldset>
						</div>
					</div>

				</div>
				<div style="width: 30%; float: left;">
					<div class="form">
						<fieldset>
							<legend>簽到統計</legend>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'worship-stat-grid',
	'dataProvider'=>$worshipDataProvider,
	'enablePagination' => false,
	'summaryText'=>'',
	'columns'=>array(
		'name:text:崇拜',
		array(
			'id' => 'memberCount',
			'name' => 'memberCount',
			'value' => '$data["memberCount"] - $data["newMemberCount"]',
			'header' => '會友',
		),
		array(
			'id' => 'newMemberCount',
			'name' => 'newMemberCount',
			'value' => '$data["newMemberCount"]',
			'header' => '新朋友',
		),
		array(
			'id' => 'totalCount',
			'name' => 'totalCount',
			'value' => '$data["memberCount"]',
			'header' => '總人數',
		),
	),
)); ?>
						</fieldset>
					</div>
					<div class="form" style="height: 300px; overflow-y: auto;">
						<fieldset>
							<legend>已簽到列表</legend>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'attend-worship-grid',
	'dataProvider'=>$attendanceDataProvider,
	'enablePagination' => false,
	'summaryText'=>'',
	'columns'=>array(
		array(
			'name' => 'name',
			'value' => '$data["name"] . " (" . $data["code"] . ")"',
			'header' => '會友',
		),
		array(
			'name' => 'attendance_date',
			'value' => 'date("H:i", strtotime($data["attendance_date"]))',
			'header' => '時間',
		),
		array(
            'class'=>'CButtonColumn',
			'deleteConfirmation'=>'確定刪除?',
			'template'=>'{delete}',
			'deleteButtonUrl'=>'Yii::app()->createUrl("WorshipAttendance/deleteByWorshipMember", array("worship_member" => $data["id"]))',
        ),
	),
)); ?>
						</fieldset>
					</div>
				</div>
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div>