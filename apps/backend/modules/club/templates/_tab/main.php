<div class="module_content">
	<div class="defaultForm">
		<section>
		<label>Nome do clube</label>
		<?php echo input_tag('clubName', $clubObj->getClubName(), array('size'=>35, 'id'=>'clubClubName')) ?>
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
		      'city/autoComplete?instanceName=cityId',
		      array('autocomplete' => 'off', 'onkeyup'=>'$("clubCityId").value=""', 'size'=>35, 'id'=>'clubCityName'),
		      array(
		        'use_style'             => true,
		        'after_update_element'  => 'function (inputField, selectedItem){ selectAutoCompleteItem(selectedItem.id, inputField.value, \'club\', \'cityId\', \'clubAddressName\') }',
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
		<?php echo input_tag('addressName', $clubObj->getAddressName(), array('size'=>35, 'id'=>'clubAddressName')) ?>
		</section>
		
		<section>
		<label>Número</label>
		<?php echo input_tag('addressNumber', $clubObj->getAddressNumber(), array('size'=>10, 'id'=>'clubAddressNumber')) ?>
		</section>
		
		<section>
		<label>Bairro</label>
		<?php echo input_tag('addressQuarter', $clubObj->getAddressQuarter(), array('size'=>20, 'id'=>'clubAddressQuarter')) ?>
		</section>

		<section>
		<label>Link GoogleMaps</label>
		<?php echo input_tag('mapsLink', $clubObj->getMapsLink(), array('size'=>50, 'id'=>'clubMapsLink')) ?>
		</section>
		
		<section>
		<label>Site/E-mail</label>
		<?php echo input_tag('clubSite', $clubObj->getClubSite(), array('size'=>45, 'id'=>'clubClubSite')) ?>
		</section>
		
		<section>
		<label>Telefone 1</label>
		<?php echo input_tag('phoneNumber1', $clubObj->getPhoneNumber1(), array('size'=>15, 'onkeyup'=>'maskPhone(event)', 'id'=>'clubPhoneNumber1')) ?>
		<div class="text">Formato: (00) 0000-0000</div>
		</section>
		
		<section>
		<label>Telefone 2</label>
		<?php echo input_tag('phoneNumber2', $clubObj->getPhoneNumber2(), array('size'=>15, 'onkeyup'=>'maskPhone(event)', 'id'=>'clubPhoneNumber2')) ?>
		</section>
		
		<section>
		<label>Telefone 3</label>
		<?php echo input_tag('phoneNumber3', $clubObj->getPhoneNumber3(), array('size'=>15, 'onkeyup'=>'maskPhone(event)', 'id'=>'clubPhoneNumber3')) ?>
		</section>
	</div>
	
</div>