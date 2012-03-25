<?php
	$userAdminId = $sf_user->getAttribute('userAdminId');
	include_partial('home/include/formHeader', array('prefix'=>'club'));
?>
<div class="module_content">
	<div class="defaultForm">
		<section>
			<label>Nome do clube</label>
			<?php echo input_tag('clubName', $clubObj->getClubName(), array('size'=>35, 'maxlength'=>60, 'id'=>'clubClubName')) ?>
		</section>
		
		<?php
			$cityId = $clubObj->getCityId();
		?>
		<section>
			<label>Cidade</label>
			<span id="clubCityIdFieldDiv" class="<?php echo ($cityId?'hidden':'') ?>">
			<?php
				echo input_hidden_tag('cityId', $cityId, array('id'=>'clubCityId'));
				echo input_auto_complete_tag(
			      'cityName',
			      $clubObj->getLocation(),
			      'city/autoComplete?instanceName=cityId&suggestNew='.Util::AUTO_COMPLETE_SUGGEST_NEW_IF_EMPTY,
			      array('autocomplete' => 'off', 'onkeyup'=>'$("clubCityId").value=""', 'size'=>35, 'id'=>'clubCityName'),
			      array(
			        'use_style'             => true,
			        'after_update_element'  => 'function (inputField, selectedItem){ selectAutoCompleteItem(selectedItem.id, inputField.value, \'club\', \'cityId\', \'clubAddressName\', null, {searchFieldName:\'clubCityName\', quickModuleName:\'city\'}) }',
			      	'with'                  => ' value+\'?&cityName=\'+$("clubCityName").value',
			      	'inTab'                 => false)
			    );
			?>
			</span>
			<div id="clubCityIdRoDiv" class="text <?php echo ($cityId?'':'hidden') ?>"><div id="clubCityIdDiv"><?php echo $clubObj->getLocation() ?></div></div>
			<div id="clubCityIdAutoComplete" class="image <?php echo ($cityId?'':'hidden') ?>"><a href="javascript:void(0)" onclick="openAutoComplete('club', 'cityId', 'clubCityName')"><?php echo image_tag('backend/icon/reload') ?></a></div>
		</section>
		
		<section>
			<label>Endereço</label>
			<?php echo input_tag('addressName', $clubObj->getAddressName(), array('size'=>35, 'maxlength'=>200, 'id'=>'clubAddressName')) ?>
		</section>
		
		<section>
			<label>Número</label>
			<?php echo input_tag('addressNumber', $clubObj->getAddressNumber(), array('size'=>10, 'maxlength'=>20, 'id'=>'clubAddressNumber')) ?>
		</section>
		
		<section>
			<label>Bairro</label>
			<?php echo input_tag('addressQuarter', $clubObj->getAddressQuarter(), array('size'=>20, 'maxlength'=>50, 'id'=>'clubAddressQuarter')) ?>
		</section>

		<section>
			<label>Link GoogleMaps</label>
			<?php echo input_tag('mapsLink', $clubObj->getMapsLink(), array('size'=>50, 'maxlength'=>500, 'id'=>'clubMapsLink')) ?>
		</section>
		
		<section>
			<label>Site/E-mail</label>
			<?php echo input_tag('clubSite', $clubObj->getClubSite(), array('size'=>45, 'maxlength'=>150, 'id'=>'clubClubSite')) ?>
		</section>
		
		<section>
			<label>Telefone 1</label>
			<?php echo input_tag('phoneNumber1', $clubObj->getPhoneNumber1(), array('size'=>15, 'maxlength'=>15, 'onkeyup'=>'maskPhone(event)', 'id'=>'clubPhoneNumber1')) ?>
			<div class="text">Formato: (00) 0000-0000</div>
		</section>
		
		<section>
			<label>Telefone 2</label>
			<?php echo input_tag('phoneNumber2', $clubObj->getPhoneNumber2(), array('size'=>15, 'maxlength'=>15, 'onkeyup'=>'maskPhone(event)', 'id'=>'clubPhoneNumber2')) ?>
		</section>
		
		<section>
			<label>Telefone 3</label>
			<?php echo input_tag('phoneNumber3', $clubObj->getPhoneNumber3(), array('size'=>15, 'maxlength'=>15, 'onkeyup'=>'maskPhone(event)', 'id'=>'clubPhoneNumber3')) ?>
		</section>
		
		<?php
			$fileNameLogo = $clubObj->getFileNameLogo(true);
		?>
		<section>
			<label>Logo</label>
			<div class="text" style="min-width: 100px" id="clubFileNameLogoDiv"><?php echo ($fileNameLogo?link_to($fileNameLogo, '#goToPage("club", "downloadLogo", "clubId", '.$clubObj->getId().')'):'Não disponível') ?></div>
			<div class="upload">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="16" height="16" id="uploadFileLink" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="allowFullScreen" value="false" />
					<param name="FlashVars" value="scriptName=backend&moduleName=club&actionName=uploadLogo&fieldName=clubId&objectId=<?php echo $clubObj->getId() ?>&uid=<?php echo $userAdminId ?>" />
					<param name="movie" value="/flash/uploadFile.swf?scriptName=backend&moduleName=club&actionName=uploadLogo&fieldName=clubId&objectId=<?php echo $clubObj->getId() ?>&uid=<?php echo $userAdminId ?>&time=<?php echo time() ?>" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#FFFFFF" />
					<embed src="/flash/uploadFile.swf?scriptName=backend&moduleName=club&actionName=uploadLogo&fieldName=clubId&objectId=<?php echo $clubObj->getId() ?>&uid=<?php echo $userAdminId ?>&time=<?php echo time() ?>" quality="high" bgcolor="#FFFFFF" width="16" height="16" name="uploadFileLink" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
				</object>
			</div>
			<div class="text">Imagem JPG com 90 x 90 pixels</div>
		</section>
	</div>
</div>