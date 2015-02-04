<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'登入',
);
Yii::app()->clientScript->registerCSSFile(Yii::app()->request->baseUrl . '/css/login.css');
?>

			<div id="element-box" class="login">
				<div class="t">
					<div class="t">
						<div class="t"></div>
					</div>
				</div>
				<div class="form m">
					<h1>登入</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'form-login',
	'enableAjaxValidation'=>true,
)); ?>
					<div id="section-box">
						<div class="t">
							<div class="t">
								<div class="t"></div>
							</div>
						</div>
						<div class="m">
		
							<p id="form-login-username">
								<?php echo $form->labelEx($model,'username'); ?>
								<?php echo $form->textField($model,'username'); ?>
								<?php echo $form->error($model,'username'); ?>
							</p>
						
							<p id="form-login-password">
								<?php echo $form->labelEx($model,'password'); ?>
								<?php echo $form->passwordField($model,'password'); ?>
								<?php echo $form->error($model,'password'); ?>
							</p>
							<p id="form-login-lang" style="clear: both;">
								<?php echo $form->checkBox($model,'rememberMe'); ?>
								<?php echo $form->label($model,'rememberMe'); ?>
								<?php echo $form->error($model,'rememberMe'); ?>	
							</p>
							<div class="button_holder">
								<div class="button">
									<?php echo CHtml::submitButton('Login'); ?>
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

					<p>歡迎使用教會系統易</p>
					<div id="lock"></div>
					<div class="clr"></div>
					<?php $this->endWidget(); ?>
				</div>
				<div class="b">
					<div class="b">
						<div class="b"></div>
					</div>
				</div>
			</div>
			<div class="clr"></div>

