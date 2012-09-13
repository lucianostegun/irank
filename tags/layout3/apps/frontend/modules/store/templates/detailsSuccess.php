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
	$unavailable        = !$productObj->getStock();
	
	sfContext::getInstance()->getResponse()->setTitle('iRank Store :: '.$productObj->toString());
	
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', $categoryName=>"store?category=$tagName", $shortName=>null)));
	
	echo form_tag('store/addItem', array('id'=>'storeProductForm'));
	echo input_hidden_tag('productCode', $productCode);
?>
	<div class="productDetail">
	<?php echo link_to(image_tag('store/discount'), 'home', array()); ?><br/><br/>
				
		<div class="productImages">
			<a href="/images/<?php echo $productObj->getImageCover('full') ?>" rel="lightbox-product" id="productImageZoom"><?php echo image_tag($productObj->getImageCover(true), array('id'=>'productImagePreview', 'class'=>'productImage')) ?></a>
			<div id="gallery" class="extraImageList gallery">
				<?php
					for($imageIndex=1; $imageIndex <= 5; $imageIndex++){
						
						$function = "getImage$imageIndex";
						$fileName = $productObj->$function();
						if( is_null($fileName) )
							continue;
						
						echo '<a href="/images/store/product/full/'.$fileName.'" rel="lightbox-product">'.image_tag("store/product/thumb/$fileName", array('class'=>'productImage extra')).'</a>';
					}
				?>
			</div>
			<div class="clear"></div>
			<!-- AddThis Button BEGIN -->
			<div class="share addthis_default_style">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet" style="position: relative; left: -10px"></a>
				<a class="addthis_counter addthis_pill_style" style="position: absolute; margin-left: 182px"></a>
			</div>
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-501b327e1cbc0097"></script>
			<!-- AddThis Button END -->
		</div>
		<div class="productInfo">
			<h1 class="name"><?php echo "$categoryShortName: $productName" ?></h1>

			<div class="mt10"></div>
			<span class="label availability">Disponibilidade:</span>
			<span class="value availability <?php echo ($unavailable?'unavailable':'available') ?>"><?php echo ($unavailable?'Produto indisponível':'Em estoque') ?></span>
			
			<span class="label price">Valor unit.</span>
			<span class="value price">R$ <?php echo Util::formatFloat($defaultPrice, true) ?></span>
			<div class="clear"></div>

			<div class="productOptions">
				<div class="productOption">
					<label>Qtd.:</label> <?php echo input_tag('quantity', 1, array('size'=>2, 'maxlength'=>2)) ?> 
				</div>
				<div class="productOption color" id="productOptionColors">
					<label>Cor:</label>
					<?php
						$productOptionList = ProductOption::getList(null, 'color', $productObj->getId());
						foreach($productOptionList as $key=>$productOptionObj){
							
							$productOptionId = $productOptionObj->getId();
							
							echo '<div class="productOptionOption color" onclick="selectProductOption(\'color\', '.$productOptionId.')" id="productOptionColor-'.$productOptionId.'">';
							echo '	<div class="color" style="background: '.$productOptionObj->getDescription().'"></div>';
							echo '</div>';
						}
						
						echo input_hidden_tag('productOptionIdColor', null); 
					?>
				</div>

				<div class="productOption" id="productOptionSizes">
					<label>Tam.:</label>
					<?php
						$productOptionList = ProductOption::getList(null, 'size', $productObj->getId());
						
						foreach($productOptionList as $key=>$productOptionObj){
							
							$productOptionId = $productOptionObj->getId();
							
							echo '<div class="productOptionOption size disabled" onclick="selectProductOption(\'size\', '.$productOptionId.')" id="productOptionSize-'.$productOptionId.'">';
							echo $productOptionObj->getOptionName();
							echo '</div>';
						}
						
						echo input_hidden_tag('productOptionIdSize', null);

						if( $tagName=='tshirt' )
							echo link_to(image_tag('icon/help'), '#showTshirtSizeHelp()', array('class'=>'sizeHelpButton', 'title'=>'Consulte a tabela de medidas de cada tamanho')); ?>
				</div>
			</div>
			<div class="buttons">
				<?php echo link_to(image_tag('store/buy', array('class'=>'buyButton')), '#addProductToCart()'); ?><br/>
				<?php echo link_to(image_tag('store/bookmark').'Adicionar aos favoritos', '#addProductToBookmarks()', array('class'=>'bookmarkButton')); ?>
			</div>
			<div class="clear"></div>

			<span class="description">
				<?php echo $productObj->getDescription() ?>
			</span>
			
		</div>
		<div class="clear"></div>
	</div>
</form>

<?php
	include_partial('store/include/offer');
	include_partial('store/include/paymethods');
?>