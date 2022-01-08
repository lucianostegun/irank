<?php
	echo form_remote_tag(array(
		'url'=>'store/save',
		'success'=>'handleSuccessStore(response)',
		'failure'=>'handleFailureStore(response.responseText)',
		'loading'=>'showIndicator()',
		),
		array('class'=>'form', 'id'=>'storeForm'));

//	echo form_tag('store/save', array('class'=>'form', 'id'=>'storeForm'));
	
	$storeShippingZipcode = Config::getConfigByName('storeShippingZipcode', true);
?>
	<div class="formRow">
		<label>CEP de envio</label>
		<div class="formRight">
			<?php echo input_tag('storeShippingZipcode', $storeShippingZipcode, array('size'=>9, 'maxlength'=>9, 'onkeyup'=>'maskZipcode(event)', 'id'=>'storeStoreShippingZipcode')) ?>
			<div class="formNote error" id="storeFormErrorStoreShippingZipcode"></div>
			<div class="formNote">CEP utilizado para calcular o valor do frete dos produtos</div>
		</div>
		<div class="clear"></div>
	</div>
</form>