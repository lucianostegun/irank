<?php
	$userAdminId = $sf_user->getAttribute('userAdminId');
?>
	<div class="formRow">
		<label>Clube</label>
		<div class="formRight">
			<label><?php echo $emailMarketingObj->getClub()->getClubName('Não informado') ?></label>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Template global</label>
		<div class="formRight">
			<?php echo select_tag('emailTemplateId', EmailTemplate::getOptionsForSelect($emailMarketingObj->getEmailTemplateId()), array('id'=>'emailMarketingEmailTemplateId')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="emailMarketingFormErrorEmailTemplateId"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Título</label>
		<div class="formRight">
			<?php echo input_tag('description', $emailMarketingObj->getDescription(), array('size'=>50, 'maxlength'=>80, 'id'=>'emailMarketingDescription')) ?>
			<div class="formNote error" id="emailMarketingFormErrorDescription"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Assunto do e-mail</label>
		<div class="formRight">
			<?php echo input_tag('emailSubject', $emailMarketingObj->getEmailSubject(), array('size'=>50, 'maxlength'=>50, 'id'=>'emailMarketingEmailSubject')) ?>
			<div class="formNote error" id="emailMarketingFormErrorEmailSubject"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Classe de anexo</label>
		<div class="formRight">
			<?php
				$optionList = array(''=>'Selecione', 'Bankroll'=>'Relatório de bankroll');
				echo select_tag('className', options_for_select($optionList, $emailMarketingObj->getClassName()), array('id'=>'emailMarketingClassName'));
			?>
			<div class="clear"></div>
			<div class="formNote error" id="emailMarketingFormErrorClassName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<?php
		$fileObj  = $emailMarketingObj->getFile();
		$fileName = $fileObj->getFileName();
		
		echo input_hidden_tag('fileName', $fileName, array('id'=>'emailMarketingFileName'));
	?>
	<div class="formRow">
		<label>Arquivo</label>
		<div class="formRight">
			<label id="emailMarketingFileNameDiv">
				<?php echo ($fileName?link_to($fileName, '#goToPage("emailMarketing", "downloadFile", "emailMarketingId", '.$emailMarketingObj->getId().')'):'Não disponível') ?>
			</label>
			<div class="upload">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="32" height="32" id="uploadFileLink" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="allowFullScreen" value="false" />
					<param name="FlashVars" value="scriptName=backend&moduleName=emailMarketing&actionName=uploadFile&fieldName=emailMarketingId&objectId=<?php echo $emailMarketingObj->getId() ?>&uid=<?php echo $userAdminId ?>&fileType=html" />
					<param name="movie" value="/flash/uploadFile.swf?scriptName=backend&moduleName=emailMarketing&actionName=uploadFile&fieldName=emailMarketingId&objectId=<?php echo $emailMarketingObj->getId() ?>&uid=<?php echo $userAdminId ?>&fileType=html&time=<?php echo time() ?>" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#FAFAFA" />
					<embed src="/flash/uploadFile.swf?scriptName=backend&moduleName=emailMarketing&actionName=uploadFile&fieldName=emailMarketingId&objectId=<?php echo $emailMarketingObj->getId() ?>&uid=<?php echo $userAdminId ?>&fileType=html&time=<?php echo time() ?>" quality="high" bgcolor="#FAFAFA" width="32" height="32" name="uploadFileLink" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
				</object>
			</div>
			<label>Arquivos HTML</label>
			<div class="<?php echo ($emailMarketingObj->getIsNew()?'hidden':'') ?>" id="emailMarketingFileControls">
			<?php echo link_to(image_tag('backend/icons/light/create', array('class'=>'icon')).'<span>editar</span>', '#editMarketingContent()', array('class'=>'button blueB', 'style'=>'margin-left: 10px')); ?>
			</div>
			<div class="clear"></div>
			<div class="formNote error" id="emailMarketingFormErrorFileName"></div>
		</div>
		<div class="clear"></div>
	</div>