<div class="formRow">
	<?php echo link_to(image_tag('backend/icons/light/refresh3', array('class'=>'icon')).'<span>visualizar</span>', '#previewTemplateContent()', array('class'=>'button greenB')); ?>
	<div class="clear"></div>
</div>

<?php
	$emailContent = $emailTemplateObj->getContent();
?>
	<div class="formRow">
			<?php echo textarea_tag('content', $emailContent, array('style'=>'height: 450px; width: 100%', 'id'=>'emailTemplateContent')) ?>
			<div class="formNote error" id="emailTemplateFormErrorDescription"></div>
		<div class="clear"></div>
	</div>