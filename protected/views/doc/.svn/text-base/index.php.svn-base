<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/multifield.js"); ?>

<?php
$this->breadcrumbs = array(
    Doc::label(2),
    Yii::t('app', 'Index'),
);

$this->menu = array(
    array('label' => Yii::t('app', 'Create') . ' ' . Doc::label(), 'url' => array('create')),
    array('label' => Yii::t('app', 'Manage') . ' ' . Doc::label(2), 'url' => array('admin')),
    array('label' => Yii::t('app', 'Register URL'), 'url' => 'index.php?r=docUrl/'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiListView.update('doclistview', { 
        //this entire js section is taken from admin.php. w/only this line diff
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>All <?php echo GxHtml::encode(Doc::label(2)); ?> Minted by TERN</h1>

<?php echo CHtml::link('Refine Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php  $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'id'=>'doclistview',       // must have id corresponding to js above
    'sortableAttributes'=>array(
        'doc_title',
        'doc_url',
        'doc_doi',
        'user_id',
    ),
));
?>
<button id="exportDOI">Export DOIs</button>
<script>
$('#exportDOI').click(function() {
    Doc_doc_title = $('#Doc_doc_title').val(); 
    Doc_doc_url = $('#Doc_doc_url').val();
    Doc_doc_doi = $('#Doc_doc_doi').val();
    Doc_user_id = $('#Doc_user_id').val();
    window.open('index.php?r=doc/export&Doc[doc_title]='+Doc_doc_title+'&Doc[doc_url]='+Doc_doc_url+'&Doc[doc_doi]='+Doc_doc_doi+'&Doc[user_id]='+Doc_user_id);
});
</script>