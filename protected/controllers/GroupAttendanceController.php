<?php

class GroupAttendanceController extends Controller
{

	public function actionIndex()
	{
		//$this->redirect(array('view','id'=>$model->id));
		$this->redirect(array('group/admin'));
		//$this->render('index');
	}

	public function actionView($id)
	{
		if(isset($_POST['GroupAttendance']))
		{
			if (isset($_POST['GroupAttendance']['attendance']))
			{
				foreach ($_POST['GroupAttendance']['attendance'] as $vdate => $members)
				{
					GroupAttendance::model()->deleteAll("group_id=:group_id AND attendance_date=:date", array("group_id"=>$id, "date"=>$vdate));
					foreach ($members as $member_id => $v)
					{
						if ($member_id == 0){
							continue;
						}
						$newModel = new GroupAttendance;
						$newModel->group_id = $id;
						$newModel->member_id = $member_id;
						$newModel->attendance_date = $vdate;
						$newModel->save();
					}
				}
			}
			
			if (!empty($_POST['GroupAttendance']['newDate']))
			{
				foreach ($_POST['GroupAttendance']['newAttendance'] as $k => $v)
				{
					$newModel = new GroupAttendance;
					$newModel->group_id = $id;
					$newModel->member_id = $k;
					$newModel->attendance_date = $_POST["GroupAttendance"]["newDate"];
					$newModel->save();
				}
			}
		}
		
		$criteria=new CDbCriteria(array(
	        'condition'=>'group_id=:id',
			'params'=>array(":id"=>$id),
	        'order'=>'code',
			'with'=>'groups',
			'together'=>true,
	    ));
        $member_list = Member::model()->findAll($criteria);
        
		$query = "SELECT DISTINCT attendance_date " . 
				"FROM tbl_group_attendance " . 
				"WHERE group_id=" . ((int) $id) . " " . 
				"ORDER BY attendance_date DESC LIMIT 0, 10";
		$date_list = Yii::app()->db->createCommand($query)->queryColumn();
		$date_list = array_reverse($date_list);
		
		$this->render('view',array(
			'model'=>Group::model()->findByPk($id),
	        'members'=>$member_list,
	        'dates'=>$date_list,
		));
	}
}