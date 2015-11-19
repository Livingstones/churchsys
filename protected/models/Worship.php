<?php

/**
 * This is the model class for table "tbl_worship".
 *
 * The followings are the available columns in table 'tbl_worship':
 * @property integer $id
 * @property integer $state
 * @property string $name
 * @property string $start_time
 * @property string $end_time
 * @property integer $weekly
 * @property string $remarks
 *
 * The followings are the available model relations:
 * @property WorshipAttendance[] $worshipAttendances
 * @property WorshipRemarks[] $worshipRemarks
 */
class Worship extends CActiveRecord
{
	public function getWeeklyList($value = "")
	{
		$list = array(
			0 => "週日",
			1 => "週一",
			2 => "週二",
			3 => "週三",
			4 => "週四",
			5 => "週五",
			6 => "週六",
		);
		return $value === "" ? $list : $list[$value];
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Worship the static model class
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
		return 'tbl_worship';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, start_time, end_time, weekly', 'required'),
			array('weekly', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, state, start_time, end_time, weekly, remarks', 'safe', 'on'=>'search'),
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
			'worshipAttendances' => array(self::HAS_MANY, 'WorshipAttendance', 'worship_id'),
			'worshipRemarks' => array(self::HAS_MANY, 'WorshipRemarks', 'worship_id'),
		
			'lastAttendanceCount' => array(self::STAT, 'WorshipAttendance', 'worship_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'state' => 'State',
			'name' => '名稱',
			'start_time' => '開始時間',
			'end_time' => '結束時間',
			'weekly' => '每週',
			'remarks' => '備註',
			'lastAttendanceCount' => '上次出席總人數'
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
		$criteria->compare('state', 1);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('weekly',$this->weekly);
		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
