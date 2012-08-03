<?php
	$pathList = array('Loja virtual'=>'store/index');
	
	if( $category ){
		
		$productCategoryObj = ProductCategoryPeer::retrieveByTagName($category);
		if( is_object($productCategoryObj) )
			$pathList[$productCategoryObj->getCategoryName()] = 'store?category='.$category;
	}
	
	include_partial('home/component/commonBar', array('pathList'=>$pathList));
?>
<div class="moduleIntro">
	<?php echo image_tag('store/logo', array('align'=>'left', 'style'=>'margin-right: 10px')) ?>
	Seja bem-vindo à <b>iRank Store</b>, a nova loja virtual que traz a você<br/>uma nova linha de produtos originais de alta qualidade voltados ao mundo do Poker.<br/>
	Clique, conheça nossos produtos e acompanhe os lançamentos dos novos modelos de camisetas e acessórios.
</div>
<div class="clear"></div>
<?php
	$criteria = new Criteria();
	if( $category ) $criteria->add( ProductCategoryPeer::TAG_NAME, $category );
	
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
			
			if( $distinct )
				echo image_tag('store/new', array('class'=>'distinct '.$distinct))
		?>
		<span class="tshirt name"><?php echo link_to($productName, "store/details?$productCode=") ?></span>
		<span class="tshirt size"><b>Tam:</b> <?php #echo $productObj->getSizeList() ?></span>
		<span class="tshirt prize">R$ <?php echo Util::formatFloat($defaultPrice, true) ?></span>
	</div>
<?php endforeach; ?>

<div class="clear mt50">&nbsp;</div>

<?php
	include_partial('store/include/paymethods');
?>