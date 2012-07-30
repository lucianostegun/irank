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
	
	echo form_tag('store/addItem', array('id'=>'storeProductForm'));
	echo input_hidden_tag('productCode', $productCode);
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
		<div class="productInfo">
			<h1 class="tshirt name"><?php echo "$categoryShortName: $productName" ?></h1>
			<span class="tshirt description"><?php echo $productObj->getDescription() ?></span>
			
			<span class="tshirt prizeLabel">Valor unit.</span>
			<span class="tshirt prize">R$ <?php echo Util::formatFloat($defaultPrice, true) ?></span>
			
			<div class="productOptions">
				<div class="productOption">
					<label>Quantidade:</label> <?php echo input_tag('quantity', 1, array('size'=>2, 'maxlength'=>2)) ?> 
				</div>
				<div class="productOption color" id="productOptionColors">
					<label>Cor:</label>
					<?php
						$productOptionIdColor = null;
						$productOptionList    = ProductOption::getList(null, 'color', $productObj->getId());
						foreach($productOptionList as $key=>$productOptionObj){
							
							$productOptionId = $productOptionObj->getId();
							$isDefault       = $productOptionObj->getIsDefault();
							
							if( $isDefault || (!$productOptionIdColor && $key==count($productOptionList)-1)){
								
								$productOptionIdColor = $productOptionObj->getId();
								$isDefault            = true;
							}
							
							echo '<div class="productOptionOption color '.($isDefault?'selected':'').'" onclick="selectProductOption(\'color\', '.$productOptionId.')" id="productOptionColor-'.$productOptionId.'">';
							echo '	<div class="color" style="background: '.$productOptionObj->getDescription().'"></div>';
							echo '</div>';
						}
						
						echo input_hidden_tag('productOptionIdColor', $productOptionIdColor); 
					?>
				</div>

				<div class="productOption" id="productOptionSizes">
					<label>Tamanho:</label>
					<?php
						$productOptionIdSize = null;
						$productOptionList   = ProductOption::getList(null, 'size', $productObj->getId());
						
						foreach($productOptionList as $key=>$productOptionObj){
							
							$productOptionId = $productOptionObj->getId();
							$isDefault       = $productOptionObj->getIsDefault();
							
							if( $isDefault || (!$productOptionIdSize && $key==count($productOptionList)-1) ){
								
								$productOptionIdSize = $productOptionObj->getId();
								$isDefault           = true;  
							}
							
							echo '<div class="productOptionOption size '.($isDefault?'selected':'').'" onclick="selectProductOption(\'size\', '.$productOptionId.')" id="productOptionSize-'.$productOptionId.'">';
							echo $productOptionObj->getOptionName();
							echo '</div>';
						}
						
						echo input_hidden_tag('productOptionIdSize', $productOptionIdSize);

						if( $tagName=='tshirt' )
							echo link_to(image_tag('icon/help'), '#showTshirtSizeHelp()', array('class'=>'sizeHelpButton', 'title'=>'Consulte a tabela de medidas de cada tamanho')); ?>
				</div>
			</div>
			
			<?php
				echo link_to(image_tag('store/buy', array('class'=>'buyButton')), '#addProductToCart()');
				echo link_to(image_tag('store/favorite').'Adicionar aos favoritos', '#addProductToBookmarks()', array('class'=>'favoriteButton'));
			?>
		</div>
	</div>
</form>
<div class="clear"></div>

<?php
	include_partial('store/include/paymethods');
	include_partial('store/include/offer');
?>