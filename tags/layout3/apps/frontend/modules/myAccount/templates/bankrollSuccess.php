<?php
	$userSiteObj   = UserSite::getCurrentUser();
	$startBankroll = $userSiteObj->getStartBankroll();
	$messageList = array();
	
	if( is_null($startBankroll) )
		$messageList['startBankroll'] = '!Você ainda não definiu seu bankroll inicial. <b>'.link_to('Atualize sua conta', 'myAccount/index', array('class'=>'red')).'</b> para atualizar seu bankroll.';
	
	include_partial('home/component/commonBar', array('pathList'=>array('Minha conta'=>'myAccount/index', 'Bankroll'=>null), 'messageList'=>$messageList));

	$peopleId   = $sf_user->getAttribute('peopleId');
	$userSiteId = $sf_user->getAttribute('userSiteId');

	$currentYear = date('Y');
	
	$sql = "SELECT * FROM bankroll WHERE user_site_id = $userSiteId OR people_id = $peopleId ORDER BY event_date";
	$resultSet = Util::executeQuery($sql);
	
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
	}else{
		
		echo '<br/><h2 class="textC">Você ainda não possui eventos para gerar seu bankroll</h2>';
		return;
	}
	
	$year = date('Y');
	
	if( !is_null($startBankroll) )
		include_partial('myAccount/bankroll/startBankroll', array('edit'=>true, 'peopleId'=>$peopleId, 'startBankroll'=>$startBankroll, 'userSiteId'=>$userSiteId));
?>
<div id="bankrollTopResume"><?php include_partial('myAccount/bankroll/topResume', array('peopleId'=>$peopleId, 'startBankroll'=>$startBankroll, 'userSiteId'=>$userSiteId, 'year'=>null)); ?></div>
<div id="bankrollChartResume"><?php include_partial('myAccount/bankroll/chartResume', array('peopleId'=>$peopleId, 'startBankroll'=>$startBankroll, 'userSiteId'=>$userSiteId, 'year'=>null, 'pdf'=>false)); ?></div>
<?php
	$buyinFinal       = 0;
    $rebuyFinal       = 0;
    $addonFinal       = 0;
    $prizeFinal       = 0;
    $entranceFeeFinal = 0;
	$balanceFinal     = $startBankroll;
	
	foreach($bankrollList as $year=>$bankroll):
?>
<div id="<?php echo $year==$currentYear?'now':$year ?>" class="pt10"></div>
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
		<tr class="year">
			<td class="textL" colspan="7"><?php echo $year ?></td>
			<td class="textR expand" colspan="9">
				<?php
					if( $year!=$currentYear )
						echo link_to('detalhes', '#toggleBankroll('.$year.')', array('class'=>'expand', 'id'=>'togglerLink-'.$year));
				?>
			</td>
		</tr>
		<tr>
			<th class="textC">Data</th>
			<th class="textL">Evento</th>
			<th class="textC">Posição</th>
			<th class="textR value">Buy-in</th>
			<th class="textR value">Rebuy</th>
			<th class="textR value">Add-on</th>
			<th class="textR value">Taxa</th>
			<th class="textR value">Prêmio</th>
			<th class="textR value">Saldo</th>
		</tr>
		<?php
		
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
		    
		    $hidden = ($year!=$currentYear);
		    
		    $className = ($className=='even'?'odd':'even');
		    
		    $link = "goModule('$eventType', 'edit', 'id', $eventId, true)";
	?>
	<tr class="hoverable <?php echo $className.' year-'.$year.' '.($hidden?'hidden':'') ?>" onclick="<?php echo $link ?>">
		<td class="textC"><?php echo date('d/m/Y', strtotime($eventDate)) ?></td>
		<td><?php echo $eventName ?></td>
		<td class="textC"><?php echo "$eventPosition/$players" ?></td>
		<td class="textR"><?php echo Util::formatFloat($buyin, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($rebuy, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($addon, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($entranceFee, true) ?></td>
		<td class="textR"><?php echo Util::formatFloat($prize, true) ?></td>
		<td class="textR <?php echo ($balance>0?'positive':'negative') ?>"><?php echo Util::formatFloat($balance, true) ?></td>
	</tr>
<?php endforeach; ?>
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
		<td class="textL <?php echo 'year-'.$year.' '.($hidden?'hidden':'') ?>" colspan="9" style="padding: 0px">
			<?php
				$urlChart = url_for('myAccount/bankrollChart?year='.$year.'&type=png', true);
				echo link_to(image_tag($urlChart), $urlChart);
			?>
		</td>
	</tr>
<?php
    $className = ($className=='even'?'odd':'even');
?>
</tbody>
</table>
<br/>
<br/>
<?php endforeach; ?>