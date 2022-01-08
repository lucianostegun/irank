<?php
	$peopleId = $sf_user->getAttribute('peopleId');
	
	if( !$peopleId )
		return;
	
	$whereList = array('people_id = '.$peopleId);
	$nl = chr(10);
	
	foreach($keyWordList as $keyWord){
		
		$where = '';

		if( preg_match('/buyin:/i', $keyWord) ){
			
			$keyWord = trim(str_ireplace('buyin:', '', $keyWord));
			$keyWord = preg_replace('/[^0-9\-,\.]/', '', $keyWord);
			$keyWord = $keyWord.'-'.$keyWord;
			list($buyinMin, $buyinMax) = explode('-', $keyWord);
			
			$buyinMin = Util::formatFloat($buyinMin);
			$buyinMax = Util::formatFloat($buyinMax);
			
			$buyinMin = is_numeric($buyinMin)?$buyinMin:0;
			$buyinMax = is_numeric($buyinMax)?$buyinMax:0;
			
			$where = "buyin BETWEEN $buyinMin AND $buyinMax";
		}elseif( Validate::validateDate($keyWord) ){
			
			$date = Util::formatDate($keyWord);
			$where = "event_date = '$date'$nl";
		}elseif( Validate::validateMonthYear($keyWord) ){
			
			$date      = Util::formatDate('01/'.$keyWord);
			$timestamp = strtotime($date);
			$dateStart = date('Y-m-d', mktime(0,0,0,date('m', $timestamp),1,date('Y', $timestamp)));
			$dateEnd   = date('Y-m-d', mktime(0,0,0,date('m', $timestamp)+1,0,date('Y', $timestamp)));
			$where = "event_date BETWEEN '$dateStart' AND '$dateEnd'$nl";
		}elseif( $month=array_search($keyWord, Util::getMonthNames(true)) ){
			
			$dateStart = date('Y-m-d', mktime(0,0,0,$month,1,date('Y')));
			$dateEnd   = date('Y-m-d', mktime(0,0,0,$month+1,0,date('Y')));
			$where = "event_date BETWEEN '$dateStart' AND '$dateEnd'$nl";
		}elseif( $keyWord >= 2011 && $keyWord <= date('Y')+3 ){
			
			$dateStart = date('Y-m-d', mktime(0,0,0,1,1,$keyWord));
			$dateEnd   = date('Y-m-d', mktime(0,0,0,12,31,$keyWord));
			$where = "event_date BETWEEN '$dateStart' AND '$dateEnd'$nl";
		}elseif( preg_match('/(hoje|ontem|amanh[aã])/i', $keyWord) ){
			
			switch($keyWord){
				case 'ontem':
					$incrase = -1;
					break;
				case 'hoje':
					$incrase = 0;
					break;
				case 'amanha':
					$incrase = 1;
					break;
			}
			
			$date = date('Y-m-d', mktime(0,0,0, date('m'), date('d')+$incrase, date('Y')));
			$where = "event_date = '$date'";
		}elseif( preg_match('/!?free?roo?ll?/i', $keyWord) ){
			
			$where = (preg_match('/!/', $keyWord)?'NOT ':'').'is_freeroll';
		}else{
			
			$where  = "(no_accent(event_name) ILIKE '%$keyWord%' ";
			$where .= "OR no_accent(ranking_name) ILIKE '%$keyWord%' ";
			$where .= "OR no_accent(comments) ILIKE '%$keyWord%')";
		}
		
		if( empty($where) )
			continue;
		
		$whereList[] = $where;
	}
	
	$whereClause = implode(chr(10).chr(9).'AND ', $whereList);
	
	$sql = "SELECT id, event_name, event_date_time, buyin, entrance_fee, is_freeroll, place_name, ranking_name FROM event_search WHERE $whereClause ORDER BY event_date_time DESC";
	
	$resultSet   = Util::executeQuery($sql);
	$recordIndex = 0;
	$recordCount = $resultSet->getRecordCount();
	
	$plural = ($recordCount==1?'':'s');
	
	if( $recordCount==0 ):
?>
	<div class="moduleIntro">Não foram encontrados eventos <b>HOME</b> para "<b><?php echo $originalKeyWord ?></b>"</div>
<?php else: ?>
	<div class="moduleIntro">
		<br/>
		<span class="recordCount"><?php echo $recordCount ?></span> evento<?php echo $plural ?> <b>HOME</b> encontrado<?php echo $plural ?>
		<hr/>
	</div>

<table border="0" cellspacing="0" cellpadding="0" class="searchTable">
	<tr class="header">
		<th class="first">Data/Hora</th>
		<th>Evento</th>
		<th>Local</th>
		<th>Ranking</th>
		<th>Buyin</th>
	</tr>
<?php
	while($resultSet->next()):
	
		$eventLiveId   = $resultSet->getInt(1);
		$eventName     = $resultSet->getString(2);
		$eventDateTime = $resultSet->getTimestamp(3);
		$buyin         = $resultSet->getFloat(4);
		$entranceFee   = $resultSet->getFloat(5);
		$isFreeroll    = $resultSet->getBoolean(6);
		$placeName     = $resultSet->getString(7);
		$rankingName   = $resultSet->getString(8);
		
		$entranceFee = Util::formatFloat($entranceFee, true);
		$entranceFee = preg_replace('/[,\.]00$/', '', $entranceFee);
		
		$trClass = ($recordIndex%2==0?'':'odd');
		$trClass .= ($recordIndex+1==$recordCount?' last':'');
		$trClass .= ($isFreeroll?' freeroll':'');
		$recordIndex++;
		
		$onclick = "goToPage('event', 'show', 'eventId', $eventLiveId)";
?>
<tr class="<?php echo $trClass ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" title="Abrir detalhes do evento" onclick="<?php echo $onclick ?>">
	<td class="first"><?php echo date('d/m/Y H:i', strtotime($eventDateTime)) ?></td>
	<td><?php echo $eventName ?></td>
	<td><?php echo $placeName ?></td>
	<td><?php echo $rankingName ?></td>
	<td class="buyin"><?php echo ($entranceFee?$entranceFee.($buyin?'+':''):'').($buyin?Util::formatFloat($buyin, true):($isFreeroll?'Freeroll':'')) ?></td>
</tr>
<?php endwhile ?>
</table>
<?php endif; ?>