<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Tabela de medidas'=>null)));
?>
<div class="moduleIntro">
	Pare escolher o tamanho correto de sua camiseta, verifique a tabela de medidas para cada tamanho.
</div>
<br/>
<h3>Camiseta Tamanho M</h1>
<table cellspacing="5" cellpadding="5" border="0" class="sizeBoard">
	<tr>
		<th>Branca</th>
		<th>Preta</th>
	</tr>
	<tr>
		<td><?php echo image_tag('store/size/tshirtMediumWhite') ?></td>
		<td><?php echo image_tag('store/size/tshirtMediumBlack') ?></td>
	</tr>
</table>

<h3>Camiseta Tamanho G</h1>
<table cellspacing="5" cellpadding="5" border="0" class="sizeBoard">
	<tr>
		<th>Branca</th>
		<th>Preta</th>
		<th>Vermelha</th>
	</tr>
	<tr>
		<td><?php echo image_tag('store/size/tshirtLargeWhite') ?></td>
		<td><?php echo image_tag('store/size/tshirtLargeBlack') ?></td>
		<td><?php echo image_tag('store/size/tshirtLargeRed') ?></td>
	</tr>
</table>

<h3>Camiseta Tamanho GG</h1>
<table cellspacing="5" cellpadding="5" border="0" class="sizeBoard">
	<tr>
		<th>Branca</th>
		<th>Preta</th>
	</tr>
	<tr>
		<td><?php echo image_tag('store/size/tshirtExtraLargeWhite') ?></td>
		<td><?php echo image_tag('store/size/tshirtExtraLargeBlack') ?></td>
	</tr>
</table>

<h3>Baby Look</h1>
<table cellspacing="5" cellpadding="5" border="0" class="sizeBoard">
	<tr>
		<th>Preta</th>
	</tr>
	<tr>
		<td><?php echo image_tag('store/size/babyLookBlack') ?></td>
	</tr>
</table>

<div class="moduleFooter">
	As medidas apresentadas aqui são os valores médios obtidos para cada tamanho e podem sofrer variações.
</div>