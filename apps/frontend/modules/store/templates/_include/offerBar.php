<?php
	MyTools::addStylesheet('storeBar');
?>
<div id="storeOfferBar">
	<div class="header">
		<a href="<?php echo url_for('store/index') ?>">
			<div class="image"><?php echo image_tag('store/icon') ?></div>
			<h1>iRank Store</h1>
		</a>
	</div>
	<?php
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn('RANDOM()');
		$criteria->setLimit(2);
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
<script>

function fixStoreBar(){

	if( window.scrollY >= 990 ){
	
		if( !$('storeOfferBar').hasClassName('fixed') ){
			
			$('storeOfferBar').style.position = 'fixed';
			$('storeOfferBar').addClassName('fixed');	
			$('storeOfferBar').style.top      = '0px';
		}
	}else{
		
		$('storeOfferBar').style.position = 'relative';
		$('storeOfferBar').style.top      = '0px';
		$('storeOfferBar').removeClassName('fixed');
	}
}

window.addEventListener('scroll', fixStoreBar, false);
</script>