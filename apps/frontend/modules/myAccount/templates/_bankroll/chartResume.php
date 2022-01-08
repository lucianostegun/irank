<?php
	$width  = ($pdf?'140mm':'600px');
	$width2 = ($pdf?'50mm':'250px');
	
	$whereYear = ($year?" AND event_date BETWEEN '$year-01-01' AND '$year-12-31'":"");
	
	$year = ($year?$year:date('Y'));
?>
<table cellspacing="0" cellpadding="0" class="dashboard chart">
<tr>
	<td style="width: <?php echo $width ?>" class="chart">
	<?php
		$urlChart = url_for('myAccount/resumeChart?year='.$year.'.png', true);
//		$urlChart = str_replace('/frontend_dev.php', '', $urlChart);
		if( $pdf )
			echo image_tag($urlChart.'&peopleId='.$peopleId.'&userSiteId='.$userSiteId);
		else
			echo link_to(image_tag($urlChart, array('id'=>'bankrollTopChartResumeImage')), $urlChart, array('id'=>'bankrollTopChartResumeLink'));
	?>
	</td>
	<td valign="top">
		<table cellspacing="0" cellpadding="0" class="chart">
			<tr>
				<th><h1 class="up">Melhor vitória</h1></th>
			</tr>
			<tr>
				<th class="textL" style="width: <?php echo $width2 ?>">
					<?php
						$resultSet = Util::executeQuery("SELECT * FROM bankroll WHERE (people_id = $peopleId OR user_site_id = $userSiteId) AND prize > 0 $whereYear ORDER BY (prize-buyin-rebuy-addon-entrance_fee) DESC LIMIT 1");
						$eventId   = 0;
						
						if( $resultSet->getRecordCount() > 0 ){
							
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
							    
							    $totalPaid = ($buyin+$rebuy+$addon+$entranceFee);
							    $profit    = Util::formatFloat($prize-$totalPaid, true);
							    $totalPaid = Util::formatFloat($buyin+$rebuy+$addon+$entranceFee, true);
							    $prize     = Util::formatFloat($prize, true);
							    
							    $eventDate     = date('d/m/Y', strtotime($eventDate));
							    $players       = ($players?$players:'N/D');
							    $eventPosition = ($eventPosition?'#'.$eventPosition:'N/D');
							    
							    echo "<b>$eventDate - $eventName</b> @$eventPlace<hr/>
										<span>Jogadores:</span> <b>$players</b><br/>
										<span>Posição:</span> <b>$eventPosition</b><br/>
										<span>BRA:</span> <b>$totalPaid</b><br/>
										<span>Prêmio:</span> <b>$prize</b><br/>
										<span>Lucro:</span> <b>$profit</b>";
							}
						}else{
							
							echo 'Nenhum evento';
						}
					?>
				</th>
			</tr>
			<tr>
				<th style="padding-top: 20px"><h1 class="down">Pior derrota</h1></th>
			</tr>
			<tr>
				<th class="textL">
					<?php
						$resultSet = Util::executeQuery("SELECT * FROM bankroll WHERE (people_id = $peopleId OR user_site_id = $userSiteId) AND id <> $eventId $whereYear ORDER BY (prize-buyin-rebuy-addon-entrance_fee) ASC LIMIT 1");
						if( $resultSet->getRecordCount() > 0 ){
							
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
							    
							    $totalPaid = ($buyin+$rebuy+$addon+$entranceFee);
							    $profit    = Util::formatFloat($prize-$totalPaid, true);
							    $totalPaid = Util::formatFloat($buyin+$rebuy+$addon+$entranceFee, true);
							    $prize     = Util::formatFloat($prize, true);
							    
							    $eventDate     = date('d/m/Y', strtotime($eventDate));
							    $players       = ($players?$players:'N/D');
							    $eventPosition = ($eventPosition?'#'.$eventPosition:'N/D');
							    
							    echo "<b>$eventDate - $eventName</b> @$eventPlace<hr/>
										<span>Jogadores:</span> <b>$players</b><br/>
										<span>Posição:</span> <b>$eventPosition</b><br/>
										<span>BRA:</span> <b>$totalPaid</b><br/>
										<span>Prêmio:</span> <b>$prize</b><br/>
										<span>Prejuízo:</span> <b>$profit</b>";
							}
						}else{
							
							echo 'Nenhum evento';
						}
					?>
				</th>
			</tr>
		</table>
	</td>
</tr>
</table>