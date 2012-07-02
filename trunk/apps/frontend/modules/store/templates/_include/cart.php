<div class="cartBar">
	<div class="cartIcon"><?php echo image_tag('store/cart') ?></div>
	<?php echo button_tag('storeCart', 'Meu carrinho', array('onclick'=>'goToPage("store", "cart")', 'style'=>'margin-left: 35px')) ?>
	<div class="cartInfo">
	Você possui <b>3</b> itens em seu <u><b><?php echo link_to('carrinho', 'store/cart') ?></b></u>.<br/>Total atual: <b>R$ 119,70</b><br/>
	</div>
	<div class="clear"></div>
</div>