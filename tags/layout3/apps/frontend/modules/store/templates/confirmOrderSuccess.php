<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Carrinho'=>'store/cart', 'Pagamento'=>'store/payment', 'Confirmação'=>null)));
	
	$productItemList = $cartSessionObj->productItemList;
	
	$peopleObj         = People::getCurrentPeople();
	$addressState      = $peopleObj->getAddressState();
    $addressCity       = $peopleObj->getAddressCity();
    $addressQuarter    = $peopleObj->getAddressQuarter();
    $addressName       = $peopleObj->getAddressName();
    $addressNumber     = $peopleObj->getAddressNumber();
    $addressComplement = $peopleObj->getAddressComplement();
    $addressZipcode    = $peopleObj->getAddressZipcode();
?>
	<div class="storeCartResume">
	
		<h3>Nome/Endereço</h3>
		<div class="ml30 textB"><?php echo $peopleObj->getName() ?></div>
		<div class="ml30">
			<?php
				$addressComplement = ($addressComplement?' '.$addressComplement:'');
				echo "$addressName, $addressNumber{$addressComplement}<br/>$addressQuarter<br>$addressCity, $addressState<br/>$addressZipcode";
			?>
		</div>
		
		
		
		<h3 class="mt30">Resumo do pedido</h3>
		
		<table border="0" cellspacing="0" cellpadding="0" class="gridTable store cart" style="margin-top: 0px">
		  <tr class="header">
		    <th class="first">Produto</th>
		    <th width="70">Qtd</th>
		    <th width="100">Vl. unit.</th>
		    <th width="100">Vl. total</th>
		  </tr>
		  <?php
		  	$shippingValue   = $cartSessionObj->shippingValue;
		  	$zipcode         = $cartSessionObj->zipcode;
		  	$totalOrderValue = $shippingValue;
		  	
		  	foreach($productItemList as $productItemId=>$productItem):
		  	
		  		$productCode    = $productItem->code;
		  		$productObj     = ProductPeer::retrieveByCode($productCode);
		  		$productItemObj = ProductItemPeer::retrieveByPK($productItemId);
		  		
		  		if( !is_object($productItemObj) || !is_object($productObj) )
		  			continue;
		  		
		  		$productCategoryObj = $productObj->getProductCategory();
				$categoryShortName  = $productCategoryObj->getShortName();
				$productName        = $productObj->getProductName();
				$shortName          = $productObj->getShortName();
				
		  		$size     = $productItem->size;
		  		$color    = $productItem->color;
		  		$price    = $productItem->price;
		  		$quantity = $productItem->quantity;
				
				$totalValue       = $price*$quantity;
				$totalOrderValue += $totalValue;
		  ?>
		  <tr class="productItemRow" id="cartProductItem-<?php echo $productItemId ?>">
		    <td class="textL productName">
		    	<span><?php echo "$categoryShortName: $productName" ?></span>
		    	<div class="clear mt0"></div>
		    	<span class="productDetail resume"><b>Tamanho:</b> <?php echo $size ?></span>
		    	<span class="productDetail resume"><b>Cor:</b> <?php echo $color ?></span>
		    </td>
		    <td class="textC quantity"><?php echo $quantity ?></td>
		    <td class="textR productPrice">R$ <?php echo Util::formatFloat($price, true) ?></td>
		    <td class="textR totalValue" id="storeCartProductItemTotalValue-<?php echo $productItemId ?>">R$ <?php echo Util::formatFloat($price*$quantity, true) ?></td>
		  </tr>
		  <?php
		  	endforeach;
		  ?>
		  <tr class="footer shipping">
		    <th class="textC"></th>
		    <th class="textR pr10" colspan="2">FRETE</th>
		    <th class="textR" id="storeCartShippingValue">R$ <?php echo Util::formatFloat($shippingValue, true) ?></th>
		  </tr>
		  <tr class="footer shipping">
		    <th class="textC"></th>
		    <th class="textR pr10" colspan="2">TOTAL DO PEDIDO</th>
		    <th class="textR" id="storeCartTotalValue">R$ <?php echo Util::formatFloat($totalOrderValue, true) ?></th>
		  </tr>
		</table>
		
		
		
		
	
		<h3 class="mt30">Forma de pagamento</h3>
		<div class="ml30 mb20">
			<?php if( $cartSessionObj->paymethod=='billet' ): ?><label for="paymethodBillet"><?php echo image_tag('store/boleto', array('class'=>'mr10', 'align'=>'absmiddle')) ?> Boleto bancário</label><?php endif; ?>
			<?php if( $cartSessionObj->paymethod=='pagseguro' ): ?><label for="paymethodPagseguro"><?php echo image_tag('store/pagseguro', array('class'=>'mr10', 'align'=>'absmiddle')) ?> Pagseguro</label><?php endif; ?>
		</div>
		
		<?php echo link_to(image_tag('store/back', array('class'=>'ml20')), 'store/payment') ?>
		<?php echo link_to(image_tag('store/finish', array('class'=>'ml10')), '#confirmOrder()') ?>
	</div>

<div class="clear mt5"></div>