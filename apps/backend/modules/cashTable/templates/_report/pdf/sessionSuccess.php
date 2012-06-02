<style>
	* {
		padding: 0;
		margin: 0;
		font-family: 	helvetica
	}
	
	body {
		
		background: #f9f9f9 url('/images/backgrounds/pdfLight.png') repeat-x;
	}
	
	.header {
		
		position: 		relative;
		border-bottom: 	thin solid #000000;
		height: 		15mm;
	}
	
	.page {
		page-break-after: always;
		margin: 5mm;
		height: 		287mm;
	}
	
	.resultTable {
	
		margin: 	2mm 0mm;
		border: 	thin solid #303030	
	}
	
	.resultTable tr th {
		
		font-size: 		7pt;
		padding: 		0.5mm 0mm;
		background: 	#CDD0D0;
		border-top: 	thin solid #606060;
		border-bottom: 	thin solid #606060
	}
	
	.resultTable tr td {
		
		font-size: 	0.6em;
		padding: 	0.9mm 1mm;
	}
	
	.resultTable tr td.position {
		
		background: 	#C0c0c0;
		font-weight: 	bold;
	}
	
	.resultTable tr.odd { background: #FFFFFF }
	.resultTable tr.even { background: #F0F0F0 }
	
	.textL { text-align: left }
	.textC { text-align: center }
	.textR { text-align: right }
	.textB { font-weight: bold }
	
	.mt5 { margin-top: 5mm }
	.ml3 { margin-left: 3mm }
	.ml5 { margin-left: 5mm }
	
	.pl2 { padding-left: 20mm }
	
	.checkInfo span,
	.checkInfo label {
		
		font-size: 7pt
	}
	
	.checkInfo span {
		font-weight: bold;
		margin-left: 2mm;
	}
	
	h1 { font-size: 16pt; color: #c23b00; padding-top: 5mm; margin-bottom: 5mm; border-bottom: thin solid #404040 }
	h5 { position: absolute; font-size: 10pt; top: 0.5mm }
	h6 { position: absolute; right: 5mm; top: 2mm; font-size: 8pt; font-weight: normal }
	
	.clear { clear: both; width: 100% }
</style>
</head>
<body>
<?php
	$cashTableObj        = CashTablePeer::retrieveByPK($cashTableId);
	$clubObj             = $cashTableObj->getClub();
	$cashTableSessionObj = $cashTableObj->getCashTableSession();
	
	$fileNameLogo = $clubObj->getFileNameLogo();
	$closedAt     = $cashTableSessionObj->getClosedAt('d/m/Y H:i');
?>
<div class="page">
	<div class="header" style="position: relative">
		<img src="[webDir]/images/logo/pdf.png" style="position: absolute; right: 35mm; top: -2mm" />
		<img src="[webDir]/images/club/<?php echo $fileNameLogo ?>" style="position: absolute; left: 0mm; top: -2mm; height: 15mm" />
		<div style="position: absolute; left: 20mm; font-weight: bold; font-size: 1.2em">
			Relatório transações - <?php echo $cashTableObj->getCashTableName() ?> - Sessão <?php echo $cashTableSessionObj->getCode() ?>
		</div>
		<div style="position: absolute; left: 20mm; top: 8mm; font-size: 9pt">
			<b>Abertura:</b> <?php echo $cashTableSessionObj->getOpenedAt('d/m/Y H:i') ?>
			<b class="ml3">Fechamento:</b> <?php echo nvl($closedAt, '-') ?>
			<b class="ml3">Jogadores:</b> <?php echo $cashTableSessionObj->getTotalPlayers() ?>
			<b class="ml3">Dealers:</b> <?php echo $cashTableSessionObj->getTotalDealers() ?>
		</div>
		<div style="position: absolute; right: 00mm; top: 10mm; font-size: 8pt"><b>Emissão:</b> <?php echo date('d/m/Y H:i:s') ?></div>
	</div>
	<div class="clear"></div>
	<br/>
	<h1>Transações de jogadores</h1>
	<?php
		$criteria = new Criteria();
		$criteria->add( CashTablePlayerPeer::CASH_TABLE_ID, $cashTableObj->getId() );
		$criteria->add( CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $cashTableObj->getCashTableSessionId() );
		$criteria->addJoin( CashTablePlayerPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$criteria->addAscendingOrderByColumn( PeoplePeer::FULL_NAME );
		$cashTablePlayerObjList = CashTablePlayerPeer::doSelect($criteria);
		
		$currentHeight = 0;
		
		$totalBuyinFinal          = 0;
		$totalEntranceFeeFinal    = 0;
		$totalCashoutPlayersFinal = 0;
		$totalCashoutDealersFinal = 0;
					
		foreach($cashTablePlayerObjList as $cashTablePlayerObj):
			$currentHeight += 1;
			
			$buyin        = $cashTablePlayerObj->getTotalBuyin();
			$entranceFee  = $cashTablePlayerObj->getTotalEntranceFee();
			$cashoutValue = $cashTablePlayerObj->getCashoutValue();
			
			$totalBuyinFinal          += $buyin;
			$totalEntranceFeeFinal    += $entranceFee;
			$totalCashoutPlayersFinal += $cashoutValue;
	?>
		<table class="resultTable full" cellspacing="0" cellpadding="0" style="width: 100%">
			<thead>
			<tr> 
				<td colspan="8" style="text-align: left; height: 5mm; position: relative; background: #F0F0F0">
					<h5><?php echo $cashTablePlayerObj->getPeople()->getName() ?></h5>
					<h6>
						<b class="ml5">Entrada:</b> <?php echo $cashTablePlayerObj->getCheckinAt('H:i') ?>
						<b class="ml5">Saída:</b> <?php echo $cashTablePlayerObj->getCheckoutAt('H:i') ?>
						<b class="ml5">Total buyin:</b> <?php echo Util::formatFloat($buyin, true) ?>
						<b class="ml5">Cashout:</b> <?php echo Util::formatFloat($cashoutValue, true) ?>
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
				
				$lineNumber = 0;
				$class      = 'even';
				foreach($cashTablePlayerBuyinObjList as $key=>$cashTablePlayerBuyinObj):
				
					$clubCheckObj = $cashTablePlayerBuyinObj->getClubCheck();
					
					if( !is_object($clubCheckObj) ) $clubCheckObj = new ClubCheck();
					
					$class = ($class=='even'?'odd':'even');
			?>
			<tr class="<?php echo $class ?>">
				<td width="12%" class="textC"><?php echo $cashTablePlayerBuyinObj->getCreatedAt('d/m/Y H:i') ?></td>
				<td width="7%" class="textR"><?php echo Util::formatFloat($cashTablePlayerBuyinObj->getBuyin(), true) ?></td>
				<td width="7%" class="textR"><?php echo Util::formatFloat($cashTablePlayerBuyinObj->getEntranceFee(), true) ?></td>
				<td width="10%"><?php echo $cashTablePlayerBuyinObj->getPayMethod()->getDescription() ?></td>
				<td width="7%"><?php echo $clubCheckObj->getCheckNumber() ?></td>
				<td width="20%"><?php echo $clubCheckObj->getCheckNominal() ?></td>
				<td width="15%"><?php echo $clubCheckObj->getCheckBank() ?></td>
				<td width="9%"><?php echo $clubCheckObj->getCheckDate('d/m/Y') ?></td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php
		if( $currentHeight >= 11 ){
			
			echo '</div><div class="page">';
			$currentHeight = 0;
		}
		
		endforeach;
	?>

	</div><div class="page">

	<h1>Transições de dealers</h1>
	<table class="resultTable full first" cellspacing="0" cellpadding="0" style="width: 100%">
		<tr> 
			<th>Dealer</th>
			<th>Entrada</th>
			<th>Saída</th>
			<th>Cashout</th>
		</tr>
		<?php
			$criteria = new Criteria();
			$criteria->add( CashTableDealerPeer::CASH_TABLE_ID, $cashTableObj->getId() );
			$criteria->add( CashTableDealerPeer::CASH_TABLE_SESSION_ID, $cashTableObj->getCashTableSessionId() );
			$criteria->addAscendingOrderByColumn( CashTableDealerPeer::ID );
			$cashTableDealerObjList = CashTableDealerPeer::doSelect($criteria);
			
			$class = 'even';
			$totalCashoutValue = 0;
			foreach($cashTableDealerObjList as $cashTableDealerObj):
				
				$class = ($class=='odd'?'even':'odd');
				$cashoutValue = $cashTableDealerObj->getCashoutValue();
				$totalCashoutValue += $cashoutValue;
				$totalCashoutDealersFinal += $cashoutValue;
		?>
		<tr class="<?php echo $class ?>">
			<td class="textB"><?php echo $cashTableDealerObj->getPeople()->getName() ?></td>
			<td width="15%" class="textC"><?php echo $cashTableDealerObj->getCheckinAt('d/m/Y H:i') ?></td>
			<td width="15%" class="textC"><?php echo $cashTableDealerObj->getCheckoutAt('d/m/Y H:i') ?></td>
			<td width="10%" class="textR"><?php echo Util::formatFloat($cashoutValue, true) ?></td>
		</tr>
		<?php endforeach; ?>
		<tr> 
			<th colspan="2" class="textR" style="font-size: 12pt">TOTAL</th>
			<th colspan="2" class="textR" style="padding-right: 1mm; font-size: 12pt"><?php echo Util::formatFloat($totalCashoutValue, true) ?></th>
		</tr>
	</table>
	
	
	<br/><br/>
	
	
	<h1>Resumo</h1><br/>
	<table class="resumeTable" cellspacing="2" cellpadding="0" style="width: 100%">
		<tr>
			<th class="textR" width="50%">Jogadores</th>
			<td class="textL" width="50%" style="padding-left: 5mm"><?php echo $cashTableSessionObj->getTotalPlayers() ?></td>
		</tr>
		<tr>
			<th class="textR" width="50%">Dealers</th>
			<td class="textL" width="50%" style="padding-left: 5mm"><?php echo $cashTableSessionObj->getTotalDealers() ?></td>
		</tr>
		<tr> 
			<th class="textR" width="50%">Total buyin (+)</th>
			<td class="textL" width="50%" style="padding-left: 5mm"><?php echo Util::formatFloat($totalBuyinFinal, true) ?></td>
		</tr>
		<tr> 
			<th class="textR" width="50%">Total taxas (+)</th>
			<td class="textL" width="50%" style="padding-left: 5mm"><?php echo Util::formatFloat($totalEntranceFeeFinal, true) ?></td>
		</tr>
		<tr> 
			<th class="textR" width="50%">Subtotal</th>
			<td class="textL" width="50%" style="padding-left: 5mm"><?php echo Util::formatFloat($totalBuyinFinal+$totalEntranceFeeFinal, true) ?></td>
		</tr>
		<tr> 
			<th class="textR" width="50%">Total cashouts jogadores (-)</th>
			<td class="textL" width="50%" style="padding-left: 5mm"><?php echo Util::formatFloat($totalCashoutPlayersFinal, true) ?></td>
		</tr>
		<tr> 
			<th class="textR" width="50%">Total cashouts dealers (-)</th>
			<td class="textL" width="50%" style="padding-left: 5mm"><?php echo Util::formatFloat($totalCashoutDealersFinal, true) ?></td>
		</tr>
		<tr> 
			<th class="textR" width="50%">TOTAL</th>
			<td class="textL" width="50%" style="padding-left: 5mm"><?php echo Util::formatFloat($totalBuyinFinal+$totalEntranceFeeFinal-$totalCashoutPlayersFinal-$totalCashoutDealersFinal, true) ?></td>
		</tr>
	</table>
	
	
</body>
</html>

