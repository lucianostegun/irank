<div id="eventCalendar">
<?php
$currentMonth = (isset($month)?$month:date('m'));
$currentYear  = (isset($year)?$year:date('Y'));

$lastMonth = date('m', mktime(0,0,0,$currentMonth-1,1,$currentYear));
$lastYear  = date('Y', mktime(0,0,0,$currentMonth-1,1,$currentYear));

$nextMonth = date('m', mktime(0,0,0,$currentMonth+1,1,$currentYear));
$nextYear  = date('Y', mktime(0,0,0,$currentMonth+1,1,$currentYear));

$monthDays          = Util::getMonthDays($currentMonth, $currentYear); // Quantidade de dias do mês atual
$monthDaysLastMonth = Util::getMonthDays($lastMonth, $lastYear);       // Quantidade de dias do mês anterior

$dayWeekStart  = date('w', mktime(0,0,0,$currentMonth,1,$currentYear))+1;          // Dia da semana em que o mês atual começou
$dayWeekFinish = date('w', mktime(0,0,0,$currentMonth,$monthDays,$currentYear))+1; // Dia da semana em que o mês atual começou

$daysLastMonth = ($dayWeekStart==1?0:$dayWeekStart-1); // Quantidade de dias para compensar o calendário quando o mês não começar no domingo
$daysNextMonth = 42-($daysLastMonth+$monthDays);       // Quantidade de dias para compensar o calendário quando o mês não terminar no sábado

$weeks = ceil($monthDays/7);

echo input_hidden_tag('calendarDate', date('Y-m-d'));
echo input_hidden_tag('calendarMonth', $currentMonth);
echo input_hidden_tag('calendarYear', $currentYear);

$day       = ($monthDaysLastMonth-$daysLastMonth+1);
$startDate = date('d/m/Y', mktime(0,0,0,$lastMonth,$day,$lastYear));
$endDate   = date('d/m/Y', mktime(0,0,0,$lastMonth,$day+$weeks*7+7,$lastYear));

$eventDateList = UserSite::getCalendarList($startDate, $endDate);
?>
	<div class="monthName" id="currentMonthDiv" style="text-align: center"><?php echo Util::getMonthName($currentMonth).'/'.$currentYear ?></div>
	<div class="month">
		<div class="weekDay">Dom</div>
		<div class="weekDay">Seg</div>
		<div class="weekDay">Ter</div>
		<div class="weekDay">Qua</div>
		<div class="weekDay">Qui</div>
		<div class="weekDay">Sex</div>
		<div class="weekDay">Sáb</div>
		<?php
			// Compensação de dias antes do começo do mês
			for($day=($monthDaysLastMonth-$daysLastMonth+1); $day <= $monthDaysLastMonth; $day++):
				
				$day       = sprintf('%02d', $day);
				$lastMonth = sprintf('%02d', $lastMonth);
				$dayId     = $lastYear.$lastMonth.$day;
				$date      = "$day/$lastMonth/$lastYear";
				
				$link = "getCalendarDetails('$dayId', '$date')";
				
				$hasEvent = in_array($dayId, $eventDateList);
		?>
		<div class="dayGray<?php echo ($hasEvent?' withEvent':'') ?>" id="<?php echo $dayId ?>Div" onclick="<?php echo $link ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">
			<div class="dayNumberGray"><?php echo $day ?></div>
		</div>
		<?php
			endfor;
			
			// Dias do mês atual
			for($day=1; $day <= $monthDays; $day++):
				
				$day          = sprintf('%02d', $day);
				$currentMonth = sprintf('%02d', $currentMonth);
				$dayId        = $currentYear.$currentMonth.$day;
				$date         = "$day/$currentMonth/$currentYear";
				$isMarked     = ($date==date('Y-m-d'));
				$className    = 'day';
				
				$link = "getCalendarDetails('$dayId', '$date')";
				
				$hasEvent = in_array($dayId, $eventDateList);
		?>
		<div class="day<?php echo ($isMarked?' selected':'').($hasEvent?' withEvent':'') ?>" id="<?php echo $dayId ?>Div" onclick="<?php echo $link ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">
			<div class="dayNumber" style="z-index: 1"><?php echo $day ?></div>
		</div>
		<?php
			// Compensação de dias no final do mês
			endfor;
				for($day=1; $day <= $daysNextMonth; $day++):
					
					$day       = sprintf('%02d', $day);
					$nextMonth = sprintf('%02d', $nextMonth);
					$dayId     = $nextYear.$nextMonth.$day;
					$date      = "$day/$nextMonth/$nextYear";
					
					$link = "getCalendarDetails('$dayId', '$date')";
				
				$hasEvent = in_array($dayId, $eventDateList);
		?>
		<div class="dayGray<?php echo ($hasEvent?' withEvent':'') ?>" id="<?php echo $dayId ?>Div" onclick="<?php echo $link ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">
			<div class="dayNumberGray"><?php echo $day ?></div>
		</div>
		<?php endfor;?>
	</div>
</div>
<?php
	sfContext::getInstance()->getResponse()->addStylesheet('calendar');
	sfContext::getInstance()->getResponse()->addJavascript('calendar');
?>