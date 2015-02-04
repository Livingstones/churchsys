<?php

/**
 * This is the model class for table "tbl_issues_reply".
 *
 * The followings are the available columns in table 'tbl_issues_reply':
 * @property integer $id
 * @property integer $issues_id
 * @property string $reply
 * @property integer $creator
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property Issues $issues
 */
class IssuesReply extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return IssuesReply the static model class
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
		return 'tbl_issues_reply';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('issues_id, reply, creator, create_date', 'required'),
			array('issues_id, creator', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, issues_id, reply, creator, create_date', 'safe', 'on'=>'search'),
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
			'issues' => array(self::BELONGS_TO, 'Issues', 'issues_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'issues_id' => '問題',
			'reply' => '回覆',
			'creator' => '創建者',
			'create_date' => '創建日期',
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
		$criteria->compare('issues_id',$this->issues_id);
		$criteria->compare('reply',$this->reply,true);
		$criteria->compare('creator',$this->creator);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}