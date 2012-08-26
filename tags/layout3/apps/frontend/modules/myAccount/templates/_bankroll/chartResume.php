<table cellspacing="0" cellpadding="0" class="dashboard chart">
<tr>
	<td style="width: 600px">
	<?php
		$urlChart = url_for('myAccount/resumeChart?year='.date('Y').'&type=png', true);
		echo link_to(image_tag($urlChart), $urlChart);
	?>
	</td>
	<td valign="top">
		<table cellspacing="0" cellpadding="0" class="chart">
			<tr>
				<th><h1 class="up">Melhor vitória</h1></th>
			</tr>
			<tr>
				<th class="textL" style="width: 250px">
					<?php
						$resultSet = Util::executeQuery("SELECT * FROM bankroll WHERE (people_id = $peopleId OR user_site_id = $userSiteId) AND prize > 0 ORDER BY (prize-buyin-rebuy-addon-entrance_fee) DESC LIMIT 1");
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
							    $players       = ($players?$players:'Não informado');
							    $eventPosition = ($eventPosition?'#'.$eventPosition:'Não informado');
							    
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
						$resultSet = Util::executeQuery("SELECT * FROM bankroll WHERE (people_id = $peopleId OR user_site_id = $userSiteId) AND id <> $eventId ORDER BY (prize-buyin-rebuy-addon-entrance_fee) ASC LIMIT 1");
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
							    $players       = ($players?$players:'Não informado');
							    $eventPosition = ($eventPosition?'#'.$eventPosition:'Não informado');
							    
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