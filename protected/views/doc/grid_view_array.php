<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $arrayDataProvider,
	'columns' => array(
		array(
			'name' => 'Title',
			'type' => 'raw',
			'value' => 'CHtml::encode($data["title"])'
		),
		array(
			'name' => 'Title Type',
			'type' => 'raw',
			'value' => 'CHtml::encode($data["titleType"])',
		),
         
	),
    'enablePagination' => false,
    'summaryText' => '',
));
?>
