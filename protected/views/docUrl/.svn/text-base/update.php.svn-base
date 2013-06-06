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
	$model->url=>array('view','id'=>$model->url),
	'Update',
);

$this->menu=array(
	array('label'=>'List URL', 'url'=>array('index')),
	array('label'=>'Create URL', 'url'=>array('create')),
	array('label'=>'Manage URL', 'url'=>array('admin')),
);
?>

<h2>Update URL: <?php echo $model->url; ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>