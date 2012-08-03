<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Carrinho'=>'store/cart', 'Pagamento'=>'store/payment', 'Confirmação'=>null)));
	
	$productItemList = $cartSessionObj->productItemList;
	
	$peopleObj         = People::getCurrentPeople();
	$addressState      = $cartSessionObj->addressState;
    $addressCity       = $cartSessionObj->addressCity;
    $addressQuarter    = $cartSessionObj->addressQuarter;
    $addressName       = $cartSessionObj->addressName;
    $addressNumber     = $cartSessionObj->addressNumber;
    $addressComplement = $cartSessionObj->addressComplement;
    $addressZipcode    = $cartSessionObj->zipcode;
?>
	<div class="storeCartResume">
	
		<h3>Nome/Endereço</h3>
		<div class="ml30 mt15 textB customerAddress"><?php echo $peopleObj->getName() ?></div>
		<div class="ml30 mt5 customerAddress">
			<?php
				$addressComplement = ($addressComplement?' '.$addressComplement:'');
				echo "$addressName, $addressNumber{$addressComplement}<br/>$addressQuarter<br>$addressCity, $addressState<br/>$addressZipcode";
			?>
		</div>
		
		
		
		<h3 class="mt30">Resumo do pedido</h3>
		
		<table border="0" cellspacing="0" cellpadding="0" class="store cart resume">
		  <tr class="header">
		    <th colspan="2" class="first">Produto</th>
		    <th width="70">Qtd</th>
		    <th width="70">Vl. unit.</th>
		    <th width="80">Vl. total</th>
		  </tr>
		  <?php
		  	$shippingValue   = $cartSessionObj->shippingValue;
		  	$zipcode         = $cartSessionObj->zipcode;
		  	$totalOrderValue = $shippingValue;
		  	
		  	$class = ((count($productItemList)%2==0)?'odd':'even');
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
				
				$class = ($class=='even'?'odd':'even');
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
		
		
		
		
	
		<h3 class="mt30">Forma de pagamento</h3>
		<div class="pl30 mb10 mt20">
			<?php if( $cartSessionObj->paymethod=='billet' ): ?><label for="paymethodBillet"><?php echo image_tag('store/boleto', array('class'=>'mr10', 'align'=>'absmiddle')) ?> Boleto bancário</label><?php endif; ?>
			<?php if( $cartSessionObj->paymethod=='pagseguro' ): ?><label for="paymethodPagseguro"><?php echo image_tag('store/pagseguro', array('class'=>'mr10', 'align'=>'absmiddle')) ?> Pagseguro</label><?php endif; ?>
		</div>
		<div class="separator mb15"></div>
		
		<?php echo link_to(image_tag('store/back', array('class'=>'ml20')), 'store/payment') ?>
		<?php echo link_to(image_tag('store/finish', array('class'=>'ml10')), '#confirmOrder()') ?>
	</div>

<div class="clear mt200"></div>