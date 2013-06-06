<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CreatorManagerController extends Controller {
  public function actionCreate()
    {
        $model=new Doc;
        $creatorManager=new CreatorManager();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Doc']))
        {
            $model->attributes=$_POST['Doc'];
            $creatorManager->manage($_POST['Creator']);
            if (!isset($_POST['noValidate']))
            {
                $valid=$model->validate();
                $valid=$creatorManager->validate($model) && $valid;

                if($valid)
                {
                    $model->save();
                    $studentManager->save($model);
                    $this->redirect(array('view','id'=>$model->id));
                }
            }
        }

        $this->render('create',array(
            'model'=>$model,
            'creatorManager'=>$creatorManager,
        ));
    }
}
?>
