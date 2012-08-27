<?php
	$resumeInfo = People::getFullResume();
	
	$eventsTotal    = $resumeInfo['events']+$resumeInfo['eventsPersonal']+$resumeInfo['eventsLive'];
	$eventsTotalDiv = ($eventsTotal>0?$eventsTotal:1);
	
	$buyin        = $resumeInfo['buyin'];
    $rebuy        = $resumeInfo['rebuy'];
    $addon        = $resumeInfo['addon'];
    $prize        = $resumeInfo['prize'];
    $entranceFee  = $resumeInfo['fee'];
    $average      = $resumeInfo['average'];
	$balance      = $prize-$buyin-$rebuy-$addon-$entranceFee;
	$balanceFinal = $startBankroll+$balance;
    
    $itm = Util::executeOne("SELECT SUM(1) FROM event_player, event, ranking WHERE event_player.PEOPLE_ID = $peopleId AND event_player.ENABLED AND event_player.PRIZE > 0 AND event.VISIBLE AND event.ENABLED AND NOT event.DELETED AND event.SAVED_RESULT AND event_player.EVENT_ID=event.ID AND event.RANKING_ID=ranking.ID AND ranking.VISIBLE AND NOT ranking.DELETED", 'float');
	
	$firstEventDate = Util::executeOne("SELECT MIN(event_date) FROM bankroll WHERE (people_id = $peopleId OR user_site_id = $userSiteId) LIMIT 1", 'timestamp');
	$lastEventDate  = Util::executeOne("SELECT MAX(event_date) FROM bankroll WHERE (people_id = $peopleId OR user_site_id = $userSiteId) LIMIT 1", 'timestamp');
	
	$eventPosition = Util::executeOne("SELECT SUM(event_player.EVENT_POSITION) FROM event_player, event, ranking WHERE event_player.PEOPLE_ID = $peopleId AND event_player.ENABLED AND event.VISIBLE AND event.ENABLED AND NOT event.DELETED AND event.SAVED_RESULT AND event_player.EVENT_ID=event.ID AND event.RANKING_ID=ranking.ID AND ranking.VISIBLE AND NOT ranking.DELETED");
	$eventPlayers  = Util::executeOne("SELECT SUM(event.PLAYERS) FROM event_player, event, ranking WHERE event_player.PEOPLE_ID = $peopleId AND event_player.ENABLED AND event.VISIBLE AND event.ENABLED AND NOT event.DELETED AND event.SAVED_RESULT AND event_player.EVENT_ID=event.ID AND event.RANKING_ID=ranking.ID AND ranking.VISIBLE AND NOT ranking.DELETED");
	
	$averagePosition = round($eventPosition/$eventsTotalDiv);
	$averagePlayers  = round($eventPlayers/$eventsTotalDiv);
?>

<table cellspacing="0" cellpadding="0" class="dashboard mt10">
<tr>
	<th>Total gasto:</th><td class="textL"><?php echo Util::formatFloat($buyin+$rebuy+$addon+$entranceFee, true) ?></td>
	<th>Lucro:</th><td class="textL"><?php echo Util::formatFloat($prize, true) ?></td>
	<th>Média:</th><td class="textL"><?php echo Util::formatFloat($average, true) ?></td>
</tr>
<tr>
	<th>Gasto médio:</th><td class="textL"><?php echo Util::formatFloat(($buyin+$rebuy+$addon+$entranceFee)/$eventsTotalDiv, true) ?>/evt</td>
	<th>Retorno médio:</th><td class="textL"><?php echo Util::formatFloat($prize/$eventsTotalDiv, true) ?>/evt</td>
	<th>Taxa entrada:</th><td class="textL"><?php echo Util::formatFloat($entranceFee, true) ?></td>
</tr>
<tr>
	<th>Buy-in:</th><td class="textL"><?php echo Util::formatFloat($buyin, true) ?></td>
	<th>Rebuy:</th><td class="textL"><?php echo Util::formatFloat($rebuy, true) ?></td>
	<th>Add-on:</th><td class="textL"><?php echo Util::formatFloat($addon, true) ?></td>
</tr>
<tr>
	<th>Eventos home:</th><td class="textL"><?php echo $resumeInfo['events'] ?></td>
	<th>Eventos pessoais:</th><td class="textL"><?php echo $resumeInfo['eventsPersonal'] ?></td>
	<th>Eventos clubes:</th><td class="textL"><?php echo $resumeInfo['eventsLive'] ?></td>
</tr>
<tr>
	<th>Primeiro jogo:</th><td><?php echo ($firstEventDate?date('d/m/Y', strtotime($firstEventDate)):'-') ?></td>
	<th>Último jogo:</th><td><?php echo ($lastEventDate?date('d/m/Y', strtotime($lastEventDate)):'-') ?></td>
	<th>ITMs:</th><td><?php echo nvl($itm, 0) ?></td>
</tr>
<tr class="bigger">
	<th>Aproveitamento:</th><td class="textL"><?php echo Util::formatFloat(($itm*100/$eventsTotalDiv), true, 1) ?>%</td>
	<th>Posição média:</th><td>#<?php echo "$averagePosition/$averagePlayers" ?></td>
	<th>SALDO ATUAL:</th><td class="<?php echo ($balanceFinal<0?'negative':'positive') ?>"><?php echo Util::formatFloat($balanceFinal, true) ?></td>
</tr>
</table>