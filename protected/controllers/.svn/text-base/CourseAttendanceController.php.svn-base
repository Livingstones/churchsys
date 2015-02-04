<?php

class CourseAttendanceController extends Controller
{
	public function actionIndex()
	{
		$this->redirect(array('course/admin'));
	}

	public function actionView($id)
	{
		if(isset($_POST['CourseAttendance']))
		{
			if (isset($_POST['CourseAttendance']['attendance'])){
				foreach ($_POST['CourseAttendance']['attendance'] as $vdate => $members)
				{
					CourseAttendance::model()->deleteAll("course_id=:course_id AND attendance_date=:date", array("course_id"=>$id, "date"=>$vdate));
					foreach ($members as $member_id => $v)
					{
						if ($member_id == 0){
							continue;
						}
						$newModel = new CourseAttendance;
						$newModel->course_id = $id;
						$newModel->member_id = $member_id;
						$newModel->lesson_number = 0;
						$newModel->state = 1;
						$newModel->attendance_date = $vdate;
						$newModel->insert();
					}
				}
			}
			
			if (!empty($_POST['CourseAttendance']['newDate']))
			{
				foreach ($_POST['CourseAttendance']['newAttendance'] as $k => $v)
				{
					$newModel = new CourseAttendance();
					$newModel->course_id = $id;
					$newModel->member_id = $k;
					$newModel->lesson_number = 0;
					$newModel->state = 1;
					$newModel->attendance_date = $_POST["CourseAttendance"]["newDate"];
					$newModel->insert();
				}
			}
		}
		
		$criteria=new CDbCriteria(array(
	        'condition'=>'course_id='.$id,
	        'order'=>'member_id',
	    ));
        $member_list = CourseMember::model()->findAll($criteria);
        
		$query = "SELECT DISTINCT attendance_date " . 
				"FROM tbl_course_attendance " . 
				"WHERE course_id=" . ((int) $id) . " " . 
				"ORDER BY attendance_date DESC LIMIT 0, 10";
		$date_list = Yii::app()->db->createCommand($query)->queryColumn();
		$date_list = array_reverse($date_list);
		
		$this->render('view',array(
			'model'=>Course::model()->findByPk($id),
	        'coursemembers'=>$member_list,
	        'dates'=>$date_list,
		));
	}
}