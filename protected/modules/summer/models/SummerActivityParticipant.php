<?php

/**
 * This is the model class for table "tbl_summer_activity_participant".
 *
 * The followings are the available columns in table 'tbl_summer_activity_participant':
 * @property integer $activity_id
 * @property string $name
 * @property integer $age
 * @property string $mobile
 * @property string $email
 * @property string $school
 *
 * The followings are the available model relations:
 * @property SummerActivity $activity
 */
class SummerActivityParticipant extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SummerActivityParticipant the static model class
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
		return 'tbl_summer_activity_participant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('activity_id, name, age, mobile, email, school', 'required'),
			array('age', 'numerical', 'integerOnly'=>true),
			array('email', 'email'),
			array('name, email, school', 'length', 'max'=>255),
			array('mobile', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('activity_id, name, age, mobile, email, school', 'safe', 'on'=>'search'),
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
			'activity' => array(self::BELONGS_TO, 'SummerActivity', 'activity_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'activity_id' => '活動',
			'name' => '姓名',
			'age' => '年齡',
			'mobile' => '電話',
			'email' => 'E-mail',
			'school' => '學校',
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

		$criteria->compare('activity_id',$this->activity_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('school',$this->school,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}