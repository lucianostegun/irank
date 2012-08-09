<?php
	sfContext::getInstance()->getResponse()->addStylesheet('quickLogin');
	sfContext::getInstance()->getResponse()->addJavascript('quickLogin');
	
	$cartSession    = $sf_user->getAttribute('iRankStoreCartSession');
  	$cartSessionObj = base64_decode($cartSession);
  	$cartSessionObj = unserialize($cartSessionObj);
  	
  	$products = $cartSessionObj->products;
  	
  	if( $products==0 )
  		if( !UserSite::isAuthenticated() )
  			return include_partial('login/include/login', array());
  		
  	$totalValue    = $cartSessionObj->totalValue;
  	$shippingValue = $cartSessionObj->shippingValue;
  	$discountValue = $cartSessionObj->discountValue;
  	$orderValue    = $cartSessionObj->orderValue;
  	
  	$discountValue *= -1;
?>
<div class="cartResume">
	<div class="cartIcon"><?php echo image_tag('store/basket') ?></div>
	<?php echo button_tag('storeCart', 'Meu carrinho', array('onclick'=>'goToPage("store", "cart")', 'style'=>'float: right; top: -2px; right: -4px')) ?>
	<div class="clear"></div>
</div>
<div class="cartInfo">
	Você possui <b><?php echo $products ?></b> <?php echo ($products==1?'item':'itens') ?> em seu carrinho.
	<div class="clear mt5"></div>
	<label>Subtotal:</label>R$ <span id="storeCartSideBarOrderValue"><?php echo Util::formatFloat($orderValue, true) ?></span><br/>
	<label>Frete:</label>R$ <span id="storeCartSideBarShippingValue"><?php echo Util::formatFloat($shippingValue, true) ?></span><br/>
	<label>Desconto:</label>R$ <span id="storeCartSideBarDiscountValue"><?php echo Util::formatFloat($discountValue, true) ?></span><br/>
	<label>Total:</label>R$ <span id="storeCartSideBarTotalValue"><?php echo Util::formatFloat($totalValue, true) ?></span>
</div>
<div class="clear"></div>