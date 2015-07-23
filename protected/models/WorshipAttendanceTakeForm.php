<?php

/**
 * WorshipAttendanceTakeForm class.
 * WorshipAttendanceTakeForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class WorshipAttendanceTakeForm extends CFormModel
{
	public $member_code;
	public $member_name;
	public $worship_id;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('member_code, member_name', 'required'),
			array('member_code', 'numerical', 'integerOnly'=>true),
			array('worship_id', 'numerical', 'integerOnly'=>true),
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
			'member_code' => '會友編號/姓名',
			'member_name' => '會友姓名',
			'worship_id' => '崇拜'
		);
	}
	
	public function attendNow()
	{
		// Check Worship
		$modelWorship = Worship::model()->findByPk($this->worship_id);
		if ($modelWorship===null)
		{
			return "今天沒有崇拜!";
		}
		$attendance_date = date("Y-m-d H:i:s");
		if (isset($_REQUEST['adminTake']) && !empty($_REQUEST['adminTake']))
		{
			$attendance_date = $_REQUEST['WorshipAttendanceTakeForm']['attendance_date'];
		}
		
		// Check Member
		if (empty($this->member_code) && !empty($this->member_name))
		{
			$members = Member::model()->findAllByAttributes(array("name" => $this->member_name));
			if (count($members) > 1)
			{
				$message = "";
				foreach ($members as $key => $member){
					$message .= "<a href=\"javascript:void(0);\" onclick=\"jQuery('#WorshipAttendanceTakeForm_member_code').val('" . $member['code'] . "');jQuery('#take_attendance_form').submit();\">" . $member['name'] . " (" . $member['code'] . ")</a><br/>";
				}
				return $message;
			}
			else
			{
				$this->member_code = $members[0]["code"];
			}
		}
		
		$modelMember = Member::model()->findByAttributes(array("code" => $this->member_code));
		if ($modelMember===null)
		{
			$members = Member::model()->findAllByAttributes(array("name" => $this->member_code));
			if (count($members) > 1)
			{
				$message = "";
				foreach ($members as $key => $member){
					$message .= "<a href=\"javascript:void(0);\" onclick=\"jQuery('#WorshipAttendanceTakeForm_member_code').val('" . $member['code'] . "');jQuery('#take_attendance_form').submit();\">" . $member['name'] . " (" . $member['code'] . ")</a><br/>";
				}
				return $message;
			}
			elseif (count($members) == 1)
			{
				$modelMember = $members[0];
			}
			else
			{
				return "找不到此會友!";
			}
		}
		
		// Check Duplicate Attendance
		$criteria = new CDbCriteria;
		$criteria->compare('worship_id',$this->worship_id);
		$criteria->compare('member_id',$modelMember->id);
		$criteria->compare('DATE(attendance_date)',date("Y-m-d", strtotime($attendance_date)));
		$model = WorshipAttendance::model()->find($criteria);
		
		if ($model !== null)
		{
			return $modelMember->name . " 己出席崇拜!";
		}
		
		// Create Worship Attendance
		$model = new WorshipAttendance;
		$model->worship_id = $this->worship_id;
		$model->member_id = $modelMember->id;
		$model->attendance_date = $attendance_date;
		$model->save();

        $gender = (int) $modelMember->gender;
        $brother_sister = "弟兄/姊妹";
        if ($gender === 2) {
            $brother_sister = "弟兄";
        } elseif ($gender === 1) {
            $brother_sister = "姊妹";
        }
		// General Welcome Message
		$message = $modelMember->name . " " . $brother_sister . " 歡迎您!";
		
		// Get Birthday Celebrate Message
		if (date("m-d", strtotime($modelMember->birthday)) >= date("m-d") && date("m-d", strtotime($modelMember->birthday)) <= date("m-d", time() + (7 * 24 * 3600)))
		{
			$message .= "<br/>" . date("d/m", strtotime($modelMember->birthday)) . " 是您的生日，祝您生日快樂！";	
		}
		
		// Get Greeting Message
		WorshipGreeting::model()->deleteAll('expiry_date<NOW()');
		$modelGreeting = WorshipGreeting::model()->findByAttributes(array('member_id' => $modelMember->id));
		if ($modelGreeting !== null)
		{
			$message .= "<br/>" . $modelGreeting->message;
		}
		
		$criteria = new CDbCriteria;
		$criteria->compare('member.account_type','=' . MEMBER::ACCOUNT_TYPE_NEW_MEMBER);
		$criteria->compare('member_id',$modelMember->id);
//        $worship_count = (int) WorshipAttendance::model()->lastTwoMonth()->with('member')->count($criteria);
        // cancel two month limit (edited by Warren Chan Ka Lun 2015-07-22)
        $worship_count = (int) WorshipAttendance::model()->with('member')->count($criteria);
        // show
		if ($worship_count >= 6) {
			$message = "<span style='color: purple'>" . $modelMember->name . $brother_sister . "，歡迎你第" . $worship_count . "次參與活石家崇拜，邀請您填交會友資料表格，成為會友。</span>";
		} elseif ($worship_count === 5) {
            $message = "<span style='color: purple'>" . $modelMember->name . $brother_sister . "，歡迎你第5次參與活石家崇拜。</span>";
        } elseif ($worship_count === 4) {
            $message = "<span style='color: purple'>" . $modelMember->name . $brother_sister . "，歡迎你第4次參與活石家崇拜。</span>";
        } elseif ($worship_count === 3) {
            $message = "<span style='color: purple'>" . $modelMember->name . $brother_sister . "，歡迎你第3次參與活石家崇拜。</span>";
        } elseif ($worship_count === 2) {
            $message = "<span style='color: purple'>" . $modelMember->name . $brother_sister . "，歡迎你第2次參與活石家崇拜。</span>";
        } elseif ($worship_count === 1) {
            $message = "<span style='color: yellow'>" . $modelMember->name . $brother_sister . "，歡迎你第1次參與活石家崇拜。</span>";
        }
		
		if ($modelMember->new_card == MEMBER::NEW_CARD_WAITING_CARD) {
			$message .= "<br/>您的\"個人名牌\"己備妥，請領取。";
			$modelMember->new_card = 0;
			$modelMember->save();
		}
		$message .= "<script type=\"text/javascript\">
			onTakeSuccess(" . $modelMember->id . ", '" . $modelMember->name . "', '" . $modelMember->code . "', '" . date("H:i") . "');
			</script>";
		return $message;
		
	}
	
}