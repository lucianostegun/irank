<div class="formRow">
	<?php echo link_to(image_tag('backend/icons/light/refresh3', array('class'=>'icon')).'<span>visualizar</span>', '#previewMarketingContent()', array('class'=>'button greenB')); ?>
	<div class="clear"></div>
</div>

<?php
	$emailContent = $emailMarketingObj->getContent();
?>
	<div class="formRow">
			<?php echo textarea_tag('content', $emailContent, array('style'=>'height: 450px; width: 100%', 'id'=>'emailMarketingContent')) ?>
			<div class="formNote error" id="emailMarketingFormErrorDescription"></div>
		<div class="clear"></div>
	</div>