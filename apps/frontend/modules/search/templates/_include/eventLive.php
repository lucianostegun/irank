<?php
	$whereList = array('true');
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
			
			$where = "buyin BETWEEN $buyinMin AND $buyinMax$nl";
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
			$where = "event_date = '$date'$nl";
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
		}elseif( preg_match('/!?free?roo?ll?/i', $keyWord) ){
			
			$where = (preg_match('/!/', $keyWord)?'NOT ':'').'is_freeroll'.$nl;
			if( !strstr('!', $keyWord) ){
				
				$where  = "($where OR no_accent(event_name) ILIKE '%freeroll%' $nl";
				$where .= "OR no_accent(event_short_name) ILIKE '%freeroll%') $nl";
			}
		}else{
			
			$keyWord = preg_replace('/[^a-zA-Z0-9\.]/', '%', $keyWord);
			$where  = "(no_accent(event_name) ILIKE '%$keyWord%' $nl";
			$where .= "OR no_accent(event_short_name) ILIKE '%$keyWord%' $nl";
			$where .= "OR no_accent(ranking_name) ILIKE '%$keyWord%' $nl";
			$where .= "OR no_accent(club_name) ILIKE '%$keyWord%' $nl";
			$where .= "OR no_accent(city_name) ILIKE '%$keyWord%' $nl";
			$where .= "OR no_accent(initial) ILIKE '%$keyWord%' $nl";
			$where .= "OR no_accent(address_quarter) ILIKE '%$keyWord%' $nl";
			$where .= "OR no_accent(description) ILIKE '%$keyWord%')$nl";
		}

		if( empty($where) )
			continue;
		
		$whereList[] = $where;
	}
	
	$whereClause = implode(chr(10).chr(9).'AND ', $whereList);
	
	$sql = "SELECT$nl id, event_live_schedule_id, step_number, event_name, step_day, event_date_time, buyin, entrance_fee, is_freeroll, club_name, city_name, initial$nl FROM$nl event_live_search$nl WHERE$nl $whereClause$nl ORDER BY event_date_time ASC";
//	echo "<Pre>$sql";exit;
	
	$resultSet   = Util::executeQuery($sql);
	$recordIndex = 0;
	$recordCount = $resultSet->getRecordCount();
	
	$plural = ($recordCount==1?'':'s');
	
	if( $recordCount==0 ):
?>
	<div class="moduleIntro">Não foram encontrados eventos ao vivo para "<b><?php echo $originalKeyWord ?></b>"</div>
<?php else: ?>
	<div class="moduleIntro">
		<span class="recordCount"><?php echo $recordCount ?></span> evento<?php echo $plural ?> <b>AO VIVO</b> encontrado<?php echo $plural ?>
		<hr/>
	</div>
	<?php include_partial('search/include/eventLiveDetails') ?>

<table border="0" cellspacing="0" cellpadding="0" class="searchTable">
	<tr class="header">
		<th class="first">Data/Hora</th>
		<th>Etapa</th>
		<th>Local</th>
		<th>Buyin</th>
	</tr>
<?php
	while($resultSet->next()):
	
		$eventLiveId         = $resultSet->getInt(1);
		$eventLiveScheduleId = $resultSet->getInt(2);
		$stepNumber          = $resultSet->getString(3);
		$eventName           = $resultSet->getString(4);
		$stepDay             = $resultSet->getString(5);
		$eventDateTime       = $resultSet->getTimestamp(6);
		$buyin               = $resultSet->getFloat(7);
		$entranceFee         = $resultSet->getFloat(8);
		$isFreeroll          = $resultSet->getBoolean(9);
		$clubName            = $resultSet->getString(10);
		$cityName            = $resultSet->getString(11);
		$initial             = $resultSet->getString(12);
		
		$eventName = ($stepNumber?$stepNumber.' ª Etapa ':'').$eventName.($stepDay?' - Dia '.$stepDay:'');
		
		$entranceFee = Util::formatFloat($entranceFee, true);
		$entranceFee = preg_replace('/[,\.]00$/', '', $entranceFee);
		
		$trClass = ($recordIndex%2==0?'':'odd');
		$trClass .= ($recordIndex+1==$recordCount?' last':'');
		$trClass .= ($isFreeroll?' freeroll':'');
		$recordIndex++;
		
		$onclick     = "goToPage('eventLive', 'details', 'id', $eventLiveId)";
		$onclickInfo = "loadEventLiveDetails($eventLiveId)";
?>
<tr class="<?php echo $trClass ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" title="Abrir detalhes do evento">
	<td onclick="<?php echo $onclick ?>" class="first"><?php echo date('d/m/Y H:i', strtotime($eventDateTime)) ?></td>
	<td onclick="<?php echo $onclick ?>"><?php echo $eventName ?></td>
	<td onclick="<?php echo $onclick ?>"><?php echo $clubName ?> - <?php echo $cityName ?>, <?php echo $initial ?></td>
	<td onclick="<?php echo $onclick ?>" class="buyin"><?php echo ($entranceFee?$entranceFee.($buyin?'+':''):'').($buyin?Util::formatFloat($buyin, true):($isFreeroll?'Freeroll':'')) ?></td>
	<td onclick="<?php echo $onclickInfo ?>" class="info"><?php echo image_tag('icon/info', array('title'=>'Detalhe rápido do evento')) ?></td>
</tr>
<?php endwhile ?>
</table>
<?php endif; ?>