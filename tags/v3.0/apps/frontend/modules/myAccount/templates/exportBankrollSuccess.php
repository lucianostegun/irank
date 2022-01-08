<html>
<head>
<style>
	* {
		padding: 0;
		margin: 0;
		font-family: 	helvetica;
		font-size: 12px;
	}
	
	.page {
		page-break-after: always;
	}
	
	<?php
		$content = file_get_contents(Util::getFilePath('/css/bankroll.css'));
		echo $content;
		
		$content = file_get_contents(Util::getFilePath('/css/reset.css'));
		echo $content;
	?>
	
h1.startBankroll {

	width: 100%;
	padding: 3mm 5mm 3mm 5mm;
}

h1.startBankroll span {

	position: relative;
	margin-left: 3mm;
	font-size: 18px;
	display: inline-block;
	text-align: left;
}

h1.startBankroll img {

	position: absolute;
	right: 35mm;
	top: 1mm
}
	
table.dashboard {

	padding: 5mm;
	margin-left: 10mm;
	width: 220mm;
}

table.dashboard.chart {

	margin-left: 10mm;
	padding-left: 0mm;
	height: 90mm;
}

table.dashboard.chart tr td.chart {

	padding-right: 5mm
}

table.dashboard.chart tr * {

	font-size: 8pt;
}

table.dashboard.chart hr {

	margin-bottom: 3mm
}

table.bankroll {

	width: auto;
	margin-left: 17mm;
	margin-top: 5mm;
}

h1.startBankroll.yearHeader {

	font-size: 16pt;
}





div.footer {
	
	position: absolute;
	bottom: 0mm;
	left: 0mm;
	width: 100%;
	height: 15mm;
	border-top: thin solid #909090;
	background: #F0F0F0
}

div.footer img {
	
	position: absolute;
	left: 5mm;
	top: 3mm;
}

div.footer h1 {
	
	text-align: left;
	width: auto;
	margin: 0;
	padding: 0;
	font-size: 4mm;
	font-weight: bold;
	position: absolute;
	left: 45mm;
	top: 3mm;
}

div.footer h2 {
	
	width: auto;
	margin: 0;
	padding: 0;
	font-size: 3mm;
	font-weight: normal;
	position: absolute;
	left: 45mm;
	top: 8mm;
}

.mt5 { margin-top: 5mm }
</style>
</head>
<body>
<div class="page">
<?php
	$startBankroll = $userSiteObj->getStartBankroll();

	$currentYear = date('Y');
	
	$sql = "SELECT * FROM bankroll WHERE user_site_id = $userSiteId OR people_id = $peopleId ORDER BY event_date";
	$resultSet = Util::executeQuery($sql);
	
	if( $throwException && $resultSet->getRecordCount()==0 )
		throw new Exception('zeroInfo');
	
	$bankrollList = array();
	$lastYear      = null;
	$lastYearMonth = null;
	
	$balanceSum   = 0;
	$balanceTotal = 0;

	$eventList = array();
	while($resultSet->next()){
		
		$eventId       = $resultSet->getInt(1);
	    $eventDate     = $resultSet->getTimestamp(2);
	    $eventName     = $resultSet->getString(3);
	    $eventPosition = $resultSet->getInt(4);
	    $players       = $resultSet->getInt(5);
	    $buyin         = $resultSet->getFloat(6);
	    $entranceFee   = $resultSet->getFloat(7);
	    $rebuy         = $resultSet->getFloat(8);
	    $addon         = $resultSet->getFloat(9);
	    $prize         = $resultSet->getFloat(10);
	    $eventPlace    = $resultSet->getString(13);
	    $eventType     = $resultSet->getString(14);
	    
	    $year  = date('Y', strtotime($eventDate));
	    $month = date('m', strtotime($eventDate));
	    
	    $balance = $prize-$buyin-$rebuy-$addon-$entranceFee;
	    
	    if( !is_null($lastYear) && $year!=$lastYear ){

	    	$bankrollList[$lastYear]['balanceEnd'] = $balanceSum;
	    	$bankrollList[$lastYear]['balance']    = $balanceTotal;
	    	$bankrollList[$year]['balanceStart']   = $balanceSum;
	    	$bankrollList[$lastYear]['events']     = $eventList;
	    	
	    	$balanceSum = 0;
	    	$eventList  = array();
	    }
    	
	    $balanceSum   += $balance;
	    $balanceTotal += $balance;
	    
	    $eventList[] = array('id'=>$eventId,
		    				 'eventType'=>$eventType,
		    				 'eventName'=>$eventName,
		    				 'eventDate'=>$eventDate,
		    				 'eventPosition'=>$eventPosition,
		    				 'players'=>$players,
		    				 'buyin'=>$buyin,
		    				 'entranceFee'=>$entranceFee,
		    				 'rebuy'=>$rebuy,
		    				 'addon'=>$addon,
		    				 'prize'=>$prize);

		$lastYear  = $year;
		$lastMonth = $month;
	}
	
	if( $resultSet->getRecordCount() ){
		
		$bankrollList[$year]['balanceEnd'] = $balanceSum;
		$bankrollList[$year]['balance']    = $balanceTotal;
		$bankrollList[$year]['events']     = $eventList;
	}
	
	$lastYear = Util::executeOne("SELECT COALESCE(MAX(EXTRACT(YEAR FROM event_date)), EXTRACT(YEAR FROM current_date)) FROM bankroll WHERE (people_id = $peopleId OR user_site_id = $userSiteId) LIMIT 1");
	
	include_partial('myAccount/bankroll/startBankroll', array('edit'=>false, 'startBankroll'=>$startBankroll));
	
	include_partial('myAccount/bankroll/topResume', array('peopleId'=>$peopleId, 'startBankroll'=>$startBankroll, 'userSiteId'=>$userSiteId, 'year'=>null));
	
	if( $lastYear )
		include_partial('myAccount/bankroll/chartResume', array('peopleId'=>$peopleId, 'startBankroll'=>$startBankroll, 'userSiteId'=>$userSiteId, 'year'=>$lastYear, 'pdf'=>true));

	$buyinFinal       = 0;
    $rebuyFinal       = 0;
    $addonFinal       = 0;
    $prizeFinal       = 0;
    $entranceFeeFinal = 0;
	$balanceFinal     = $startBankroll;

	foreach($bankrollList as $year=>$bankroll):
		
		$currentHeight = 22;	
		echo getNewPage();
?>
<div id="<?php echo $year==$currentYear?'now':$year ?>" class="pt10"></div>
<h1 class="startBankroll yearHeader">Lista de eventos de <?php echo $year ?></h1>
<table class="bankroll" border="0" cellpadding="0" cellspacing="0">
<tbody id="bankrollEventBody">
	<?php
		$className     = 'even';
		$lastYear      = null;
		$lastYearMonth = null;
		
		$balanceYear    = 0;
		$buyinSum       = 0;
	    $rebuySum       = 0;
	    $addonSum       = 0;
	    $prizeSum       = 0;
	    $entranceFeeSum = 0;
		
		?>
		<tr>
			<th class="textC">Data</th>
			<th class="textL" width="130">Evento</th>
			<th class="textC">Posição</th>
			<th class="textR value">Buy-in</th>
			<th class="textR value">Rebuy</th>
			<th class="textR value">Add-on</th>
			<th class="textR value">Taxa</th>
			<th class="textR value">Prêmio</th>
			<th class="textR value">Saldo</th>
		</tr>
	<?php
		
		$currentHeight += 5;
			
		foreach($bankroll['events'] as $event):
		
			$eventId       = $event['id'];
		    $eventDate     = $event['eventDate'];
		    $eventName     = $event['eventName'];
		    $eventPosition = $event['eventPosition'];
		    $players       = $event['players'];
		    $buyin         = $event['buyin'];
		    $entranceFee   = $event['entranceFee'];
		    $rebuy         = $event['rebuy'];
		    $addon         = $event['addon'];
		    $prize         = $event['prize'];
		    $eventType     = $event['eventType'];
		    
		    $balance = $prize-$buyin-$rebuy-$addon-$entranceFee;
		    
		    $buyinSum       += $buyin;
		    $rebuySum       += $rebuy;
		    $addonSum       += $addon;
		    $prizeSum       += $prize;
		    $entranceFeeSum += $entranceFee;

		    $buyinFinal       += $buyin;
		    $rebuyFinal       += $rebuy;
		    $addonFinal       += $addon;
		    $prizeFinal       += $prize;
		    $entranceFeeFinal += $entranceFee;
		    
		    $balanceFinal += $balance;
		    $balanceYear  += $balance;
		    
		    $className = ($className=='even'?'odd':'even');
	?>
	<tr class="<?php echo $className.' year-'.$year ?>">
		<td class="textC"><?php echo date('d/m/Y', strtotime($eventDate)) ?></td>
		<td><?php echo truncate_text($eventName, 32) ?></td>
		<td class="textC"><?php echo "$eventPosition/$players" ?></td>
		<td class="textR"><?php echo Util::formatFloat($buyin, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($rebuy, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($addon, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($entranceFee, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($prize, true) ?></td>
		<td class="textR <?php echo ($balance>0?'positive':'negative') ?>"><?php echo Util::formatFloat($balance, true) ?></td>
	</tr>
<?php
		$currentHeight += 5;
		if( $currentHeight >= 280 ):
			$currentHeight = 0;
?>
	<tr>
		<td colspan="9" style="padding: 0px">
			<img src="[webDir]/images/blank.gif" style="width: 200mm; height: 1mm"/>
		</td>
	</tr>
</tbody>
</table>
<?php echo getNewPage(); ?>
<table class="bankroll mt5" border="0" cellpadding="0" cellspacing="0">
<tbody id="bankrollEventBody">
		<tr>
			<th class="textC">Data</th>
			<th class="textL" width="130">Evento</th>
			<th class="textC">Posição</th>
			<th class="textR value">Buy-in</th>
			<th class="textR value">Rebuy</th>
			<th class="textR value">Add-on</th>
			<th class="textR value">Taxa</th>
			<th class="textR value">Prêmio</th>
			<th class="textR value">Saldo</th>
		</tr>
<?php
		endif;
	endforeach;
?>
	<tr class="final odd">
		<td class="textL" colspan="3">SALDO <?php echo $year ?></td>
		<td class="textR"><?php echo Util::formatFloat($buyinSum, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($rebuySum, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($addonSum, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($entranceFeeSum, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($prizeSum, true) ?></td>
		<td class="textR <?php echo ($balanceYear>0?'positive':'negative') ?>"><?php echo Util::formatFloat($balanceYear, true) ?></td>
	</tr>
	<tr class="final last odd">
		<td class="textL" colspan="3">BANKROLL <?php echo $year ?></td>
		<td class="textR"><?php echo Util::formatFloat($buyinFinal, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($rebuyFinal, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($addonFinal, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($entranceFeeFinal, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($prizeFinal, true) ?></td>
		<td class="textR <?php echo ($balanceFinal>0?'positive':'negative') ?>"><?php echo Util::formatFloat($balanceFinal, true) ?></td>
	</tr>
	<tr>
		<td class="textL <?php echo 'year-'.$year ?>" colspan="9" style="padding: 0px">
			<?php
				$urlChart = url_for("myAccount/bankrollChart?year=$year&peopleId=$peopleId&userSiteId=$userSiteId", true);
				echo image_tag($urlChart);
			?>
		</td>
	</tr>
<?php
	$currentHeight += 75;
    $className = ($className=='even'?'odd':'even');
?>
</tbody>
</table>
<?php
	endforeach;

	echo getFooter();

function getNewPage(){
	
	return getFooter().'</div><div class="page">';
}

function getFooter(){
	
	return '<div class="footer"><img src="[webDir]/images/logo/pdf.png"><h1>iRank - Poker Ranking</h1><h2>www.irank.com.br</h2></div>';
}
?>