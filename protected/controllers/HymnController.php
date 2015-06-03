<?php

class HymnController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
			'rights',
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','import','addNewLesson','updateAttendance','view','viewOwn','create','update','removeMember', 'admin','delete','ajaxAddNewMember','ajaxAddNewAttendance'),
				'roles'=>array('hymnManager', 'pastor', 'preacher', 'deacon', 'staff', 'itadmin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	 */

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Hymn;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Hymn']))
		{
			$model->attributes=$_POST['Hymn'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Hymn']))
		{
			$model->attributes=$_POST['Hymn'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Hymn('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Hymn']))
			$model->attributes=$_GET['Hymn'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionImport()
	{
		set_time_limit(600);
		$hymn_list = Hymn::model()->findAll();
		foreach ($hymn_list as $hymn)
		{
			if (!empty($hymn->notation))
			{
                $path = Yii::app()->params['upload_dir'] . "/file/hymn/notation/";
				$old_filename = mb_convert_encoding($hymn->notation, "UTF-8", "Big5,UTF-8");
				if (file_exists($path . $old_filename))
				{
					$pinfo = pathinfo($path . $old_filename);
					$new_filename = $hymn->id . "-notation." . $pinfo["extension"];
					rename($path . $old_filename, $path . $new_filename);
					
					$hymn->notation = $new_filename;
					$hymn->save();
				}
			}
			if (!empty($hymn->powerpoint))
			{
                $path = Yii::app()->params['upload_dir'] . "/file/hymn/powerpoint/";
				$old_filename = mb_convert_encoding($hymn->powerpoint, "UTF-8", "Big5,UTF-8");
				if (file_exists($path . $old_filename))
				{
					$pinfo = pathinfo($path . $old_filename);
					$new_filename = $hymn->id . "-powerpoint." . $pinfo["extension"];
					rename($path . $old_filename, $path . $new_filename);
					
					$hymn->powerpoint = $new_filename;
					$hymn->save();
				}
				
			}
		}
		
//		$path = 'file/hymn/notation/';
//		if ($handle = opendir($path)) {
//		    /* This is the correct way to loop over the directory. */
//		    while (false !== ($file = readdir($handle))) {
//		    	$path_parts = pathinfo($path . $file);
//		    	if ($file == "." || $file == ".." || $file == ".svn" || $path_parts['extension'] != "pdf")
//		    		continue;
//		    		
//				$model=new Hymn('search');
//				if (!$model->exists('name=:name', array(':name'=>mb_substr(mb_convert_encoding($file, "UTF-8", "Big5,UTF-8"), 0, -4))))
//				{
//					$hymn = new Hymn();
//					$hymn->name = mb_substr(mb_convert_encoding($file, "UTF-8", "Big5,UTF-8"), 0, -4);
//					$hymn->category = Hymn::CATEGORY_OTHERS;
//					$hymn->language = Hymn::LANGUAGE_CANTONESE;
//					$hymn->notation = mb_convert_encoding($file, "UTF-8", "Big5,UTF-8");
//					$hymn->save();
//				} else {
//					$hymn = Hymn::model()->find('name=:name', array(':name'=>mb_substr(mb_convert_encoding($file, "UTF-8", "Big5,UTF-8"), 0, -4)));
//					$hymn->notation = mb_convert_encoding($file, "UTF-8", "Big5,UTF-8");
//					$hymn->save();
//				}
//		    }
//		
//		    closedir($handle);
//		}
//		$path = 'file/hymn/powerpoint/';
//		if ($handle = opendir($path)) {
//		    /* This is the correct way to loop over the directory. */
//		    while (false !== ($file = readdir($handle))) {
//		    	$path_parts = pathinfo($path . $file);
//		    	if ($file == "." || $file == ".." || $file == ".svn" || $path_parts['extension'] != "ppt")
//		    		continue;
//		    		
//				$model=new Hymn('search');
//				if (!$model->exists('name=:name', array(':name'=>mb_substr(mb_convert_encoding($file, "UTF-8", "Big5,UTF-8"), 0, -4))))
//				{
//					$hymn = new Hymn();
//					$hymn->name = mb_substr(mb_convert_encoding($file, "UTF-8", "Big5,UTF-8"), 0, -4);
//					$hymn->category = Hymn::CATEGORY_OTHERS;
//					$hymn->language = Hymn::LANGUAGE_CANTONESE;
//					$hymn->powerpoint = mb_convert_encoding($file, "UTF-8", "Big5,UTF-8");
//					$hymn->save();
//				} else {
//					$hymn = Hymn::model()->find('name=:name', array(':name'=>mb_substr(mb_convert_encoding($file, "UTF-8", "Big5,UTF-8"), 0, -4)));
//					$hymn->powerpoint = mb_convert_encoding($file, "UTF-8", "Big5,UTF-8");
//					$hymn->save();
//				}
//		    }
//		
//		    closedir($handle);
//		}
//		$path = 'file/hymn/lyric/';
//		if ($handle = opendir($path)) {
//		    /* This is the correct way to loop over the directory. */
//		    while (false !== ($file = readdir($handle))) {
//		    	$path_parts = pathinfo($path . $file);
//		    	if ($file == "." || $file == ".." || $file == ".svn" || $path_parts['extension'] != "txt")
//		    		continue;
//		    	$filename = mb_substr(mb_convert_encoding($file, "UTF-8", "Big5,UTF-8"), 0, -4);
//				$model=new Hymn('search');
//				if (!$model->exists('name=:name', array(':name'=>$filename)))
//				{
//					$hymn = new Hymn();
//					$hymn->name = $filename;
//					$hymn->category = Hymn::CATEGORY_OTHERS;
//					$hymn->language = Hymn::LANGUAGE_CANTONESE;
//					$hymn->lyric = file_get_contents($path . $file);
//					$hymn->save();
//				} else {
//					$hymn = Hymn::model()->find('name=:name', array(':name'=>$filename));
//					echo $path . $file . "<br/>\n";
//					$hymn->lyric = file_get_contents($path . $file);
//					$hymn->save();
//				}
//		    }
//		
//		    closedir($handle);
//		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Hymn::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='hymn-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
