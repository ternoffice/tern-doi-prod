<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);

$this->menu = array(
    //	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
    array('label' => Yii::t('app', 'Create ') . ' ' . $model->label(), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('doc-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php /*echo GxHtml::link(Yii::t('app', 'Search'), '#', array('class' => 'search-button'));*/ ?>
<!--div class="search-form">
    <?php
//    $this->renderPartial('_search', array(
//        'model' => $model,
//    ));
    ?>
</div--><!-- search-form -->
<div id="statusMsg">
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
</div>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'doc-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            'doc_title',
            'doc_url',
            array(
		'name' => 'doc_doi',
		'header' => 'DOI',
		'type' => 'raw',
		'value' => '($data->doc_doi)? str_replace(\'%D$s\',$data->doc_doi,substr(Yii::app()->params->doiCitateFormat,strpos(Yii::app()->params->doiCitateFormat,"<a"))):""',
            ),
            array(
                'header' => 'Metadata Sync Status',
                'class' => 'CButtonColumn',
                'template' => '{sync} {unsync}',
                'buttons' => array(
                    'sync' => array(
                        'label' => 'Is synchronized with ANDS',
                        'imageUrl' => Yii::app()->theme->baseUrl  . '/images/sync.png',
                         'visible' => '$data->doc_status == "Successfully minted"',
                    ),
                    'unsync' => array(
                        'label' => 'Click to synchronize with ANDS',
                        'imageUrl' => Yii::app()->theme->baseUrl  . '/images/unsync.png',
                        'url' => 'Yii::app()->createUrl("doc/resync",array("id"=>$data->doc_id))',
                        'ajax' => true,
                        'visible' => '$data->doc_status != "Successfully minted"',
                    ),
                ),
            ),
            array(
                'header' => 'Active Status',
                'class' => 'CButtonColumn',
                'template' => '{active} {inactive}',
                'buttons' => array(
                    'active' => array(
                        'label' => 'Click to deactivate DOI',
                        'imageUrl' => Yii::app()->theme->baseUrl  . '/images/go.png',
                        'url' => 'Yii::app()->createUrl("doc/inactive",array("id"=>$data->doc_id))',
                        'ajax' => true,
                        'visible' => '$data->doc_active == 1',
                    ),
                    'inactive' => array(
                        'label' => 'Click to activate DOI',
                        'imageUrl' =>  Yii::app()->theme->baseUrl  . '/images/stop.png',
                        'url' => 'Yii::app()->createUrl("doc/active",array("id"=>$data->doc_id))',
                        'ajax' => true,
                        'visible' => '$data->doc_active == 0',
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
    ));
?>