<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/multifield.js"); ?>
<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    html_entity_decode(GxHtml::encode($model->doc_title)),
);
$this->menu = array(
    array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
    array('label' => Yii::t('app', 'Update') . ' ' . $model->label(), 'url' => array('update', 'id' => $model->doc_id)),
    array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . '  ' . GxHtml::encode($model->doc_title); ?></h1>

<?php
// prepare arrays for printing

$creator = new CArrayDataProvider(flattenArray($model->creator, array('creatorName', 'nameIdentifier', 'nameIdentifierScheme')),array('keyField' =>'creatorName'));
$gridViewCreator = $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $creator,
	'columns' => array(
            array(
                'name' => 'Creator Name',
                'value' => 'CHtml::encode($data["creatorName"])'
                ),
            array(
                'name' => 'Name Identifier',
                'value' => 'CHtml::encode($data["nameIdentifier"])'
            ),
            array(
                'name' => 'Name Identifier Scheme',
                'value' => 'CHtml::encode($data["nameIdentifierScheme"])'
            )

        ),
        'enablePagination' => FALSE,
        'summaryText' => '',
    ),TRUE);

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'label' => 'Title(s)',
            'type' => 'raw',
            'value' => implodeTitles($model->title),
        ),
        array(
            'label' => 'Creators',
            'type' => 'raw',
            'value' => $gridViewCreator,
        ),
        array(
            'label' => 'Date',
            'type' => 'raw',
            'value' => Yii::app()->dateFormatter->formatDateTime($model->doc_date),
        ),
        'publisher',
        'publicationYear',
        'doc_url',
        'doc_doi',
        array(
            'label' => 'Status',
            'type' => 'raw',
//            'value' => prepStatus($model->doc_status),
            'value' => $model->doc_status,
        ),
        array(
            'label' => 'Citation',
            'type' => 'raw',
            'value' => ($model->doc_doi)? dataCitate(Array('creator' => $model->creator, 'publicationYear' => $model->publicationYear, 'title' => $model->doc_title, 'publisher' => $model->publisher, 'identifier' => $model->doc_doi)):'',
        ),
    ),
        )
);
?><br/>
<h3 id="OptionalData" style="background: -moz-linear-gradient(center top , #EDEDED 5%, #DFDFDF 100%) repeat scroll 0 0 #EDEDED;
    border: 1px solid #DCDCDC;
    border-radius: 6px 6px 6px 6px;
    box-shadow: 0 1px 0 0 #DCDCDC inset;
    color: #666666;
    display: inline-block;
    font-family: arial;
    font-size: 15px;
    font-weight: bold;
    padding: 6px 24px;
    text-decoration: none;
    text-shadow: 1px 1px 0 #FFFFFF;">Optional Data</h3>
<div class="advanced">This section under vigorous development.
<?php
$contributor = new CArrayDataProvider(flattenArray($model->contributor, array('contributorName', 'nameIdentifier', 'nameIdentifierScheme', 'contributorType')),array('keyField' =>'contributorName'));;
$gridViewContributor = $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $contributor,
	'columns' => array(
            array(
                'name' => 'Contributor Type',
                'value' => 'CHtml::encode(spaceCapital($data["contributorType"]))',
                ),
            array(
                'name' => 'Contributor Name',
                'value' => 'CHtml::encode($data["contributorName"])'
                ),
            array(
                'name' => 'Name Identifier',
                'value' => 'CHtml::encode($data["nameIdentifier"])'
            ),
            array(
                'name' => 'Name Identifier Scheme',
                'value' => 'CHtml::encode($data["nameIdentifierScheme"])'
            ),

        ),
        'enablePagination' => FALSE,
        'summaryText' => '',
    ),TRUE);
$date = flattenArray($model->date, array('root', 'dateType'));
$alternateIdentifier = flattenArray($model->alternateIdentifier, array('root', 'alternateIdentifierType'));
$relatedIdentifier = flattenArray($model->relatedIdentifier, array('root', 'relatedIdentifierType', 'relationType'));
$description = flattenArray($model->description, array('root', 'descriptionType'));

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'label' => 'Subject(s)',
            'type' => 'raw',
            'value' => implodeSubject($model->subject),
        ),
        array(
            'label' => 'Contributor(s)',
            'type' => 'raw',
            'value' => $gridViewContributor,
        ),
        array(
            'label' => 'Dates',
            'type' => 'raw',
            'value' => formatArray2Sprintf($date, '%dateType$s at %root$s <br/>'),
        ),
        'language',
        array(
            'label' => 'Resource Type',
            'type' => 'raw',
            'value' => multiImplode($model->resourceType, ' of type '),
        ),
        array(
            'label' => 'Alternate Identifier',
            'type' => 'raw',
            'value' => formatArray2Sprintf($alternateIdentifier, '%root$s of type %alternateIdentifierType$s <br/>'),
        ),
        array(
            'label' => 'Related Identifier',
            'type' => 'raw',
            'value' => formatArray2Sprintf($relatedIdentifier, '%relationType$s %root$s (%relatedIdentifierType$s) <br/>'),
        ),
        array(
            'label' => 'Size',
            'type' => 'raw',
            'value' => multiImplode($model->size, ' <br/>'),
        ),
        array(
            'label' => 'Format',
            'type' => 'raw',
            'value' => multiImplode($model->format, ' <br/>'),
        ),
        'version',
        'rights',
        array(
            'label' => 'Description',
            'type' => 'raw',
            'value' => formatArray2Sprintf($description, '%descriptionType$s :  <blockquote>%root$s  </blockquote><br/>'),
        ),
    ),
        )
);
?></div>