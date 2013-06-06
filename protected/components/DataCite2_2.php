<?php

/*
 * Class Name: DataCite2_2 (for DataCite2.2 schema)
 * Description: This class constructs the array for converting to XML or deconstruct an Array to fit the BaseDoc model.
 *
 */

class DataCite2_2
{

    /**
    * To construct the array from the BaseDoc model.
    * @param BaseDoc object $model the DOI document model
    * @return array $doc the information extract from the DOI document model
    */
    public static function constructDataArray($model)
    {

        $strValue = Yii::app()->params->strValue;
        $strAttribute = Yii::app()->params->strAttribute;
        //construct array
        //populate Identifier field
        DataCite2_2::setIdentifier($model);

        $doc = Array($model->strAttribute => $model->resource,
            'identifier' => $model->identifier,
            'creators' => Array('creator' => $model->creator),
            'titles' => Array('title' => $model->title),
            'publisher' => Array($strValue => $model->publisher),
            'publicationYear' => Array($strValue => $model->publicationYear));
        if (count($model->subject) > 0)
        {
            $doc['subjects'] = Array('subject' => $model->subject);
        }
        if (count($model->contributor) > 0)
        {
            $doc['contributors'] = Array('contributor' => $model->contributor);
        }
        if (count($model->date) > 0)
        {
            $doc['dates'] = Array('date' => $model->date);
        }
        if ($model->language != "")
        {
            $doc['language'] = Array($strValue => $model->language);
        }
        if ($model->resourceType[$strValue] != '')
        {
            $doc['resourceType'] = $model->resourceType;
        }
        if (count($model->alternateIdentifier) > 0)
        {
            $doc['alternateIdentifiers'] = Array('alternateIdentifier' => $model->alternateIdentifier);
        }
        if (count($model->relatedIdentifier) > 0)
        {
            $doc['relatedIdentifiers'] = Array('relatedIdentifier' => $model->relatedIdentifier);
        }
        if (count($model->size) > 0)
        {
            $doc['sizes'] = Array('size' => $model->size);
        }
        if (count($model->format) > 0)
        {
            $doc['formats'] = Array('format' => $model->format);
        }
        if ($model->version != '')
        {
            $doc['version'] = Array($strValue => $model->version);
        }
        if ($model->rights != '')
        {
            $doc['rights'] = Array($strValue => $model->rights);
        }
        if (count($model->description) > 0)
        {
            $doc['descriptions'] = Array('description' => $model->description);
        }
         
        return $doc;
    }

    /**
    * To deconstruct the document array and insert data into the BaseDoc model.
    * @param BaseDoc object $model the DOI document model, array $docArray the array holding DOI information. 
    */
    public static function deconstructDataArray(&$model, $docArray)
    {

        $model->publisher = $docArray['publisher'][$model->strValue];


        if( isset($docArray['creators']['creator']['creatorName'][$model->strValue]))
        {
            $model->creator[0] = $docArray['creators']['creator'];

        }else if (count($docArray['creators']['creator']) > 1)
        {
            $model->creator = $docArray['creators']['creator'];
        }
        if (isset($docArray['titles']['title'][$model->strValue]))
        {
            $model->title[0] = $docArray['titles']['title'];
        }
        else if(count($docArray['titles']['title'])>1)
        {
             $model->title = $docArray['titles']['title'];
        }

        $model->publicationYear = $docArray['publicationYear'][$model->strValue];

        if (isset($docArray['subjects']) && isset($docArray['subjects']['subject'][$model->strValue]))
        {
            $model->subject[0] = $docArray['subjects']['subject'];
        }
        elseif (isset($docArray['subjects']) && count($docArray['subjects']['subject']) > 1)
        {
            $model->subject = $docArray['subjects']['subject'];
        }

        if (isset($docArray['contributors']) && isset($docArray['contributors']['contributor']['contributorName'][$model->strValue]))
        {
            $model->contributor[0] = $docArray['contributors']['contributor'];
        }
        elseif (isset($docArray['contributors']) && count($docArray['contributors']['contributor']) > 1)
        {
            $model->contributor = $docArray['contributors']['contributor'];
        }

        if (isset($docArray['dates']) && isset($docArray['dates']['date'][$model->strValue]))
        {
            $model->date[0] = $docArray['dates']['date'];
        }
        elseif (isset($docArray['dates']) && count($docArray['dates']['date']) > 1)
        {
            $model->date = $docArray['dates']['date'];
        }

        if (isset($docArray['language']))
        {
            $model->language = $docArray['language'][$model->strValue];
        }

        if (isset($docArray['resourceType']))
        {
            $model->resourceType = $docArray['resourceType'];
        }

        if (isset($docArray['alternateIdentifiers']) && isset($docArray['alternateIdentifiers']['alternateIdentifier'][$model->strValue]))
        {
            $model->alternateIdentifier[0] = $docArray['alternateIdentifiers']['alternateIdentifier'];
        }
        elseif (isset($docArray['alternateIdentifiers']) && count($docArray['alternateIdentifiers']['alternateIdentifier']) > 1)
        {
            $model->alternateIdentifier = $docArray['alternateIdentifiers']['alternateIdentifier'];
        }

        if (isset($docArray['relatedIdentifiers']['relatedIdentifier']) && isset($docArray['relatedIdentifiers']['relatedIdentifier'][$model->strValue]))
        {
            $model->relatedIdentifier[0] = $docArray['relatedIdentifiers']['relatedIdentifier'];
        }
        elseif (isset($docArray['relatedIdentifiers']['relatedIdentifier']) && count($docArray['relatedIdentifiers']['relatedIdentifier']) > 1)
        {
            $model->relatedIdentifier = $docArray['relatedIdentifiers']['relatedIdentifier'];
        }
        if (isset($docArray['sizes']) && count($docArray['sizes']['size']) > 1)
        {
            $model->size = $docArray['sizes']['size'];
        }
        elseif (isset($docArray['sizes']))
        {
            $model->size[0] = $docArray['sizes']['size'];
        }

        if (isset($docArray['formats']) && count($docArray['formats']['format']) > 1)
        {
            $model->format = $docArray['formats']['format'];
        }
        elseif (isset($docArray['formats']))
        {
            $model->format[0] = $docArray['formats']['format'];
        }
        if (isset($docArray['version']))
        {
            $model->version = $docArray['version'][$model->strValue];
        }
        if (isset($docArray['rights']))
        {
            $model->rights = $docArray['rights'][$model->strValue];
        }

        if (isset($docArray['descriptions']) && isset($docArray['descriptions']['description'][$model->strValue]))
        {
            $model->description[0] = $docArray['descriptions']['description'];
        }
        elseif (isset($docArray['descriptions']) && count($docArray['descriptions']['description']) > 1)
        {
            $model->description = $docArray['descriptions']['description'];
        }
    }

    /* Create dummy identifier if needed. Called to add identifier before constructDataArray */
    public static function setIdentifier(&$model)
    {
        if ($model->doc_doi != "")
        {
            $model->identifier = Array(
                $model->strValue => $model->doc_doi, $model->strAttribute => Array('identifierType' => 'DOI')); //populate Identifier from existing DOI
        }
        else
        { // set Dummy Identifier
            $model->identifier = Array(
                $model->strValue => '10.5072/05/1111', $model->strAttribute => Array('identifierType' => 'DOI')); //give default Identifier
        }
    }

}
?>
