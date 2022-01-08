<div class="wrapper">
    <div class="widget">
		<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Categorias de produto</h6></div>                          
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
		    <thead>
				<tr>
					<th>Nome</th> 
					<th width="100">Produtos</th> 
				</tr> 
			</thead> 
			<tbody id="productCategoryTbody"> 
				<?php
					$criteria = new Criteria();
					foreach(ProductCategory::getList($criteria) as $productCategoryObj):
						
						$productCategoryId  = $productCategoryObj->getId();
						$onclick = 'goToPage(\'productCategory\', \'edit\', \'productCategoryId\', '.$productCategoryId.')"';
				?>
				<tr class="gradeA" id="productCategoryIdRow-<?php echo $productCategoryId ?>">
					<td onclick="<?php echo $onclick ?>"><?php echo $productCategoryObj->getCategoryName() ?></td> 
					<td onclick="<?php echo $onclick ?>"><?php echo $productCategoryObj->getProducts() ?></td> 
				</tr> 
				<?php
					endforeach;
				?>
			</tbody> 
		</table>
	</div>
</div>