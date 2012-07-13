<?php
	$cartSession    = $sf_user->getAttribute('iRankStoreCartSession');
  	$cartSessionObj = base64_decode($cartSession);
  	$cartSessionObj = unserialize($cartSessionObj);
  	
  	$products   = $cartSessionObj->products;
  	$totalValue = $cartSessionObj->totalValue;
?>
<div class="cartBar">
	<div class="cartIcon"><?php echo image_tag('store/cart') ?></div>
	<?php echo button_tag('storeCart', 'Meu carrinho', array('onclick'=>'goToPage("store", "cart")', 'style'=>'margin-left: 35px')) ?>
	<div class="cartInfo">
	Você possui <b><?php echo $products ?></b> <?php echo ($products==1?'item':'itens') ?> em seu <u><b><?php echo link_to('carrinho', 'store/cart') ?></b></u>.<br/>Total atual: <b>R$ <?php echo Util::formatFloat($totalValue, true) ?></b><br/>
	</div>
	<div class="clear"></div>
</div>