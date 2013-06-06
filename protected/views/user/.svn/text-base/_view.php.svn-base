<div class="view">

	<!--b><?= CHtml::encode($data->getAttributeLabel('id')) ?>:</b>
	<?= CHtml::link(CHtml::encode($data->user_id), array('view', 'id'=>$data->user_id)) ?>
	<br /-->
	
	<b><?= CHtml::encode($data->getAttributeLabel('username')) ?>:</b>
	<?= CHtml::encode($data->username) ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('email')) ?>:</b>
	<?= CHtml::encode($data->email) ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('facility')) ?>:</b>
	<?= CHtml::decode($data->facility) ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('data_manager')) ?>:</b>
	<?= (CHtml::encode($data->data_manager))? 'Yes':'No' ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('approved')) ?>:</b>
	<?= (CHtml::encode($data->approved))? 'Yes':'No' ?>
	<br />
	
	<b><?= CHtml::encode($data->getAttributeLabel('enabled')) ?>:</b>
	<?= (CHtml::encode($data->enabled))? 'Yes':'No' ?>
	<br />

	<?php 
	if (CHtml::encode($data->data_manager)) { 
		$appIdExpiry = Yii::app()->params->appIdExpiry;
		$digest = date('Y') . CHtml::encode($data->email) .  CHtml::encode($data->appid_seed) .  floor((date('m')-1)/$appIdExpiry);
		$month = (floor((date('m')-1)/$appIdExpiry)+1)*$appIdExpiry+1;
		$month = (strlen($month)==1)?  "0$month":$month;
		$end = ($month>12)? (date('Y')+1).'-01-01 00:00:00' : date('Y').'-'.$month.'-01 00:00:00';
		$date_diff = date_diff(date_create(), date_create($end));
	?>

	<b>AppID:</b> <?= hash('ripemd128', $digest); ?> 
	<div class="help" id="expiryDay"><strong style="color:red;">The AppID will be expired in <?= $date_diff->days ?> days.</strong></div>
	<script type="text/javascript">
		$('#expiryDay').show();
	</script>
	<?php 
	} 
	?>

</div>