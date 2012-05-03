<?php
	$players = $eventLiveObj->getPlayers();
?>
<div class="eventResult">
	<div class="formRow">
		<label>Total Rebuys/Addons</label>
		<div class="formRight">
			<?php echo input_tag('totalRebuys', Util::formatFloat($eventLiveObj->getTotalRebuys(), true), array('maxlength'=>10, 'onblur'=>'updateMainBalanceByEventLive()', 'class'=>'decimal small100', 'id'=>'eventLiveTotalRebuys')) ?>
			<div class="formNote">Formato: 0000,00</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Divisão do prêmio</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('prizeSplit', $eventLiveObj->getPrizeSplit(), array('onkeyup'=>'updatePrizeSplitLabel()', 'class'=>'decimal small300', 'id'=>'eventLivePrizeSplit')) ?></span>
			<span class="multi"><label id="prizeSplitTotalLabel"><?php echo Util::formatFloat($eventLiveObj->getTotalPercentPrizeSplit()) ?>%</label></span>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorPrizeSplit"></div>
			<div class="formNote">Formato: 25%; 15%; 7,5%, ...</div>
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
			<?php include_partial('eventLive/include/result', array('eventLiveObj'=>$eventLiveObj, 'hasPendingResult'=>$hasPendingResult)) ?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	setupEventLiveResultAutoComplete();
</script>