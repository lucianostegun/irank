<div class="cartBar">
	<div class="cartIcon"><?php echo image_tag('store/cart') ?></div>
	<?php
		echo button_tag('storeCart', 'Continuar comprando', array('onclick'=>'goToPage("store", "index")', 'style'=>'margin-left: 35px'));
		
		if( !$emptyCart )
			echo button_tag('storeFinish', 'Finalizar compra', array('onclick'=>'goToPage("store", "payment")', 'image'=>'ok.png', 'class'=>'finishOrderButton'));
	?>
	<div class="clear"></div>
</div>