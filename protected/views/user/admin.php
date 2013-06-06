<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Show Profile', 'url'=>array('index')),
//	array('label'=>'Create User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

<!--p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p-->

<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button'));*/ ?>
<!--div class="search-form" style="display:none">
<?php 
//	$this->renderPartial('_search',array(
//		'model'=>$model,
//	)); 
?>
</div--><!-- search-form -->

<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
//		'user_id',
		'username',
		'email',
		array(
			'name' => 'facility',
			'header' => 'Facility',
			'value' => 'str_replace(" ", "&nbsp;", $data->facility)',
			'filter' => Yii::app()->params->facilityList,
			'type' => 'raw',
		),
		array(
			'name' => 'data_manager',
			'header' => 'Data Manager',
			'value' => '"<a title=\"click to transfer DOI to different user\" href=\"".Yii::app()->createUrl("doc/transfer",array("id"=>$data->user_id))."\"><strong>".(($data->data_manager)? "Yes":"No")."</strong></a>"',
			'filter' => array(1 => 'Yes', 0 => 'No'),
			'htmlOptions'=>array('style'=>'text-align:center;'),
			'type' => 'raw',
		),
		array(
			'name' => 'approved',
			'header' => 'Approved',
			'value' => '($data->approved)? "Yes":"<font color=\"red\">No</font>"',
			'filter' => array(1 => 'Yes', 0 => 'No'),
			'htmlOptions'=>array('style'=>'text-align:center;'),
			'type' => 'raw',
		),
		array(
			'name' => 'enabled',
			'header' => 'Enabled',
			'value' => '($data->enabled)? "Yes":"<font color=\"red\">No</font>"',
			'filter' => array(1 => 'Yes', 0 => 'No'),
			'htmlOptions'=>array('style'=>'text-align:center;'),
			'type' => 'raw',
		),
 		array(
			'header' => 'User Status',
			'class' => 'CButtonColumn',
			'template' => '{enabled} {disabled}',
			'buttons' => array(
				'enabled' => array(
					'label' => 'Click to deactivate User',
					'imageUrl' => Yii::app()->theme->baseUrl  . '/images/go.png',
					'url' => 'Yii::app()->createUrl("user/disabled",array("id"=>$data->user_id))',
					'ajax' => true,
					'visible' => '$data->enabled == 1',
				),
				'disabled' => array(
					'label' => 'Click to activate User',
					'imageUrl' =>  Yii::app()->theme->baseUrl  . '/images/stop.png',
					'url' => 'Yii::app()->createUrl("user/enabled",array("id"=>$data->user_id))',
					'ajax' => true,
					'visible' => '$data->enabled == 0',
				),
			),
		),
		array(
			'header' => 'Actions',
			'class' => 'CButtonColumn',
			'template' => ' {view} {update} ',
			'buttons' => array(
				'view' => array(
					'label'=>'View detail',
				),
				'update' => array(
					'label'=>'Update record',
				)
			)
            ),
	),
)); ?>
