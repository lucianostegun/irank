<?php
	$players = $eventLiveObj->getPlayers();
	
	$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerResultList(null, true);
	
	$hasPreviousPendingResult = $eventLiveObj->hasPreviousPendingResult();
	
	$totalPrizeValue = 0;
	$eventPosition   = 0;
	$eventLiveId     = $eventLiveObj->getId();
	$rankingLiveObj  = $eventLiveObj->getRankingLive();
	$noRanking       = $rankingLiveObj->getNoRanking();
?>
<tr class="thead">
	<th colspan="3" class="mark"><div id="playerResultCountDiv"><?php echo $players.' Jogador'.($players==1?'':'es').' confirmado'.($players==1?'':'s') ?></div></th>
	<th align="right" class="calculateScore mark"><input type="button" value="<?php echo ($noRanking?'Calcular premiação':'Calcular pontuação') ?>" class="button greenB" onclick="calculateEventLiveScore()"></th> 
	<?php if( $hasPreviousPendingResult ): ?>
		<th colspan="2">&nbsp;</th> 
	<?php else: ?>
		<th colspan="2" class="publishResult mark"><input type="button" value="Divulgar resultados" class="button blueB" onclick="publishEventLiveResult()"></th> 
	<?php endif; ?>
</tr>
<tr class="thead"> 
	<th class="mark"></th>
	<th class="mark">#</th> 
	<th class="mark">Nome</th> 
	<th class="mark">E-mail</th> 
	<th class="mark">Premiação</th> 
	<th class="mark">Pontos</th> 
</tr>
<?php
	$eventPlayerPositionList = array();
	foreach($eventLivePlayerObjList as $eventPosition=>$eventLivePlayerObj){
		
		if( $eventPositionReal = $eventLivePlayerObj->getEventPosition() )
			$eventPosition = $eventPositionReal;
		else
			$eventPosition = $eventPosition+1;
		
		$eventPlayerPositionList[$eventPosition] = $eventLivePlayerObj;
	}
	
	for($eventPosition=1; $eventPosition <= $players; $eventPosition++):
	
		if( array_key_exists($eventPosition, $eventPlayerPositionList) ){
			
			$eventLivePlayerObj = $eventPlayerPositionList[$eventPosition];
			$peopleObj          = $eventLivePlayerObj->getPeople();
			
			$peopleId     = $peopleObj->getId();
			$peopleName   = $peopleObj->getFullName();
			$emailAddress = $peopleObj->getEmailAddress();
			$prize        = $eventLivePlayerObj->getPrize();
			$score        = $eventLivePlayerObj->getScore();
		}else{
			
			$peopleId     = null;
			$peopleName   = null;
			$emailAddress = null;
			$prize        = 0;
			$score        = 0;
		}
	
		$totalPrizeValue += $prize;
		
		$class = ($eventPosition%2==0?'rd':'rl odd');
		
		$readOnlyScore = (is_object($rankingLiveObj) && $rankingLiveObj->getScoreFormulaOption()=='multiple');
		$scoreField    = input_tag('score-'.$eventPosition, Util::formatFloat($score, true, 3), array('maxlength'=>6, 'readonly'=>$readOnlyScore, 'class'=>'decimal', 'tabindex'=>(($players*2)+$eventPosition)));
?>
<tr class="<?php echo $class ?> gradeB" id="eventLiveResultRow-<?php echo $eventPosition ?>">
	<td width="10" class="rowhandler"><div class="drag row"></div></td> 
	<td width="5%" id="eventLivePositionLabel-<?php echo $eventPosition ?>" class="eventLivePositionLabel"><?php echo $eventPosition ?></td> 
	<td width="40%">
		<?php
		    echo input_hidden_tag('peopleIdPosition-'.$eventPosition, $peopleId);
			echo input_tag('peopleName', $peopleName, array('tabindex'=>$eventPosition, 'autocomplete'=>'off', 'onblur'=>'checkEventPositionField('.$eventPosition.')', 'size'=>40, 'class'=>'autocompletePlayer', 'id'=>'eventLivePeopleNameResult-'.$eventPosition));
		?>
		<div id="eventLivePeopleNameResult-<?php echo $eventPosition ?>_auto_complete" class="auto_complete"></div>
	</td>
	<td width="35%" class="emailAddress" id="eventLiveResultEmailAddressTd-<?php echo $eventPosition ?>"><?php echo $emailAddress ?></td>
	<td class="prize"><?php echo input_tag('prize-'.$eventPosition, Util::formatFloat($prize, true), array('maxlength'=>7, 'class'=>'decimal', 'tabindex'=>($players+$eventPosition), 'onkeyup'=>'updateTotalPrizeValue()')); ?></td>
	<td class="score"><?php echo $scoreField ?></td>
</tr>
<?php endfor; ?>
	<tr class="tfoot resumeEventResult"> 
		<th></th>
		<th></th> 
		<th></th> 
		<th></th> 
		<th id="totalPrizeValue"><?php echo Util::formatFloat($totalPrizeValue, true) ?></th> 
		<th></th> 
	</tr>
	<tr class="thead">
		<th colspan="3" class="mark"></th>
		<th align="right" class="calculateScore mark"><input type="button" value="<?php echo ($noRanking?'Calcular premiação':'Calcular pontuação') ?>" class="button greenB" onclick="calculateEventLiveScore()"></th> 
		<?php if( $hasPreviousPendingResult ): ?>
		<th colspan="2"></th> 
		<?php else: ?>
		<th colspan="2" class="publishResult mark"><input type="button" value="Divulgar resultados" class="button blueB" onclick="publishEventLiveResult()"></th> 
		<?php endif; ?>
	</tr>