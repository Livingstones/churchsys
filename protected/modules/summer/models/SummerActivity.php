<?php

/**
 * This is the model class for table "tbl_summer_activity".
 *
 * The followings are the available columns in table 'tbl_summer_activity':
 * @property integer $id
 * @property string $activity_name
 * @property string $description
 * @property string $person_in_charge
 *
 * The followings are the available model relations:
 * @property SummerActivityParticipant[] $summerActivityParticipants
 */
class SummerActivity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SummerActivity the static model class
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
		return 'tbl_summer_activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('activity_name, description, person_in_charge', 'required'),
			array('activity_name, person_in_charge', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, activity_name, description, person_in_charge', 'safe', 'on'=>'search'),
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
			'summerActivityParticipants' => array(self::HAS_MANY, 'SummerActivityParticipant', 'activity_id'),
			'participantCount' => array(self::STAT, 'SummerActivityParticipant', 'activity_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'activity_name' => 'Activity Name',
			'description' => 'Description',
			'person_in_charge' => 'Person In Charge',
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
		$criteria->compare('activity_name',$this->activity_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('person_in_charge',$this->person_in_charge,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}