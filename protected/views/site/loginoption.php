<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'googlelogin',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	
	
	<div class="row buttons">
		<a href="aaf">Login using AAF</a>		
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
    



