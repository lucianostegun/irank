<?php
	$userAdminId = $sf_user->getAttribute('userAdminId');
?>
	<div class="formRow">
		<label>Clube</label>
		<div class="formRight">
			<label><?php echo $emailTemplateObj->getClub()->getClubName('Não informado') ?></label>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Template global</label>
		<div class="formRight">
			<?php echo select_tag('emailTemplateIdParent', EmailTemplate::getOptionsForSelect($emailTemplateObj->getEmailTemplateId()), array('id'=>'emailTemplateEmailTemplateId')) ?>
			<div class="formNote error" id="emailTemplateFormErrorEmailTemplateId"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Nome do template</label>
		<div class="formRight">
			<?php echo input_tag('templateName', $emailTemplateObj->getTemplateName(), array('size'=>50, 'maxlength'=>50, 'id'=>'emailTemplateTemplateName')) ?>
			<div class="formNote error" id="emailTemplateFormErrorTemplateName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Tag name</label>
		<div class="formRight">
			<?php echo input_tag('tagName', $emailTemplateObj->getTagName(), array('size'=>32, 'maxlength'=>32, 'id'=>'emailTemplateTagName')) ?>
			<div class="formNote error" id="emailTemplateFormErrorTagName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<?php
		$fileObj  = $emailTemplateObj->getFile();
		$fileName = $fileObj->getFileName();
		
		echo input_hidden_tag('fileName', $fileName, array('id'=>'emailTemplateFileName'));
	?>
	<div class="formRow">
		<label>Arquivo</label>
		<div class="formRight">
			<label id="emailTemplateFileNameDiv">
				<?php echo ($fileName?link_to($fileName, '#goToPage("emailTemplate", "downloadFile", "emailTemplateId", '.$emailTemplateObj->getId().')'):'Não disponível') ?>
			</label>
			<div class="upload">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="32" height="32" id="uploadFileLink" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="allowFullScreen" value="false" />
					<param name="FlashVars" value="scriptName=backend&moduleName=emailTemplate&actionName=uploadFile&fieldName=emailTemplateId&objectId=<?php echo $emailTemplateObj->getId() ?>&uid=<?php echo $userAdminId ?>&fileType=html" />
					<param name="movie" value="/flash/uploadFile.swf?scriptName=backend&moduleName=emailTemplate&actionName=uploadFile&fieldName=emailTemplateId&objectId=<?php echo $emailTemplateObj->getId() ?>&uid=<?php echo $userAdminId ?>&fileType=html&time=<?php echo time() ?>" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#FAFAFA" />
					<embed src="/flash/uploadFile.swf?scriptName=backend&moduleName=emailTemplate&actionName=uploadFile&fieldName=emailTemplateId&objectId=<?php echo $emailTemplateObj->getId() ?>&uid=<?php echo $userAdminId ?>&fileType=html&time=<?php echo time() ?>" quality="high" bgcolor="#FAFAFA" width="32" height="32" name="uploadFileLink" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
				</object>
			</div>
			<label>Arquivos HTML</label>
			<div class="<?php echo ($emailTemplateObj->getIsNew()?'hidden':'') ?>" id="emailTemplateFileControls">
			<?php echo link_to(image_tag('backend/icons/light/create', array('class'=>'icon')).'<span>editar</span>', '#editTemplateContent()', array('class'=>'button blueB', 'style'=>'margin-left: 10px')); ?>
			</div>
			<div class="clear"></div>
			<div class="formNote error" id="emailTemplateFormErrorFileName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Disponível para uso</label>
		<div class="formRight">
			<?php echo checkbox_tag('isAvailableForUse', true, $emailTemplateObj->getIsAvailableForUse(), array('id'=>'emailTemplateIsAvailableForUse')) ?>
			<label for="emailTemplateIsAvailableForUse">Disponível para uso dos clubes</label>
			<div class="formNote error" id="emailTemplateFormErrorIsAvailableForUse"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Disponível para venda</label>
		<div class="formRight">
			<?php echo checkbox_tag('isAvailableForSale', true, $emailTemplateObj->getIsAvailableForSale(), array('id'=>'emailTemplateIsAvailableForSale')) ?>
			<label for="emailTemplateIsAvailableForSale">Disponível para compra pelos clubes</label>
			<div class="formNote error" id="emailTemplateFormErrorIsAvailableForSale"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Observações</label>
		<div class="formRight">
			<?php echo textarea_tag('description', $emailTemplateObj->getDescription(), array('style'=>'height: 150px', 'id'=>'emailTemplateDescription')) ?>
			<div class="formNote error" id="emailTemplateFormErrorDescription"></div>
		</div>
		<div class="clear"></div>
	</div>