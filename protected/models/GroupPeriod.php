<?php

/**
 * This is the model class for table "tbl_group_period".
 *
 * The followings are the available columns in table 'tbl_group_period':
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Group[] $groups
 */
class GroupPeriod extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GroupPeriod the static model class
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
		return 'tbl_group_period';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description', 'required'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description', 'safe', 'on'=>'search'),
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
			'groups' => array(self::HAS_MANY, 'Group', 'period_id'),
			'groupsCount' => array(self::STAT, 'Group', 'period_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '名稱',
			'description' => '簡介',
			'groupsCount' => '小組數目',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		//$criteria->compare('g.c',$this->groupsCount);
		$criteria->select = "t.*,g.c AS groupsCount";
		$criteria->join = "LEFT JOIN (SELECT period_id, id, COUNT(*) AS c FROM tbl_group GROUP BY period_id) AS g ON g.period_id=t.id";
		$criteria->group = "t.id";
		
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20,
			),
			'sort' => array( 
				'attributes' => array(
					'id'=>array(),
					'name'=>array(),
					'description'=>array(),
					'groupsCount' => array('asc' => 'groupsCount DESC', 'desc' => 'groupsCount'),
				), 
				'defaultOrder' => array('id'),
			),
		));
	}
}