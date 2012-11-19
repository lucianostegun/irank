<?php
	$messageList = array();
	include_partial('home/component/commonBar', array('pathList'=>array('Loja virtual'=>'store/index', 'Minhas compras'=>null), 'messageList'=>$messageList));
	
	$userSiteObj = UserSite::getCurrentUser();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th class="first">Nº pedido</th>
		<th>Data compra</th>
		<th>Status</th>
		<th>Pagamento</th>
		<th>Valor total</th>
	</tr>
	<?php
		$className = 'odd';
		$records   = 0;
		foreach($userSiteObj->getPurchaseList() as $purchaseObj):
		
			$link         = 'goModule(\'store\', \'orderDetails\', \'orderNumber\', '.$purchaseObj->getOrderNumber().')';
			$hasNewStatus = $purchaseObj->getHasNewStatus();
			
			$records++;
	?>
	<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" onclick="<?php echo $link ?>" class="<?php echo ($hasNewStatus?'textB':'') ?>">
		<td>#<?php echo $purchaseObj->getOrderNumber() ?></td>
		<td class="textC"><?php echo $purchaseObj->getCreatedAt('d/m/Y H:i') ?></td>
		<td><?php echo $purchaseObj->getPaymethod(true) ?></td>
		<td><?php echo $purchaseObj->getOrderStatus(true) ?></td>
		<td class="textR">R$ <?php echo Util::formatFloat($purchaseObj->getTotalValue(), true) ?></td>
	</tr>
	<?php
		endforeach;
		
		if( !$records ):
	?>
	<tr>
		<td class="textL" colspan="5">
			<div class="p20">
				Você ainda não possui nenhum pedido em seu histórico!<br/>
				<?php echo link_to('Clique aqui', 'store/index') ?> para navegar entre os produtos da <b>iRank Store</b>.
			</div>
		</td>
	</tr>
	<?php endif; ?>
</table>
</form>
<div class="mt200"></div>