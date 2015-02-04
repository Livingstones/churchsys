<?php

/**
 * This is the model class for table "tbl_worship_remarks".
 *
 * The followings are the available columns in table 'tbl_worship_remarks':
 * @property integer $id
 * @property integer $worship_id
 * @property string $worship_date
 * @property string $remarks
 *
 * The followings are the available model relations:
 * @property Worship $worship
 */
class WorshipRemarks extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return WorshipRemarks the static model class
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
		return 'tbl_worship_remarks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('worship_id, worship_date, remarks', 'required'),
			array('worship_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, worship_id, worship_date, remarks', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'worship_id' => 'Worship',
			'worship_date' => 'Worship Date',
			'remarks' => 'Remarks',
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
		$criteria->compare('worship_id',$this->worship_id);
		$criteria->compare('worship_date',$this->worship_date,true);
		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}