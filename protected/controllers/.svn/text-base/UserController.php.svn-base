<?php

class UserController extends Controller
{
var $user;

public function init(){
       
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
		if($this->user !== null && $this->user->approved == TRUE && $this->user->enabled==TRUE){
            // approved
            $userId= $this->user->user_id;
        }
		else
		{
            // not approved
            $userId= 'notapproved';
        }
		// check admin user
        $adminUser = (Yii::app()->params->adminId == $userId)? true:false;
		return array(
			array('allow', 
				'actions'=>array('index','update','create','enabled','disabled','admin'),
				'expression' => "$adminUser",
			),
			array('allow', 
				'actions'=>array('index','update','view'),
				'users'=>array('@'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		if (!(Yii::app()->params->adminId == Yii::app()->user->id || 
			Yii::app()->user->id == $id))
		{
			$this->redirect(array('index'));
		}
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->facility=$_POST['fac'];
			//$model->approved=$_POST['app'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->user_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates the USER model.
	 * If not updated by administrator then set approved = false and send an email to administrator  
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if (!(Yii::app()->params->adminId == Yii::app()->user->id || 
			Yii::app()->user->id == $id))
		{
			$this->redirect(array('index'));
		}
		$model=$this->loadModel($id);
		$facilities = explode('<br/>', $model->facility);
		$facilityArray = null;
		for ($i=0; $i< count($facilities); $i++)
		{
			$facilityArray[$i]['@value'] = $facilities[$i];
		}
		$model->facility = $facilityArray; 

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$facilities = null;
			foreach ($_POST['User']['facility'] as &$facility) 
			{
				if (!strpos($facilities, $facility['@value']))
				{
					$facilities .= '<br/>'.$facility['@value'] ;
				}
			}
			$_POST['User']['facility'] = subStr($facilities, 5); 

			$model->attributes=$_POST['User'];

			$checkChange=User::model()->findByAttributes(array('user_id'=>$_GET['id'],'facility'=>$_POST['User']['facility'],'data_manager'=>$_POST['User']['data_manager'],'appid_seed'=>$_POST['User']['appid_seed'],'approved'=>$_POST['User']['approved']));
			if ($checkChange){
				$this->redirect(Yii::app()->user->returnUrl.'?r=user/index');
			}			


			if (Yii::app()->params->adminId != $this->user->user_id)
			{
				mailAdmin($model);
				$model->approved = false;
			}
			else if ((Yii::app()->params->adminId == $this->user->user_id) && ($model->approved == true)) 
			{
				mailUser($model);
			}
							
			if($model->save())
			{
				if (Yii::app()->params->adminId == $this->user->user_id)
				{
					$this->redirect(array('admin'));
				} 
				elseif ($model->approved == FALSE)
				{
	           			$this->redirect(Yii::app()->user->returnUrl.'?r=site/notapproved');
				}
				else				
				{
					$this->redirect(array('index','id'=>Yii::app()->user->id));
				}
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
/*	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id,'User')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}*/

	/**
	 * Display the user profile.
	 */
	public function actionIndex()
	{
		/*
			$dataProvider=new CActiveDataProvider('User');
			$this->render('index',array(
				'dataProvider'=>$dataProvider,
			));
			*/
		if($this->user !== null && $this->user->approved == TRUE && $this->user->enabled==TRUE){
                // approved
                $userId= $this->user->user_id;
        }
		else
		{
            // not approved
            $userId= 'notapproved';
        }

        $dataProvider = new CActiveDataProvider('User', array(
                    'criteria' => array(
                        'condition' => 'user_id=:user_val ',
                        'params' => array(':user_val' => $userId)
                    ),
                        )
        );

        $this->render('index', array(
            'dataProvider' => $dataProvider
                )
        );
		
	}

	/**
	 * Manages all users.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

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
		$model=User::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Enable selected user.
	 */
	public function actionEnabled($id)
    {
          $model = $this->loadModel($id, 'User');
			
          $model->enabled=true;
          $model->save();
          
          $this->redirect(array('admin'));
    }

	/**
	 * Disable selected user.
	 */
	public function actionDisabled($id)
    {
          $model = $this->loadModel($id, 'User');
         
          $model->enabled=false;
          $model->save();
          $this->redirect(array('admin'));

    }

}
