<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
		// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
		),
		// page action renders "static" pages stored under 'protected/views/site/pages'
		// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
		),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		if (Yii::app()->user->isGuest)
			$this->redirect($this->createUrl("/site/login"));
		else
		{
			$dataProviders = array(); 
			
			// Group View
			if (Yii::app()->user->id > 1000){
				$groups = GroupMember::model()->findAll("member_id=:member_id AND member_type=:member_type", array(":member_id"=>Yii::app()->user->id, ":member_type"=>GroupMember::MEMBER_TYPE_LEADER));
				foreach ($groups as $groupmember)
				{
					$dataProviders[$groupmember->group->id]["group"] = $groupmember->group;
					$criteria=new CDbCriteria(array(
				        'condition'=>'group_id='.$groupmember->group->id,
				        'order'=>'code',
						'with'=>'groups',
						'together'=>true,
				    ));
					$dataProviders[$groupmember->group->id]["dataProvider"] = new CActiveDataProvider('Member', array(
				        'pagination'=>array(
				            'pageSize'=>10,
				        ),
				        'criteria'=>$criteria,
				    ));
				}
			}
			
			
			// renders the view file 'protected/views/site/index.php'
			// using the default layout 'protected/views/layouts/main.php'
			$this->render('index', array(
		        'dataProviders'=>$dataProviders,
			));
		}
	}

	/**
	 * Auth Setup
	public function actionAuthsetup()
	{
		echo(Yii::app()->getAuthManager()->checkAccess('manageMember', Yii::app()->user->id, array()));
		$auth=Yii::app()->authManager;

		$auth->createOperation('manageWorship','管理崇拜資料');
		$auth->createOperation('operateWorship','操作崇拜資料');
		$auth->createOperation('viewMember','查看會員資料');
		$auth->createOperation('manageMember','管理會員資料');
		$auth->createOperation('managePledge','管理誓約資料');
		$auth->createOperation('viewGroup','查看小組資料');
		$auth->createOperation('manageGroup','管理小組資料');
		$auth->createOperation('manageGroupPeriod','管理小組區域資料');

		$bizRule='return GroupMember::model()->count("member_id=:member_id AND group_id=:group_id AND member_type=:member_type", array(":member_id"=>Yii::app()->user->id,":group_id"=>$params["group"]->id,":member_type"=>GroupMember::MEMBER_TYPE_LEADER))>0;';
		$task=$auth->createTask('manageOwnGroup','管理自己小組資料',$bizRule);
		$task->addChild('manageGroup');
		
		$bizRule='return Yii::app()->user->memberId==$params["groupPeriod"]->tutor_id;';
		$task=$auth->createTask('manageOwnGroupPeriod','管理自己小組區域資料',$bizRule);
		$task->addChild('manageGroupPeriod');

		$role=$auth->createRole('pastor');
		$role->addChild('manageWorship');
		$role->addChild('manageMember');
		$role->addChild('managePledge');
		$role->addChild('manageGroup');
		$role->addChild('manageGroupPeriod');

		$role=$auth->createRole('preacher');
		$role->addChild('manageWorship');
		$role->addChild('manageMember');
		$role->addChild('managePledge');
		$role->addChild('manageGroup');
		$role->addChild('manageGroupPeriod');

		$role=$auth->createRole('deacon');
		$role->addChild('manageWorship');
		$role->addChild('manageMember');
		$role->addChild('managePledge');
		$role->addChild('manageGroup');
		$role->addChild('manageGroupPeriod');

		$role=$auth->createRole('periodTutor');
		$role->addChild('manageGroup');
		$role->addChild('manageOwnGroupPeriod');
		
		$role=$auth->createRole('groupTutor');
		$role->addChild('manageOwnGroup');
		
		$role=$auth->createRole('staff');
		$role->addChild('manageWorship');
		$role->addChild('operateWorship');
		$role->addChild('manageMember');
		$role->addChild('managePledge');
		$role->addChild('manageGroup');
		$role->addChild('manageGroupPeriod');
		
		$role=$auth->createRole('itadmin');
		$role->addChild('manageWorship');
		$role->addChild('operateWorship');
		$role->addChild('manageMember');
		$role->addChild('managePledge');
		$role->addChild('manageGroup');
		$role->addChild('manageGroupPeriod');
		$role->addChild('manageIssues');

		$role=$auth->createRole('operator');
		$role->addChild('operateWorship');
	}
	 */

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
			echo $error['message'];
			else
			$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
//	public function actionContact()
//	{
//		$model=new ContactForm;
//		if(isset($_POST['ContactForm']))
//		{
//			$model->attributes=$_POST['ContactForm'];
//			if($model->validate())
//			{
//				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
//				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
//				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
//				$this->refresh();
//			}
//		}
//		$this->render('contact',array('model'=>$model));
//	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
