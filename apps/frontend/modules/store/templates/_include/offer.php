<h3>Compre também</h3>
<?php
	$productObjList = ProductPeer::search();
	
	foreach($productObjList as $productObj):
		
		$productId    = $productObj->getId();
		$productCode  = $productObj->getProductCode();
		$productName  = $productObj->getProductName();
		$isNew        = $productObj->getIsNew();
		$defaultPrice = $productObj->getDefaultPrice();
		$distinct     = ($isNew?'new':'');
?>
	<a href="<?php echo url_for("/store/details?$productCode=") ?>">
		<div class="product">
			<?php
				echo image_tag($productObj->getImageCover(''), array('class'=>'productImage'));
				
				if( $distinct )
					echo image_tag('store/'.$distinct, array('class'=>'distinct '.$distinct));
			?>
			<div class="infoBar"></div>
			<span class="productName"><?php echo $productName ?></span>
			<span class="tshirt size"><b>Tam:</b> <?php echo $productObj->getSizeList() ?></span>
			<span class="tshirt prize">R$ <?php echo Util::formatFloat($defaultPrice, true) ?></span>
		</div>
	</a>
<?php endforeach; ?>
<div class="clear"></div>