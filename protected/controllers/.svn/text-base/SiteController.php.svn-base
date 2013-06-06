<?php
$baseP=Yii::app()->basePath;

require $baseP.'/include/openid.php';
class SiteController extends GxController
{
	private $_identity;
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action when user is not yet approved
	 */
	public function actionNotapproved()
	{
		$this->render('notapproved');
	}

	/**
	 * This is the action when user is disabled by administrator
	 */
	public function actionNotenabled()
	{
		$this->render('notenabled');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('loginoption',array('model'=>$model));
	}

	public function actionLoginoption()
	{
		$this->render('loginoption');
	}
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionAAF()
	{
		session_start();
		$id = $_SESSION['email'];
		$email = $_SESSION['email'];
		$displayName = $_SESSION['displayName'];
		$organizationName = $_SESSION['organizationName'];

		if(isset($_SESSION['displayName']))
		{


			Yii::app()->user->name = $displayName;
			Yii::app()->user->id = $email;
			$model=User::model()->findByPk($email);
			
			if ($model!=null && $model->facility==''){
				$this->loadModel($email,'User')->delete();
				$model=null;
			}
			
			if($model!=null)
			{
				if($model->user_id==Yii::app()->params['adminId'])
				{
					$model->username=Yii::app()->user->name;
					$model->approved=true;
					$model->enabled=true;
					$model->save(false);
					$this->redirect(Yii::app()->baseUrl . '/index.php?r=user/index');
				}
				else
				{
					if($model->approved==true && $model->enabled==true)
					{
						$this->redirect(Yii::app()->baseUrl . '/index.php?r=doc/index');
					}
					else if($model->approved==false)
					{
						$this->redirect(Yii::app()->user->returnUrl.'?r=site/notapproved');
					}
					else
					{
						$this->redirect(Yii::app()->user->returnUrl.'?r=site/notenabled');
					}
				}
			}
			else 
			{
				$model=new User;
				$model->email=$email;
				$model->user_id=$email;
				$model->username=Yii::app()->user->name;
				$model->approved=false;
				$model->enabled=true;
				$model->save(false);
				$this->render('createuser',array('model'=>$model));
			}
		}
		else
		{
			echo 'User has not logged in.';
		}
	}
	
	public function actionGoogle()
	{
		//$model=new User;

		try {

//    		$openid = new LightOpenID('qcifvm2.genome.at.uq.edu.au');
    		$openid = new LightOpenID('doi.tern.uq.edu.au');
    		//$openid = new LightOpenID('localhost');
    		if(!$openid->mode)
    		{
 //       		if(isset($_GET['googlelogin']))
 //       		{
            		$openid->identity = 'https://www.google.com/accounts/o8/id';
            		$openid->required = array('namePerson/first', 'namePerson/last', 'contact/email');
            		header('Location: ' . $openid->authUrl());
       		} elseif($openid->mode == 'cancel') {
        			echo 'User has canceled authentication!';
   			}else {
			        if($openid->validate())
			        {
			            //echo 'User <b>' . $openid->identity . '</b> has logged in.<br>';

			            //echo "<h3>User information</h3>";

			            $identity = $openid->identity;
			            $attributes = $openid->getAttributes();
			            $email = $attributes['contact/email'];
			            $id = $attributes['contact/email'];

			            if(isset($attributes['namePerson/first']))
			            {
			            	$first_name = $attributes['namePerson/first'];
			            }else
			            {
			            	$first_name='';
			            }
			            if(isset($attributes['namePerson/last']))
			            {
			            	$last_name = $attributes['namePerson/last'];
			            }else
			            {
			            	$last_name='';
			            }


			            if($first_name.$last_name!='')
			            {
							Yii::app()->user->name=$first_name.' '.$last_name;

			            }else
			            {
			            	Yii::app()->user->name=$email;
			            }
							//Yii::app()->user->name=$email;
							Yii::app()->user->id=$email;

                                  //  print_r(Yii::app()->user->guestName);
                                  //  print_r(Yii::app()->user);
			           // Yii::app()->user->login($email);

			            //print_r(Yii::app()->user->name);

			           // $model->id=$email;
			            //$model->username=$first_name.' '.$last_name;

			            $model=User::model()->findByPk($id);
			            //$model->username=$first_name.' '.$last_name;
			            //$model->save(false);

			        	//admin email

			        	if($model!=null)
			        	{
			        	 	if($model->user_id==Yii::app()->params['adminId'])
			            	{
			            		$model->username=Yii::app()->user->name;
			       				$model->approved=true;
			       				$model->enabled=true;

			       				$model->save(false);

			       				$this->redirect(Yii::app()->baseUrl . '/index.php?r=user/index');

			           		}else
			            	{
			            		if($model->approved==true && $model->enabled==true)
			            		{

			            			//individual page
			            			 $this->render('individualuser',array('model'=>$model));
			            		}else if($model->approved==false && $model->enabled==true)
			            		{
			            			$this->redirect(Yii::app()->user->returnUrl.'?r=site/notapproved');

			            		}else
			            		{
			            			$this->redirect(Yii::app()->user->returnUrl.'?r=site/notenabled');
			            		}
			            	}
			        	}
			            else
			           	{
			           		//create user page
			            		//echo 'create user';
			            		$model=new User;
			            		//echo $email;
			            		$model->email=$email;
			            		$model->user_id=$id;
			            		//echo $model->email;

			       				$model->username=Yii::app()->user->name;
			       				$model->approved=false;
			       				$model->enabled=true;
			       				$model->save(false);
			       				//echo 'saved';
			            		$this->render('createuser',array('model'=>$model));

			            }


			        }
			        else
			        {
			            echo 'User ' . $openid->identity . 'has not logged in.';
			        }
    			//}
    		}
    	}catch(ErrorException $e) {
    		echo $e->getMessage();
		}

	}

	public function actionCreateuser()
	{
		if(isset($_POST['accept']))
		{
			$model=$this->loadModel(Yii::app()->user->id,'User');

			$facilities = null;
			foreach ($_POST['User']['facility'] as &$facility) {
				if (!strpos($facilities, $facility['@value']))
				{
					$facilities .= '<br/>'.$facility['@value'] ;
				}
			}
			$_POST['User']['facility'] = subStr($facilities, 5); 

			$model->facility=$_POST['User']['facility'];
			$model->data_manager=$_POST['User']['data_manager'];
			$model->save();
			mailAdmin($model);
			$this->render('emailsend');
		}
		else
		{
   			$this->redirect(Yii::app()->user->returnUrl.'?r=site/AAF');
		}
	}
}
