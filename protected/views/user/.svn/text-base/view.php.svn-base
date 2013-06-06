<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username,
);

$this->menu=array(
	array('label'=>'Show Profile', 'url'=>array('index')),
//	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>View User <?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'username',
		array(
			'name' => 'facility',
			'header' => 'Facility',
			'value' => str_replace(' ', '&nbsp;', $model->facility),
			'type' => 'raw',
		),
		'email',
		array(
			'name' => 'data_manager',
			'header' => 'Data Manager',
			'value' => ($model->data_manager)? 'Yes':'No',
			'type' => 'raw',
		),
		array(
			'name' => 'approved',
			'header' => 'Approved',
			'value' => ($model->approved)? 'Yes':'No',
			'type' => 'raw',
		),
		array(
			'name' => 'enabled',
			'header' => 'Enabled',
			'value' => ($model->enabled)? 'Yes':'No',
			'type' => 'raw',
		),
	),
)); ?>
