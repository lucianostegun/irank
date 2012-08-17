<?php
	MyTools::addStylesheet('storeBar');
?>
<div class="storeOfferBar">
	<h1><?php echo link_to('iRank Store', 'store/index') ?></h1>
	<hr/>
	<?php
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn('RANDOM()');
		$criteria->setLimit(3);
		$productObjList = ProductPeer::search($criteria);
		
		foreach($productObjList as $productObj):
			
			$productId    = $productObj->getId();
			$productCode  = $productObj->getProductCode();
			$productName  = $productObj->getProductName();
			$isNew        = $productObj->getIsNew();
			$defaultPrice = $productObj->getDefaultPrice();
			$distinct     = ($isNew?'new':'');
	?>
		<div class="product">
			<?php
				echo link_to(image_tag($productObj->getImageCover('preview'), array('class'=>'productImage')), "store/details?$productCode=");
				
//				if( $distinct )
					echo image_tag('store/'.$distinct, array('class'=>'distinct '.$distinct));
			?>
			<div class="clear"></div>
			<div class="name"><?php echo link_to($productName, "store/details?$productCode=") ?></div>
			<div class="size"><b>Tam:</b> <?php echo $productObj->getSizeList() ?></div>
			<div class="prize">R$ <?php echo Util::formatFloat($defaultPrice, true) ?></div>
			<div class="clear"></div>
		</div>
	<?php endforeach; ?>
	<div class="clear"></div>
</div>