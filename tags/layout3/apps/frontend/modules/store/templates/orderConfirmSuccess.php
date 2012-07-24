<?php
	$orderNumber = $purchaseObj->getOrderNumber();
	
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Carrinho'=>'store/cart', 'Pagamento'=>'store/payment', 'Confirmação'=>'store/confirmOrder', 'Pedido confirmado'=>null)));
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
					<h1>Pedido #<?php echo $orderNumber ?></h1>
					Clique no link abaixo para gerar o boleto para pagamento<br/><br/>
					<?php
						$paymethod = $purchaseObj->getPaymethod();
						switch($paymethod){
							case 'billet':
								$paymethodIcon = 'boleto';
								$paymentUrl    = url_for("store/billet?$orderNumber=");
								break;
							case 'pagseguro':
								$paymethodIcon = 'pagseguro';
								$paymentUrl    = $purchaseObj->getPagseguroUrl();
								break;
						}
						echo image_tag('store/'.$paymethodIcon, array('align'=>'absmiddle', 'style'=>'margin-right: 10px'));
						if( $paymethod=='pagseguro' )
							echo 'Clique na URL abaixo para realizar o pagamento.<div class="clear"></div>';
							
						echo link_to($paymentUrl, $paymentUrl, array('target'=>'_blank'));
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