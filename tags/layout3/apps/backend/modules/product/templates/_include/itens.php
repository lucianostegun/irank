	<table cellpadding="0" cellspacing="0" width="100%" class="display dTableCustom" id="productItemTable">
	    <thead>
			<tr>
				<th></th>
				<th>Cor</th>
				<th>Tamanho</th>
				<th>Valor</th>
				<th>Peso</th>
				<th>Imagens</th>
				<th>Estoque</th>
			</tr> 
		</thead> 
		<tbody id="productItemTbody"> 
			<?php
				$productId = $productObj->getId();
				
				$criteria = new Criteria();
				$criteria->add( ProductItemPeer::PRODUCT_ID, $productId );
				
				$criteria->addJoin( ProductItemPeer::PRODUCT_OPTION_ID_COLOR, ProductOptionPeer::ID, Criteria::INNER_JOIN );
				$criteria->addJoin( ProductItemPeer::PRODUCT_OPTION_ID_SIZE, 'product_option_size.ID', Criteria::INNER_JOIN );
				
				$criteria->addAscendingOrderByColumn( ProductOptionPeer::OPTION_NAME );
				$criteria->addAscendingOrderByColumn( 'product_option_size.DESCRIPTION' );
				
				$criteria->addAlias( 'product_option_size', 'product_option' );
				
				foreach(ProductItem::getList($criteria) as $productItemObj):
					
					$productItemId  = $productItemObj->getId();
					$onclick = 'loadProductItem('.$productItemId.')"';
			?>
			<tr class="gradeA higher" id="productItemIdRow-<?php echo $productItemId ?>">
				<td onclick="<?php echo $onclick ?>" class="textC" width="40"><?php echo image_tag($productItemObj->getImageCover('thumb')) ?></td> 
				<td onclick="<?php echo $onclick ?>" class="textL"><?php echo $productItemObj->getProductOptionColor()->getOptionName() ?></td> 
				<td onclick="<?php echo $onclick ?>" class="textL"><?php echo $productItemObj->getProductOptionSize()->getDescription() ?></td> 
				<td onclick="<?php echo $onclick ?>" class="textR" width="80">R$ <?php echo Util::formatFloat($productItemObj->getPrice(), true) ?></td> 
				<td onclick="<?php echo $onclick ?>" class="textR" width="50"><?php echo $productItemObj->getWeight() ?> gr</td> 
				<td onclick="<?php echo $onclick ?>" class="textR" width="40"><?php echo $productItemObj->getImages() ?></td> 
				<td onclick="<?php echo $onclick ?>" class="textR" width="40"><?php echo $productItemObj->getStock() ?></td> 
			</tr> 
			<?php
				endforeach;
			?>
			</tbody> 
	</table>