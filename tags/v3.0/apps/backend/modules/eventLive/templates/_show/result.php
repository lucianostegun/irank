<?php
	$players = $eventLiveObj->getPlayers();
?>
<div class="eventResult">
	<div class="formRow">
		<label>Total Rebuys/Addons</label>
		<div class="formRight">
			<label><?php echo Util::formatFloat($eventLiveObj->getTotalRebuys(), true) ?></label>
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Divisão do prêmio</label>
		<div class="formRight">
			<label><?php echo $eventLiveObj->getPrizeSplit() ?></label>
		</div>
		<div class="clear"></div>
	</div>
</div>

<div class="widget eventResult" id="drag">
	<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
		<colgroup>
			<col/>
			<col/>
			<col/>
			<col/>
			<col/>
			<col/>
		</colgroup>
		<tbody id="eventLiveResultTbody">
			<?php include_partial('eventLive/include/resultRo', array('eventLiveObj'=>$eventLiveObj)) ?>
		</tbody>
	</table>
</div>