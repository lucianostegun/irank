<div class="wrapper">
    <div class="widget">
		<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Produtos</h6></div>                          
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
		    <thead>
				<tr>
					<th colspan="2">Cód</th>
					<th>Nome</th>
					<th>Categoria</th>
					<th>Valor</th>
					<th>Peso</th>
					<th>Novo</th>
					<th>Imagens</th>
					<th>Estoque</th>
				</tr> 
			</thead> 
			<tbody id="productTbody"> 
				<?php
					$criteria = new Criteria();
					foreach(Product::getList($criteria) as $productObj):
						
						$productId  = $productObj->getId();
						$onclick = 'goToPage(\'product\', \'edit\', \'productId\', '.$productId.', true)"';
				?>
				<tr class="gradeA higher" id="productIdRow-<?php echo $productId ?>">
					<td onclick="<?php echo $onclick ?>" class="textC" width="40"><?php echo image_tag($productObj->getImageCover('thumb')) ?></td> 
					<td onclick="<?php echo $onclick ?>" class="textR" width="40"><?php echo $productObj->getProductCode() ?></td> 
					<td onclick="<?php echo $onclick ?>" width="100"><?php echo $productObj->getProductCategory()->getCategoryName() ?></td> 
					<td onclick="<?php echo $onclick ?>"><?php echo $productObj->getProductName() ?></td> 
					<td onclick="<?php echo $onclick ?>" class="textR" width="60">R$ <?php echo Util::formatFloat($productObj->getDefaultPrice(), true) ?></td> 
					<td onclick="<?php echo $onclick ?>" class="textR" width="50"><?php echo $productObj->getDefaultWeight() ?> gr</td> 
					<td onclick="<?php echo $onclick ?>" class="textC" width="50"><?php echo $productObj->getIsNew()?'Sim':'Não' ?></td> 
					<td onclick="<?php echo $onclick ?>" class="textR" width="40"><?php echo $productObj->getImages() ?></td> 
					<td onclick="<?php echo $onclick ?>" class="textR" width="40"><?php echo $productObj->getStock() ?></td> 
				</tr> 
				<?php
					endforeach;
				?>
			</tbody> 
		</table>
	</div>
</div>