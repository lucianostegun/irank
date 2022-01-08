<div class="widget">
	<div class="title">
		<h6>Histórico de transações do pedido</h6>
	</div>                          
	<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
	    <thead>
			<tr>
				<td>Data</td>
				<td>Status</td>
				<td>Pagamento</td>
				<td>Valor</td>
				<td>Taxas</td>
				<td>Vl. extra</td>
				<td>Vl. Líquido</td>
				<td>Data crédito</td>
				<td>Parcelas</td>
				<td>Código</td>
			</tr> 
		</thead> 
		<tbody id="emailLogListTbody"> 
			<?php
				$criteria = new Criteria();
				$criteria->add( PurchaseTransactionLogPeer::PURCHASE_ID, $purchaseId );
				
				foreach(PurchaseTransactionLog::getList($criteria) as $purchaseStatusLogObj):
				
					$transactionStatus = $purchaseStatusLogObj->getTransactionStatus();
					$paymethodType     = $purchaseStatusLogObj->getPaymethodType();
					$paymethodCode     = $purchaseStatusLogObj->getPaymethodCode();
					
					$transactionStatus = constant("PurchaseTransactionLog::STATUS_$transactionStatus");
					$paymethodType     = constant("PurchaseTransactionLog::PAYMENT_TYPE_$paymethodType");
					$paymethodCode     = constant("PurchaseTransactionLog::PAYMENT_CODE_$paymethodCode");
			?>
			<tr class="gradeB">
				<td class="textC"><?php echo $purchaseStatusLogObj->getCreatedAt('d/m/Y H:i:s') ?></td>
				<td><?php echo $transactionStatus ?></td>
				<td><?php echo $paymethodType.' ('.$paymethodCode.')'; ?></td>
				<td class="textR"><?php echo Util::formatFloat($purchaseStatusLogObj->getGrossAmount(), true) ?></td>
				<td class="textR"><?php echo Util::formatFloat($purchaseStatusLogObj->getFeeAmount(), true) ?></td>
				<td class="textR"><?php echo Util::formatFloat($purchaseStatusLogObj->getExtraAmount(), true) ?></td>
				<td class="textR"><?php echo Util::formatFloat($purchaseStatusLogObj->getNetAmount(), true) ?></td>
				<td class="textC"><?php echo $purchaseStatusLogObj->getEscrowEndDate('d/m/Y H:i:s') ?></td>
				<td class="textR"><?php echo $purchaseStatusLogObj->getInstallmentCount() ?></td>
				<td><?php echo $purchaseStatusLogObj->getTransactionCode() ?></td>
			</tr> 
			<?php endforeach; ?>
		</tbody> 
	</table>
</div>

              