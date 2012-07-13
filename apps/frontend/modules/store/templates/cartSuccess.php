<?php
	Util::lightbox();
	
	$productList = $cartSessionObj->productList;
  	$emptyCart   = $cartSessionObj->products==0;
  	
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Carrinho'=>null)));
	include_partial('store/include/cartbar', array('emptyCart'=>$emptyCart));
?>
	<div class="storeCart">
	
		<table border="0" cellspacing="0" cellpadding="0" class="gridTable store cart">
		  <tr class="header">
		    <th colspan="2" class="first">Produto</th>
		    <th width="70">Qtd</th>
		    <th width="100">Vl. unit.</th>
		    <th width="100">Vl. total</th>
		    <th width="30"></th>
		  </tr>
		  <tr>
		    <td id="cartEmptyRow" class="emptyCart <?php echo ($emptyCart?'':' hidden') ?>" colspan="6">Você não possui nenhum produto em seu carrinho.</td>
		  </tr>
		  <?php
		  	$shippingValue   = $cartSessionObj->shippingValue;
		  	$zipcode         = $cartSessionObj->zipcode;
		  	$totalOrderValue = $shippingValue;
		  	
		  	foreach($productList as $productCode=>$product):
		  	
		  		$productObj  = ProductPeer::retrieveByCode($productCode);
		  		
		  		$productCategoryObj = $productObj->getProductCategory();
				$categoryShortName  = $productCategoryObj->getShortName();
				$tagName            = $productCategoryObj->getTagName();
				$productName        = $productObj->getProductName();
				$productCode        = $productObj->getProductCode();
				$shortName          = $productObj->getShortName();
				
				foreach($product->size as $size=>$productColor):
				
					foreach($productColor['color'] as $color=>$productInfo):
				
						$productItemId = $productInfo['id'];
						$price         = $productInfo['price'];
						$quantity      = $productInfo['quantity'];
						
						$totalValue       = $price*$quantity;
						$totalOrderValue += $totalValue;
		  ?>
		  <tr class="productItemRow" id="cartProductItem-<?php echo $productItemId ?>">
		    <td width="40" class="productImage"><?php echo image_tag($productObj->getImageCover('thumb')) ?></td>
		    <td class="textL productName">
		    	<span><?php echo "$categoryShortName: $productName" ?></span>
		    	<div class="clear mt5"></div>
		    	<span class="productDetail"><b>Tamanho:</b> <?php echo $size ?></span>
		    	<span class="productDetail"><b>Cor:</b> <?php echo $color ?></span>
		    </td>
		    <td class="textC quantity"><?php echo input_tag('quantity', $quantity, array('size'=>3)) ?></td>
		    <td class="textR productPrice">R$ <?php echo Util::formatFloat($price, true) ?></td>
		    <td class="textR totalValue">R$ <?php echo Util::formatFloat($price*$quantity, true) ?></td>
		    <td class="textC removeProduct"><?php echo link_to(image_tag('icon/delete'), '#removeProductFromCart("'.$productItemId.'")') ?></td>
		  </tr>
		  <?php
			  		endforeach;
		  		endforeach;
		  	endforeach;
		  	
		  	if( !$emptyCart ):
		  ?>
		  <tr class="footer shipping">
		    <th class="textR"></th>
		    <th class="textR pr10">Informe seu cep para calcular o valor do frete</th>
		    <th class="textC"><?php echo input_tag('zipcode', $zipcode, array('size'=>9, 'maxlength'=>9, 'class'=>'textC')) ?></th>
		    <th class="textC"><?php echo link_to('Calcular frete', '#doCalculateShipping()') ?></th>
		    <th class="textR" id="shippingValue">R$ <?php echo Util::formatFloat($shippingValue, true) ?></th>
		    <th></th>
		  </tr>
		  <?php endif; ?>
		  <tr class="footer shipping">
		    <th class="textR"></th>
		    <th class="textC"></th>
		    <th class="textR pr10" colspan="2">TOTAL DO PEDIDO</th>
		    <th class="textR" id="orderTotalValue">R$ <?php echo Util::formatFloat($totalOrderValue, true) ?></th>
		    <th></th>
		  </tr>
		</table>
	</div>

<div class="clear mt5 pt5" style="border-bottom: 10px solid #F0F0F0">
	<?php include_partial('store/include/cartbar', array('emptyCart'=>$emptyCart)); ?>
</div>

<div class="clear mt5"></div>

<?php include_partial('store/include/offer'); ?>