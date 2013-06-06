<?php
$this->breadcrumbs=array(
	'Registered URLs',
);

$this->menu=array(
	array('label'=>'Create URL', 'url'=>array('create')),
	array('label'=>'View Registered URLs', 'url'=>array('admin')),
);
?>

<h1>Your Approved URLs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
