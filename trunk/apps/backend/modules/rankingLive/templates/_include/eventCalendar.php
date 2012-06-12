<?php
	echo input_hidden_tag('quickEventEventDateList', null, array('id'=>'rankingLiveQuickEventEventDate'));
	
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
?>
    <table width="350" cellspacing="0" cellpadding="0" class="quickEventCalendar">
    	<tr>
    		<td colspan="7">
				<table width="350" cellspacing="0" cellpadding="0">
			    	<tr>
			    		<th class="pb15"><h6><?php echo link_to(Util::getMonthName($previousMonth), '#loadQuickEventCalendar('.$previousMonth.', '.$previousYear.')') ?></h6></th>
			    		<th class="pb15"><h3><?php echo Util::getMonthName($month).'/'.$year ?></h3></th>
			    		<th class="pb15"><h6><?php echo link_to(Util::getMonthName($nextMonth), '#loadQuickEventCalendar('.$nextMonth.', '.$nextYear.')') ?></h6></th>
			    	</tr>
			    </table>
    		</td>
    	</tr>
    	<tr>
    		<th>Dom</th>
    		<th>Seg</th>
    		<th>Ter</th>
    		<th>Qua</th>
    		<th>Qui</th>
    		<th>Sex</th>
    		<th>Sáb</th>
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
    				
    				$eventDate = sprintf('%04s-%02s-%02s', $year, $displayMonth, $displayDay);
    		?>
    		<td class="<?php echo $class ?> noSelect" onclick="toggleQuickEvent('<?php echo $eventDate ?>')">
    			<div><?php echo $displayDay ?></div>
    			<div class="stepNumber" id="rankingLiveQuickEvent-<?php echo $eventDate ?>"></div>
    		</td>
    		<?php endfor; ?>
    	</tr>
    	<?php
    			$firstRun = false;
    		endfor;
    	?>
    </table>