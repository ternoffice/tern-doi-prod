<div class="view">

	<!--?php echo GxHtml::encode($data->getAttributeLabel('doc_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->doc_id), array('view', 'id' => $data->doc_id)); ?>
	<br /-->
	<strong>Title:</strong> 
	<?php
		if ($this->user->user_id == $data->user_id)
		{
			echo GxHtml::link(GxHtml::encode($data->doc_title), array('view', 'id' => $data->doc_id)); 
		}
		else
		{
			echo GxHtml::encode($data->doc_title); 
		}
	?>
	<br />
	<strong><?php echo GxHtml::encode($data->getAttributeLabel('doc_url')); ?>: </strong><?php echo GxHtml::encode($data->doc_url); ?><br />
	<strong><?php echo GxHtml::encode($data->getAttributeLabel('doc_doi')); ?>: </strong><?php echo GxHtml::encode($data->doc_doi); ?><br />
	<strong><?php echo GxHtml::encode($data->getAttributeLabel('user_id')); ?>: </strong><?php echo GxHtml::encode($data->user_id); ?><br />
</div>