<?php

class WorshipReportController extends Controller
{
	public function actionAjaxNewMemberReport()
	{
		$this->_downloadable("NewMemberRecord_" . date("Ymd"));
		$year_week = $_REQUEST["week_no"];
		$year = (int) date("Y");
		$week = (int) date("W");
		if ($year_week != "" && strpos($year_week, "-") !== false)
		{
			$year = (int) substr($year_week, 0, 4);
			$week = (int) substr($year_week, -2);
		}
		$query = "SELECT DISTINCT worship.name AS worship, member.arrived_date, member.code AS member_code, member.name, member.remarks " .
				"FROM tbl_worship_attendance AS wa " .
				"INNER JOIN tbl_member AS member ON wa.member_id=member.id " .
				"INNER JOIN tbl_worship AS worship ON wa.worship_id=worship.id " .
				"WHERE YEAR(member.arrived_date)='" . $year . "' " .
				"AND WEEKOFYEAR(member.arrived_date)='" . $week . "' " .
				"ORDER BY arrived_date, member_code";
		$data=Yii::app()->db->createCommand($query)->queryAll();
		$this->renderPartial('report_weekly_new_member',array(
			'data'=>$data,
			'year'=>$year,
			'week'=>$week,
		));
		Yii::app()->end();
	}
	
	public function actionAjaxNewMemberAttendanceFormReport()
	{
		$this->_downloadable("NewMemberAttendanceRecord_" . date("Ymd"));
		$year = (int) date("Y");
		$week = (int) date("W");
		$query = "SELECT DISTINCT " .
					"worship.name AS worship, " .
					"member.code AS member_code, " .
					"wa.worship_count AS sign_in_counts, " .
					"member.name, member.remarks, " .
					"(DATE_ADD(member.arrived_date, INTERVAL 8 DAY)>DATE(NOW())) AS is_new, " .
					"(member.new_card=2 OR member.new_card=1) AS has_new_card, " .
					"(wa.worship_count > 6) AS need_form " .
				"FROM tbl_member AS member " .
				"INNER JOIN (" .
					"SELECT " .
						"SUM( DATE(attendance_date)>DATE_SUB(NOW(), INTERVAL 2 MONTH) ) AS worship_count, " .
						"worship_id, " .
						"member_id " .
				  	"FROM tbl_worship_attendance " .
					"GROUP BY member_id " .
					"ORDER BY member_id, attendance_date DESC" .
				") AS wa ON wa.member_id = member.id " .
				"INNER JOIN tbl_worship AS worship ON wa.worship_id = worship.id " .
				"WHERE (member.account_type=0) OR member.new_card>0 " .
				"ORDER BY member.name";
		$data=Yii::app()->db->createCommand($query)->queryAll();
		$this->renderPartial('report_new_member_attendance',array(
			'data'=>$data,
			'year'=>$year,
			'week'=>$week,
			'worship_list'=>Worship::model()->findAll()
		));
		Yii::app()->end();
	}
	
	public function actionAjaxNewMembershipCardReport()
	{
		$this->_downloadable("NewCardRecord_" . date("Ymd"));
		$year_week = "";
		$year = (int) date("Y", time()-7*24*3600);
		$week = (int) date("W", time()-7*24*3600);
		if ($year_week != "" && strpos($year_week, "-") !== false)
		{
			$year = (int) substr($year_week, 0, 4);
			$week = (int) substr($year_week, -2);
		}
		$query = "SELECT period.name AS period, small_group.name AS small_group, member.code AS member_code, member.name " .
				"FROM tbl_member AS member " .
				"LEFT JOIN tbl_group_member AS group_member ON group_member.member_id=member.id " . 
				"LEFT JOIN tbl_group AS small_group ON group_member.group_id=small_group.id " .
				"LEFT JOIN tbl_group_period AS period ON period.id=small_group.period_id " .
				"WHERE member.new_card>0 ";
		$data=Yii::app()->db->createCommand($query)->queryAll();
		$this->renderPartial('report_weekly_new_membership_card',array(
			'data'=>$data,
			'year'=>$year,
			'week'=>$week,
		));
		Yii::app()->end();
	}
	
	public function actionAjaxAttendanceReport()
	{
		$this->_downloadable("AttendanceRecord_" . date("Ymd"));
		$member_type = $_REQUEST["member_type"];
		$year_week = $_REQUEST["week_no"];
		$year = (int) date("Y");
		$week = (int) date("W");
		if ($year_week != "" && strpos($year_week, "-") !== false)
		{
			$year = (int) substr($year_week, 0, 4);
			$week = (int) substr($year_week, -2);
		}
		$period = (int) $_REQUEST["group_period"];
		$query = "SELECT last_worship.worship_name AS worship, " .
					"last_worship.last_attendance_date, " .
					"period.name AS period, " .
					"small_group.name AS small_group, " .
					"member.code AS member_code, " .
					"member.name " .
				"FROM tbl_member AS member " .
				"INNER JOIN (" .
					"SELECT worship.name AS worship_name, wa.member_id, MAX(attendance_date) AS last_attendance_date " .
					"FROM tbl_worship_attendance AS wa " .
					"INNER JOIN tbl_worship AS worship ON worship.id=wa.worship_id " .
					"WHERE YEAR(wa.attendance_date)=" . $year . " " .
					"AND WEEKOFYEAR(wa.attendance_date)=" . $week . " " .
					"GROUP BY wa.member_id" .
				") AS last_worship ON last_worship.member_id=member.id " .
				"LEFT JOIN tbl_group_member AS group_member ON group_member.member_id=member.id " .
				"LEFT JOIN tbl_group AS small_group ON group_member.group_id=small_group.id " .
				"LEFT JOIN tbl_group_period AS period ON period.id=small_group.period_id " .
				"WHERE " . ($period > 0 ? "period.id=" . $period : "1") . " " .
				"AND " . ($member_type === "" ? "1" : "member.account_type=" . $member_type) . " " .
				"GROUP BY period, small_group, member_code";
		
		$data=Yii::app()->db->createCommand($query)->queryAll();
		$this->renderPartial('report_attendance',array(
			'data'=>$data,
			'year'=>$year,
			'week'=>$week,
			'period'=>$period,
		));
		Yii::app()->end();
	}
	
	public function actionAjaxAbsentReport()
	{
		$this->_downloadable("AbsentRecord_" . date("Ymd"));
		$member_type = $_REQUEST["member_type"];
		$year_week = $_REQUEST["week_no"];
		$year = (int) date("Y");
		$week = (int) date("W");
		if ($year_week != "" && strpos($year_week, "-") !== false)
		{
			$year = (int) substr($year_week, 0, 4);
			$week = (int) substr($year_week, -2);
		}
		$start_date = date("Y-m-d", strtotime("+" . ($week-1) . " MONDAY " . $year . "-01-01"));
		$period = (int) $_REQUEST["group_period"];
		$boundary = (int) $_REQUEST["boundary"];
		$query = "SELECT last_worship.worship_name AS worship, " .
					"last_worship.last_attendance_date, " .
					"period.name AS period, " .
					"small_group.name AS small_group, " .
					"member.code AS member_code, " .
					"member.name " .
				"FROM tbl_member AS member " .
				"INNER JOIN (" .
					"SELECT worship.name AS worship_name, wa.member_id, MAX(attendance_date) AS last_attendance_date " .
					"FROM tbl_worship_attendance AS wa " .
					"INNER JOIN tbl_worship AS worship ON worship.id=wa.worship_id " .
					"WHERE YEAR(wa.attendance_date)<=" . $year . " " .
					"AND WEEKOFYEAR(wa.attendance_date)<=" . $week . " " .
					"GROUP BY wa.member_id " .
					"ORDER BY attendance_date DESC" .
				") AS last_worship ON last_worship.member_id=member.id " .
				"LEFT JOIN tbl_group_member AS group_member ON group_member.member_id=member.id " .
				"LEFT JOIN tbl_group AS small_group ON group_member.group_id=small_group.id " .
				"LEFT JOIN tbl_group_period AS period ON period.id=small_group.period_id " .
				"WHERE " . ($period > 0 ? "period.id=" . $period : "1") . " " .
				"AND " . ($member_type === "" ? "1" : "member.account_type=" . $member_type) . " " .
				"AND YEARWEEK(last_worship.last_attendance_date, 3)<" . $year.$week . " " .
				($boundary == "" ? "" : "AND DATE(last_worship.last_attendance_date)>'" . date("Y-m-d", strtotime("-" . $boundary . " months " . date("Y-m-d"))) . " ") . "' " . 
				"GROUP BY period, small_group, member_code";
		$data=Yii::app()->db->createCommand($query)->queryAll();
		$this->renderPartial('report_absent',array(
			'data'=>$data,
			'year'=>$year,
			'week'=>$week,
			'period'=>$period,
		));
		Yii::app()->end();
	}
	
	public function actionAjaxAnnualReport()
	{
		$this->_downloadable("AnnualRecord_" . date("Ymd"));
		$year = (int) $_REQUEST['year'];
		$query = "SELECT stat.*, nmc.new_member_count, wr.remarks FROM (" .
					"SELECT MAX(DATE(wa.attendance_date)) AS d, ";
		$worship_list = Worship::model()->findAll(); 
		foreach ($worship_list as $worship) 
		{
			$query .= 	"SUM(wa.worship_id=" . $worship["id"] . ") AS w" . $worship["id"] . ", ";
		}
		$query .= 		"COUNT(DISTINCT DATE(attendance_date)) AS total, " .
						"COUNT(DISTINCT wa.member_id) AS total_p " .
					"FROM tbl_worship_attendance AS wa " .
					"WHERE YEAR(attendance_date)=" . $year . " " .
					"GROUP BY WEEKOFYEAR(attendance_date) " .
					"ORDER BY d) AS stat " .
				"LEFT JOIN (" .
					"SELECT MAX(fc.first_come) AS dd, COUNT(*) AS new_member_count FROM 
					(
					SELECT MIN(DATE(attendance_date)) AS first_come, member_id 
						FROM tbl_worship_attendance
						WHERE 1
						GROUP BY member_id
					ORDER BY first_come
					) AS fc
					WHERE YEAR(fc.first_come)=" . $year . " 
					GROUP BY WEEKOFYEAR(fc.first_come)" .
				") AS nmc ON nmc.dd=stat.d " .
				"LEFT JOIN tbl_worship_remarks AS wr ON wr.`worship_date`=stat.d";
		
		$data=Yii::app()->db->createCommand($query)->queryAll();
		$this->renderPartial('report_annual',array(
			'data'=>$data,
			'year'=>$year,
			'worship_list' => $worship_list,
		));
		Yii::app()->end();
	}
	
	public function actionAjaxBirthdayReport()
	{
		$this->_downloadable("BirthdayReport_" . date("Ymd"));
		
		$year_week = $_REQUEST["week_no"];
		$year = (int) date("Y");
		$week = (int) date("W");
		if ($year_week != "" && strpos($year_week, "-") !== false)
		{
			$year = (int) substr($year_week, 0, 4);
			$week = (int) substr($year_week, -2);
		}
		$dayofyear = (int) date("z", strtotime("+" . ($week-1) . " MONDAY " . $year . "-01-01"));
		$boundary = (int) $_REQUEST["boundary"];
		$query = "SELECT last_worship.worship_name AS worship, " .
					"last_worship.last_attendance_date, " .
					"period.name AS period, " .
					"small_group.name AS small_group, " .
					"member.code AS member_code, " .
					"member.name, " . 
					"CONCAT(DAYOFMONTH(member.birthday), '/', MONTH(member.birthday)) AS birthday " .
				"FROM tbl_member AS member " .
				"INNER JOIN (" .
					"SELECT worship.name AS worship_name, wa.member_id, MAX(attendance_date) AS last_attendance_date " .
					"FROM tbl_worship_attendance AS wa " .
					"INNER JOIN tbl_worship AS worship ON worship.id=wa.worship_id " .
					"WHERE YEAR(wa.attendance_date)<=" . $year . " " .
					"AND WEEKOFYEAR(wa.attendance_date)<=" . $week . " " .
					"GROUP BY wa.member_id " .
					"ORDER BY attendance_date DESC" .
				") AS last_worship ON last_worship.member_id=member.id " .
				"LEFT JOIN tbl_group_member AS group_member ON group_member.member_id=member.id " .
				"LEFT JOIN tbl_group AS small_group ON group_member.group_id=small_group.id " .
				"LEFT JOIN tbl_group_period AS period ON period.id=small_group.period_id " .
				"WHERE DAYOFYEAR(member.birthday)<=" . ($dayofyear+7) . " AND DAYOFYEAR(member.birthday)>=" . $dayofyear . " " .
				($boundary == "" ? "" : "AND DATE(last_worship.last_attendance_date)>'" . date("Y-m-d", strtotime("-" . $boundary . " months " . date("Y-m-d"))) . " ") . "' " . 
				"GROUP BY period, small_group, member_code";
		$data=Yii::app()->db->createCommand($query)->queryAll();
		$this->renderPartial('report_birthday',array(
			'data'=>$data,
			'year'=>$year,
			'week'=>$week,
		));
		Yii::app()->end();
	}
	
	private function _downloadable( $name="" )
	{
		if ($name == "")
			$name = date("Ymd");
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=" . $name . ".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
	}
}