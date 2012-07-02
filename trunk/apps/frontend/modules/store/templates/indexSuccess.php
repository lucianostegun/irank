<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index')));
	include_partial('store/include/cart');
?>
	<div class="product">
		<?php echo link_to(image_tag('temp/tshirt1.jpg', array('class'=>'productImage')), 'store/details') ?>
		<?php echo image_tag('store/new', array('class'=>'distinct new')) ?>
		<span class="tshirt name"><?php echo link_to('I\'m bluffing / I\'m All In', 'store/details') ?></span>
		<span class="tshirt size"><b>Tam:</b> M/G/GG</span>
		<span class="tshirt prize"><?php echo link_to('R$ 39,90', 'store/details') ?></span>
	</div>
	<div class="product">
		<?php echo image_tag('temp/dealer1.jpg', array('class'=>'productImage')) ?>
		<?php echo image_tag('store/new', array('class'=>'distinct new')) ?>
		<span class="tshirt name">Dealer iRank 3D</span>
		<span class="tshirt prize">R$ 19,50</span>
	</div>
	<div class="product">
		<?php echo image_tag('temp/tshirt2.jpg', array('class'=>'productImage')) ?>
		<?php echo image_tag('store/new', array('class'=>'distinct new')) ?>
		<span class="tshirt name">Four of a kind: Aces</span>
		<span class="tshirt size"><b>Tam:</b> M/G/GG</span>
		<span class="tshirt prize">R$ 39,90</span>
	</div>
	<div class="product">
		<?php echo image_tag('temp/tshirt3.jpg', array('class'=>'productImage')) ?>
		<span class="tshirt name">iRank red suit #1</span>
		<span class="tshirt size"><b>Tam:</b> M/G/GG</span>
		<span class="tshirt prize">R$ 39,90</span>
	</div>
	<div class="product">
		<?php echo image_tag('temp/tshirt4.jpg', array('class'=>'productImage')) ?>
		<span class="tshirt name">iRank red suit #2</span>
		<span class="tshirt size"><b>Tam:</b> M/G/GG</span>
		<span class="tshirt prize">R$ 39,90</span>
	</div>
	<div class="product">
		<?php echo image_tag('temp/tshirt6.jpg', array('class'=>'productImage')) ?>
		<span class="tshirt name">I Love Poker</span>
		<span class="tshirt size"><b>Tam:</b> M/G/GG</span>
		<span class="tshirt prize">R$ 39,90</span>
	</div>
<div class="clear"></div>