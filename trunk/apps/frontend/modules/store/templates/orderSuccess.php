<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Loja'=>'store/index', 'Carrinho'=>'store/cart', 'Pagamento'=>null)));
?>
	<div class="storeCartOrder" align="center">
		
		<table border="0" cellspacing="0" cellpadding="0" class="formTable" style="width: 750px; margin-top: 20px">
			<tr class="header">
				<th colspan="2"><h1>Pedido confirmado!</h1></th>
			</tr>
			<tr>
				<td align="left" valign="top" width="160" align="center" class="icon">
					<?php echo image_tag('success', array('align'=>'left', 'style'=>'margin: 0px 0px 0px 15px')) ?>
				</td>
				<td align="left" valign="top" class="message">
					Por favor, anote o número de seu pedido:<br/>
					<h1>Pedido #0239483</h1>
					Clique no link abaixo para gerar o boleto para pagamento<br/><br/>
					<?php
						echo image_tag('store/boleto', array('align'=>'absmiddle', 'style'=>'margin-right: 10px'));
						echo link_to('http://www.irank.com.br/store/boleto/0239483');
					?>
					<br/><br/>
					Uma mensagem foi enviada para seu e-mail contendo todas as informações do pedido.<br/>
					O prazo de envio é de até 3 dias úteis após a confirmação do pagamento.<br/>
				</td>
			</tr>
		</table>
		
	</div>

<div class="clear mt5"></div>

<?php
	include_partial('store/include/offer');
?>