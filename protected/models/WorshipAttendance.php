<?php

/**
 * This is the model class for table "tbl_worship_attendance".
 *
 * The followings are the available columns in table 'tbl_worship_attendance':
 * @property integer $worship_id
 * @property integer $member_id
 * @property string $attendance_date
 *
 * The followings are the available model relations:
 * @property Worship $worship
 * @property Member $member
 * 
 * The followings are the available for search:
 * @property integer $group_id
 */
class WorshipAttendance extends CActiveRecord
{
	public $w1, $w2, $w3, $w4, $w5, $w6, $w7, $w8, $w9, $w10, $w11, $w12, $w13, $w14, $w15;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return WorshipAttendance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_worship_attendance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('worship_id, member_id, attendance_date', 'required'),
			array('worship_id, member_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('worship_id, member_id, attendance_date, group_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'worship' => array(self::BELONGS_TO, 'Worship', 'worship_id'),
			'member' => array(self::BELONGS_TO, 'Member', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'worship_id' => '崇拜',
			'member_id' => '會友',
			'group_id' => '組別',
			'attendance_date' => '簽到日期',
			'w1' => 'w1',
		);
	}
	
	public function searchByMember()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$modelMember = Member::model();
		if(isset($_GET['Member'])) {
			$modelMember->setAttributes($_GET['Member']);
			$modelMember->assignedGroups = $_GET['Member']['assignedGroups'];
		}
		$criteria=new CDbCriteria;
		$criteria->compare('code',$modelMember->code,true);
		$criteria->compare('account_type',$modelMember->account_type);
		$criteria->compare('group_id',$modelMember->assignedGroups);
		//$criteria->compare('t.name',$this->member_id,true);
		//$criteria->compare('worship_id',$this->worship_id);
		$criteria->select = "t.*," . 
							"MAX(attendance_date) AS worshipAttendancesLastDate," . 
							"SUM(attendance_date >= '" . date("Y-m-d", strtotime("-2 months")) . "') AS worshipAttendancesTwoMonthCount," . 
							"SUM(attendance_date >= '" . date("Y-m-d", strtotime("-6 months")) . "') AS worshipAttendancesSixMonthCount," . 
							"SUM(attendance_date >= '" . date("Y-m-d", strtotime("-1 year")) . "') AS worshipAttendancesYearCount";
		$criteria->join = "LEFT JOIN tbl_worship_attendance AS worshipAttendance ON worshipAttendance.member_id=t.id ";
		$criteria->with = array("groups", "worshipAttendancesLastDate", "worshipAttendancesTwoMonthCount", "worshipAttendancesSixMonthCount", "worshipAttendancesYearCount");
		$criteria->together=true;
		$criteria->group = "t.id";
		
		return new CActiveDataProvider(get_class($modelMember), array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 30,
			),
			'sort' => array( 
				'attributes' => array(
					'code' => array('asc' => 't.id', 'desc' => 't.id DESC'),
					'account_type' => array('asc' => 'account_type', 'desc' => 'account_type DESC'),
					//'groupMember.groups' => array('asc' => 'groupMember.groups', 'desc' => 'groupMember.groups DESC'),
					'worshipAttendancesLastDate' => array('asc' => 'worshipAttendancesLastDate', 'desc' => 'worshipAttendancesLastDate DESC'),
					'worshipAttendancesTwoMonthCount' => array('asc' => 'worshipAttendancesTwoMonthCount DESC', 'desc' => 'worshipAttendancesTwoMonthCount'),
					'worshipAttendancesSixMonthCount' => array('asc' => 'worshipAttendancesSixMonthCount DESC', 'desc' => 'worshipAttendancesSixMonthCount'),
					'worshipAttendancesYearCount' => array('asc' => 'worshipAttendancesYearCount DESC', 'desc' => 'worshipAttendancesYearCount'),
				), 
				'defaultOrder' => array('member_id'),
			),
			
		));
	}
	
	public function searchByWorship()
	{
		$worship_list = Worship::model()->findAll();
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		$criteria->compare('YEAR(attendance_date)',$this->attendance_date);
		$criteria->group = "YEAR(attendance_date),WEEKOFYEAR(attendance_date)";
		$criteria->order = "attendance_date DESC";
		$criteria->select = "attendance_date";
		foreach ($worship_list as $worship)
		{
			$criteria->select .= ",SUM(worship_id=" . $worship->id . ") AS w" . $worship->id;
		}
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 30,
			),
		));
	}
	
	public function searchByDate()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$modelMember = Member::model();
		if(isset($_GET['Member'])) {
			$modelMember->setAttributes($_GET['Member']);
			$modelMember->assignedGroups = $_GET['Member']['assignedGroups'];
		}
		$criteria=new CDbCriteria;
		$criteria->compare('code',$modelMember->code,true);
		$criteria->compare('account_type',$modelMember->account_type);
		$criteria->compare('group_id',$modelMember->assignedGroups);
		//$criteria->compare('t.name',$this->member_id,true);
		//$criteria->compare('worship_id',$this->worship_id);
		$criteria->select = "t.*," . 
							"MAX(attendance_date) AS worshipAttendancesLastDate," . 
							"SUM(attendance_date >= '" . date("Y-m-d", strtotime("-2 months")) . "') AS worshipAttendancesTwoMonthCount," . 
							"SUM(attendance_date >= '" . date("Y-m-d", strtotime("-6 months")) . "') AS worshipAttendancesSixMonthCount," . 
							"SUM(attendance_date >= '" . date("Y-m-d", strtotime("-1 year")) . "') AS worshipAttendancesYearCount";
		$criteria->join = "INNER JOIN tbl_worship_attendance AS worshipAttendance ON worshipAttendance.member_id=t.id";
		$criteria->with = array("groups", "worshipAttendancesLastDate", "worshipAttendancesTwoMonthCount", "worshipAttendancesSixMonthCount", "worshipAttendancesYearCount");
		$criteria->together=true;
		$criteria->group = "t.id";
		$criteria->having = "MAX(DATE(attendance_date))='" . date('Y-m-d', strtotime($_REQUEST['date'])) . "'";
		$criteria->order = "worshipAttendancesLastDate";
		
		return new CActiveDataProvider(get_class($modelMember), array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 30,
			),
			'sort' => array( 
				'attributes' => array(
					'code' => array('asc' => 't.id', 'desc' => 't.id DESC'),
					'account_type' => array('asc' => 'account_type', 'desc' => 'account_type DESC'),
					//'groupMember.groups' => array('asc' => 'groupMember.groups', 'desc' => 'groupMember.groups DESC'),
					'worshipAttendancesLastDate' => array('asc' => 'worshipAttendancesLastDate', 'desc' => 'worshipAttendancesLastDate DESC'),
					'worshipAttendancesTwoMonthCount' => array('asc' => 'worshipAttendancesTwoMonthCount DESC', 'desc' => 'worshipAttendancesTwoMonthCount'),
					'worshipAttendancesSixMonthCount' => array('asc' => 'worshipAttendancesSixMonthCount DESC', 'desc' => 'worshipAttendancesSixMonthCount'),
					'worshipAttendancesYearCount' => array('asc' => 'worshipAttendancesYearCount DESC', 'desc' => 'worshipAttendancesYearCount'),
				), 
				'defaultOrder' => array('worshipAttendancesLastDate'),
			),
			
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('worship_id',$this->worship_id);
		$criteria->compare('attendance_date',$this->attendance_date,true);
		$criteria->order = 'attendance_date DESC';

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 30,
			),
		));
	}
	
	public function scopes()
    {
        return array(
            'lastWeek'=>array(
                'condition'=>'DATE(attendance_date) >= DATE_SUB(NOW(), INTERVAL 7 DAY)',
            ),
            'lastTwoMonth'=>array(
                'condition'=>'DATE(attendance_date) >= DATE_SUB(NOW(), INTERVAL 2 MONTH)',
            ),
            'lastThreeMonth'=>array(
                'condition'=>'DATE(attendance_date) >= DATE_SUB(NOW(), INTERVAL 3 MONTH)',
            ),
            'lastSixMonth'=>array(
                'condition'=>'DATE(attendance_date) >= DATE_SUB(NOW(), INTERVAL 6 MONTH)',
            ),
            'lastYear'=>array(
                'condition'=>'DATE(attendance_date) >= DATE_SUB(NOW(), INTERVAL 12 MONTH)',
            ),
        );
    }
}
