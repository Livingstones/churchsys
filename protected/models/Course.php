<?php

/**
 * This is the model class for table "tbl_course".
 *
 * The followings are the available columns in table 'tbl_course':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property string $lesson_time
 * @property string $venue
 * @property string $teacher
 * @property integer $state
 *
 * The followings are the available model relations:
 * @property Member[] $members
 */
class Course extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Course the static model class
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
		return 'tbl_course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, start_date, end_date, lesson_time, venue, teacher, state', 'required'),
			array('state', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>10),
			array('name, venue, teacher', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code, name, start_date, end_date, lesson_time, venue, teacher, state', 'safe', 'on'=>'search'),
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
			'members' => array(self::MANY_MANY, 'Member', 'tbl_course_member(course_id, member_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => '編號',
			'name' => '名稱',
			'start_date' => '開課日期',
			'end_date' => '結束日期',
			'lesson_time' => '授課時間',
			'venue' => '地點',
			'teacher' => '教師',
			'state' => '狀態',
		);
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

		$criteria->compare('id',$this->id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('lesson_time',$this->lesson_time,true);
		$criteria->compare('venue',$this->venue,true);
		$criteria->compare('teacher',$this->teacher,true);
		$criteria->compare('state',$this->state);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	protected function afterSave()
	{
		parent::afterSave();
		if (isset($_REQUEST["delete"]) && is_array($_REQUEST["delete"])) {
			foreach ($_REQUEST["delete"] as $k => $d) {
				CourseMember::model()->deleteAll("course_id=:cid AND member_id=:mid", array(":cid" => $this->id, ":mid" => $k));
			}
		}
		for ($i=0; $i<10; $i++){
			if (!empty($_REQUEST["new_member_name_" . $i])){
				if (empty($_REQUEST["new_member_code_" . $i])){
					$member = Member::model()->find("code=:code", array("code"=>$_REQUEST["new_member_name_" . $i]));
					if (empty($member)){
						continue;
					}
					$_REQUEST["new_member_code_" . $i] = $member->id;
				}
				
				CourseMember::model()->deleteAll("course_id=:cid AND member_id=:mid", array(":cid" => $this->id, ":mid" => $_REQUEST["new_member_code_" . $i]));
				
				$courseMember = new CourseMember;
				$courseMember->course_id = $this->id;
				$courseMember->member_id = $_REQUEST["new_member_code_" . $i];
				$courseMember->remarks = $_REQUEST["new_remarks_" . $i];
				$courseMember->save();
			
			}
		}
	}
}