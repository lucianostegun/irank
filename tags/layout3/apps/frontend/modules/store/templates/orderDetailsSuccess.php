<?php
	$orderNumber = $purchaseObj->getOrderNumber();
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Minhas compras'=>'store/myOrders', 'Pedido #'.$orderNumber=>null)));
	
	$tracingCode   = $purchaseObj->getTracingCode();
	$shippingDate  = $purchaseObj->getShippingDate('d/m/Y');
	$billetLink    = null;
	$fileId        = $purchaseObj->getFileId();
	
	$paymethod = $purchaseObj->getPaymethod();
	
	switch($paymethod){
		case 'billet':
			$billetLink = link_to('Imprimir boleto', "store/billet?$orderNumber=", array('class'=>'ml15', 'target'=>'_blank'));
			break;
		case 'pagseguro':
			$billetLink = link_to('Link para pagamento', $purchaseObj->getPagseguroUrl(), array('class'=>'ml15', 'target'=>'_blank'));
			break;
	}
?>
	<div class="storeOrderHeader">
		<div class="orderNumber">Pedido: <span>#<?php echo $orderNumber ?></span></div>
		<div class="orderStatus">Status: <span><?php echo $purchaseObj->getOrderStatus(true) ?></span></div>
		
		<div class="productsLabel">Itens do pedido</div>
	</div>
	


<table border="0" cellspacing="0" cellpadding="0" class="store cart resume" style="width: 765px; margin: 10px 10px 0px 10px">
  <tr class="header">
    <th colspan="2" class="first">Produto</th>
    <th width="70">Qtd</th>
    <th width="70">Vl. unit.</th>
    <th width="80">Vl. total</th>
  </tr>
  <?php
  	$shippingValue   = $purchaseObj->getShippingValue();
  	$totalOrderValue = $purchaseObj->getTotalValue();
  	
  	$class = ($purchaseObj->getProducts()%2==0?'odd':'even');
  	foreach($purchaseObj->getPurchaseProductItemList() as $purchaseProductItemObj):
  	
  		$productItemObj = $purchaseProductItemObj->getProductItem();
  		$productObj     = $productItemObj->getProduct();
  		$productCode    = $productObj->getProductCode();
  		
  		$productCategoryObj = $productObj->getProductCategory();
		$categoryShortName  = $productCategoryObj->getShortName();
		$productName        = $productObj->getProductName();
		$shortName          = $productObj->getShortName();
		
  		$color    = $productItemObj->getProductOptionColor()->getOptionName();
  		$size     = $productItemObj->getProductOptionSize()->getDescription();
  		$price    = $purchaseProductItemObj->getPrice();
  		$quantity = $purchaseProductItemObj->getQuantity();
		
		$totalValue = $price*$quantity;
		$class      = ($class=='even'?'odd':'even');
  ?>
  <tr class="productItemRow <?php echo $class ?>" id="cartProductItem-<?php echo $productItemId ?>">
    <td width="40" class="productImage"><?php echo image_tag($productItemObj->getImageCover('thumb')) ?></td>
    <td class="textL productInfo">
    	<span class="productName"><?php echo link_to("$categoryShortName: $productName", 'store/details?'.$productCode.'=') ?></span>
    	<div class="clear"></div>
    	<span class="productOption"><?php echo $color ?> | <?php echo $size ?></span>
    </td>
    <td class="textC quantity"><?php echo $quantity ?></td>
    <td class="textR productPrice">R$ <?php echo Util::formatFloat($price, true) ?></td>
    <td class="textR totalValue">R$ <?php echo Util::formatFloat($price*$quantity, true) ?></td>
  </tr>
  <?php
  	endforeach;
  ?>
  <tr class="footer shipping">
    <th class="textC"></th>
    <th class="textC"></th>
    <th class="textC"></th>
    <th class="textR pr10">FRETE</th>
    <th class="textR" id="storeCartShippingValue">R$ <?php echo Util::formatFloat($shippingValue, true) ?></th>
  </tr>
  <tr class="footer total">
    <th class="textC"></th>
    <th class="textR pr10" colspan="2">TOTAL DO PEDIDO</th>
    <th class="textR" colspan="2" id="storeCartTotalValue">R$ <?php echo Util::formatFloat($totalOrderValue, true) ?></th>
  </tr>
</table>

<div class="purchaseInfo">
	<h1>Informações do pedido</h1>
	<div class="info"><label>Data pedido:</label><?php echo $purchaseObj->getCreatedAt('d/m/Y H:i') ?></div>
	<?php if( $shippingDate ): ?>
		<div class="info"><label>Data envio:</label><?php echo $shippingDate ?></div>
	<?php else: ?>
		<div class="info"><label>Prazo de envio:</label>
		<?php
			$approvalDate = $purchaseObj->getApprovalDate(null);
			
			if( $approvalDate )
				echo date('d/m/Y', ($approvalDate+(3*86400)));
			else
				echo '3 dias úteis após pagamento'
		?>
		</div>
	<?php endif; ?>
	<div class="info"><label>Forma pagamento:</label><?php echo $purchaseObj->getPaymethod(true).$billetLink ?></div>
	<div class="info"><label>Transporte:</label>E-Sedex</div>
	<?php if( $tracingCode ): ?><div class="info"><label>Cód rastreamento:</label><?php echo link_to($tracingCode, "http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI=$tracingCode", array('target'=>'_blank')) ?></div><?php endif; ?>
	<div class="info"><label>Comprovante:</label>
	<?php
		$fileName = null;
		if( $fileId )
			$fileName = $purchaseObj->getFile()->getFileName();
		
		echo link_to(truncate_text($fileName, 30, '...', false, true), "#downloadPayTicket($orderNumber)", array('class'=>'pr20 '.($fileId?'':'hidden'), 'title'=>$fileName, 'id'=>'payTicketDownloadLink'));
		echo link_to(($fileId?'Reenviar':'Enviar'), "#uploadPayTicket()", array('id'=>'payTicketUploadLink'));
	?>
	</div>
	<script>
		function submitUploadFileForm(){
			
			$('uploadFileForm').target = 'uploadFileFrame';
			$('uploadFileForm').submit()
		}
	</script>
	<?php
		echo form_remote_tag(array(
			'url'=>'store/uploadFile',
			'encoding'=>'utf8',
			), array('id'=>'uploadFileForm', 'enctype'=>'multipart/form-data'));
			
		echo input_hidden_tag('purchaseId', $purchaseObj->getId());
	?>
	<div id="storePurchaseFileUploadDiv">
		<span class="fileName" id="fileNameLabel">&nbsp;</span>
		<span class="cabinet"><?php echo input_file_tag('filePath', array('onchange'=>'updateFileNameLabel(this.value); submitUploadFileForm()', 'class'=>'file')); ?></span>
		<?php echo button_tag('submitForm', 'ENVIAR', array('onclick'=>'submitUploadFileForm()', 'style'=>'position: relative; left: 10px')) ?>
		<div class="clear"></div>
		<div class="pt10">
			Selecione um arquivo do tipo JPG, PNG ou PDF com até 2Mb
		</div>
	</div>
	
	<iframe border="0" id="uploadFileFrame" name="uploadFileFrame" class="hidden" src="" width="00" height="0" scrolling="no" frameborder="0"></iframe>
</div>

<div class="shippingInfo">
	<h1>Endereço de entrega</h1>
	<?php
		$customerName      = $purchaseObj->getCustomerName();
		$addressName       = $purchaseObj->getAddressName();
		$addressNumber     = $purchaseObj->getAddressNumber();
		$addressComplement = $purchaseObj->getAddressComplement();
		$addressComplement = ($addressComplement?' '.$addressComplement:'');
		$addressQuarter    = $purchaseObj->getAddressQuarter();
		$addressCity       = $purchaseObj->getAddressCity();
		$addressState      = $purchaseObj->getAddressState();
		$addressZipcode    = $purchaseObj->getAddressZipcode();
		
		echo "<b>$customerName</b><div class=\"mt5\"></div>$addressName, $addressNumber{$addressComplement}<br/>$addressQuarter<br>$addressCity, $addressState<br/>CEP: $addressZipcode";
	?>
</div>
<div class="clear"></div>
<script type="text/javascript" language="javascript">
	SI.Files.stylizeAll();
</script>