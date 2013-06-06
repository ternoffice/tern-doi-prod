<?php
$transferFrom = User::model()->findByPk($this->transferFrom);
$transferTo = User::model()->findAllbyAttributes(array('data_manager'=>true));
$transferToList = '<select id="transferTo" name="transferTo"><option></option>';
for ($i=0;$i<count($transferTo);$i++)
{
	$transferToList .= '<option value='.$transferTo[$i]->user_id.'>'.$transferTo[$i]->username.'</option>';
} 
$transferToList .= '</select>';

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Transfer'),
);

$this->menu = array(
    array('label' => 'Manage Users', 'url' => array('user/admin')),
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
<script>
function actionTransfer()
{
	if (document.getElementById('transferTo').value != '')
	{
		document.transfer.submit();
	}
	else
	{
		alert('Please select a Data Manager for DOIs transfer.');
	}
}
</script>
<h3>Transfer DOIs from <?= $transferFrom->username ?></h3>
<form name="transfer" action="?r=doc/transfer&id=<?= $transferFrom->user_id?>" method="post">
<strong>To:</strong> <?= $transferToList ?>
<input type="button" onclick="actionTransfer();" name="Transfer" value="Transfer" />

<?php

    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'doc-grid',
        'dataProvider' => $model->transfer($transferFrom->user_id),
        'filter' => $model,
        'columns' => array(
            'doc_title',
            'doc_url',
            'doc_doi',
            array(
                'header' => 'Select',
				'value'=>'CHtml::checkBox("doi[]","", array("value"=>$data->doc_doi))',
				'type'=>'raw',
				'htmlOptions'=>array('style'=>'text-align:center;'),
			),
        ),
    ));
?>
</form>
