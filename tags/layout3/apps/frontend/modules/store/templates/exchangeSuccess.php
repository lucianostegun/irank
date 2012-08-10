<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Trocas e Devoluções'=>null)));
?>
<div class="moduleIntro">
	<h1>Trocas e devoluções</h1>
	<br/>
	<p>O processo de substituição de mercadoria se dá da seguinte forma:</p>
 
	<p>1. O pedido de troca/devolução poderá fazer a escolha de outro item conforme estoque disponível na loja virtual e dentro da característica a seguir:<br/>
	Via e-mail informe o motivo da troca, CPF, nº do pedido, código de referência do produto que deseja trocar e do novo produto, bem como descrição de cor e tamanho.<br/>
	O pedido poderá ser feito no prazo de 30 (trinta) dias corridos após a data de envio do pedido.</p>
	
	<p>2. Todos os encargos da <b>PRIMEIRA</b> tentativa de troca serão de responsabilidade da <b>iRank Store</b>. Nas demais solicitações de troca, caso existam, reserva-se o direito de fazer uma nova troca mediante pagamento dos encargos de postagem do(s) produto(s).</p>
	<p>3. A escolha do item a ser substituído deverá se limitar ao valor máximo do produto. Se houver diferença de preço, deverá ser providenciado o pagamento da diferença através das <?php echo link_to('opções de pagamento', 'store/paymethods') ?> disponíveis. Caso haja devolução de valores, a troca só poderá ser feita pelo titular do pedido, na conta do titular da compra.</p>
	<p>4. O prazo de troca é de até 30 (trinta) dias corridos, a contar da data do recebimento, para poder substituí-lo, desde que o apresente nas mesmas condições em que foi recebido/comprado (na embalagem original, sem indícios de uso, com o lacre original do fabricante e o DANFE (Documento Auxiliar da Nota Fiscal Eletrônica)</p>
	
	<p>Seguimos todas as leis e orientações do código do consumidor</p>
</div>

<?php
	include_partial('store/include/paymethods');
?>