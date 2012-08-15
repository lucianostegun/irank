<style>
	* {
		padding: 0;
		margin: 0;
		font-family: 	helvetica
	}
	
	body {
		
		background: #e8e8e8 url('/images/backgrounds/pdf.png') repeat-x;
	}
	
	.header {
		
		position: 		relative;
		border-bottom: 	thin solid #000000;
		height: 		15mm;
	}
	
	.page {
		page-break-after: always;
		margin: 5mm;
		height: 		287mm;
	}
	
	table.product {
	
		margin: 	5mm 1mm;
		border-bottom: 0.3pt solid #000000;
		width: 100%;
	}

	table.product .image {
	
		width: 250px;
	}

	table.product h1 {
	
		font-size: 14pt;
		padding-bottom: 3mm;
		text-align: left;
	}

	table.product .cover {
	
		margin: 2mm
	}

	table.product .description {
	
		vertical-align: top;
		padding: 2mm 0mm 0mm 8mm;
		font-size: 10pt;
	}

	table.product .description label {
	
		color: rgb(52, 79, 124);
		font-weight: bold
	}
	
	
	
	table.stock {
	
		margin: 3mm	
	}
	
	table.stock th {
		
		text-align: center;
	}

	table.stock th .color {
		
		width: 12mm;
		height: 5mm;
		border: 0.3mm solid #000000;
		margin: 2mm;
	}

	table.stock td {
		
		width: 12mm;
		padding: 2mm
	}

	table.stock tr td:first-child {
		
		padding-left: 5mm
	}

	table.stock td.productStock {
		
		vertical-align: middle;
		text-align: center;
		font-size: 14pt
	}
	
	table.resume {
		
		width: 100%;
		margin-top: 5mm;
		font-size: 10pt;
	}
	
	table.resume tr th {
		
		border-bottom: 0.5pt solid #000000;
		padding-top: 1mm;
		padding-bottom: 1mm;
	}

	table.resume tr.footer th {
		
		empty-cells: show;
		border-top: 0.5pt solid #000000;
		border-bottom: none;
		background: #DADADA
	}
	
	table.resume tr td {
		
		border-bottom: 0.3pt dotted #000000;
		padding-top: 1mm;
		padding-bottom: 1mm;
	}

	.textL { text-align: left }
	.textC { text-align: center }
	.textR { text-align: right }
	.textB { font-weight: bold }
	
	.mt5 { margin-top: 5mm }
	
	.pl2 { padding-left: 20mm }

	.pl5 { padding-left: 5mm }
	
	.pr5 { padding-right: 5mm }
	.pr2 { padding-right: 2mm }
</style>
</head>
<body>

<div class="page">
	<div class="header">
		<img src="[webDir]/images/logo/pdf.png" />
		<div style="position: absolute; left: 50mm; font-weight: bold; font-size: 1.2em">RELATÓRIO DE ESTOQUE DE PRODUTOS</div>
	</div>
	
	<table cellspacing="0" cellpadding="0" class="resume">
		<tr>
			<th class="textL" width="22mm">Código</th>
			<th class="textL" width="50mm">Categoria</th>
			<th class="textL">Produto</th>
			<th class="textL pr2" width="10mm">Estoque</th>
		</tr>
<?php
	$criteria = new Criteria();
	$criteria->addJoin( ProductPeer::PRODUCT_CATEGORY_ID, ProductCategoryPeer::ID, Criteria::INNER_JOIN );
	$criteria->addAscendingOrderByColumn( ProductCategoryPeer::CATEGORY_NAME );
	$productObjList = Product::getList($criteria);
	
	$products = count($productObjList);
	
	$totalStock = 0;
	foreach($productObjList as $key=>$productObj):
		
		$totalStock += $productObj->getStock();
?>
		<tr>
			<td><?php echo $productObj->getProductCode() ?></td>
			<td><?php echo $productObj->getProductCategory()->getCategoryName() ?></td>
			<td><?php echo $productObj->getProductName() ?></td>
			<td class="textR pr2"><?php echo $productObj->getStock() ?></td>
		</tr>
<?php endforeach; ?>
		<tr class="footer">
			<th>TOTAL</th>
			<th></th>
			<th></th>
			<th class="textR pr2"><?php echo $totalStock ?></th>
		</tr>
	</table>
</div>


<?php
	foreach($productObjList as $key=>$productObj):
		$productId = $productObj->getId();
?>
<div class="page">
	<div class="header">
		<img src="[webDir]/images/logo/pdf.png" />
		<div style="position: absolute; left: 50mm; font-weight: bold; font-size: 1.2em">RELATÓRIO DE ESTOQUE DE PRODUTOS</div>
	</div>

	<table class="product">
		<tr>
			<th class="textL" colspan="2"><h1><?php echo $productObj->toString() ?></h1></th>
		</tr>
		<tr>
			<td class="image"><img src="[webDir]/images/store/product/<?php echo $productObj->getImageCover() ?>" class="cover"/></td>
			<td class="description">
				<label>Categoria:</label> <?php echo $productObj->getProductCategory()->getCategoryName() ?>
				<br/><br/> 
				<?php echo $productObj->getDescription(true) ?>
			</td>
		</tr>
	</table>
	

	<table width="0%" cellspacing="0" cellpadding="0" border="1" class="stock">
		<tr>
			<th>&nbsp;</th>
			<?php
				$optionListColor = ProductOption::getOptionsForSelect('color', null, false, true, 'description');
				$optionListSize = ProductOption::getOptionsForSelect('size', null, false, true, 'optionName', $productObj->getProductCategoryId());
				
				$totalByColor = array();
				
				foreach($optionListColor as $productOptionIdColor=>$optionColor):
					$totalByColor[$productOptionIdColor] = 0;
			?>
			<th width="10mm"><div class="color" style="background: <?php echo $optionColor ?>"></div></th>
			<?php endforeach; ?>
			<th width="10mm" class="textB pl5 pr5">TOTAL</th>
		</tr>
		
		<?php
			
			foreach($optionListSize as $productOptionIdSize=>$optionSize):
		?>
		<tr>
			<td class="textB" style="width: 20mm; font-size: 16pt"><?php echo $optionSize ?></td>
			<?php
				$total = 0;
				foreach($optionListColor as $productOptionIdColor=>$optionColor):
					
					$stock = Util::executeOne("SELECT stock FROM product_item WHERE product_id = $productId AND product_option_id_color = $productOptionIdColor AND product_option_id_size = $productOptionIdSize");
					
					$totalByColor[$productOptionIdColor] += $stock;
					$total += $stock;
			?>
				<td class="productStock"><?php echo nvl($stock, '-') ?></td>
			<?php endforeach; ?>
				<td class="productStock textB"><?php echo ($total?$total:'-') ?></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td class="textB" style="width: 20mm; font-size: 16pt">TOTAL</td>
			<?php
				foreach($totalByColor as $total):
			?>
				<td class="productStock textB"><?php echo ($total?$total:'-') ?></td>
			<?php endforeach; ?>
				<td class="productStock textB"><?php echo array_sum($totalByColor) ?></td>
		</tr>
	</table>
	
	
	
	
	
	
	
	<?php
		
		if( ($key+1) < $products )
			echo '</div>';
		
		endforeach;
	?>
	

</body>
</html>

