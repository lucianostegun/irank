<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Formas de pagamento'=>null)));
?>
<div class="moduleIntro">
	<h1>Formas de pagamento</h1>
	<br/>
	<p>Para maior comodidade e segurança do comprador, todas as transações realizadas na loja atualmente aceitam as seguintes formas de pagamento:</p>
	<br/> 

<h2><?php echo image_tag('store/boleto', array('align'=>'right', 'class'=>'mr10')) ?> Boleto bancário</h2>
<div class="clear"></div> 
<p>Após a confirmação do pedido, o boleto para pagamento será exibido com seus dados e o valor total do pedido. Efetue o pagamento em qualquer agência bancária do país ou via internet banking. Nós seremos notificados num prazo de 24 horas, liberando então o seu pedido.</p>
<p class="italic">IMPORTANTE: não enviamos uma cópia impressa do boleto via Correios. Enviamos um link para acesso ao boleto através do e-mail de confirmação da compra no fechamento do pedido.<p>

<br/>
<br/>

<h2><?php echo image_tag('store/pagseguro', array('align'=>'right', 'class'=>'mr10')) ?> PagSeguro</h2>
<div class="clear"></div> 
<p>O comprador efetua o pagamento pelo meio de pagamento escolhido (cartão de crédito, Saldo PagSeguro, débito online / TEF, boleto ou Oi Paggo). O pagamento é aprovado após a análise da transação pelo PagSeguro. A aprovação geralmente acontece em tempo real, mas o tempo de processamento e análise pode variar dependendo do tipo de pagamento.</p>
<p>Assim que o pagamento estiver com o status de "aprovado", forneceremos as informações necessárias para o rastreamento da mercadoria e comprovação da entrega.</p>

</div>

<?php
	include_partial('store/include/paymethods');
?>