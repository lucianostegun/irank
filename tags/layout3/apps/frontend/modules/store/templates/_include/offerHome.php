<div class="storeOfferHome">
	<div class="image"><?php echo image_tag('home/store') ?></div>
		<h1>iRank Store</h1>
	<div class="clear"></div>
	
	<?php
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn('RANDOM()');
		$criteria->setLimit(1);
		$productObjList = ProductPeer::search($criteria);
		
		foreach($productObjList as $productObj):
			
			$productId    = $productObj->getId();
			$productCode  = $productObj->getProductCode();
			$productName  = $productObj->getProductName();
			$isNew        = $productObj->getIsNew();
			$defaultPrice = $productObj->getDefaultPrice();
	?>
		<div class="product">
			<?php
				echo link_to(image_tag($productObj->getImageCover('preview'), array('class'=>'productImage')), "store/details?$productCode=");
			?>
			<div class="clear"></div>
			<div class="name"><?php echo link_to(truncate_text($productName, 27), "store/details?$productCode=") ?></div>
			<div class="size"><b>Tam:</b> <?php echo $productObj->getSizeList() ?></div>
			<div class="prize">R$ <?php echo Util::formatFloat($defaultPrice, true) ?></div>
			<div class="clear"></div>
		</div>
	<?php endforeach; ?>
	<div class="clear"></div>
</div>