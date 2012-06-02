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
	
		margin: 	5mm 1mm;
		border: 	thin solid #303030	
	}
	
	.resultTable.full {
	
		margin: 	0mm;
		border: 	thin solid #303030	
	}

	.resultTable.full.first {
	
		margin: 	5mm 0mm;
	}
	
	.resultTable tr th {
		
		font-size: 		0.7em;
		padding: 		1mm 1mm;
		background: 	#BDC0C0;
		border-bottom: 	thin solid #606060
	}
	
	.resultTable tr td {
		
		font-size: 	0.6em;
		padding: 	0.9mm 1mm
	}
	
	.resultTable.full tr td {
		
		font-size: 	0.7em;
	}

	.resultTable tr td.position {
		
		background: 	#C0c0c0;
		font-weight: 	bold;
	}
	
	.resultTable tr.odd { background: #FFFFFF }
	.resultTable tr.even { background: #F0F0F0 }
	
	.resultTable.full tr td {
		
		border-bottom: 	thin solid #303030;
	}
	
	.resultTable.full tr td.dark {
		
		background: 	#E0E0E0;
	}
	
	
	.resultFull h1 {
		
		font-family: Avengeance;
		text-align: center;
		font-size: 28px;
		padding-bottom: 5mm;
		margin-bottom: 0mm;
		border-bottom: thin solid #000000;
	}
	
	.eventPhoto {
		
		width: 90mm;
		margin: 2.5mm;
		border: 0.5mm solid 303030;
		background: #000000;
	}

	.eventPhoto.right1 {
		
		-webkit-transform: rotate(0.1rad);
		-moz-transform: rotate(0.1rad);
		-ms-transform: rotate(0.1rad);
	}

	.eventPhoto.left1 {
		
		-webkit-transform: rotate(-0.1rad);
		-moz-transform: rotate(-0.1rad);
		-ms-transform: rotate(-0.1rad);
	}
	
	.eventPhotos h1 {
		
		font-family: Avengeance;
		text-align: center;
		font-size: 28px;
		padding-bottom: 5mm;
		margin-bottom: 7mm;
		border-bottom: thin solid #000000;
	}
	
	
	.textL { text-align: left }
	.textC { text-align: center }
	.textR { text-align: right }
	.textB { font-weight: bold }
	
	.mt5 { margin-top: 5mm }
	.ml3 { margin-left: 3mm }
	
	.pl2 { padding-left: 20mm }
	
	.checkInfo span,
	.checkInfo label {
		
		font-size: 7pt
	}
	
	.checkInfo span {
		font-weight: bold;
		margin-left: 2mm;
	}
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
			Relatório de buyins - <?php echo $cashTableObj->getCashTableName() ?> - Sessão <?php echo $cashTableSessionObj->getCode() ?>
		</div>
		<div style="position: absolute; left: 20mm; top: 8mm; font-size: 9pt">
			<b>Abertura:</b> <?php echo $cashTableSessionObj->getOpenedAt('d/m/Y H:i') ?>
			<b class="ml3">Fechamento:</b> <?php echo nvl($closedAt, '-') ?>
			<b class="ml3">Jogadores:</b> <?php echo $cashTableSessionObj->getTotalPlayers() ?>
			<b class="ml3">Dealers:</b> <?php echo $cashTableSessionObj->getTotalDealers() ?>
		</div>
		<div style="position: absolute; right: 00mm; top: 10mm; font-size: 8pt"><b>Emissão:</b> <?php echo date('d/m/Y H:i:s') ?></div>
	</div>








	<table class="resultTable full first" cellspacing="0" cellpadding="0" style="width: 100%">
			<tr> 
				<th>Jogador</th>
				<th>Data/Hora</th>
				<th>Vl. compra</th>
				<th>Taxa</th>
				<th>Pagto.</th>
			</tr>
			<?php
				$criteria = new Criteria();
				$criteria->add( CashTablePlayerBuyinPeer::CASH_TABLE_ID, $cashTableObj->getId() );
				$criteria->add( CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $cashTableObj->getCashTableSessionId() );
				$criteria->addAscendingOrderByColumn( CashTablePlayerBuyinPeer::ID );
				$cashTablePlayerBuyinObjList = CashTablePlayerBuyinPeer::doSelect($criteria);
				
				$payMethodIdCheck      = VirtualTable::getIdByTagName('payMethod', 'check');
				$payMethodIdDatedCheck = VirtualTable::getIdByTagName('payMethod', 'datedCheck');
				
				$class = 'even';
				$totalBuyin       = 0;
				$totalEntranceFee = 0;
				foreach($cashTablePlayerBuyinObjList as $cashTablePlayerBuyinObj):
					
					$class = ($class=='odd'?'even':'odd');
					
					$payMethodId       = $cashTablePlayerBuyinObj->getPayMethodId();
					$buyin             = $cashTablePlayerBuyinObj->getBuyin();
					$entranceFee       = $cashTablePlayerBuyinObj->getEntranceFee();
					$totalBuyin       += $buyin;
					$totalEntranceFee += $entranceFee;
			?>
			<tr class="<?php echo $class ?>">
				<td class="textB"><?php echo $cashTablePlayerBuyinObj->getPeople()->getName() ?></td>
				<td width="15%" class="textC"><?php echo $cashTablePlayerBuyinObj->getCreatedAt('d/m/Y H:i') ?></td>
				<td width="10%" class="textR"><?php echo Util::formatFloat($buyin, true) ?></td>
				<td width="10%" class="textR"><?php echo Util::formatFloat($entranceFee, true) ?></td>
				<td width="15%"><?php echo $cashTablePlayerBuyinObj->getPayMethod()->getDescription() ?></td>
			</tr>
			
			<?php
				if( in_array($payMethodId, array($payMethodIdCheck, $payMethodIdDatedCheck)) ):
					$clubCheckObj = $cashTablePlayerBuyinObj->getClubCheck();
			?>
			<tr class="<?php echo $class ?>">
				<td colspan="5" class="checkInfo">
					<span>Número: </span><label><?php echo $clubCheckObj->getCheckNumber() ?></label>
					<span>Emitente: </span><label><?php echo $clubCheckObj->getCheckNominal() ?></label>
					<span>Banco: </span><label><?php echo $clubCheckObj->getCheckBank() ?></label>
					<span>Data: </span><label><?php echo $clubCheckObj->getCheckDate('d/m/Y') ?></label>
				</td>
			</tr>
			<?php endif; ?>
			
			<?php endforeach; ?>
			<tr> 
				<th colspan="2"class="textR">Subtotal</th>
				<th class="textR"><?php echo Util::formatFloat($totalBuyin, true) ?></th>
				<th class="textR"><?php echo Util::formatFloat($totalEntranceFee, true) ?></th>
				<th></th>
			</tr>
			<tr> 
				<th colspan="2" class="textR">TOTAL</th>
				<th colspan="2" class="textR"><?php echo Util::formatFloat($totalBuyin+$totalEntranceFee, true) ?></th>
				<th></th>
			</tr>
	</table>

</body>
</html>

