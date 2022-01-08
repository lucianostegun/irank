<?php echo link_to(image_tag('backend/icons/light/pdfDoc', array('class'=>'icon')).'<span>Exportar</span>', '#exportCashGame("buyin", "pdf")', array('class'=>'button greenB')) ?>
	
<div class="widget form">
	<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
		<thead>
			<tr> 
				<td>Jogador</td>
				<td>Data/Hora</td>
				<td>Vl. compra</td>
				<td>Taxa</td>
				<td>Pagto.</td>
			</tr>
		</thead>
		<tbody id="eventLivePlayerIdTbody"> 
			<?php
				$criteria = new Criteria();
				$criteria->add( CashTablePlayerBuyinPeer::CASH_TABLE_ID, $cashTableObj->getId() );
				$criteria->add( CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $cashTableObj->getCashTableSessionId() );
				$cashTablePlayerBuyinObjList = CashTablePlayerBuyinPeer::doSelect($criteria);
				
				$totalBuyin       = 0;
				$totalEntranceFee = 0;
				
				foreach($cashTablePlayerBuyinObjList as $cashTablePlayerBuyinObj):
				
					$buyin       = $cashTablePlayerBuyinObj->getBuyin();
					$entranceFee = $cashTablePlayerBuyinObj->getEntranceFee();
					
					$totalBuyin       += $buyin;
					$totalEntranceFee += $entranceFee;
			?>
			<tr class="gradeB">
				<td><?php echo $cashTablePlayerBuyinObj->getPeople()->getName() ?></td>
				<td width="12%" class="textC"><?php echo $cashTablePlayerBuyinObj->getCreatedAt('d/m/Y H:i') ?></td>
				<td width="10%" class="textR"><?php echo Util::formatFloat($buyin, true) ?></td>
				<td width="10%" class="textR"><?php echo Util::formatFloat($entranceFee, true) ?></td>
				<td width="15%"><?php echo $cashTablePlayerBuyinObj->getPayMethod()->getDescription() ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		<tfooter>
			<tr>
				<td class="textR textB" colspan="2">Subtotal</td>
				<td width="10%" class="textR textB"><?php echo Util::formatFloat($totalBuyin, true) ?></td>
				<td width="10%" class="textR textB"><?php echo Util::formatFloat($totalEntranceFee, true) ?></td>
				<td width="15%"></td>
			</tr>
			<tr>
				<td class="textR textB" colspan="2">TOTAL</td>
				<td width="10%" colspan="2" class="textR textB"><?php echo Util::formatFloat($totalBuyin+$totalEntranceFee, true) ?></td>
				<td width="15%"></td>
			</tr>
		</tfooter>
	</table>
</div>