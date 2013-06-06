<?php

/**
 * This is the model base class for the table "tbl_doc".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Doc".
 *
 * Columns in table "tbl_doc" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $doc_url
 * @property integer $doc_id
 * @property string $doc_xml
 * @property string $doc_status
 * @property string $doc_doi
 * @property string $doc_date
 * @property string $doc_title
 * 
 */
include('Array2XML.php');

abstract class BaseDoc extends GxActiveRecord
{
    public $creator, $title, $publisher, $publicationYear, $identifier, $subject, $contributor, $date, $language, $resourceType, $alternateIdentifier, $relatedIdentifier, $size, $format, $version, $rights, $description;
    public $strValue = '@value';
    public $strAttribute = '@attributes';
    public $resource = Array(
        'xmlns' => 'http://datacite.org/schema/kernel-2.1',
        'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
        'xsi:schemaLocation' => 'http://datacite.org/schema/kernel-2.1 http://schema.datacite.org/meta/kernel-2.1/metadata.xsd'
    );
    public $dateRegex = "^([\+-]?\d{4}(?!\d{2}\b))((-?)((0[1-9]|1[0-2])(\3([12]\d|0[1-9]|3[01]))?|W([0-4]\d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]\d|[12]\d{2}|3([0-5]\d|6[1-6])))([T\s]((([01]\d|2[0-3])((:?)[0-5]\d)?|24\:?00)([\.,]\d+(?!:))?)?(\17[0-5]\d([\.,]\d+)?)?([zZ]|([\+-])([01]\d|2[0-3]):?([0-5]\d)?)?)?)?$";

    public function init()
    {
        $this->strValue = Yii::app()->params->strValue;
        $this->strAttribute = Yii::app()->params->strAttribute;
        $this->dateRegex = Yii::app()->params->dateRegex;
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tbl_doc';
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'DOI|DOIs', $n);
    }

    public static function representingColumn()
    {
        return 'doc_url';
    }

    public function rules()
    {
        return array(
            array('doc_url,  publisher, publicationYear, creator,title', 'required'),
            array('doc_url', 'length', 'max' => 256),
            array('publicationYear', 'length', 'max' => 4),
            array('publicationYear', 'date', 'format' => 'yyyy'),
            array('doc_status, doc_doi, doc_date', 'default', 'setOnEmpty' => true, 'value' => null),
            array('doc_url, doc_title, doc_status, doc_doi, doc_active', 'safe', 'on' => 'search'),
            array('language', 'length', 'max' => 10),
            array('version', 'length', 'max' => 10),
            array('subject, resourceType, relatedIdentifier, alternateIdentifier, size, format, rights, description', 'safe'),
            array('date', 'validateDate'),
            array('creator', 'validateCreator'),
            array('title', 'validateTitle'),
            array('contributor', 'validateContributor'),
        
        );
    }

    public function cleanupAllAttributes()
    {
        //clean up attributes one by one delete invalid elements from array. This function directly modifies the model properties 
        $this->cleanupAttribute('subject');
        $this->cleanupAttribute('contributor', Array('contributorName'));
        $this->cleanupAttribute('date');
        $this->cleanupAttribute('alternateIdentifier');
        $this->cleanupAttribute('relatedIdentifier');
        $this->cleanupAttribute('description');
        $this->cleanupAttribute('size');
        $this->cleanupAttribute('format');
    }

    //clean up a single model property/variable. accepts string attribute name, and $required as the names of the array key that validates the attribute.
    public function cleanupAttribute($attribute, $required = '')
    {
        $this->$attribute = $this->emptyArrayTrim($this->$attribute);

        if (is_array($this->$attribute))
        {
            $modelArr = $this->$attribute;
            for ($i = 0; $i < count($this->$attribute); $i++)
            {
                if ($required)
                {
                    for ($p = 0; $p < count($required); $p++)
                    {
                        $key = $required[$p];
                        if (!isset($modelArr[$i][$key][$this->strValue]) || $modelArr[$i][$key][$this->strValue] == "")
                        {
                            unset($modelArr[$i]);
                            break;
                        }
                    }
                }
                else
                {
                    if (!isset($modelArr[$i][$this->strValue]) || $modelArr[$i][$this->strValue] == "")
                    {
                        unset($modelArr[$i]);
                    }
                }
            }
            $this->$attribute = array_merge($modelArr);
        }
    }

    public function emptyArrayTrim($array)
    {

        if (is_array($array))
        {
            foreach ($array as $num => $sub)
            {
                if (is_array($sub))
                {
                    $array[$num] = $this->emptyArrayTrim($sub);
                }
            }
            return array_merge(array_filter($array));
        }
    }

    public function validateTitle($attribute, $params)
    {
        $this->title = $this->emptyArrayTrim($this->title);

        if (empty($this->title[0][$this->strValue]))
        {
            $this->addError('title', 'Please specify at least one Title');
        }
        for ($i = 0; $i < count($this->title); $i++)
        {
            if (!isset($this->title[$i][$this->strValue]) && isset($this->title[$i][$this->strAttribute]))
            {
                $this->addError('title', 'Please specify the Title for the type' . $this->title[$i][$this->strAttribute]['titleType']);
            }
        }
    }

    public function validateCreator($attribute, $params)
    {

        $this->creator = $this->emptyArrayTrim($this->creator);
      
        if (empty($this->creator))
        {
            $this->addError('creator', 'Please specify at least one Creator');
        }
        else
        {
            foreach ($this->creator as $num => $keyset)
            {
                if (!isset($keyset['creatorName'][$this->strValue]) && (isset($keyset['givenName'][$this->strValue])))
                {
                    $this->addError('creator', 'Creator family name is required ');
                }
                elseif (!isset($keyset['creatorName'][$this->strValue]) && (isset($keyset['nameIdentifier'][$this->strValue]) || isset($keyset['nameIdentifier'][$this->strAttribute]['nameIdentifierScheme'])))
                {
                    $this->addError('creator', 'Creator name has to be filled when specifying Name Identifier ');
                }
                elseif (isset($keyset['nameIdentifier'][$this->strValue]) && !isset($keyset['nameIdentifier'][$this->strAttribute]['nameIdentifierScheme']))
                {
                    $this->addError('creator', 'Name Identifier Scheme has to be filled when specifying Name Identifier ');
                }
                elseif (!isset($keyset['nameIdentifier'][$this->strValue]) && isset($keyset['nameIdentifier'][$this->strAttribute]['nameIdentifierScheme']))
                {
                    $this->addError('creator', 'Name Identifier  has to be filled when specifying Name Identifier Scheme');
                }
				elseif ((isset($keyset['creatorName'][$this->strValue]) && preg_match('/[0-9]/', $keyset['creatorName'][$this->strValue])) || (isset($keyset['givenName'][$this->strValue]) && preg_match('/[0-9]/', $keyset['givenName'][$this->strValue]))){
                    $this->addError('creator', 'Creator name cannot contains number');
				}
            }
        }
    }

    /* validate Contributor. If identifier scheme/name is specified, the whole set should be filled. (name, identifier name, scheme, and contributor type) */

    public function validateContributor($attribute, $params)
    {

        $this->$attribute = $this->emptyArrayTrim($this->$attribute);

        foreach ($this->contributor as $num => $keyset)
        {
            if (!isset($keyset['contributorName'][$this->strValue]) && (isset($keyset['nameIdentifier'][$this->strValue]) || isset($keyset['nameIdentifier'][$this->strAttribute]['nameIdentifierScheme'])))
            {
                $this->addError('contributor', 'Contributor name has to be filled when specifying Name Identifier ');
            }
            elseif (isset($keyset['nameIdentifier'][$this->strValue]) && !isset($keyset['nameIdentifier'][$this->strAttribute]['nameIdentifierScheme']))
            {
                $this->addError('contributor', 'Name Identifier Scheme has to be filled when specifying Name Identifier ');
            }
            elseif (!isset($keyset['nameIdentifier'][$this->strValue]) && isset($keyset['nameIdentifier'][$this->strAttribute]['nameIdentifierScheme']))
            {
                $this->addError('contributor', 'Name Identifier has to be filled when specifying Name Identifier Scheme');
            }
        }
    }

   
    
    public function validateDate($attribute, $params)
    {
        for ($i = 0; $i < count($this->date); $i++)
        {
            if (isset($this->date[$i][$this->strValue]) && $this->date[$i][$this->strValue] != '')
            {
                if (preg_match($this->dateRegex, $this->date[$i][$this->strValue]) < 1)
                {
                    $this->addError('date', 'Dates must comply to the W3C format. ');
                }
            }
        }
    }

    public function relations()
    {
        return array(
        );
    }

    public function pivotModels()
    {
        return array(
        );
    }

    public function attributeLabels()
    {
        return array(
//            'doc_url' => Yii::t('app', 'Document Url'),
            'doc_url' => Yii::t('app', 'Dataset landing page'),
            'doc_id' => Yii::t('app', 'Doc'),
            'doc_title' => Yii::t('app', 'Title'),
            'doc_xml' => Yii::t('app', 'Data'),
            'doc_status' => Yii::t('app', 'Status'),
            'doc_doi' => Yii::t('app', 'DOI'),
            'doc_doi_date' => Yii::t('app', 'Doc Doi Date'),
            'user_id' => Yii::t('app', 'Data Manager'),
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('doc_title', $this->doc_title, true);
        $criteria->compare('doc_url', $this->doc_url, true);
        $criteria->compare('user_id', $this->user_id, true);
        if ($this->doc_doi == 'index page')
        {
            // search for minted recorded only
            $criteria->addCondition('doc_doi != \'\'');
        }
        else
        {
            $criteria->compare('doc_doi', $this->doc_doi, true);
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function transfer($transferFrom)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('doc_title', $this->doc_title, true);
        $criteria->compare('doc_url', $this->doc_url, true);
        $criteria->compare('doc_doi', $this->doc_doi, true);
        $criteria->compare('user_id', $transferFrom, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave()
    {

        $this->resource = Yii::app()->params->resource;
        $this->doc_title = $this->title[0][$this->strValue];

        if (parent::beforeSave())
        {
            if ($this->getIsNewRecord())
            { // if the document is new set the user ID for the record and the status of the document
                if (!$this->user_id)
                {
                    $user = User::model()->findByPk(Yii::app()->user->id);
                    if ($user !== null && $user->approved == TRUE)
                    {
                        // approved
                        $this->user_id = $user->email;
                    }
                    else
                    {
                        return false;
                    }
                }
                $this->setAttribute('doc_status', 'new'); // set Status as 'new'
            }
            else
            { // if the document is being updated, set the status of the document
                $this->setAttribute('doc_status', 'updated');
            }

            //prepare all attributes, cleanups
            $this->cleanupAllAttributes();

			if (isset($doc_url['domain'])){
				$doc_url = $doc_url['domain'].'/'.$doc_url['landing'];
			}
			
			$creator = $this['creator'];
			if (isset($creator[0]['givenName'])){
				for ($i = 0; $i < count($creator); $i++){
					$creator[$i]['creatorName']['@value'] = $creator[$i]['creatorName']['@value'] . ', ' . $creator[$i]['givenName']['@value'];
					unset($creator[$i]['givenName']);
				}
				$this['creator'] = $creator; 
			}
            $doc = DataCite2_2::constructDataArray($this, $this->doc_status);
            //convert to XML
			if ($this->doc_xml != 'API'){
				$this->setAttribute('doc_xml', Array2XML::createXML('resource', $doc)->saveXML());
			}
            return true;
        }
        else
        {

            return false;
        }
    }

    public function afterSave()
    {

        // try out saving to ANDS
        $cite = new CiteANDS();
		if (!isset($_POST['saveOnly'])){
			if (!$this->doc_doi)
			{
				$doi = $cite->postANDS($this->doc_url, $this->doc_xml, 'mint');
				if ($doi['doi'] != '' && $doi['doi'] != 'Array')
				{
					$this->setIsNewRecord(false);
					$this->doc_doi = $doi['doi'];
					$this->doc_status = 'Successfully minted';
					$this->doc_active = true;
					$this->saveAttributes(array('doc_doi', 'doc_status','doc_active'));
				} else {
					$this->setIsNewRecord(false);
					$this->doc_status = $doi['xml'];
					$this->saveAttributes(array('doc_status'));
				}
			}
			elseif ($this->doc_status == 'updated')
			{
				$doi = $cite->postANDS($this->doc_url, $this->doc_xml, 'update', $this->doc_doi);
				if ($doi['doi'] != '' && $doi['doi'] != 'Array')
				{
					$this->doc_doi = $doi['doi'];
					$this->doc_status = 'Successfully minted';
					$this->saveAttributes(array('doc_status'));
				} else {
					$this->doc_status = $doi['xml'];
					$this->saveAttributes(array('doc_status'));
				}
			}
		}
        return parent::afterSave();
    }

    public function afterFind()
    {

    }

}
