<?php

/**
 * WorshipAttendanceNewForm class.
 * WorshipAttendanceNewForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class WorshipAttendanceNewForm extends CFormModel
{
	public $member_name;
	public $member_remarks;
	public $member_gender;
	public $member_group;
	public $worship_id;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('member_name, member_gender, member_group, worship_id', 'required'),
			array('member_remarks', 'safe'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'member_name' => '會友姓名',
			'member_remarks' => '備註',
			'member_gender' => '性別',
			'member_group' => '小組',
			'worship_id' => '崇拜'
		);
	}
	
	public function attendNow()
	{
		if (empty($this->member_name))
		{
			return "請輸入新朋友的名字!";
		}
		$attendance_date = date("Y-m-d H:i:s");
		if (isset($_REQUEST['adminTake']) && !empty($_REQUEST['adminTake']))
		{
			$attendance_date = $_REQUEST['WorshipAttendanceNewForm']['attendance_date'];
		}
		$wa = WorshipAttendance::model()->with("member")->find("DATE(attendance_date)=CURDATE() AND DATE(member.arrived_date)=CURDATE() AND member.name=:member_name", array("member_name"=>$this->member_name));
		if ($wa !== null)
			return $wa->member->name . " 已經新增!! 請輸入其他新朋友!!";
		
		$query = 'SELECT (MIN(code1)+1) AS code FROM
(SELECT t0.code AS code1, t1.code AS codeplus1 FROM tbl_member AS t0 LEFT JOIN tbl_member AS t1 ON t0.code+1=t1.code WHERE t0.code>9100) AS temp
WHERE codeplus1 IS NULL';		
		$nextCode=Yii::app()->db->createCommand($query)->queryScalar();
		
		$member = new Member;
		$member->state = 1;
		$member->code = $nextCode;
		$member->name = $this->member_name;
		$member->remarks = $this->member_remarks;
		$member->gender = $this->member_gender;
		$member->account_type = Member::ACCOUNT_TYPE_NEW_MEMBER;
		$member->new_card = Member::NEW_CARD_NO_CARD;
		$member->arrived_date = $attendance_date;
		$member->create_date = $attendance_date;
		$member->modify_date = $attendance_date;
		$member->creator_id = Yii::app()->user->id;
		$member->modifier_id = Yii::app()->user->id;
		if (!$member->save())
		{
			print_r($member->getErrors());
			return "新增 新朋友 " . $this->member_name . "錯誤 ! 敬請願諒 ! ";
		}
		else
		{
			$group = new GroupMember;
			$group->group_id = (int) $this->member_group;
			$group->member_id = $member->id;
			$group->member_type = GroupMember::MEMBER_TYPE_MEMBER;
			$group->save();
		}
		
		$worshipAttendance = new worshipAttendance;
		$worshipAttendance->worship_id = $this->worship_id;
		$worshipAttendance->member_id = $member->id;
		$worshipAttendance->attendance_date = $attendance_date;
		if (!$worshipAttendance->save())
		{
			print_r($worshipAttendance->getErrors());
			return "新增 新朋友 " . $this->member_name . "錯誤 ! 敬請願諒 ! ";
		}
		
		$message = "<span style='color:yellow'>新朋友 " . $member->name . " (" . $member->code . ") 己新增!</span>";
		$message .= "<script type=\"text/javascript\">
			onTakeSuccess(" . $member->id . ", '" . $member->name . "', '" . $member->code . "', '" . date("H:i") . "');
			</script>";
		
		return $message;
		
	}
}