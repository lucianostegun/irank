<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja'=>'store/index', 'Camiseta I\'m all in'=>null)));
	include_partial('store/include/cart');
?>
	<div class="productDetail">
		<?php echo image_tag('temp/tshirt1Full.jpg', array('class'=>'productImage')) ?>
		<div class="extraImageList">
			<?php echo image_tag('temp/tshirt1.jpg', array('class'=>'productImage extra')) ?>
			<?php echo image_tag('temp/tshirt2.jpg', array('class'=>'productImage extra')) ?>
			<?php echo image_tag('temp/tshirt3.jpg', array('class'=>'productImage extra')) ?>
			<?php echo image_tag('temp/tshirt4.jpg', array('class'=>'productImage extra')) ?>
			<?php echo image_tag('temp/tshirt5.jpg', array('class'=>'productImage extra')) ?>
		</div>
		
		<span class="tshirt name">Camiseta: I'm bluffing / I'm All In</span>
		<span class="tshirt size"><b>Tamanhos:</b> M/G/GG</span>
		<span class="tshirt color"><b>Cores:</b> Preta/Branca</span>
		<span class="tshirt description">
			Camiseta <b>iRank</b> 100% algodão com estampa termocolante com o texto "I'M NOT CALLING CAUSE I'M BLUFFING" com a mensagem "<b>I'M ALL IN</b>" sutilmente escondida no meio da frase.</span>
		<span class="tshirt prizeLabel">Vl. unit.</span>
		<span class="tshirt prize">R$ 39,90</span>
		<?php echo link_to(image_tag('store/buy', array('class'=>'buyButton')), 'store/cart'); ?>
	</div>

<div class="clear"></div>

<?php
	include_partial('store/include/paymethods');
	include_partial('store/include/offer');
?>