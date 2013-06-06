<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<!--h2>Error <?php echo $code; ?></h2-->

<div class="error">
<h2><?php echo CHtml::encode($message); ?></h2>
</div>
