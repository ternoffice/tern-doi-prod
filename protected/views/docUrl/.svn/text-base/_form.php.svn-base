<div class="form">

<?php 
$adminUser = (Yii::app()->params->adminId == $this->user->user_id)? true:false;
if (!$adminUser){ 
	$facilities = explode('<br/>', $this->user->facility); 
	for ($c=0;$c<count($facilities);$c++)
	{
		$facilityList[$facilities[$c]] = $facilities[$c];
	}
}
else
{
	$facilityList = Yii::app()->params->facilityList;
}

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'doc-url-form',
	'enableAjaxValidation'=>false,
)); 
?>
<h3>The top-level domain(s) URL for which DOI(s) resolves.</h3>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>1024,'disabled'=> ($model['_scenario']=='update')? 'true':'')); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<table class="tableForm indent"  id="facilitiesRow">
			<tr>
				<th><?php echo $form->labelEx($model,'facilities'); ?></th>
				<th></th>
			</tr>
			<?php
			if (count($model->facilities) == 0)
			{
				$c = 1;
			}
			else
			{
				$c = count($model->facilities);
			}

			for ($i = 0; $i < $c; $i++)
			{
			?>
			<tr id="facilitiesTemplateRow" >
				<td>
					<?php echo $form->dropDownList($model, 'facilities[' . $i . '][@value]', $facilityList); ?>
				</td>
				<td>
					<?php
					if ($i == 0)
					{
						echo CHtml::htmlButton('+', array('onClick' => 'addRow(\'facilities\')'));
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

<?php
if ($adminUser){
?>
	<div class="row">
		<?php echo $form->labelEx($model,'approved'); ?>
		<?php echo $form->dropDownList($model,'approved',array('Processing'=>'Processing','Approved'=>'Approved','Rejected'=>'Rejected')); ?>
		<?php echo $form->error($model,'approved'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'disabled'=>'true')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
<?php
}
?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Register' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->