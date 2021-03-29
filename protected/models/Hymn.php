<?php

/**
 * This is the model class for table "tbl_hymn".
 *
 * The followings are the available columns in table 'tbl_hymn':
 * @property integer $id
 * @property integer $name
 * @property integer $category
 * @property integer $language
 * @property string $composer
 * @property string $lyricist
 * @property string $producer
 * @property string $notation
 * @property string $midi
 * @property string $powerpoint
 *
 * The followings are the available model relations:
 * @property HymnTags[] $hymnTags
 */
class Hymn extends CActiveRecord
{
	const CATEGORY_OTHERS = 0;

	const LANGUAGE_CANTONESE = 0;
	const LANGUAGE_MANDARIN = 1;

	public function showTags($withLinks = false)
	{
		$tags = array();
		foreach ($this->hymnTags as $hymnTag)
		{
			if ($withLinks)
			{
				$tags[] = "<a href='" . Yii::app()->createUrl("hymn/admin", array("k" => $hymnTag->tag)) . "'>" . $hymnTag->tag . "</a>";
			} else 
			{
				$tags[] = $hymnTag->tag;
			}
		}
		return implode(", ", $tags);
	}
	
	public function getCategoryList($value = "")
	{
		$list = array(
			self::CATEGORY_OTHERS => "其他",
		);
		return $value === "" ? $list : $list[$value];
	}

	public function getLanguageList($value = "")
	{
		$list = array(
			self::LANGUAGE_CANTONESE => "粵語",
			self::LANGUAGE_MANDARIN => "國語",
			
		);
		return $value === "" ? $list : $list[$value];
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Hymn the static model class
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
		return 'tbl_hymn';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, category, language', 'required'),
			array('category, language', 'numerical', 'integerOnly'=>true),
            array('notation', 'file', 'types'=>'pdf,doc,zip', 'allowEmpty'=>true),
            array('midi', 'file', 'types'=>'mid,midi', 'allowEmpty'=>true),
            array('powerpoint', 'file', 'types'=>'ppt', 'allowEmpty'=>true),
			array('composer, lyricist, producer, notation, midi, powerpoint', 'length', 'max'=>255),
			array('lyric', 'safe'),
			array('notation', 'unsafe'),
			array('midi', 'unsafe'),
			array('powerpoint', 'unsafe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, category, language, lyric, composer, lyricist, producer, notation, midi, powerpoint', 'safe', 'on'=>'search'),
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
			'hymnTags' => array(self::HAS_MANY, 'HymnTags', 'hymn_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '歌名',
			'category' => '類別',
			'language' => '語言',
			'lyric' => '歌詞',
			'composer' => '作曲',
			'lyricist' => '填詞',
			'producer' => '製作',
			'notation' => '歌譜',
			'midi' => 'Midi',
			'powerpoint' => 'PowerPoint',
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
		$criteria->compare('category',$this->category);
		$criteria->compare('language',$this->language);
		$criteria->compare('lyric',$this->lyric,true);
		$criteria->compare('composer',$this->composer,true);
		$criteria->compare('lyricist',$this->lyricist,true);
		$criteria->compare('producer',$this->producer,true);
		$criteria->compare('notation',$this->notation,true);
		$criteria->compare('midi',$this->midi,true);
		$criteria->compare('powerpoint',$this->powerpoint,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave()
	{
		$notation = CUploadedFile::getInstance($this,'notation');
		$midi = CUploadedFile::getInstance($this,'midi');
		$powerpoint = CUploadedFile::getInstance($this,'powerpoint');
        $path = Yii::app()->params['upload_dir'] . "/file/";
        if (is_object($notation))
		{
			$notation->saveAs($path . 'hymn/notation/' . $this->id . "-notation" . $notation->getExtensionName());
			$this->notation = $this->id . "-notation." . $notation->getExtensionName();
			$ch = true;
		}
		if (is_object($midi))
		{
			$midi->saveAs($path . 'hymn/midi/' . $this->id . "-midi" . $midi->getExtensionName());
			$this->midi = $this->id . "-midi." . $midi->getExtensionName();
			$ch = true;
		}
		if (is_object($powerpoint))
		{
			$powerpoint->saveAs($path . 'hymn/powerpoint/' . $this->id . "-powerpoint" . $powerpoint->getExtensionName());
			$this->powerpoint = $this->id . "-powerpoint." . $powerpoint->getExtensionName();
			$ch = true;
		}
		return parent::beforeSave();
	}
	
	protected function afterSave()
	{
		if ($_POST["hymnTags"])
		{
			$tags = explode(",", $_POST["hymnTags"]);
			HymnTags::model()->deleteAll("hymn_id=:hymn_id", array(":hymn_id" => $this->id));
			foreach ($tags as $tag)
			{
				$t = new HymnTags();
				$t->hymn_id = $this->id;
				$t->tag = trim($tag);
				$t->save();
			}
		}
		parent::afterSave();
	}
}