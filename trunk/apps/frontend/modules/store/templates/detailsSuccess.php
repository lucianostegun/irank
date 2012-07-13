<?php
	Util::lightbox();
	
	$productCategoryObj = $productObj->getProductCategory();
	$categoryName       = $productCategoryObj->getCategoryName();
	$categoryShortName  = $productCategoryObj->getShortName();
	$tagName            = $productCategoryObj->getTagName();
	$productName        = $productObj->getProductName();
	$productCode        = $productObj->getProductCode();
	$shortName          = $productObj->getShortName();
	$defaultPrice       = $productObj->getDefaultPrice();
	
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', $categoryName=>"store?category=$tagName", $shortName=>null)));
	include_partial('store/include/cart');
?>
	<div class="productDetail">
		<a href="/images/<?php echo $productObj->getImageCover('full') ?>" rel="lightbox" id="productImageZoom"><?php echo image_tag($productObj->getImageCover(true), array('id'=>'productImagePreview', 'class'=>'productImage')) ?></a>
		<div class="extraImageList">
			<?php
				for($imageIndex=1; $imageIndex <= 5; $imageIndex++){
					
					$function = "getImage$imageIndex";
					$fileName = $productObj->$function();
					if( is_null($fileName) )
						continue;
					
					echo link_to(image_tag("store/product/thumb/$fileName", array('class'=>'productImage extra')), '#loadProductPreview("'.$fileName.'")');
				}
			?>
		</div>
		
		<span class="tshirt name"><?php echo "$categoryShortName: $productName" ?></span>
		<span class="tshirt size"><b>Tamanhos:</b> M/G/GG</span>
		<span class="tshirt color"><b>Cores:</b> Preta/Branca</span>
		<span class="tshirt description"><?php echo $productObj->getDescription() ?></span>
		<span class="tshirt prizeLabel">Vl. unit.</span>
		<span class="tshirt prize">R$ <?php echo Util::formatFloat($defaultPrice, true) ?></span>
		<?php echo link_to(image_tag('store/buy', array('class'=>'buyButton')), "store/addItem?$productCode="); ?>
	</div>

<div class="clear"></div>

<?php
	include_partial('store/include/paymethods');
	include_partial('store/include/offer');
?>