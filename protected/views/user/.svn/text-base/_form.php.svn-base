<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); 

$buttonText = $model->isNewRecord ? 'Create' : 'Update and wait for approval';
$buttonText = (Yii::app()->params->adminId == $this->user->user_id)? 'Save' : $buttonText;
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128,'disabled'=>'true')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'disabled'=>'true')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
		<table class="tableForm indent"  id="facilityRow">
			<tr>
				<th><?php echo $form->labelEx($model,'facility'); ?></th>
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
					<?php echo $form->dropDownList($model, 'facility[' . $i . '][@value]', Yii::app()->params->facilityList); ?>
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
		<?php echo $form->error($model,'data_manager'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'appid_seed'); ?>
		<?php echo $form->textField($model,'appid_seed',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'appid_seed'); ?>
		<span class="inputTitle" id="hseedId"><img src="<?php echo Yii::app()->theme->baseUrl . '/images/help.png'; ?>"></span>
		<div class="help" id="help-hseedId">Data manager optional data: a random value for generating the API App ID (default is null).</div>
	</div>

<?php if(((isset($_GET['id']) && $_GET['id']!='profile')) || (Yii::app()->params->adminId==$this->user->user_id)) { ?>	
	<div class="row">
		<?php echo $form->labelEx($model,'approved'); ?>
		<?php echo $form->dropDownList($model,'approved',array('1'=>'approved','0'=>'not approved')); ?>
		<?php echo $form->error($model,'approved'); ?>
	</div>
<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($buttonText); ?>
		<input type="button" value="Cancel" onClick="window.location='index.php?r=user/index'" />
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->