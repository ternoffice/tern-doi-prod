<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php Yii::app()->clientScript->registerCoreScript('jquery.ui');?>
<?php Yii::app()->clientScript->registerCssFile(
	Yii::app()->clientScript->getCoreScriptUrl().
	'/jui/css/base/jquery-ui.css'
);?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/multifield.js"); ?>
<?php
$this->breadcrumbs=array(
	'Registered URLs'=>array('index'),
	'Register',
);

$this->menu=array(
	array('label'=>'List URL', 'url'=>array('index')),
	array('label'=>'View Registered URLs', 'url'=>array('admin')),
);
?>

<h1>Register Document URL</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>