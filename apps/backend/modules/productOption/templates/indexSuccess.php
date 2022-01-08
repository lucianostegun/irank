<div class="wrapper">
    <div class="widget">
		<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Opções de produto</h6></div>                          
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
		    <thead>
				<tr>
					<th width="150">Categoria</th> 
					<th>Nome</th> 
					<th>Descrição</th> 
					<th width="100">Tipo</th> 
					<th width="80">Padrão</th> 
				</tr> 
			</thead> 
			<tbody id="productOptionTbody"> 
				<?php
					$criteria = new Criteria();
					foreach(ProductOption::getList($criteria) as $productOptionObj):
						
						$productOptionId  = $productOptionObj->getId();
						$onclick = 'goToPage(\'productOption\', \'edit\', \'productOptionId\', '.$productOptionId.')"';
						
						$productCategoryObj = $productOptionObj->getProductCategory();
						$productCategory    = (is_object($productCategoryObj)?$productCategoryObj->toString():'-');
				?>
				<tr class="gradeA" id="productOptionIdRow-<?php echo $productOptionId ?>">
					<td onclick="<?php echo $onclick ?>"><?php echo $productCategory ?></td> 
					<td onclick="<?php echo $onclick ?>"><?php echo $productOptionObj->getOptionName() ?></td> 
					<td onclick="<?php echo $onclick ?>"><?php echo $productOptionObj->getDescription() ?></td> 
					<td onclick="<?php echo $onclick ?>"><?php echo $productOptionObj->getOptionType(true) ?></td> 
					<td onclick="<?php echo $onclick ?>" class="textC"><?php echo ($productOptionObj->getIsDefault()?'Sim':'Não') ?></td> 
				</tr> 
				<?php
					endforeach;
				?>
			</tbody> 
		</table>
	</div>
</div>