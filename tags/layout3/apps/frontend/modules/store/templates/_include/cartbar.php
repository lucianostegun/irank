<div class="cartBar">
	<?php
		echo button_tag('storeCart', 'Continuar comprando', array('onclick'=>'goToPage("store", "index")'));
		
		if( !$emptyCart )
			echo button_tag('storeFinish', 'Finalizar compra', array('onclick'=>'goToPage("store", "payment")', 'image'=>'ok.png', 'class'=>'finishOrderButton'));
	?>
	<div class="clear"></div>
</div>