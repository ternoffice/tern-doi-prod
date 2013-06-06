<?php

class DocController extends GxController
{

    var $user;
	
	var $transferFrom;

    public function init()
    {
        $this->user = User::model()->findByPk(Yii::app()->user->id);
    }

	/**
	 * @return array action filters
	 */
    public function filters()
    {
        return array(
            'accessControl',
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
        $dataManager = ($this->user->data_manager == true)? 'true':'false';
		return array(
			array('allow', 
				'actions'=>array('index','view','active','inactive','resync','create','update','admin','transfer','fail','export'),
				'expression' => "$adminUser || $dataManager",
			),
			array('allow', 
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
    }

	/**
	 * Displays a particular document model.
	 * @param integer $id the ID of the model to be displayed
	 */
    public function actionView($id)
	{
		$model = $this->loadModel($id, 'Doc');
		
		if (($this->user->user_id != $model->user_id) && (Yii::app()->params->adminId !== $this->user->user_id))
		{
			$this->redirect(array('index'));
		}
		else
		{
			$xml = simplexml_load_string($model->doc_xml);
			$doc_array = Array2XML::createArray($xml, TRUE, FALSE, TRUE);

			$temp = DataCite2_2::deconstructDataArray($model, $doc_array);
			$this->render('view', array(
				'model' => $model,
			));
		}
	}

	/**
	 * Export DOI to TXT actions.
	 * 
	 */
    public function actionExport()
    {
        header("Content-type: application/txt");
        header('Content-disposition: filename="TERN-DOI.txt"');
	 $criteria = '';
        $criteria .= (isset($_GET['Doc']['doc_title']) && $_GET['Doc']['doc_title'])? ' AND doc_title like \'%'.$_GET['Doc']['doc_title'].'%\'':''; 
        $criteria .= (isset($_GET['Doc']['doc_url']) && $_GET['Doc']['doc_url'])? ' AND doc_url like \'%'.$_GET['Doc']['doc_url'].'%\'':''; 
        $criteria .= (isset($_GET['Doc']['doc_doi']) && $_GET['Doc']['doc_doi'])? ' AND doc_doi like \'%'.$_GET['Doc']['doc_doi'].'%\'':''; 
        $criteria .= (isset($_GET['Doc']['user_id']) && $_GET['Doc']['user_id'])? ' AND user_id like \'%'.$_GET['Doc']['user_id'].'%\'':''; 
        $sql = 'select * from tbl_doc where doc_doi != \'\'' . $criteria;

        $model = Doc::model()->findAllBySql($sql);
        $doiArray = array();
        $citationArray = array();
        for ($c=0;$c<count($model);$c++)
        {
            $xml = simplexml_load_string($model[$c]->doc_xml);
            $doc_array = Array2XML::createArray($xml, TRUE, FALSE, TRUE);
            $temp = DataCite2_2::deconstructDataArray($model[$c], $doc_array);
            $doiArray[$c] = $model[$c]->publicationYear;
            $citationArray[$c] = strip_tags ( dataCitate(Array('creator' => $model[$c]->creator, 'publicationYear' => $model[$c]->publicationYear, 'title' => $model[$c]->doc_title, 'publisher' => $model[$c]->publisher, 'identifier' => $model[$c]->doc_doi)));
        }
        asort($doiArray); 
        foreach ($doiArray as $key => $year) {
            echo "$citationArray[$key]\r\n";
        }
    }

	/**
	 * Displays fail page for mint and update actions.
	 * 
	 */
    public function actionFail($id)
	{
		$this->render('fail', array('id'=>$id));
	}


	/**
	 * Activate a particular document model.
	 * @param integer $id the ID of the model to be activated
	 */
    public function actionActive($id)
	{
		$model = $this->loadModel($id, 'Doc');
		$cite = new CiteANDS();
		// check document status and process if it is not a new unminted document
		if($model->doc_status != 'new')
		{
			// activate document
			$doi = $cite->getANDS($model->doc_doi,  'activate');
			if ($doi['doi'] != '')
			{
				 $model->doc_active = true;
				 $model->saveAttributes(array('doc_active'));
				 Yii::app()->user->setFlash('success','Activated Successfully');
			} 
			else 
			{
				Yii::app()->user->setFlash('error','Failed activating DOI');
			}
		}
		else{
			Yii::app()->user->setFlash('error','This DOI has not been minted. Please synchronise the data first');
		}
		$this->redirect(array('admin'));
	}
	
	/**
	 * Deactivate a particular document model.
	 * @param integer $id the ID of the model to be deactivated
	 */
    public function actionInactive($id)
	{
		$model = $this->loadModel($id, 'Doc');
		$cite = new CiteANDS();
		// check document status and process if it is not a new unminted document
		if($model->doc_status != 'new')
		{
			// deactivate document
			$doi = $cite->getANDS($model->doc_doi,  'deactivate');
			if ($doi['doi'] != '')
			{
				$model->doc_active = false;
				$model->saveAttributes(array('doc_active'));
				Yii::app()->user->setFlash('success','Deactivated Successfully');
			} 
			else
			{
				Yii::app()->user->setFlash('error','Failed deactivating DOI');
			}
		}
		$this->redirect(array('admin'));
	}

	/**
	 * Deactivate a particular document model.
	 * @param integer $id the ID of the model to be minted or updated
	 */
    public function actionResync($id)
	{
		$model = $this->loadModel($id, 'Doc');
		$cite = new CiteANDS();
		// check document status
		if($model->doc_doi)
		{
			$doi = $cite->postANDS($model->doc_url, $model->doc_xml, 'update', $model->doc_doi);
			if ($doi['doi'] != '')
			{
				$model->doc_status = 'Successfully minted';
				$model->doc_active = true;
				$model->saveAttributes(array('doc_status', 'doc_active'));
				Yii::app()->user->setFlash('success','Synchronized Successfully');
			}
			else
			{
				$status = $doi['xml'];
				Yii::app()->user->setFlash('error','Synchronize unsuccessful:'.$status);
			}
		}
		else
		{
			$doi = $cite->postANDS($model->doc_url, $model->doc_xml, 'mint');
			if ($doi['doi'] != '')
			{
				$model->doc_doi = $doi['doi'];
				$model->doc_status = 'Successfully minted';
				$model->doc_active = true;
				$model->saveAttributes(array('doc_doi', 'doc_status', 'doc_active'));
				Yii::app()->user->setFlash('success','Synchronized Successfully');
			}
			else
			{
				$status = $doi['xml'];
				Yii::app()->user->setFlash('error','Synchronize unsuccessful:'.$status);
			}
		}

		//return to the Admin Page
		$model = new Doc('search');
		$model->unsetAttributes();

		if (isset($_GET['Doc']))
			$model->setAttributes($_GET['Doc']);
		$this->redirect(array('admin'));
	}

	/**
	 * Mint a particular document model.
	 */
    public function actionCreate()
	{
		$model = new Doc;
		$user = $this->user;
		if (isset($_POST['Doc']))
		{
			$model->setAttributes($_POST['Doc']);
			if ($model->save())
			{
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					if (($model->doc_doi && $model->doc_status == 'Successfully minted') || $model->doc_status == 'new' || $model->doc_status == 'updated')
					{
						$this->redirect(array('view', 'id' => $model->doc_id));
					}
					else
					{
						$this->redirect(array('fail', 'id' => $model->doc_id));
					}
			}
		}
		$this->render('create', array('model' => $model));
	}

	/**
	 * Update a particular document model.
	 * @param integer $id the ID of the model to be updated
	 */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, 'Doc');
     
        $xml = simplexml_load_string($model->doc_xml);
        $doc_array = Array2XML::createArray($xml, TRUE, FALSE, TRUE);
        DataCite2_2::deconstructDataArray($model, $doc_array);

        if (isset($_POST['Doc']))
        {
            $model->setAttributes($_POST['Doc']);
            if ($model->save())
            {
				if (($model->doc_doi && $model->doc_status == 'Successfully minted') || $model->doc_status == 'new' || $model->doc_status == 'updated')
				{
					$this->redirect(array('view', 'id' => $model->doc_id));
				}
				else
				{
					$this->redirect(array('fail', 'id' => $model->doc_id));
				}
            }
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }

	/**
	 * Lists all minted document owned by the user.
	 */
    public function actionIndex()
    {
        if ($this->user !== null && $this->user->approved == TRUE)
        {
            // approved
            $userId = $this->user->email;
        }
        else
        {
            // not approved
            $userId = 'notapproved';
        }
        $model=new Doc('search');
        $model->unsetAttributes(); 
        if(isset($_GET['Doc']))
	 {
            $model->attributes=$_GET['Doc'];
            $model->user_id=$_GET['Doc']['user_id'];
        }
        else
        {
            $model->doc_doi='index page';
        }
        $this->render('index',array(
            'dataProvider'=>$model->search(),
            'model'=>$model)
        ); 

    }

	/**
	 * Manages all documents.
	 */
    public function actionAdmin()
	{
		$model = new Doc('search');
		$model->unsetAttributes();
		if (isset($_GET['Doc']))
			$model->setAttributes($_GET['Doc']);

		if (Yii::app()->params->adminId != $this->user->email)
		{
              	$model->user_id=$this->user->email;
		}

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Transfer DOIs between Data Manager.
	 */
	public function actionTransfer($id)
    {
		if (isset($_POST['transferTo']) && count($_POST['doi']))
		{
			$transferTo = $_POST['transferTo'];
			$doi = $_POST['doi'];
			$attributes = array('user_id'=>$transferTo);
			$condition = null;
			for ($i=0;$i<count($_POST['doi']);$i++)
			{
				$condition .= ' , \''.$_POST['doi'][$i].'\'';
			}
			$condition = 'doc_doi in ('. substr($condition,2) .')';
			$update = Doc::model()->updateAll($attributes,$condition);
		}

		$model = new Doc('search');
		$model->unsetAttributes();
		if (isset($_GET['Doc']))
			$model->setAttributes($_GET['Doc']);
		$this->transferFrom = $id;
		$this->render('transfer',array(
			'model'=>$model,
		));
    }

}
