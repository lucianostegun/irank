<?php
	sfContext::getInstance()->getResponse()->addJavascript('eventLiveCalendar');
	sfContext::getInstance()->getResponse()->addStylesheet('eventLiveCalendar');
	
	$month         = $sf_request->getParameter('month', date('m'));
	$year          = $sf_request->getParameter('year', date('Y'));
	
	$monthDays     = Util::getMonthDays($month, $year);
	$monthDaysPrev = Util::getMonthDays(($month==1?12:$month-1), ($month==1?$year-1:$year));
	$weeks         = ceil($monthDays/7);
	$startDay      = date('w', mktime(0,0,0,$month,1,$year));
	
	$previousMonth = ($month==1?12:$month-1);
	$nextMonth     = ($month==12?1:$month+1);
	$nextYear      = ($month==12?$year+1:$year);
	$previousYear  = ($month==1?$year-1:$year);
	
	$clubId        = $sf_request->getParameter('clubId');
	$rankingLiveId = $sf_request->getParameter('rankingLiveId');
	
	$criteria = new Criteria();
	
	if( $clubId ) $criteria->add( EventLivePeer::CLUB_ID, $clubId );
	if( $rankingLiveId ) $criteria->add( EventLivePeer::RANKING_LIVE_ID, $rankingLiveId );
	
	$criteria->add( EventLivePeer::EVENT_DATE, "$year-$month-01", Criteria::GREATER_EQUAL );
	$criteria->addAnd( EventLivePeer::EVENT_DATE, "$nextYear-$nextMonth-01", Criteria::LESS_THAN );
	$criteria->addAscendingOrderByColumn( EventLivePeer::EVENT_DATE_TIME );
	$eventLiveObjList = EventLivePeer::search($criteria);
	
	$eventLiveList = array();
	foreach($eventLiveObjList as $eventLiveObj){
		
		foreach($eventLiveObj->getScheduleList() as $eventLiveScheduleObj){
			
			$eventDateKey = $eventLiveScheduleObj->getEventDate('Ymd');
			if( !isset($eventLiveList[$eventDateKey]) )
				$eventLiveList[$eventDateKey] = array();
				
			$stepDay = $eventLiveScheduleObj->getStepDay();
			$stepDay = ($stepDay?' - Dia '.$stepDay:'');
				
			$eventLiveList[$eventDateKey][] = array('id'=>$eventLiveObj->getId(),
													'eventName'=>$eventLiveObj->toString().$stepDay);
		}
	}
	
?>
<table class="eventLiveCalendar noSelect" cellspacing="1" cellpadding="0">
	<tr class="header">
		<td><h6><?php echo link_to(' < '.Util::getMonthName($previousMonth), '#loadEventLiveCalendar('.$previousMonth.', '.$previousYear.', "'.$clubId.'", "'.$rankingLiveId.'")') ?></h6></td>
    	<td colspan="5"><h3><?php echo Util::getMonthName($month).'/'.$year ?></h3></td>
    	<td><h6><?php echo link_to(Util::getMonthName($nextMonth).' > ', '#loadEventLiveCalendar('.$nextMonth.', '.$nextYear.', "'.$clubId.'", "'.$rankingLiveId.'")') ?></h6></td>
		</td>
	</tr>
	<tr>
		<th class="weekend">Dom</th>
		<th>Seg</th>
		<th>Ter</th>
		<th>Qua</th>
		<th>Qui</th>
		<th>Sex</th>
		<th class="weekend">Sáb</th>
	</tr>
	<?php
		if( $startDay > 5 )
			$weeks++;

		$day = 1;
		$firstRun = true;
		$lastRun  = false;
		for($week=1; $week <= $weeks; $week++):
	?>
	<tr class="days">
		<?php
			for($weekDay=0; $weekDay < 7; $weekDay++):
			
				if( $day > $monthDays ){
					
					$month++;
					if( $month > 12 ){
						$month = 1;
						$year++;
					}
					
					$day = 1;
					$lastRun = true;
				}
				
				if( $firstRun && $weekDay < $startDay ){
					
					$class        = 'otherMonth';
					$displayDay   = ($monthDaysPrev-($startDay-($weekDay+1)));
					$displayMonth = $month-1;
				}else{
					
					$class        = 'currentMonth';
					$displayDay   = sprintf('%02d', $day++);
					$displayMonth = $month;
				}
				
				if( $lastRun )
					$class = 'otherMonth';
				
				$eventDate    = sprintf('%04s-%02s-%02s', $year, $displayMonth, $displayDay);
				$eventDateKey = sprintf('%04s%02s%02s', $year, $displayMonth, $displayDay);
		?>
		<td class="<?php echo $class ?> noSelect">
			<div class="calendarDay"><?php echo $displayDay ?></div>
			<div class="eventList">
				<?php
					if( isset($eventLiveList[$eventDateKey]) ){
						
						foreach($eventLiveList[$eventDateKey] as $eventLive){
							
							echo '<div class="eventLive" onclick="goToPage(\'eventLive\', \'details\', \'id\', '.$eventLive['id'].', event)">'.$eventLive['eventName'].'</div>';
						}
					}
				?>
			</div>
		</td>
		<?php endfor; ?>
	</tr>
	<?php
			$firstRun = false;
		endfor;
	?>
</table>