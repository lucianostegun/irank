<?php
	$allowedRebuys = $eventLiveObj->getAllowedRebuys();
	
	echo input_hidden_tag('eventLiveId', $eventLiveObj->getId());
	echo input_hidden_tag('rankingLiveId', $eventLiveObj->getRankingLiveId(), array('id'=>'eventLiveRankingLiveId'));
?>
	<?php if( $iRankAdmin ): ?>
	<div class="formRow">
		<label>Clube</label>
		<div class="formRight">
			<label><?php echo $eventLiveObj->getClub()->toString() ?></label>
		</div>
		<div class="clear"></div>
	</div>
	<?php endif; ?>

	<div class="formRow">
		<label>Ranking</label>
		<div class="formRight" id="eventLiveRankingLiveIdDiv">
			<label><?php echo $eventLiveObj->getRankingLive()->toString() ?></label>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Nome do evento</label>
		<div class="formRight">
			<label><?php echo $eventLiveObj->getEventName() ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Nome curto</label>
		<div class="formRight">
			<label><?php echo $eventLiveObj->getEventShortName() ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Data</label>
		<div class="formRight">
			<label><?php echo $eventLiveObj->getEventDate('d/m/Y') ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Hora</label>
		<div class="formRight">
			<label><?php echo $eventLiveObj->getStartTime('H:i') ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Buy-in</label>
		<div class="formRight">
			<?php if( $eventLiveObj->getIsFreeroll() ): ?>
			<span class="multi"><label>Freeroll</label></span>
			<?php else: ?>
			<label><?php echo Util::formatFloat($eventLiveObj->getBuyin(), true) ?>
			+
			<?php echo Util::formatFloat($eventLiveObj->getEntranceFee(), true) ?></label>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorBuyin"></div>
			<div class="formNote">Buyin + Taxa de entrada</div>
			<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Rake</label>
		<div class="formRight">
			<label><?php echo Util::formatFloat($eventLiveObj->getRakePercent(), true) ?> %</label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Duração dos blinds</label>
		<div class="formRight">
			<label><?php echo $eventLiveObj->getBlindTime('H:i') ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Stack inicial</label>
		<div class="formRight">
			<label><?php echo $eventLiveObj->getStackChips(true) ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Rebuys permitidos</label>
		<div class="formRight">
			<label><?php echo ($eventLiveObj->getIsIlimitedRebuys()?'Ilimitados':($allowedRebuys?$allowedRebuys:0)) ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Add-ons permitidos</label>
		<div class="formRight">
			<label><?php echo $eventLiveObj->getAllowedAddons() ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Informações</label>
		<div class="formRight">
			<label class="longText"><?php echo $eventLiveObj->getDescription() ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Observações</label>
		<div class="formRight">
			<label><?php echo $eventLiveObj->getComments() ?></label>
		</div>
		<div class="clear"></div>
	</div>