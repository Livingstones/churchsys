<?php

/**
 * This is the model class for table "tbl_issues".
 *
 * The followings are the available columns in table 'tbl_issues':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property integer $priority
 * @property integer $creator
 * @property string $modify_date
 * @property string $create_date
 * 
 * The followings are the available model relations:
 * @property IssuesReply[] $issuesReplys
 */
class Issues extends CActiveRecord
{
	const STATUS_NEW = 0;
	const STATUS_ACCEPTED = 1;
	const STATUS_IN_PROGRESS = 2;
	const STATUS_FIXED = 3;
	
	const PRIORITY_LOW = 0;
	const PRIORITY_MEDIUM = 1;
	const PRIORITY_HIGH = 2;
	
	public function getStatusList($value="")
	{
		$list = array(
			self::STATUS_NEW => "新建",
			self::STATUS_ACCEPTED => "已接納",
			self::STATUS_IN_PROGRESS => "更改中",
			self::STATUS_FIXED => "已解決", 
		);
		return $value === "" ? $list : $list[$value];
	}
	
	public function getPriorityList($value="")
	{
		$list = array(
			self::PRIORITY_LOW => "低",
			self::PRIORITY_MEDIUM => "中",
			self::PRIORITY_HIGH => "高",
		);
		return $value === "" ? $list : $list[$value];
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Issues the static model class
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
		return 'tbl_issues';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, status, priority', 'required'),
			array('status, priority', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, status, priority, creator, modify_date, create_date', 'safe', 'on'=>'search'),
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
			'issuesReplys' => array(self::HAS_MANY, 'IssuesReply', 'issues_id'),
            'countReplys'=>array(self::STAT,'IssuesReply','issues_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '主題',
			'description' => '內容',
			'status' => '狀態',
			'priority' => '優先權',
			'creator' => '建立者',
			'modify_date' => '更改日期',
			'create_date' => '創建日期',
			'countReplys' => '回覆#'
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('creator',$this->creator);
		$criteria->compare('modify_date',$this->modify_date,true);
		$criteria->compare('create_date',$this->create_date,true);

		$criteria->order = "create_date DESC";
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave()
	{
		if ($this->isNewRecord) {
			$this->creator = Yii::app()->user->id;
			$this->create_date = date("Y-m-d H:i:s");
		}
		$this->modify_date = date("Y-m-d H:i:s");
		return parent::beforeSave();
	}
	
	protected function afterSave()
	{
		parent::afterSave();
		$user = User::model()->findByPk($this->creator);
		$adminEmail = Yii::app()->params->adminEmail;
		$app_name = Yii::app()->name;
		$details = "
	title: " . $this->title . "
	status: " . $this->getStatusList($this->status) . "
	priority: " . $this->getPriorityList($this->priority) . "
	description: " . $this->description . "
";
		$footer = "
God Bless
" . $app_name . "
";
		
		Yii::app()->mailer->IsSMTP();
		Yii::app()->mailer->Host = "mail.evangelight.com.hk";
		Yii::app()->mailer->From = $adminEmail;
		Yii::app()->mailer->FromName = $app_name;
		//Yii::app()->mailer->AddAddress($user->email);
		//Yii::app()->mailer->AddAddress($adminEmail);
		if ($this->isNewRecord) {
			Yii::app()->mailer->AddAddress($adminEmail);
			Yii::app()->mailer->Subject = $app_name . ' :: New Issue Created Notification';
			Yii::app()->mailer->Body = 'Dear Sir,
You got a new issue, details are the follow:: 
' . $details . $footer;
		} else {
			Yii::app()->mailer->AddAddress($adminEmail);
			Yii::app()->mailer->Subject = $app_name . ' :: Issue Updated Notification';
			Yii::app()->mailer->Body = 'Dear Sir,
You got a issue update, details are the follow:: 
' . $details . $footer;
		}
		if(!Yii::app()->mailer->Send()){
		   echo "Message could not be sent. <p>";
		   echo "Mailer Error: " . Yii::app()->mailer->ErrorInfo;
		}
	}
}