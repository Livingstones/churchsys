<?php

/**
 * This is the model class for table "tbl_member".
 *
 * The followings are the available columns in table 'tbl_member':
 * @property integer $id
 * @property integer $state
 * @property string $code
 * @property string $name
 * @property string $remarks
 * @property string $english_name
 * @property string $photo
 * @property string $photo_upload
 * @property integer $gender
 * @property string $birthday
 * @property string $email
 * @property string $believe
 * @property string $believe_date
 * @property string $baptized
 * @property string $baptized_date
 * @property integer $account_type
 * @property integer $new_card
 * @property string $arrived_date
 * @property string $create_date
 * @property string $modify_date
 * @property integer $creator_id
 * @property integer $modifier_id
 * @property string $address_district
 * @property string $address_estate
 * @property string $address_house
 * @property string $address_flat
 * @property string $contact_home
 * @property string $contact_mobile
 * @property string $contact_office
 * @property string $contact_others
 *
 * The followings are the available model relations:
 * @property Course[] $courses
 * @property Course[] $courseAttendance
 * @property GroupAttendance[] $groupAttendances
 * @property Group[] $leadingGroups
 * @property Group $group
 * @property MemberRelationship[] $memberRelationships
 * @property PledgeMember[] $pledgeMembers
 * @property WorshipAttendance[] $worshipAttendances
 * @property WorshipGreeting[] $worshipGreetings
 */
class Member extends CActiveRecord
{
    const ACCOUNT_TYPE_NEW_MEMBER = 0;
    const ACCOUNT_TYPE_MEMBER = 1;
    const ACCOUNT_TYPE_CO_MEMBER = 2;
    const NEW_CARD_NO_CARD = -1;
    const NEW_CARD_HAS_CARD = 0;
    const NEW_CARD_WAITING_CARD = 1;
    const GENDER_UNKNOWN = 3;
    const GENDER_MALE = 2;
    const GENDER_FEMALE = 1;

    public $assignedGroups, $worshipName, $photo_upload;

    /**
     * Returns the static model of the specified AR class.
     * @return Member the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getStateList($value = "")
    {
        $list = array(
            0 => "已刪除",
            1 => "會友",
            2 => "已故會友",
        );
        return $value === "" ? $list : $list[$value];
    }

    public function getAccountTypeList($value = "")
    {
        $list = array(
            self::ACCOUNT_TYPE_NEW_MEMBER => "臨時會友",
            self::ACCOUNT_TYPE_MEMBER => "會友",
            self::ACCOUNT_TYPE_CO_MEMBER => "已故會友",
        );
        return $value === "" ? $list : $list[$value];
    }

    public function getNewCardList($value = "")
    {
        $list = array(
            0 => "沒有新名牌",
            1 => "新名牌製作中",
            2 => "新名牌已辦妥，請於下次崇拜時領取",
        );
        return $value === "" ? $list : $list[$value];
    }

    public function getGenderList($value = "")
    {
        $list = array(
            self::GENDER_MALE => "男",
            self::GENDER_FEMALE => "女",
            self::GENDER_UNKNOWN => "未知"
        );
        return $value === "" ? $list : $list[$value];
    }

    public function getGroupNames()
    {
        $groupsName = array();
        foreach ($this->groups as $group) {
            $groupsName[] = $group->name . "(" . $group->period->name . ")";
        }
        if (count($groupsName) > 0) {
            return implode(", ", $groupsName);
        }
        return "未入組";
    }

    public function isAttendedGroup($group_id, $date)
    {
        return GroupAttendance::model()->exists('group_id=:group_id AND member_id=:member_id AND attendance_date=:attendance_date',
            array(":group_id" => $group_id,
                ":member_id" => $this->id,
                ":attendance_date" => $date));
    }

    public function isAttendedCourse($course_id, $date)
    {
        return CourseAttendance::model()->exists('course_id=:course_id AND member_id=:member_id AND attendance_date=:attendance_date',
            array(":course_id" => $course_id,
                ":member_id" => $this->id,
                ":attendance_date" => $date));
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_member';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('state, code, name, gender, account_type, new_card, arrived_date, create_date, creator_id, modifier_id', 'required'),
            array('state, gender, account_type, new_card, creator_id, modifier_id', 'numerical', 'integerOnly' => true),
            array('code', 'length', 'max' => 10),
            array('photo', 'file', 'types' => 'jpg', 'allowEmpty' => true),
            array('birthday', 'default', 'setOnEmpty' => true, 'value' => null),
            array('name, english_name, email, believe, believe_date, baptized, baptized_date, address_district, address_estate, address_house, address_flat, contact_home, contact_mobile, contact_office, contact_others', 'length', 'max' => 255),
            array('remarks, birthday, modify_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, state, code, name, remarks, english_name, assignedGroups, photo, gender, birthday, email, believe, believe_date, baptized, baptized_date, account_type, new_card, arrived_date, create_date, modify_date, creator_id, modifier_id, address_district, address_estate, address_house, address_flat, contact_home, contact_mobile, contact_office, contact_others', 'safe', 'on' => 'search'),
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
            'courses' => array(self::MANY_MANY, 'Course', 'tbl_course_member(member_id, course_id)'),
            'courseAttendances' => array(self::MANY_MANY, 'Course', 'tbl_course_attendance(member_id, course_id)'),
            'groupAttendances' => array(self::HAS_MANY, 'GroupAttendance', 'member_id'),
            'groups' => array(self::MANY_MANY, 'Group', 'tbl_group_member(member_id, group_id)'),
            'memberRelationships' => array(self::HAS_MANY, 'MemberRelationship', 'related2_id'),
            'pledgeMembers' => array(self::HAS_MANY, 'PledgeMember', 'member_id'),
            'worshipAttendances' => array(self::HAS_MANY, 'WorshipAttendance', 'member_id'),
            'worshipGreetings' => array(self::HAS_MANY, 'WorshipGreeting', 'member_id'),

            'worshipAttendancesLastDate' => array(self::STAT, 'WorshipAttendance', 'member_id', 'select' => 'MAX(attendance_date)'),
            'worshipAttendancesTwoMonthCount' => array(self::STAT, 'WorshipAttendance', 'member_id', 'select' => 'SUM(DATE(attendance_date) >= DATE_SUB(NOW(), INTERVAL 2 MONTH))'),
            'worshipAttendancesSixMonthCount' => array(self::STAT, 'WorshipAttendance', 'member_id', 'select' => 'SUM(DATE(attendance_date) >= DATE_SUB(NOW(), INTERVAL 6 MONTH))'),
            'worshipAttendancesYearCount' => array(self::STAT, 'WorshipAttendance', 'member_id', 'select' => 'SUM(DATE(attendance_date) >= DATE_SUB(NOW(), INTERVAL 12 MONTH))'),

            'groupAttendancesLastDate' => array(self::STAT, 'GroupAttendance', 'member_id', 'select' => 'MAX(attendance_date)'),
            'groupAttendancesTwoMonthCount' => array(self::STAT, 'GroupAttendance', 'member_id', 'select' => 'SUM(DATE(attendance_date) >= DATE_SUB(NOW(), INTERVAL 2 MONTH))'),
            'groupAttendancesSixMonthCount' => array(self::STAT, 'GroupAttendance', 'member_id', 'select' => 'SUM(DATE(attendance_date) >= DATE_SUB(NOW(), INTERVAL 6 MONTH))'),
            'groupAttendancesYearCount' => array(self::STAT, 'GroupAttendance', 'member_id', 'select' => 'SUM(DATE(attendance_date) >= DATE_SUB(NOW(), INTERVAL 12 MONTH))'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'state' => '狀態',
            'code' => '編號',
            'name' => '姓名',
            'groups' => '小組',
            'remarks' => '備註',
            'english_name' => '英文姓名',
            'photo' => '相片',
            'gender' => '性別',
            'birthday' => '生日日期',
            'email' => '電郵地址',
            'believe' => '已信主',
            'believe_date' => '信主日期',
            'baptized' => '已受洗',
            'baptized_date' => '受洗日期',
            'account_type' => '戶用類別',
            'new_card' => '已有新名牌',
            'arrived_date' => '初來崇拜日期',
            'create_date' => '創建日期',
            'modify_date' => '更改日期',
            'creator_id' => '創建者',
            'modifier_id' => '更改者',
            'address_district' => '區(地址)',
            'address_estate' => '邨(地址)',
            'address_house' => '樓(地址',
            'address_flat' => '室(地址)',
            'contact_home' => '屋企(電話)',
            'contact_mobile' => '手提(電話)',
            'contact_office' => '工作(電話)',
            'contact_others' => '其他(電話)',
            'worshipAttendancesLastDate' => '最近一次出席崇拜日期',
            'worshipAttendancesTwoMonthCount' => '近兩個月出席崇拜次數',
            'worshipAttendancesSixMonthCount' => '近半年出席崇拜次數',
            'worshipAttendancesYearCount' => '近一年出席崇拜次數',
            'assignedGroups' => '組別',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('state', $this->state);
        $criteria->compare('code', $this->code, true);
        // disambiguating column names
        // http://www.yiiframework.com/doc/guide/1.1/en/database.arr#disambiguating-column-names
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('remarks', $this->remarks, true);
        $criteria->compare('english_name', $this->english_name, true);
        $criteria->compare('photo', $this->photo, true);
        $criteria->compare('gender', $this->gender);
        $criteria->compare('birthday', $this->birthday, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('believe', $this->believe, true);
        $criteria->compare('believe_date', $this->believe_date, true);
        $criteria->compare('baptized', $this->baptized, true);
        $criteria->compare('baptized_date', $this->baptized_date, true);
        $criteria->compare('account_type', $this->account_type);
        $criteria->compare('new_card', $this->new_card);
        $criteria->compare('arrived_date', $this->arrived_date, true);
//		$criteria->compare('create_date',$this->create_date,true);
//		$criteria->compare('modify_date',$this->modify_date,true);
//		$criteria->compare('creator_id',$this->creator_id);
//		$criteria->compare('modifier_id',$this->modifier_id);
        $criteria->compare('address_district', $this->address_district, true);
        $criteria->compare('address_estate', $this->address_estate, true);
        $criteria->compare('address_house', $this->address_house, true);
        $criteria->compare('address_flat', $this->address_flat, true);
        $criteria->compare('contact_home', $this->contact_home, true);
        $criteria->compare('contact_mobile', $this->contact_mobile, true);
        $criteria->compare('contact_office', $this->contact_office, true);
        $criteria->compare('contact_others', $this->contact_others, true);

        $criteria->compare('group_id', $this->assignedGroups);
        $criteria->with = array('groups');
        $criteria->together = true;
        // exclude the members who are deleted
        $criteria->addSearchCondition('account_type', '-1', false, 'AND', '!=');

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave()
    {
        $this->photo = CUploadedFile::getInstance($this, 'photo');
        return parent::beforeSave();
    }

    protected function afterSave()
    {
        if ($this->photo) {
            $path = Yii::app()->params['upload_dir'] . '/file/member/' . $this->code . '.jpg';
            if (file_exists($path)) {
                unlink($path);
            }
            $this->photo->saveAs($path);
        }
        parent::afterSave();
    }
}
