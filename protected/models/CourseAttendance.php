<?php

/**
 * This is the model class for table "tbl_course_attendance".
 *
 * The followings are the available columns in table 'tbl_course_attendance':
 * @property integer $course_id
 * @property integer $member_id
 * @property string $attendance_date
 * @property integer $lesson_number
 * @property integer $state
 *
 * The followings are the available model relations:
 * @property Course $course
 * @property Member $member
 */
class CourseAttendance extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CourseAttendance the static model class
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
		return 'tbl_course_attendance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course_id, member_id, attendance_date, lesson_number, state', 'required'),
			array('course_id, member_id, lesson_number, state', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('course_id, member_id, attendance_date, lesson_number, state', 'safe', 'on'=>'search'),
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
			'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
			'member' => array(self::BELONGS_TO, 'Member', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'course_id' => 'Course',
			'member_id' => 'Member',
			'attendance_date' => 'Attendance Date',
			'lesson_number' => 'Lesson Number',
			'state' => 'State',
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

		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('attendance_date',$this->attendance_date,true);
		$criteria->compare('lesson_number',$this->lesson_number);
		$criteria->compare('state',$this->state);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}