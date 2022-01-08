<div class="storeOfferHome">
	<div class="header">
		<a href="<?php echo url_for('store/index') ?>">
			<div class="image"><?php echo image_tag('home/store') ?></div>
			<h1>Oferta iRank Store</h1>
		</a>
	</div>
	<div class="clear"></div>
	
	<?php
		$criteria = new Criteria();
//		$criteria->add( ProductPeer::PRODUCT_CODE, array('IRKTS-005', 'IRKBL-005'), Criteria::IN );
		$criteria->add( ProductPeer::ENABLED, true );
		$criteria->add( ProductPeer::VISIBLE, true );
		$criteria->add( ProductPeer::DELETED, false );
		$criteria->addAscendingOrderByColumn('RANDOM()');
		$criteria->setLimit(1);
		$productObjList = ProductPeer::search($criteria);
		
		foreach($productObjList as $key=>$productObj):
			
			$productId    = $productObj->getId();
			$productCode  = $productObj->getProductCode();
			$productName  = $productObj->getProductName();
			$isNew        = $productObj->getIsNew();
			$defaultPrice = $productObj->getDefaultPrice();
	?>
		<div class="product">
			<?php echo link_to(image_tag($productObj->getImageCover(''), array('class'=>'productImage')), "store/details?$productCode="); ?>
			<div class="infoBar"></div>
			<div class="name"><?php echo link_to(truncate_text($productName, 40), "store/details?$productCode=") ?></div>
			<div class="size"><b>Tam:</b> <?php echo $productObj->getSizeList() ?></div>
			<div class="prize">R$ <?php echo Util::formatFloat($defaultPrice, true) ?></div>
			<div class="clear"></div>
		</div>
	<?php endforeach; ?>
	<div class="clear"></div>
</div>