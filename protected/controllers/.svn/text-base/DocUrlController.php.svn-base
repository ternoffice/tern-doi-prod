<?php

class DocUrlController extends Controller
{

	var $user;

	public function init()
	{
		$this->user = User::model()->findByPk(Yii::app()->user->id); 
	}

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
        if ($this->user !== null && $this->user->approved == TRUE)
        {
            // approved
            $userId = $this->user->user_id;
        }
        else
        {
            // not approved
            $userId = 'notapproved';
        }
		// check admin user
        $adminUser = (Yii::app()->params->adminId == $userId)? 'true':'false';
        $dataManager = $this->user->data_manager;
		return array(
			array('allow', 
				'actions'=>array('admin','index','update','create'),
				'expression' => "$adminUser",
			),
			array('allow', 
				'actions'=>array('admin','index','create'),
				'expression' => "$dataManager",
			),
			array('allow', 
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new DocUrl;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DocUrl']))
		{
			$model->attributes=$_POST['DocUrl'];
			$model->url=trim($model->url);
			$model->approved='Processing';
			$model->email=$this->user->user_id;
			$facilities = ''; 
			for ($c=0;$c<count($model->facilities);$c++)
			{
				$facilities .= $model->facilities[$c]['@value'].'<br/>';
			}
			$model->facilities = $facilities;

			if (Yii::app()->params->adminId != $this->user->user_id){
				mailAdmin($model);
			}
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if (!$this->user->data_manager)
		{
			$this->redirect(array('index'));
		}
		$model=$this->loadModel($id);
		$facilities = explode('<br/>', $model->facilities);
		$facilityArray = null;
		for ($i=0; $i< count($facilities); $i++)
		{
			$facilityArray[$i]['@value'] = $facilities[$i];
		}
		$model->facilities = $facilityArray; 
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DocUrl']))
		{
			$facilities = null;
			foreach ($_POST['DocUrl']['facilities'] as &$facility) {
				if (!strpos($facilities, $facility['@value']))
				{
					$facilities .= '<br/>'.$facility['@value'] ;
				}
			}
			$_POST['DocUrl']['facilities'] = subStr($facilities, 5); 

			$model->attributes=$_POST['DocUrl'];

			if($model->save())
			{
				if ((Yii::app()->params->adminId == $this->user->user_id) && ($model->approved != 'Processing')) 
				{
					mailUser($model);
				}
				$this->redirect(array('admin'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$facilities = explode('<br/>', $this->user->facility); 
		$condition = '';
		for ($c=0;$c<count($facilities);$c++)
		{
			$condition .= ' OR facilities like \'%'.$facilities[$c].'%\'';
		}
		$condition = 'approved = \'Approved\' AND ('.substr($condition,3).')';
		$dataProvider = new CActiveDataProvider('DocUrl'
		, array(
			'criteria' => array(
					'condition' => $condition,
					'order' => 'url',
				)
			)
		);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DocUrl('search', array('criteria' => array('order' => 'url',)));
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DocUrl']))
			$model->attributes=$_GET['DocUrl'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=DocUrl::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='doc-url-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
