<?php
	echo form_remote_tag(array(
		'url'=>'club/save',
		'success'=>'handleSuccessClub(response)',
		'failure'=>'handleFailureClub(response.responseText)',
		),
		array('class'=>'form', 'id'=>'clubForm'));
	
	$clubId = $clubObj->getId();
	
	echo input_hidden_tag('clubId', $clubId);

	$userAdminId = $sf_user->getAttribute('userAdminId');
?>
	<div class="formRow">
		<label>Nome do clube</label>
		<div class="formRight">
			<?php echo input_tag('clubName', $clubObj->getClubName(), array('size'=>35, 'maxlength'=>60, 'id'=>'clubClubName')) ?>
			<div class="formNote error" id="clubFormErrorClubName"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<?php
		$cityId = $clubObj->getCityId();
		echo input_hidden_tag('cityId', $cityId, array('id'=>'clubCityId'));
	?>
	
	<div class="formRow">
		<label>Cidade</label>
		<div class="formRight">
			<?php echo input_autocomplete_tag('cityName', 'city/autoComplete', 'doSelectClubCity', array('size'=>50, 'maxlength'=>200, 'suggestNew'=>true, 'id'=>'clubCityName')) ?>
			<div class="formNote error" id="clubFormErrorCityId"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Endereço</label>
		<div class="formRight"><?php echo input_tag('addressName', $clubObj->getAddressName(), array('size'=>35, 'maxlength'=>200, 'id'=>'clubAddressName')) ?></div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Número</label>
		<div class="formRight">
			<?php echo input_tag('addressNumber', $clubObj->getAddressNumber(), array('size'=>10, 'maxlength'=>20, 'id'=>'clubAddressNumber')) ?>
			<div class="formNote error" id="clubFormErrorAddressNumber"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Bairro</label>
		<div class="formRight">
			<?php echo input_tag('addressQuarter', $clubObj->getAddressQuarter(), array('size'=>20, 'maxlength'=>50, 'id'=>'clubAddressQuarter')) ?>
			<div class="formNote error" id="clubFormErrorAddressQuarter"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Link GoogleMaps</label>
		<div class="formRight">
			<?php echo input_tag('mapsLink', $clubObj->getMapsLink(), array('size'=>50, 'maxlength'=>500, 'id'=>'clubMapsLink')) ?>
			<div class="formNote error" id="clubFormErrorMapsLink"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Site/E-mail</label>
		<div class="formRight">
			<?php echo input_tag('clubSite', $clubObj->getClubSite(), array('size'=>45, 'maxlength'=>150, 'id'=>'clubClubSite')) ?>
			<div class="formNote error" id="clubFormErrorClubSite"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Telefone 1</label>
		<div class="formRight">
			<?php echo input_tag('phoneNumber1', $clubObj->getPhoneNumber1(), array('size'=>15, 'maxlength'=>15, 'onkeyup'=>'maskPhone(event)', 'id'=>'clubPhoneNumber1')) ?>
			<div class="formNote error" id="clubFormErrorPhoneNumber1"></div>
			<span class="formNote">Formato: (00) 0000-0000</span>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Telefone 2</label>
		<div class="formRight">
			<?php echo input_tag('phoneNumber2', $clubObj->getPhoneNumber2(), array('size'=>15, 'maxlength'=>15, 'onkeyup'=>'maskPhone(event)', 'id'=>'clubPhoneNumber2')) ?>
			<div class="formNote error" id="clubFormErrorPhoneNumber2"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Telefone 3</label>
		<div class="formRight">
			<?php echo input_tag('phoneNumber3', $clubObj->getPhoneNumber3(), array('size'=>15, 'maxlength'=>15, 'onkeyup'=>'maskPhone(event)', 'id'=>'clubPhoneNumber3')) ?>
			<div class="formNote error" id="clubFormErrorPhoneNumber3"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<?php
		$fileNameLogo = $clubObj->getFileNameLogo(true);
	?>
	<div class="formRow">
		<label>Logo</label>
		<div class="formRight">
			<label id="clubFileNameLogoDiv" style="height: 130px; width: 130px">
				<?php echo ($fileNameLogo?link_to(image_tag('club/'.$fileNameLogo), '#goToPage("club", "downloadLogo", "clubId", '.$clubObj->getId().')'):'Não disponível') ?>
			</label>
			<div class="upload">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="32" height="32" id="uploadFileLink" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="allowFullScreen" value="false" />
					<param name="FlashVars" value="scriptName=backend&moduleName=club&actionName=uploadLogo&fieldName=clubId&objectId=<?php echo $clubObj->getId() ?>&uid=<?php echo $userAdminId ?>" />
					<param name="movie" value="/flash/uploadFile.swf?scriptName=backend&moduleName=club&actionName=uploadLogo&fieldName=clubId&objectId=<?php echo $clubObj->getId() ?>&uid=<?php echo $userAdminId ?>&time=<?php echo time() ?>" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#FAFAFA" />
					<embed src="/flash/uploadFile.swf?scriptName=backend&moduleName=club&actionName=uploadLogo&fieldName=clubId&objectId=<?php echo $clubObj->getId() ?>&uid=<?php echo $userAdminId ?>&time=<?php echo time() ?>" quality="high" bgcolor="#FAFAFA" width="32" height="32" name="uploadFileLink" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
				</object>
			</div>
			<label>Imagem JPG com 122 x 122 pixels</label>
		</div>
		<div class="clear"></div>
	</div>
	

	<div class="formRow">
		<label>Informações</label>
		<div class="formRight">
			<?php echo textarea_tag('description', $clubObj->getDescription(), array('style'=>'width: 80%; height: 350px', 'id'=>'clubDescription')) ?>
			<div class="formNote error" id="clubFormErrorDescription"></div>
		</div>
		<div class="clear"></div>
	</div>
</form>