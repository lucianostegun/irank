<div class="formRow">
	<?php echo link_to(image_tag('backend/icons/light/refresh3', array('class'=>'icon')).'<span>atualizar</span>', '#previewTemplateContent()', array('class'=>'button greenB')); ?>
	<?php echo link_to(image_tag('backend/icons/light/create', array('class'=>'icon')).'<span>editar</span>', '#editTemplateContent()', array('class'=>'button blueB', 'style'=>'margin-left: 10px')); ?>
	<?php echo link_to(image_tag('backend/icons/light/mail', array('class'=>'icon')).'<span>E-mail de teste</span>', '#sendEmailPreview()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')); ?>
	<div class="clear"></div>
</div>
	
<div class="emailTemplatePreview">
<?php
	$emailContent = $emailTemplateObj->getContent();
	
	$eventObj = EventPeer::retrieveByPK(10);
	
	$infoList = array('resultList'=>$eventObj->getEmailResultList(),
					  'classifyList'=>$eventObj->getEmailClassifyList(),
					  'emailTitle'=>$emailTemplateObj->toString(),
					  'peopleName'=>$sf_user->getAttribute('fullName'));
	
	$infoList = array_merge($infoList, $eventObj->getInfo());
	
	if( !is_null($emailTemplateObj->getEmailTemplateId()) ){
		
		$emailTemplate = $emailTemplateObj->getEmailTemplate()->getContent();
		$emailContent = str_replace('[emailContent]', $emailContent, $emailTemplate);
	}
					  
	$emailContent = Report::defaultReplace($emailContent, $infoList);
	echo $emailContent;
?>
</div>
