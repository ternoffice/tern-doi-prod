<?php

Yii::import('application.models._base.BaseDoc');

class Doc extends BaseDoc
{

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}