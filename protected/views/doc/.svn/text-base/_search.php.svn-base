<div class="wide form">

<?php
if ($model['doc_doi']=='index page'){
	$model['doc_doi']='';
}

$form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>



	<div class="row">
		<?php echo $form->label($model, 'doc_title'); ?>
		<?php echo $form->textField($model, 'doc_title', array('maxlength' => 128)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model, 'doc_url'); ?>
		<?php echo $form->textField($model, 'doc_url', array('maxlength' => 256)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model, 'doc_doi'); ?>
		<?php echo $form->textField($model, 'doc_doi', array('maxlength' => 128)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model, 'user_id'); ?>
		<?php echo $form->textField($model, 'user_id', array('maxlength' => 256)); ?>
		<span class="inputTitle" id="hdatamgr"><img src="<?php echo Yii::app()->theme->baseUrl . '/images/help.png'; ?>"></span>
		<div class="help" id="help-hdatamgr">Data manager can be refined by email id only.</div>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
