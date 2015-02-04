
<div id="course_member">
	<div id="course-member-grid" class="grid-view">
		<table class="items">	
			<thead>
				<tr>
					<th>會友</th>
					<th>性別</th>
					<th>小組</th>
					<th>備註</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
<?php foreach ($data_list as $data) : ?>
				<tr>
					<td><?php echo $data->member->name; ?>(<?php echo $data->member->code; ?>)</td>
					<td><?php echo $data->member->gender == 1 ? "F" : "M"; ?></td>
					<td><?php echo $data->member->group->name; ?></td>
					<td><?php echo $data->remarks; ?></td>
					<td><?php echo CHtml::ajaxLink(
						'刪除',
						$this->createUrl('course/removeMember',
						array(
							'member_id' => $data->member_id,
							'course_id' => $data->course_id
						)),
						array(
							'onclick'=>'if (!confirm("要刪除這個會友嗎?")) return false;',
							'update' => '#course_member',
							'beforeSend' => 'function(){$("#content-box").addClass("loading");}',
						    'complete' => 'function(){$("#content-box").removeClass("loading");}',
						)); ?>		
					</td>
				</tr>
<?php endforeach;?>
			</tbody>
		</table>
	</div>
	<fieldset>
		<legend>新增會友</legend>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'new-course-member-form',
    'enableAjaxValidation'=>false,
)); ?>
    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->hiddenField($model,'course_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'member_id'); ?>
        <?php $this->widget('CAutoComplete',
          array(
             'name'=>'member_name', 
             'url'=>array('member/memberIdAutoComplete'), 
             'max'=>10,
             'minChars'=>1, 
             'delay'=>200,
             'matchCase'=>false,
             'htmlOptions'=>array('size'=>'40'), 
             'methodChain'=>".result(function(event,item){\$(\"#CourseMember_member_id\").val(item[1]);})",
             )); ?>
        <?php echo $form->hiddenField($model,'member_id'); ?>
        <?php echo $form->error($model,'member_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'remarks'); ?>
        <?php echo $form->textField($model,'remarks'); ?>
        <?php echo $form->error($model,'remarks'); ?>
    </div>


    <div class="row buttons">
	    <?php echo CHtml::ajaxSubmitButton(
				'送出',
				array('course/ajaxAddNewMember'),
				array(
					'update' => '#course_member',
					'beforeSend' => 'function(){$("#content-box").addClass("loading");}',
				    'complete' => 'function(){$("#content-box").removeClass("loading");}',
				)
			); ?>
    </div>
<?php $this->endWidget(); ?>
</div>
	</fieldset>
</div>