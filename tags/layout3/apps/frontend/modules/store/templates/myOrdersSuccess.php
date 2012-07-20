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
		foreach($userSiteObj->getPurchaseList() as $purchaseObj):
		
			$link = 'goModule(\'store\', \'orderDetails\', \'orderNumber\', '.$purchaseObj->getOrderNumber().')';
	?>
	<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" onclick="<?php echo $link ?>">
		<td>#<?php echo $purchaseObj->getOrderNumber() ?></td>
		<td class="textC"><?php echo $purchaseObj->getCreatedAt('d/m/Y H:i') ?></td>
		<td><?php echo $purchaseObj->getPaymethod(true) ?></td>
		<td><?php echo $purchaseObj->getOrderStatus(true) ?></td>
		<td class="textR">R$ <?php echo Util::formatFloat($purchaseObj->getTotalValue(), true) ?></td>
	</tr>
	<?php endforeach; ?>
</table>
</form>