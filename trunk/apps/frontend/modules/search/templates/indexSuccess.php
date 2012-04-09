<?php

	include_partial('home/component/commonBar', array('pathList'=>array('Pesquisa'=>$moduleName, $keyWord=>null)));

	$keyWord = str_replace('  ', '', $keyWord);
	$keyWord = preg_replace('/ *- */', '-', $keyWord);
	$keyWord = preg_replace('/: */', ':', $keyWord);
	$keyWord = String::removeAccents($keyWord);
	$keyWord = strtolower($keyWord);
	$keyWordList = explode(' ', $keyWord);
	
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
			
			$where = "buyin BETWEEN $buyinMin AND $buyinMax";
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
			$where .= "OR no_accent(event_short_name) ILIKE '%$keyWord%' ";
			$where .= "OR no_accent(ranking_name) ILIKE '%$keyWord%' ";
			$where .= "OR no_accent(club_name) ILIKE '%$keyWord%' ";
			$where .= "OR no_accent(city_name) ILIKE '%$keyWord%' ";
			$where .= "OR no_accent(initial) ILIKE '%$keyWord%' ";
			$where .= "OR no_accent(description) ILIKE '%$keyWord%')";
		}
		
		if( empty($where) )
			continue;
		
		$whereList[] = $where;
	}
	
	$whereClause = implode(chr(10).chr(9).'AND ', $whereList);
	
	$sql = "SELECT id, event_name, event_date_time, buyin, entrance_fee, is_freeroll, club_name, city_name, initial FROM event_live_search WHERE $whereClause ORDER BY event_date_time DESC";
	
	$resultSet = Util::executeQuery($sql);
?>

<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th class="first">Data/Hora</th>
		<th>Etapa</th>
		<th>Local</th>
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
		$clubName      = $resultSet->getString(7);
		$cityName      = $resultSet->getString(8);
		$initial       = $resultSet->getString(9);
		
		$buyin = Util::formatFloat($buyin, true);
		$buyin = preg_replace('/[,\.]00$/', '', $buyin);
		
		$entranceFee = Util::formatFloat($entranceFee, true);
		$entranceFee = preg_replace('/[,\.]00$/', '', $entranceFee);
?>
<tr>
	<td><?php echo date('d/m/Y H:i', strtotime($eventDateTime)) ?></td>
	<td><?php echo $eventName ?></td>
	<td><?php echo $clubName ?> - <?php echo $cityName ?>, <?php echo $initial ?></td>
	<td style="text-align: right"><?php echo ($entranceFee?$entranceFee.($buyin?'+':''):'').($buyin?$buyin:($isFreeroll?'Freeroll':'')) ?></td>
</tr>
<?php endwhile ?>
</table>












