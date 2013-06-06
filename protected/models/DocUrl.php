<?php

/**
 * This is the model class for table "tbl_url".
 *
 * The followings are the available columns in table 'tbl_url':
 * @property string $url
 * @property string $facilities
 * @property string $approved
 */
class DocUrl extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DocUrl the static model class
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
		return 'tbl_url';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url, facilities', 'required'),
			array('url, facilities', 'length', 'max'=>1024),
			array('approved', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('url, facilities, approved', 'safe', 'on'=>'search'),
			array('url', 'validateUrl'),
		);
	}

	public function validateUrl($attribute, $params)
	{
		$validator= CUrlValidator::createValidator('url',$this, $attribute, $params);
		if (!$validator->validateValue($this->$attribute))
		{
			$this->addError('url', 'The format of the requested URL is not correct.');
		}

		if ($this['_scenario']=='insert')
		{
			$model=DocUrl::model()->findByPk(trim($this->$attribute));
			if (isset($model) && $model->url)
			{
				$this->addError('url', 'URL has been registered.  You need to contact system administrator to add your facility to the URL.');
			}
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
			'url' => 'URL',
			'facilities' => 'Facilities',
			'approved' => 'Approved',
			'email' => 'Requester',
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

		$criteria->compare('url',$this->url,true);
		$criteria->compare('facilities',$this->facilities,true);
		$criteria->compare('approved',$this->approved);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}