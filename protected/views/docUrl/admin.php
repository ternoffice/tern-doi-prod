<?php
$this->breadcrumbs=array(
	'Registered URLs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List URL', 'url'=>array('index')),
	array('label'=>'Create URL', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('doc-url-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

$columns = array(
		'url',
		array(
			'name' => 'facilities',
			'header' => 'Facilities',
			'value' => 'str_replace(" ", "&nbsp;", $data->facilities)',
			'filter' => Yii::app()->params->facilityList,
			'type' => 'raw',
		),
		'email',
		array(
			'name' => 'approved',
			'header' => 'Status',
			'value' => '($data->approved=="Approved")? "<font color=green>".$data->approved."</font>": (($data->approved=="Rejected")? "<font color=red>".$data->approved."</font>" : $data->approved)',
			'filter' => array('Processing' => 'Processing','Approved' => 'Approved', 'Rejected' => 'Rejected'),
			'htmlOptions'=>array('style'=>'text-align:center;'),
			'type' => 'raw',
		),
	);

if (Yii::app()->params->adminId == $this->user->user_id)
{ 
	$columns[count($columns)] = array(
		'header' => 'Update',
		'class' => 'CButtonColumn',
		'template' => ' {update} ',
		'buttons' => array(
			'update' => array(
				'label'=>'Update record',
			),
		)
	);
}
?>

<h1>Manage URL</h1>

<!--p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div--><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'doc-url-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=> $columns,
)); ?>
