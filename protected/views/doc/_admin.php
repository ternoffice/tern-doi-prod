<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'doc-grid',
    'dataProvider' => $dataProvider,
    //'filter' => $model,
    'columns' => array(
        array(
            'name' => 'Title',
            'value' => 'CHtml::link(GxHtml::encode($data->doc_title), array("doc/view", "id" => $data->doc_id))',
            'type' => 'raw',
        ),
        'doc_url',
        'doc_status',
        'doc_doi',
    ),
));
?>