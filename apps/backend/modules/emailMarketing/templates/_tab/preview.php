<div class="formRow">
	<?php echo link_to(image_tag('backend/icons/light/refresh3', array('class'=>'icon')).'<span>atualizar</span>', '#previewMarketingContent()', array('class'=>'button greenB')); ?>
	<?php echo link_to(image_tag('backend/icons/light/create', array('class'=>'icon')).'<span>editar</span>', '#editMarketingContent()', array('class'=>'button blueB', 'style'=>'margin-left: 10px')); ?>
	<?php echo link_to(image_tag('backend/icons/light/mail', array('class'=>'icon')).'<span>E-mail de teste</span>', '#sendEmailPreview()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')); ?>
	<div class="clear"></div>
</div>
	
<div class="emailMarketingPreview">
<?php
	echo $emailMarketingObj->getContentPreview(false);
?>
</div>
