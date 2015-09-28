<?php

class WorshipAttendanceController extends Controller
{

    public function actionMobileTake()
    {
        Yii::app()->theme = 'mobile';

        $model=new WorshipAttendanceTakeForm;
        $model_new=new WorshipAttendanceNewForm;

        // worship data
        $query = "SELECT worship.id AS id, " .
            "worship.name AS name, " .
            "SUM(member.id > 0 AND DATE(NOW())=DATE(worship_attendance.attendance_date)) AS memberCount, " .
            "SUM(member.id > 0 AND DATE(member.arrived_date)=DATE(NOW()) AND DATE(NOW())=DATE(worship_attendance.attendance_date)) AS newMemberCount " .
            "FROM tbl_worship AS worship " .
            "LEFT JOIN tbl_worship_attendance AS worship_attendance ON worship_attendance.worship_id=worship.id " .
            "LEFT JOIN tbl_member AS member ON member.id=worship_attendance.member_id " .
            "WHERE DAYOFWEEK(NOW())=weekly+1 " .
            "GROUP BY worship.id " .
            "ORDER BY worship.start_time ASC";
        $worshipData=Yii::app()->db->createCommand($query)->queryAll();
        $worshipDataProvider=new CArrayDataProvider($worshipData, array(
            'id'=>'worshipData',
        ));

        $query = "SELECT id, name
FROM tbl_worship
WHERE DAYOFWEEK(NOW())=weekly+1 AND start_time<=CURTIME() AND end_time>=CURTIME()";
        $curWorshipData=Yii::app()->db->createCommand($query)->queryAll();
        $worship_id = 0;
        $worship_name = "";
        if (count($curWorshipData) > 0){
            $worship_id = $curWorshipData[0]["id"];
            $worship_name = $curWorshipData[0]["name"];
        } elseif (count($worshipData) > 0){
            $worship_id = $worshipData[0]["id"];
            $worship_name = $worshipData[0]["name"];
        }

        $query = "SELECT CONCAT(attendance.worship_id, '-', member.id) AS id, member.name AS name, member.code AS code, attendance_date " .
            "FROM tbl_worship_attendance AS attendance " .
            "INNER JOIN tbl_member AS member ON member.id=attendance.member_id " .
            "WHERE attendance.worship_id=" . ($worship_id) . " " .
            "AND DATE(attendance_date)=DATE(NOW()) " .
            "ORDER BY attendance.attendance_date DESC";
        $attendanceData=Yii::app()->db->createCommand($query)->queryAll();
        $attendanceDataProvider=new CArrayDataProvider($attendanceData, array(
            'id'=>'attendanceData',
            'pagination'=>array(
                'pageSize'=>99999,
            ),
        ));

        $this->render('take', array(
            'model'=>$model,
            'model_new'=>$model_new,
            'worshipDataProvider'=>$worshipDataProvider,
            'attendanceDataProvider'=>$attendanceDataProvider,
            'worship_id'=>$worship_id,
            'worship_name'=>$worship_name,
        ));
    }
	
	public function actionTake()
	{
		$model=new WorshipAttendanceTakeForm;
		$model_new=new WorshipAttendanceNewForm;
		
		// worship data
		$query = "SELECT worship.id AS id, " .
						"worship.name AS name, " .
						"SUM(member.id > 0 AND DATE(NOW())=DATE(worship_attendance.attendance_date)) AS memberCount, " .
						"SUM(member.id > 0 AND DATE(member.arrived_date)=DATE(NOW()) AND DATE(NOW())=DATE(worship_attendance.attendance_date)) AS newMemberCount " .
				"FROM tbl_worship AS worship " .
				"LEFT JOIN tbl_worship_attendance AS worship_attendance ON worship_attendance.worship_id=worship.id " .
				"LEFT JOIN tbl_member AS member ON member.id=worship_attendance.member_id " .
				"WHERE DAYOFWEEK(NOW())=weekly+1 " .
				"GROUP BY worship.id " . 
				"ORDER BY worship.start_time ASC";
		$worshipData=Yii::app()->db->createCommand($query)->queryAll();
		$worshipDataProvider=new CArrayDataProvider($worshipData, array(
		    'id'=>'worshipData',
		));
		
		$query = "SELECT id, name
FROM tbl_worship
WHERE DAYOFWEEK(NOW())=weekly+1 AND start_time<=CURTIME() AND end_time>=CURTIME()";
		$curWorshipData=Yii::app()->db->createCommand($query)->queryAll();
		$worship_id = 0;
		$worship_name = "";
		if (count($curWorshipData) > 0){
			$worship_id = $curWorshipData[0]["id"];
			$worship_name = $curWorshipData[0]["name"];
		} elseif (count($worshipData) > 0){
			$worship_id = $worshipData[0]["id"];
			$worship_name = $worshipData[0]["name"];
		}
		
		$query = "SELECT CONCAT(attendance.worship_id, '-', member.id) AS id, member.name AS name, member.code AS code, attendance_date " .
				"FROM tbl_worship_attendance AS attendance " .
				"INNER JOIN tbl_member AS member ON member.id=attendance.member_id " .
				"WHERE attendance.worship_id=" . ($worship_id) . " " .
						"AND DATE(attendance_date)=DATE(NOW()) " .
				"ORDER BY attendance.attendance_date DESC";
		$attendanceData=Yii::app()->db->createCommand($query)->queryAll();
		$attendanceDataProvider=new CArrayDataProvider($attendanceData, array(
		    'id'=>'attendanceData',
			'pagination'=>array(
		        'pageSize'=>99999,
		    ),
		));
		
		$this->render('take', array(
			'model'=>$model,
			'model_new'=>$model_new,
			'worshipDataProvider'=>$worshipDataProvider,
			'attendanceDataProvider'=>$attendanceDataProvider,
			'worship_id'=>$worship_id,
			'worship_name'=>$worship_name,
		));
	}
	
	public function actionAjaxTake()
	{
		if (!isset($_POST['WorshipAttendanceTakeForm']))
		{
			Yii::app()->end();
		}
		$model=new WorshipAttendanceTakeForm;
		$model->attributes=$_POST['WorshipAttendanceTakeForm'];
		$message = $model->attendNow();
		$message .= "<script type=\"text/javascript\">
		renewAttendanceForm();
		</script>
		";
		echo $message;
		Yii::app()->end();
	}
	
	public function actionAjaxNewMember()
	{
		if (!isset($_POST['WorshipAttendanceNewForm']))
		{
			Yii::app()->end();
		}
		$model=new WorshipAttendanceNewForm;
		$model->attributes=$_POST['WorshipAttendanceNewForm'];
		$message = $model->attendNow();
		$message .= "<script type=\"text/javascript\">
		renewNewMemberForm();
		</script>
		";
		echo $message;
		Yii::app()->end();
	}
	
	public function actionAjaxWorshipStat()
	{
		$query = "SELECT worship.id AS id, " .
						"worship.name AS name, " .
						"SUM(member.id > 0 AND DATE(NOW())=DATE(worship_attendance.attendance_date)) AS memberCount, " .
						"SUM(member.id > 0 AND DATE(member.arrived_date)=DATE(NOW()) AND DATE(NOW())=DATE(worship_attendance.attendance_date)) AS newMemberCount " .
				"FROM tbl_worship AS worship " .
				"LEFT JOIN tbl_worship_attendance AS worship_attendance ON worship_attendance.worship_id=worship.id " .
				"LEFT JOIN tbl_member AS member ON member.id=worship_attendance.member_id " .
				"WHERE DAYOFWEEK(NOW())=weekly+1 " .
				"GROUP BY worship.id " . 
				"ORDER BY worship.start_time ASC";
		$worshipData=Yii::app()->db->createCommand($query)->queryAll();
		$worshipDataProvider=new CArrayDataProvider($worshipData, array(
		    'id'=>'worshipData',
		));
		
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'worship-stat-grid',
			'dataProvider'=>$worshipDataProvider,
			'enablePagination' => false,
			'summaryText'=>'',
			'columns'=>array(
				'name:text:崇拜',
				array(
					'id' => 'memberCount',
					'name' => 'memberCount',
					'value' => '$data["memberCount"]',
					'header' => '會友',
				),
				array(
					'id' => 'newMemberCount',
					'name' => 'newMemberCount',
					'value' => '$data["newMemberCount"]',
					'header' => '新朋友',
				),
			),
		));
		Yii::app()->end();
	}
	
	public function actionDeleteByWorshipMember()
	{
		$e = explode("-", $_REQUEST["worship_member"]);
		$worship_id = (int) $e[0];
		$member_id = (int) $e[1];
		
		WorshipAttendance::model()->deleteAll("worship_id=:worship_id AND member_id=:member_id AND DATE(attendance_date)=CURDATE()", 
						array("worship_id"=>$worship_id,"member_id"=>$member_id));
		
	}

	/**
	 * Manages all models.
	 */
	public function actionListByMember()
	{
		$model=new WorshipAttendance('searchByMember');

		$this->render('list_by_member',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionListByWorship()
	{
		$model=new WorshipAttendance('searchByWorshp');

		$this->render('list_by_worship',array(
			'model'=>$model,
		));
	}
	
	public function actionListByDate()
	{
		$model=new WorshipAttendance('searchByDate');
		
		$this->render('list_by_date', array(
			'model'=>$model,
			'worship_date'=>$_REQUEST['date']
		));
	}

	/**
	 * view all models.
	 */
	public function actionView()
	{
		$model=new WorshipAttendance('search');
//		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['WorshipAttendance']))
			$model->attributes=$_GET['WorshipAttendance'];
		if(isset($_GET['id']))
			$model->member_id = $_GET['id'];

		$this->render('view',array(
			'model'=>$model,
		));
	}
}