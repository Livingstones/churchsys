<?php

/**
 * This is the model class for table "tbl_group".
 *
 * The followings are the available columns in table 'tbl_group':
 * @property integer $id
 * @property string $name
 * @property integer $period_id
 *
 * The followings are the available model relations:
 * @property GroupPeriod $period
 * @property GroupAttendance[] $groupAttendances
 * @property Member[] $members
 */
class Group extends CActiveRecord
{
	const NO_GROUP = 17;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Group the static model class
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
		return 'tbl_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, period_id', 'required'),
			array('period_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, period_id', 'safe', 'on'=>'search'),
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
			'period' => array(self::BELONGS_TO, 'GroupPeriod', 'period_id'),
			'groupAttendances' => array(self::HAS_MANY, 'GroupAttendance', 'group_id'),
			'members' => array(self::MANY_MANY, 'Member', 'tbl_group_member(group_id, member_id)'),
			'membersCount' => array(self::STAT, 'Member', 'tbl_group_member(group_id, member_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '組別名稱',
			'period_id' => '時段',
			'membersCount' => '組員數目',
			'members' => '組員',
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
		$criteria->compare('period_id',$this->period_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function getLeadersName()
	{
		$group_members = GroupMember::model()->find("group_id=:group_id AND member_type=:member_type", array(":group_id"=>$this->id, ":member_type"=>GroupMember::MEMBER_TYPE_LEADER));
		if (empty($group_members))
		{
			return "--";
		} elseif (!is_array($group_members)) 
		{
			return $group_members->member->name;
		}
		$leadersName = array();
		foreach ($group_members as $group_member)
		{
			$leadersName[] = $group_member->member->name;
		}
		return implode(", ", $leadersName);
	}
	
	protected function afterSave()
	{
		parent::afterSave();
		if (isset($_REQUEST["delete"]) && is_array($_REQUEST["delete"])) {
			foreach ($_REQUEST["delete"] as $k => $d) {
				GroupMember::model()->deleteAll("group_id=:gid AND member_id=:mid", array(":gid" => $this->id, ":mid" => $k));
			}
		}
		for ($i=0; $i<10; $i++){
			if (!empty($_REQUEST["new_member_name_" . $i])){
				$member = null;
				if (!empty($_REQUEST["new_member_code_" . $i])){
					$member = Member::model()->find("code=:code", array("code"=>$_REQUEST["new_member_code_" . $i]));
				} else {
					$query = 'SELECT (MIN(code1)+1) AS code FROM
			(SELECT t0.code AS code1, t1.code AS codeplus1 FROM tbl_member AS t0 LEFT JOIN tbl_member AS t1 ON t0.code+1=t1.code WHERE t0.code>9100) AS temp
			WHERE codeplus1 IS NULL';		
					$nextCode=Yii::app()->db->createCommand($query)->queryScalar();
					$member = new Member;
					$member->state = 1;
					$member->code = $nextCode;
					$member->name = $_REQUEST["new_member_name_" . $i];
					$member->remarks = $_REQUEST["new_remarks_" . $i];
					$member->gender = $_REQUEST["new_gender_" . $i];
					//$member->group_id = (int) $this->id;
					$member->contact_mobile = $_REQUEST["new_mobile_" . $i];
					$member->birthday = $_REQUEST["new_birthday_" . $i];
					$member->account_type = Member::ACCOUNT_TYPE_NEW_MEMBER;
					$member->new_card = Member::NEW_CARD_NO_CARD;
					$member->arrived_date = date("Y-m-d H:i:s");
					$member->create_date = date("Y-m-d H:i:s");
					$member->modify_date = date("Y-m-d H:i:s");
					$member->creator_id = Yii::app()->user->id;
					$member->modifier_id = Yii::app()->user->id;
					$member->save();
				}
				
				GroupMember::model()->deleteAll("group_id=:gid AND member_id=:mid", array(":gid" => $this->id, ":mid" => $member->id));
				
				$groupMember = new GroupMember;
				$groupMember->group_id = $this->id;
				$groupMember->member_id = $member->id;
				$groupMember->member_type = GroupMember::MEMBER_TYPE_MEMBER;
				$groupMember->save();
			}
		}
	}
}