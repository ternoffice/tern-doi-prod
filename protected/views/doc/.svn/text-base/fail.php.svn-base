<?php
$model = Doc::model()->findByPk($id);

if ($model->doc_status == 'Successfully minted')
{
    $title = 'Successfully minted';
    $class = 'flash-success';
}
else
{
    $title = 'Fail Minting';
    $class = 'flash-error';
}

$this->breadcrumbs = array(
    'DOIs' => array('index'),
    $title,
);

$this->menu = array(
    array('label' => Yii::t('app', 'Create DOI') , 'url' => array('create')),
    array('label' => Yii::t('app', 'Update DOI') , 'url' => array('update', 'id' => $id)),
    array('label' => Yii::t('app', 'Manage DOI') , 'url' => array('admin')),
);
?>

<h1><?= $title ?></h1>
<div class="<?= $class ?>">
<?= $model->doc_status ?>
</div>
