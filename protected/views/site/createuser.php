<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php Yii::app()->clientScript->registerCoreScript('jquery.ui');?>
<?php Yii::app()->clientScript->registerCssFile(
	Yii::app()->clientScript->getCoreScriptUrl().
	'/jui/css/base/jquery-ui.css'
);?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/multifield.js"); ?>
<?php
$this->pageTitle=Yii::app()->name . ' - Register User';
$this->breadcrumbs=array(
	'Register User',
);
?>

<h1>Register User</h1>

<p>Please fill out the following form:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'createUser-form',
	'enableClientValidation'=>true,
	'action'=>array('/site/createuser')

)); ?>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $model->username; ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $model->user_id ?>
	</div>

	<div class="row">
		<table class="tableForm indent"  id="facilityRow">
			<tr>
				<th><?php echo $form->label($model,'facility'); ?></th>
				<th></th>
			</tr>
			<?php
			if (count($model->facility) == 0)
			{
				$c = 1;
			}
			else
			{
				$c = count($model->facility);
			}

			for ($i = 0; $i < $c; $i++)
			{
			?>
			<tr id="facilityTemplateRow" >
				<td>
					<?php echo CHtml::dropDownList('User[facility][0][@value]','auscover', Yii::app()->params->facilityList); ?>
				</td>
				<td>
					<?php
					if ($i == 0)
					{
						echo CHtml::htmlButton('+', array('onClick' => 'addRow(\'facility\')'));
					}
					else
					{
						echo CHtml::htmlButton('-', array('id' => 'DeleteBoxRow'));
					}
					?>
				 </td>
			 </tr>
			 <?php } ?>
		</table>
	
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_manager'); ?>
		<?php echo $form->dropDownList($model,'data_manager',array('0'=>'No','1'=>'Yes')); ?>
	</div>
	
	<div>
		<strong>Terms and conditions</strong><br />
		By using TERN DOI service you are adhering to following terms of use:
		<ul>
			<li>you will not share your app ID with others.</li>
			<li>storage and access to the material will be long-term and managed by the Facility.</li>
			<li>Mint DOI only to the material which already does not have a DOI.</li>
			<li>familiar with the Policy on DOIs: <a href="http://www.doi.org/handbook_2000/policies.html" target="_new">http://www.doi.org/handbook_2000/policies.html</a></li>
		</ul>
		<?php echo CHtml::checkBox('accept',false);?> Agree
	</div>
	
	<div class="row buttons">
		<?php
			$htmlOption = array(
				'onclick'=>"if (getElementById('accept').checked == false) alert('You need too agree the terms and conditions.'); else document.createUser-form.submit() ;",
			);
		?>
		<?php echo CHtml::button('Register', $htmlOption); ?>

	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
