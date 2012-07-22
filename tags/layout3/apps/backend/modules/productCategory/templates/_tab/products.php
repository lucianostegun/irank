<div class="widget">
	<table cellpadding="0" cellspacing="0" width="100%" class="display dTable">
	    <thead>
			<tr>
				<th colspan="2">Cód</th>
				<th>Nome</th> 
				<th>Valor</th> 
				<th>Peso</th> 
				<th>Novo</th> 
				<th>Imagens</th> 
			</tr> 
		</thead> 
		<tbody id="productCategoryTbody"> 
			<?php
				$criteria = new Criteria();
				$criteria->add( ProductPeer::PRODUCT_CATEGORY_ID, $productCategoryId );
				foreach(Product::getList($criteria) as $productObj):
					
					$productId  = $productObj->getId();
					$onclick = 'goToPage(\'product\', \'edit\', \'productId\', '.$productId.', true)"';
			?>
			<tr class="gradeA higher" id="productIdRow-<?php echo $productId ?>">
				<td onclick="<?php echo $onclick ?>" class="textC" width="40"><?php echo image_tag($productObj->getImageCover('thumb')) ?></td> 
				<td onclick="<?php echo $onclick ?>" class="textR" width="40"><?php echo $productObj->getProductCode() ?></td> 
				<td onclick="<?php echo $onclick ?>"><?php echo $productObj->getProductName() ?></td> 
				<td onclick="<?php echo $onclick ?>" class="textR" width="60">R$ <?php echo Util::formatFloat($productObj->getDefaultPrice(), true) ?></td> 
				<td onclick="<?php echo $onclick ?>" class="textR" width="50"><?php echo $productObj->getDefaultWeight() ?> gr</td> 
				<td onclick="<?php echo $onclick ?>" class="textC" width="50"><?php echo $productObj->getIsNew()?'Sim':'Não' ?></td> 
				<td onclick="<?php echo $onclick ?>" class="textR" width="40"><?php echo $productObj->getImages() ?></td> 
			</tr> 
			<?php
				endforeach;
			?>
		</tbody>
	</table>
</div>