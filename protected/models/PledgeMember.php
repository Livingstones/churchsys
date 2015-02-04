<?php

/**
 * This is the model class for table "tbl_pledge_member".
 *
 * The followings are the available columns in table 'tbl_pledge_member':
 * @property integer $id
 * @property integer $pledge_id
 * @property integer $member_id
 * @property integer $state
 * @property string $remarks
 * @property string $pledge_date
 *
 * The followings are the available model relations:
 * @property Pledge $pledge
 * @property Member $member
 */
class PledgeMember extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PledgeMember the static model class
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
		return 'tbl_pledge_member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pledge_id, member_id, state, pledge_date', 'required'),
			array('pledge_id, member_id, state', 'numerical', 'integerOnly'=>true),
			array('remarks', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pledge_id, member_id, state, remarks, pledge_date', 'safe', 'on'=>'search'),
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
			'pledge' => array(self::BELONGS_TO, 'Pledge', 'pledge_id'),
			'member' => array(self::BELONGS_TO, 'Member', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pledge_id' => '誓約',
			'member_id' => '會友',
			'state' => '狀態',
			'remarks' => '備註',
			'pledge_date' => '簽誓約日期',
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
		$criteria->compare('pledge_id',$this->pledge_id);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('state',$this->state);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('pledge_date',$this->pledge_date,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}