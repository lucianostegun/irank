<?php
	$pathList = array('Loja virtual'=>'store/index');
	
	if( $category ){
		
		$productCategoryObj = ProductCategoryPeer::retrieveByTagName($category);
		if( is_object($productCategoryObj) )
			$pathList[$productCategoryObj->getCategoryName()] = 'store?category='.$category;
	}
	
	include_partial('home/component/commonBar', array('pathList'=>$pathList));
?>
<?php echo image_tag('store', array('class'=>'logo')) ?>
<div class="moduleIntro image">
	Seja bem-vindo à <b>iRank Store</b>, a nova loja virtual que traz a você uma nova linha de produtos originais<br/>de alta qualidade voltados ao mundo do Poker.<br/><br/>
	Clique, conheça nossos produtos e acompanhe os lançamentos dos novos modelos de camisetas e acessórios.
</div>
<hr class="separator"/>

<?php #include_partial('store/include/highlight') ?>

<div class="clear"></div>
<?php
	$criteria = new Criteria();
	if( $category ) $criteria->add( ProductCategoryPeer::TAG_NAME, $category );
	
	$productObjList = ProductPeer::search($criteria);
	
	foreach($productObjList as $key=>$productObj):
		
		$productId    = $productObj->getId();
		$productCode  = $productObj->getProductCode();
		$productName  = $productObj->getProductName();
		$isNew        = $productObj->getIsNew();
		$defaultPrice = $productObj->getDefaultPrice();
		$distinct     = ($isNew?'new':'');
		
		if( $key > 0 && $key%3==0 )
			echo '<div class="productSeparator"><hr/></div>';
?>
	<a href="<?php echo url_for("/store/details?$productCode=") ?>">
		<div class="product">
			<?php
				echo image_tag($productObj->getImageCover(''), array('class'=>'productImage'));
				
				if( $distinct )
					echo image_tag('store/new', array('class'=>'distinct '.$distinct))
			?>
			<div class="infoBar"></div>
			<span class="productName"><?php echo $productName ?></span>
			<span class="tshirt size"><b>Tam:</b> <?php echo $productObj->getSizeList() ?></span>
			<span class="tshirt prize">R$ <?php echo Util::formatFloat($defaultPrice, true) ?></span>
		</div>
	</a>
<?php
	endforeach;
?>

<div class="clear mt50">&nbsp;</div>

<?php
	include_partial('store/include/paymethods');
?>