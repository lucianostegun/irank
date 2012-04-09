<?php
	$savedResult = $eventObj->getSavedResult();
	$isMyEvent   = $eventObj->isMyEvent();
	
	$className = ($isMyEvent && !$savedResult?'previous pending':'previous');
	$title     = (!$savedResult?'O resultado deste evento ainda não foi lançado!':'');
?>
<div class="event <?php echo $className ?>" title="<?php echo $title ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" onclick="loadEvent(<?php echo $eventObj->getId() ?>)">
	<div class="when"><?php echo Util::getWeekDay($eventObj->getEventDateTime('d/m/Y')).', '.$eventObj->getEventDateTime('d/m/Y H:i') ?></div>
	<div class="where">@ <?php echo $eventObj->getRankingPlace()->getPlaceName() ?></div>
	<div class="title"><?php echo $eventObj->getEventName() ?></div>
	<div class="ranking">[<?php echo $eventObj->getRanking()->getRankingName() ?>]</div>
	<div class="clear"></div>
</div>