<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Carrinho'=>'store/cart', 'Pagamento'=>null)));
	
	$productItemList = $cartSessionObj->productItemList;
?>
	<div class="storeCartResume">
	
		<?php
			if( !$userSiteId ):
			
				Util::addJavascript('sign');
				Util::addJavascript('login');
				
				include_partial('store/include/login');

			echo form_remote_tag(array(
				'url'=>'sign/save',
				'success'=>'handleSuccessSignStore(request.responseText, true)',
				'failure'=>'handleFailureSignStore(request.responseText, true)',
				'encoding'=>'UTF8',
				), array('id'=>'signForm'));
		?>
		<div id="storeSignDiv" class="hidden"></div>
		</form>
		
		<div id="storeAddressResume" class="hidden">
		<?php endif; ?>
		<h3>Endereço de entrega</h3>
		<?php
			echo form_remote_tag(array(
				'url'=>'store/finishOrder',
				'success'=>'handleSuccessStorePayment(request.responseText)',
				'failure'=>'handleFailureStorePayment(request.responseText)',
				'encoding'=>'UTF8',
				), array('id'=>'storePaymentForm'));
		?>
		<table cellspacing="0" cellpadding="0" class="formTable">
			<tr>
				<td valign="top">
					<div class="defaultForm">
						<div class="row">
							<div class="label" id="storeZipcodeLabel">CEP</div>
							<div class="field"><?php echo input_tag('addressZipcode', $zipcode, array('size'=>9, 'maxlength'=>9, 'class'=>'required', 'onkeyup'=>'maskZipcode(event)', 'id'=>'storeAddressZipcode')) ?></div>
							<div class="text"><?php echo link_to('Pesquisar CEP', '#getAddressByZipcode()') ?></div>
							<div class="error" id="storeAddressZipcodeError"></div>
						</div>
						<div class="row">
							<div class="label" id="storeAddressNameLabel">Logradouro</div>
							<div class="field"><?php echo input_tag('addressName', $addressName, array('size'=>55, 'maxlength'=>150, 'class'=>'required', 'id'=>'storeAddressName')) ?></div>
							<div class="error" id="storeAddressNameError"></div>
						</div>
						<div class="row">
							<div class="label" id="storeAddressNumberLabel">Número</div>
							<div class="field"><?php echo input_tag('addressNumber', $addressNumber, array('size'=>5, 'maxlength'=>15, 'class'=>'required', 'id'=>'storeAddressNumber')) ?></div>
							<div class="error" id="storeAddressNumberError"></div>
						</div>
						<div class="row">
							<div class="label" id="storeAddressComplementLabel">Complemento</div>
							<div class="field"><?php echo input_tag('addressComplement', $addressComplement, array('size'=>20, 'maxlength'=>50, 'id'=>'storeAddressComplement')) ?></div>
							<div class="error" id="storeAddressComplementError"></div>
						</div>
						<div class="row">
							<div class="label" id="storeAddressQuarterLabel">Bairro</div>
							<div class="field"><?php echo input_tag('addressQuarter', $quarter, array('size'=>15, 'maxlength'=>30, 'class'=>'required', 'id'=>'storeAddressQuarter')) ?></div>
							<div class="error" id="storeAddressQuarterError"></div>
						</div>
						<div class="row">
							<div class="label" id="storeAddressCityLabel">Cidade/UF</div>
							<div class="field"><?php echo input_tag('addressCity', $city, array('size'=>25, 'maxlength'=>50, 'class'=>'required', 'id'=>'storeAddressCity')) ?></div>
							<div class="field"><?php echo input_tag('addressState', $state, array('size'=>2, 'maxlength'=>2, 'class'=>'required', 'id'=>'storeAddressState')) ?></div>
							<div class="error" id="storeAddressCityError"></div>
							<div class="error" id="storeAddressStateError"></div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	
		<h3>Forma de pagamento</h3>
		
		<table cellspacing="0" cellpadding="0" class="paymethod mt10 ml10 mb20">
			<tr>
				<td class="textC p3"><?php echo radiobutton_tag('paymethod', 'billet', ($cartSessionObj->paymethod=='billet'), array('id'=>'paymethodBillet')) ?></td>
				<td class="textL p3 pr30"><label for="paymethodBillet"><?php echo image_tag('store/boleto') ?></label></td>
				<td class="textC p3"><?php echo radiobutton_tag('paymethod', 'pagseguro', ($cartSessionObj->paymethod=='pagseguro'), array('id'=>'paymethodPagseguro')) ?></td>
				<td class="textL p3"><label for="paymethodPagseguro"><?php echo image_tag('store/pagseguro') ?></label></td>
			</tr>
			<tr>
				<td colspan="4"><div class="error" id="storePaymethodError"></div></td>
			</tr>
		</table>
		
		<?php echo link_to(image_tag('store/back', array('class'=>'ml20')), 'store/cart') ?>
		<?php echo link_to(image_tag('store/nextButton', array('class'=>'ml10')), '#finishOrder()') ?>
		
		<?php if( !$userSiteId ): ?>
		</div>
		<?php endif; ?>
		</form>
		
	</div>
	<?php echo link_to(image_tag('store/rapidssl.gif', array('style'=>'position: absolute; right: 10px; bottom: 10px'), 'https://www.webyssl.com', array('target'=>'_blank', 'class'=>'rapidSslStamp'))) ?>

<div class="clear mt5"></div>