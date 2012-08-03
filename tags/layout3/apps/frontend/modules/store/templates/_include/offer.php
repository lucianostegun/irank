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
	<div class="product">
		<?php
			echo link_to(image_tag($productObj->getImageCover('preview'), array('class'=>'productImage')), "store/details?$productCode=");
			
			if( $distinct )
				echo image_tag('store/'.$distinct, array('class'=>'distinct '.$distinct));
		?>
		<span class="tshirt name"><?php echo link_to($productName, "store/details?$productCode=") ?></span>
		<span class="tshirt size"><b>Tam:</b> <?php #echo $productObj->getSizeList() ?></span>
		<span class="tshirt prize">R$ <?php echo Util::formatFloat($defaultPrice, true) ?></span>
	</div>
<?php endforeach; ?>
<div class="clear"></div>