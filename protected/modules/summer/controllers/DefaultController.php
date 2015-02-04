<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		Yii::app()->theme = 'public';
		$participant = SummerActivityParticipant::model();
		$models = SummerActivity::model()->findAll();
		
		if(isset($_POST['SummerActivityParticipant']))
		{
			if (is_array($_POST['SummerActivityParticipant']['activity_id'])) {
				foreach ($_POST['SummerActivityParticipant']['activity_id'] as $activity_id){
					$model=new SummerActivityParticipant;
					$model->attributes=$_POST['SummerActivityParticipant'];
					$model->activity_id = $activity_id;
					if(!$model->save()) {
						$this->render('index',array(
							'models' => $models,
							'participant' => $model,
						));
					}
				}
				$this->render('ack',array(		
									'activity_id' => $_POST['SummerActivityParticipant']['activity_id'],
									'participant' => $model,
								));
			}
		} else {
			$this->render('index',array(
				'models' => $models,
				'participant' => $participant,
			));
		}
	}
	
	public function actionDetails($id)
	{
		Yii::app()->theme = 'public';
		$model = SummerActivity::model()->find('id=?', array($id));
		$participants = SummerActivityParticipant::model()->findAll('activity_id=?', array($id));
		$this->render('details',array(
			'model' => $model,
			'participants' => $participants,
		));
	}
}