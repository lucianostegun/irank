<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Envio'=>null)));
?>
<div class="moduleIntro">
	<h1>Envio</h1>
	<br/>
	<p>Para todos os produtos do site, o prazo de entrega é calculado da seguinte forma:</p>
	<p>Após a confirmação do pagamento do pedido, o pedido tem o prazo máximo de cinco dias úteis para a postagem.</p>
	<p>Após o produto ser postado o pedido é atualizado com o código de rastreamento fornecido pelos Correios, uma notificação é enviada por e-mail e também disponível no menu Minhas compras.</p>
	<p>Os prazos de entrega podem variar de acordo com a modalidade de frete contratada. Estes prazos são informados ao cliente no momento da finalização do pedido no site.</p>
</div>

<?php
	include_partial('store/include/paymethods');
?>