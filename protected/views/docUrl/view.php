<?php
$this->breadcrumbs=array(
	'Doc Urls'=>array('index'),
	$model->url,
);

$this->menu=array(
	array('label'=>'List DocUrl', 'url'=>array('index')),
	array('label'=>'Create DocUrl', 'url'=>array('create')),
	array('label'=>'Update DocUrl', 'url'=>array('update', 'id'=>$model->url)),
	array('label'=>'Delete DocUrl', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->url),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocUrl', 'url'=>array('admin')),
);
?>

<h1>View DocUrl #<?php echo $model->url; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'url',
		'facilities',
		'approved',
		'email',
	),
)); ?>
