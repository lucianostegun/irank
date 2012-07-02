<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Carrinho'=>'store/cart', 'Pagamento'=>null)));
?>
	<div class="storeCartResume">
		
		<h3>Endereço de entrega</h3>
		
		<table cellspacing="0" cellpadding="0" class="formTable">
			<tr>
				<td valign="top">
					<div class="defaultForm">
						<div class="row">
							<div class="label" id="storeZipcodeLabel">CEP</div>
							<div class="field"><?php echo input_tag('zipcode', '04057-000', array('size'=>9, 'maxlength'=>9, 'id'=>'storeZipcode')) ?></div>
							<div class="error" id="storeZipcodeError" onclick="showFormErrorDetails('store', 'zipcode')"></div>
						</div>
						<div class="row">
							<div class="label" id="storeAddressNameLabel">Logradouro</div>
							<div class="field"><?php echo input_tag('addressName', null, array('size'=>55, 'maxlength'=>150, 'id'=>'storeAddressName')) ?></div>
							<div class="error" id="storeAddressNameError" onclick="showFormErrorDetails('store', 'addressName')"></div>
						</div>
						<div class="row">
							<div class="label" id="storeAddressNumberLabel">Número</div>
							<div class="field"><?php echo input_tag('addressNumber', null, array('size'=>5, 'maxlength'=>10, 'id'=>'storeAddressNumber')) ?></div>
							<div class="error" id="storeAddressNumberError" onclick="showFormErrorDetails('store', 'addressNumber')"></div>
						</div>
						<div class="row">
							<div class="label" id="storeAddressComplementLabel">Complemento</div>
							<div class="field"><?php echo input_tag('addressComplement', null, array('size'=>20, 'maxlength'=>35, 'id'=>'storeAddressComplement')) ?></div>
							<div class="error" id="storeAddressComplementError" onclick="showFormErrorDetails('store', 'addressComplement')"></div>
						</div>
						<div class="row">
							<div class="label" id="storeAddressQuarterLabel">Bairro</div>
							<div class="field"><?php echo input_tag('addressQuarter', null, array('size'=>15, 'maxlength'=>25, 'id'=>'storeAddressQuarter')) ?></div>
							<div class="error" id="storeAddressQuarterError" onclick="showFormErrorDetails('store', 'addressQuarter')"></div>
						</div>
						<div class="row">
							<div class="label" id="storeAddressCityLabel">Cidade/UF</div>
							<div class="field"><?php echo input_tag('addressCity', null, array('size'=>25, 'maxlength'=>50, 'id'=>'storeAddressCity')) ?></div>
							<div class="field"><?php echo input_tag('addressState', null, array('size'=>2, 'maxlength'=>2, 'id'=>'storeAddressState')) ?></div>
							<div class="error" id="storeAddressCityError" onclick="showFormErrorDetails('store', 'addressCity')"></div>
							<div class="error" id="storeAddressStateError" onclick="showFormErrorDetails('store', 'addressState')"></div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	
		<h3 class="mt30">Resumo do pedido</h3>
		
		<table border="0" cellspacing="0" cellpadding="0" class="gridTable store cart" style="margin-top: 0px">
		  <tr class="header">
		    <th class="first">Produto</th>
		    <th width="70">Qtd</th>
		    <th width="100">Vl. unit.</th>
		    <th width="100">Vl. total</th>
		  </tr>
		  <tr>
		    <td class="textL productName">Camiseta I'm bluffing / I'm All In</td>
		    <td class="textC quantity">1</td>
		    <td class="textR productPrice">R$ 39,90</td>
		    <td class="textR totalValue">R$ 39,90</td>
		  </tr>
		  <tr class="odd">
		    <td class="textL productName">Four of a kind: Aces</td>
		    <td class="textC quantity">1</td>
		    <td class="textR productPrice">R$ 39,90</td>
		    <td class="textR totalValue">R$ 39,90</td>
		  </tr>
		  <tr>
		    <td class="textL productName">iRank red suit #1</td>
		    <td class="textC quantity">1</td>
		    <td class="textR productPrice">R$ 39,90</td>
		    <td class="textR totalValue">R$ 39,90</td>
		  </tr>
		  <tr class="shipping">
		    <td class="textR pr10"></td>
		    <td class="textC"></td>
		    <td class="textR">FRETE</td>
		    <td class="textR shippingValue">R$ 10,00</td>
		  </tr>
		  <tr class="footer shipping">
		    <th class="textC"></th>
		    <th class="textR pr10" colspan="2">TOTAL DA COMPRA</th>
		    <th class="textR shippingValue">R$ <?php echo Util::formatFloat(39.9*3+10, true) ?></th>
		  </tr>
		</table>
		
		<h3 class="mt30">Forma de pagamento</h3>
		
		<table cellspacing="0" cellpadding="0" class="paymethod mt10 ml10">
			<tr>
				<td class="textC p3"><?php echo radiobutton_tag('paymethod', 'billet', false, array('id'=>'paymethodBillet')) ?></td>
				<td class="textL p3 pr30"><label for="paymethodBillet"><?php echo image_tag('store/boleto') ?></label></td>
				<td class="textC p3"><?php echo radiobutton_tag('paymethod', 'pagseguro', false, array('id'=>'paymethodPagseguro')) ?></td>
				<td class="textL p3"><label for="paymethodPagseguro"><?php echo image_tag('store/pagseguro') ?></label></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
		</table>
		
		<?php echo link_to(image_tag('store/finish', array('class'=>'finishOrderButton')), 'store/order') ?>
		
	</div>

<div class="clear mt5"></div>