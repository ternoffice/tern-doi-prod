<h1>Existing DOIs</h1>

<div>
<?php echo CHtml::link('Request new DOI',Yii::app()->homeUrl.'?r=doc/create');?>
</div>

<?php

 $dataProvider = new CActiveDataProvider('Doc',array(
                    'criteria' => array(
                            'condition'=> 'user_id=:user_val ',
                              'params'=> array(':user_val' =>$model->user_id)
                        ),
                
                    )
                 );
  $this->renderPartial('../doc/_admin', array(
   'dataProvider' => $dataProvider
                       
                        )
  );

?>