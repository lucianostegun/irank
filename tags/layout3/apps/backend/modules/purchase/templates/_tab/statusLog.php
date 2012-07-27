<div class="widget">
	<div class="title">
		<h6>Histórico de status do pedido</h6>
	</div>                          
	<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
	    <thead>
			<tr>
				<td>Data</td>
				<td>Status</td>
				<td>Pagamento</td>
				<td>Valor extra</td>
				<td>Parcelas</td>
				<td>Origem</td>
				<td>Código</td>
			</tr> 
		</thead> 
		<tbody id="emailLogListTbody"> 
			<?php
				$criteria = new Criteria();
				$criteria->add( PurchaseStatusLogPeer::PURCHASE_ID, $purchaseId );
				
				foreach(PurchaseStatusLog::getList($criteria) as $purchaseStatusLogObj):
			?>
			<tr class="gradeB">
				<td class="textC"><?php echo $purchaseStatusLogObj->getTransactionDate('d/m/Y H:i:s') ?></td>
				<td><?php echo $purchaseStatusLogObj->getTransactionStatus() ?></td>
				<td><?php echo $purchaseStatusLogObj->getPaymethodType() ?></td>
				<td class="textR"><?php echo Util::formatFloat($purchaseStatusLogObj->getExtraAmount(), true) ?></td>
				<td class="textR"><?php echo $purchaseStatusLogObj->getInstallmentCount() ?></td>
				<td><?php echo $purchaseStatusLogObj->getChangeSource() ?></td> 
				<td><?php echo $purchaseStatusLogObj->getTransactionCode() ?></td>
			</tr> 
			<?php endforeach; ?>
		</tbody> 
	</table>
</div>