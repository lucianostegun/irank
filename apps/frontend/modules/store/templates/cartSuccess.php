<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Carrinho'=>null)));
	include_partial('store/include/cartbar', array());
?>
	<div class="storeCart">
	
		<table border="0" cellspacing="0" cellpadding="0" class="gridTable store cart">
		  <tr class="header">
		    <th colspan="2" class="first">Produto</th>
		    <th width="70">Qtd</th>
		    <th width="100">Vl. unit.</th>
		    <th width="100">Vl. total</th>
		    <th width="30"></th>
		  </tr>
		  <tr>
		    <td width="50" class="productImage"><?php echo image_tag('temp/tshirt1Thumb.jpg') ?></td>
		    <td class="textL productName">
		    	<span>Camiseta I'm bluffing / I'm All In</span>
		    	<div class="clear mt5"></div>
		    	<span class="productDetail"><b>Tamanho:</b> G</span>
		    	<span class="productDetail"><b>Cor:</b> Preta</span>
		    </td>
		    <td class="textC quantity"><?php echo input_tag('quantity', 1, array('size'=>3)) ?></td>
		    <td class="textR productPrice">R$ 39,90</td>
		    <td class="textR totalValue">R$ 39,90</td>
		    <td class="textC removeProduct"><?php echo image_tag('icon/delete') ?></td>
		  </tr>
		  <tr class="odd">
		    <td width="50" class="productImage"><?php echo image_tag('temp/tshirt2Thumb.jpg') ?></td>
		    <td class="textL productName">
		    	<span>Four of a kind: Aces</span>
		    	<div class="clear mt5"></div>
		    	<span class="productDetail"><b>Tamanho:</b> G</span>
		    	<span class="productDetail"><b>Cor:</b> Preta</span></td>
		    <td class="textC quantity"><?php echo input_tag('quantity', 1, array('size'=>3)) ?></td>
		    <td class="textR productPrice">R$ 39,90</td>
		    <td class="textR totalValue">R$ 39,90</td>
		    <td class="textC removeProduct"><?php echo image_tag('icon/delete') ?></td>
		  </tr>
		  <tr>
		    <td width="50" class="productImage"><?php echo image_tag('temp/tshirt2Thumb.jpg') ?></td>
		    <td class="textL productName">
		    	<span>iRank red suit #1</span>
		    	<div class="clear mt5"></div>
		    	<span class="productDetail"><b>Tamanho:</b> G</span>
		    	<span class="productDetail"><b>Cor:</b> Preta</span>
		    </td>
		    <td class="textC quantity"><?php echo input_tag('quantity', 1, array('size'=>3)) ?></td>
		    <td class="textR productPrice">R$ 39,90</td>
		    <td class="textR totalValue">R$ 39,90</td>
		    <td class="textC removeProduct"><?php echo image_tag('icon/delete') ?></td>
		  </tr>
		  <tr class="footer shipping">
		    <th class="textR"></th>
		    <th class="textR pr10">Informe seu cep para calcular o valor do frete</th>
		    <th class="textC"><?php echo input_tag('zipcode', '04057-000', array('size'=>9, 'maxlength'=>9, 'class'=>'textC')) ?></th>
		    <th class="textC"><?php echo link_to('Calcular frete', '#doCalculateShipping()') ?></th>
		    <th class="textR shippingValue">R$ 10,00</th>
		    <th></th>
		  </tr>
		  <tr class="footer shipping">
		    <th class="textR"></th>
		    <th class="textC"></th>
		    <th class="textR pr10" colspan="2">TOTAL DO PEDIDO</th>
		    <th class="textR shippingTotalValue">R$ <?php echo Util::formatFloat(39.9*3+10, true) ?></th>
		    <th></th>
		  </tr>
		</table>
	</div>

<div class="clear mt5 pt5" style="border-bottom: 10px solid #F0F0F0">
	<?php include_partial('store/include/cartbar', array()); ?>
</div>

<div class="clear mt5"></div>

<?php
	include_partial('store/include/offer');
?>