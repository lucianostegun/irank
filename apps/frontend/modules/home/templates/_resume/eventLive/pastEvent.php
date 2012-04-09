<?php
	$savedResult = $eventLiveObj->getSavedResult();
	
	$rankingName = $eventLiveObj->getRankingLive()->toString();
	
	$className = (!$savedResult?'previous pending':'previous');
	$title     = (!$savedResult?'O resultado deste evento ainda não foi lançado!':'');
?>
<div class="eventLive <?php echo $className ?>" title="<?php echo $title ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" onclick="loadEventLive(<?php echo $eventLiveObj->getId() ?>)" style="background-image: url('/images/ranking/thumb/<?php echo $eventLiveObj->getRankingLive()->getFileNameLogo() ?>')">
	<div class="when"><?php echo Util::getWeekDay($eventLiveObj->getEventDateTime('d/m/Y')).', '.$eventLiveObj->getEventDateTime('d/m/Y H:i') ?></div>
	<div class="where"><b>@ <?php echo $eventLiveObj->getClub()->toString() ?></b> - <?php echo $eventLiveObj->getClub()->getLocation() ?></div>
	<div class="title"><?php echo $eventLiveObj->getEventName() ?></div>
	<div class="ranking"><?php echo ($rankingName?'['.$rankingName.']':'') ?></div>
	<div class="clear"></div>
</div>