<?php echo link_to(image_tag('backend/icons/light/pdfDoc', array('class'=>'icon')).'<span>Exportar</span>', '#exportCashGame("session", "pdf")', array('class'=>'button greenB')) ?>
	
	<?php
		$criteria = new Criteria();
		$criteria->add( CashTablePlayerPeer::CASH_TABLE_ID, $cashTableObj->getId() );
		$criteria->add( CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $cashTableObj->getCashTableSessionId() );
		$criteria->addJoin( CashTablePlayerPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$criteria->addAscendingOrderByColumn( PeoplePeer::FULL_NAME );
		$cashTablePlayerObjList = CashTablePlayerPeer::doSelect($criteria);
		
		foreach($cashTablePlayerObjList as $cashTablePlayerObj):
	?>
	<div class="widget form">
		<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
			<thead>
			<tr> 
				<td colspan="8" style="text-align: left">
					<h6 style="float: left"><?php echo $cashTablePlayerObj->getPeople()->getName() ?></h6>
					<h6 style="float: right; font-weight: normal">
						<b class="ml20">Entrada:</b> <?php echo $cashTablePlayerObj->getCheckinAt('H:i') ?>
						<b class="ml20">Saída:</b> <?php echo $cashTablePlayerObj->getCheckoutAt('H:i') ?>
						<b class="ml20">Total buyin:</b> <?php echo Util::formatFloat($cashTablePlayerObj->getTotalBuyin(), true) ?>
						<b class="ml20">Cashout:</b> <?php echo Util::formatFloat($cashTablePlayerObj->getCashoutValue(), true) ?>
					</h6>
				</td>
			</tr>
			</thead>
			<tr> 
				<th>Data/Hora</th>
				<th>Vl. compra</th>
				<th>Taxa</th>
				<th>Pagto.</th>
				<th>Num. cheque</th>
				<th>Emitente</th>
				<th>Banco</th>
				<th>Data</th>
			</tr>
			<tbody>
			<?php
				$criteria = new Criteria();
				$criteria->add( CashTablePlayerBuyinPeer::CASH_TABLE_ID, $cashTableObj->getId() );
				$criteria->add( CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $cashTableObj->getCashTableSessionId() );
				$criteria->add( CashTablePlayerBuyinPeer::PEOPLE_ID, $cashTablePlayerObj->getPeopleId() );
				$criteria->add( CashTablePlayerBuyinPeer::CASH_TABLE_PLAYER_ID, $cashTablePlayerObj->getId() );
				$cashTablePlayerBuyinObjList = CashTablePlayerBuyinPeer::doSelect($criteria);
				
				foreach($cashTablePlayerBuyinObjList as $key=>$cashTablePlayerBuyinObj):
				
					$clubCheckObj = $cashTablePlayerBuyinObj->getClubCheck();
					if( !is_object($clubCheckObj) ) $clubCheckObj = new ClubCheck();
			?>
			<tr class="gradeB">
				<td width="12%" class="textC"><?php echo $cashTablePlayerBuyinObj->getCreatedAt('d/m/Y H:i') ?></td>
				<td width="10%" class="textR"><?php echo Util::formatFloat($cashTablePlayerBuyinObj->getBuyin(), true) ?></td>
				<td width="10%" class="textR"><?php echo Util::formatFloat($cashTablePlayerBuyinObj->getEntranceFee(), true) ?></td>
				<td width="15%"><?php echo $cashTablePlayerBuyinObj->getPayMethod()->getDescription() ?></td>
				<td width="10%"><?php echo $clubCheckObj->getCheckNumber() ?></td>
				<td width="10%"><?php echo $clubCheckObj->getCheckNominal() ?></td>
				<td width="10%"><?php echo $clubCheckObj->getCheckBank() ?></td>
				<td width="10%"><?php echo $clubCheckObj->getCheckDate('d/m/Y') ?></td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php endforeach; ?>


	<?php
		$criteria = new Criteria();
		$criteria->add( CashTablePlayerPeer::CASH_TABLE_ID, $cashTableObj->getId() );
		$criteria->add( CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $cashTableObj->getCashTableSessionId() );
		$criteria->addJoin( CashTablePlayerPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$criteria->addAscendingOrderByColumn( PeoplePeer::FULL_NAME );
		$cashTablePlayerObjList = CashTablePlayerPeer::doSelect($criteria);
		
		foreach($cashTablePlayerObjList as $cashTablePlayerObj):
	?>
	<div class="widget form">
		<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
			<thead>
			<tr> 
				<td colspan="8" style="text-align: left">
					<h6 style="float: left"><?php echo $cashTablePlayerObj->getPeople()->getName() ?></h6>
					<h6 style="float: right; font-weight: normal">
						<b class="ml20">Entrada:</b> <?php echo $cashTablePlayerObj->getCheckinAt('H:i') ?>
						<b class="ml20">Saída:</b> <?php echo $cashTablePlayerObj->getCheckoutAt('H:i') ?>
						<b class="ml20">Total buyin:</b> <?php echo Util::formatFloat($cashTablePlayerObj->getTotalBuyin(), true) ?>
						<b class="ml20">Cashout:</b> <?php echo Util::formatFloat($cashTablePlayerObj->getCashoutValue(), true) ?>
					</h6>
				</td>
			</tr>
			</thead>
			<tr> 
				<th>Data/Hora</th>
				<th>Vl. compra</th>
				<th>Taxa</th>
				<th>Pagto.</th>
				<th>Num. cheque</th>
				<th>Emitente</th>
				<th>Banco</th>
				<th>Data</th>
			</tr>
			<tbody>
			<?php
				$criteria = new Criteria();
				$criteria->add( CashTablePlayerBuyinPeer::CASH_TABLE_ID, $cashTableObj->getId() );
				$criteria->add( CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $cashTableObj->getCashTableSessionId() );
				$criteria->add( CashTablePlayerBuyinPeer::PEOPLE_ID, $cashTablePlayerObj->getPeopleId() );
				$criteria->add( CashTablePlayerBuyinPeer::CASH_TABLE_PLAYER_ID, $cashTablePlayerObj->getId() );
				$cashTablePlayerBuyinObjList = CashTablePlayerBuyinPeer::doSelect($criteria);
				
				foreach($cashTablePlayerBuyinObjList as $key=>$cashTablePlayerBuyinObj):
				
					$clubCheckObj = $cashTablePlayerBuyinObj->getClubCheck();
					if( !is_object($clubCheckObj) ) $clubCheckObj = new ClubCheck();
			?>
			<tr class="gradeB">
				<td width="12%" class="textC"><?php echo $cashTablePlayerBuyinObj->getCreatedAt('d/m/Y H:i') ?></td>
				<td width="10%" class="textR"><?php echo Util::formatFloat($cashTablePlayerBuyinObj->getBuyin(), true) ?></td>
				<td width="10%" class="textR"><?php echo Util::formatFloat($cashTablePlayerBuyinObj->getEntranceFee(), true) ?></td>
				<td width="15%"><?php echo $cashTablePlayerBuyinObj->getPayMethod()->getDescription() ?></td>
				<td width="10%"><?php echo $clubCheckObj->getCheckNumber() ?></td>
				<td width="10%"><?php echo $clubCheckObj->getCheckNominal() ?></td>
				<td width="10%"><?php echo $clubCheckObj->getCheckBank() ?></td>
				<td width="10%"><?php echo $clubCheckObj->getCheckDate('d/m/Y') ?></td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php endforeach; ?>