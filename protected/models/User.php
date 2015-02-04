<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $member_code
 */
class User extends CActiveRecord
{
	public $new_password;
	public $new_password_repeat;
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required', 'on'=>'create'),
			array('username, password, email', 'length', 'max'=>128),
			array('member_code', 'length', 'max'=>4),
			array('email', 'email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array( 'password, new_password, new_password_repeat, email', 'required', 'on' => 'updateAccount' ),
			array('new_password', 'compare', 'compareAttribute'=>'new_password_repeat', 'on'=>'updateAccount'),
			array('new_password', 'length', 'min'=>8, 'max'=>128, 'on'=>'updateAccount'),
			array('password', 'validateCurrentPassword', 'on'=>'updateAccount'),
			array('new_password, new_password_repeat', 'safe'),
			array('id, username, password, email, member_code', 'safe', 'on'=>'search'),
		);
	}

	 public function validateCurrentPassword($attribute, $params)
	 {
		$user = User::model()->findByPk($this->id);
		if(md5($this->password) !== $user->password)
		{
			$this->addError('password','Please specify the correct current password');
		}
	 }


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Current Password',
			'new_password' => 'New Password',
			'new_password_repeat' => 'Retype New Password',
			'email' => 'Email',
			'member_code' => 'Member Code',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('member_code',$this->member_code,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		if(!empty($this->new_password))
			$this->password = md5($this->new_password);

		if($this->isNewRecord)
			$this->create_time=$this->update_time=date("Y-m-d H:i:s");
		else
			$this->update_time=date("Y-m-d H:i:s");

		return parent::beforeSave();
	}
}
