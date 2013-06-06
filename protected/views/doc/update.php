<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php Yii::app()->clientScript->registerCoreScript('jquery.ui');?>
<?php Yii::app()->clientScript->registerCssFile(
	Yii::app()->clientScript->getCoreScriptUrl().
	'/jui/css/base/jquery-ui.css'
);?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/multifield.js"); ?>
<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    html_entity_decode(GxHtml::encode($model->doc_title)) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
    Yii::t('app', 'Update Document'),
);

$this->menu = array(
    //array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
    array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
    array('label' => Yii::t('app', 'View') . ' ' . $model->label(), 'url' => array('view', 'id' => GxActiveRecord::extractPkValue($model, true))),
    array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
);
?>

<h2><?php echo Yii::t('app', 'Update') . ' ' . GxHtml::encode($model->label()) . ': ' . GxHtml::encode($model->doc_doi); ?></h2>

<?php
$this->renderPartial('_form', array(
    'model' => $model));
?>