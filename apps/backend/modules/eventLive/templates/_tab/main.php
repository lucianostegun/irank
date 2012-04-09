<?php include_partial('home/include/formHeader', array('prefix'=>'eventLive')) ?>
<div class="module_content">
	<div class="defaultForm">
		<?php if( $iRankAdmin ): ?>
		<section>
			<label>Clube</label>
			<?php echo select_tag('clubId', Club::getOptionsForSelect($eventLiveObj->getClubId()), array('onchange'=>'loadSelectField(this, "rankingLive", "eventLiveRankingLiveIdDiv", "eventLiveRankingLiveId")', 'id'=>'eventLiveClubId')) ?>
		</section>
		<?php endif; ?>

		<section>
			<label>Ranking</label>
			<div id="eventLiveRankingLiveIdDiv"><?php echo select_tag('rankingLiveId', RankingLive::getOptionsForSelect($eventLiveObj->getClubId()|$clubId, $eventLiveObj->getRankingLiveId()), array('onchange'=>'loadDefaultBuyin(this.value)', 'id'=>'eventLiveRankingLiveId')) ?></div>
		</section>
		
		<section>
			<label>Nome do evento</label>
			<?php echo input_tag('eventName', $eventLiveObj->getEventName(), array('size'=>50, 'maxlength'=>100, 'onblur'=>'replicateEventName(this.value)', 'id'=>'eventLiveEventName')) ?>
		</section>

		<section>
			<label>Nome curto</label>
			<?php echo input_tag('eventShortName', $eventLiveObj->getEventShortName(), array('size'=>30, 'maxlength'=>40, 'id'=>'eventLiveEventShortName')) ?>
		</section>

		<section>
			<label>Data</label>
			<?php echo input_date_tag('eventDate', $eventLiveObj->getEventDate(), array('id'=>'eventLiveEventDate')) ?>
		</section>

		<section>
			<label>Hora</label>
			<?php echo input_tag('startTime', $eventLiveObj->getStartTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'id'=>'eventLiveStartTime')) ?>
		</section>

		<section>
			<label>Buy-in</label>
			<?php echo input_tag('buyin', Util::formatFloat($eventLiveObj->getBuyin(), true), array('size'=>7, 'maxlength'=>7, 'disabled'=>$eventLiveObj->getIsFreeroll(), 'id'=>'eventLiveBuyin')) ?>
			<?php echo checkbox_tag('isFreeroll', true, $eventLiveObj->getIsFreeroll(), array('onclick'=>'handleIsFreeroll(this.checked)', 'id'=>'eventLiveIsFreeroll')) ?>
			<label for="eventLiveIsFreeroll" class="checkbox">Freeroll</label>
		</section>

		<section>
			<label>Taxa entrada (rake)</label>
			<?php echo input_tag('entranceFee', Util::formatFloat($eventLiveObj->getEntranceFee(), true), array('size'=>7, 'maxlength'=>7, 'id'=>'eventLiveEntranceFee')) ?>
		</section>

		<section>
			<label>Duração dos blinds</label>
			<?php echo input_tag('blindTime', $eventLiveObj->getBlindTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'id'=>'eventLiveBlindTime')) ?>
		</section>

		<section>
			<label>Stack inicial</label>
			<?php echo input_tag('stackChips', $eventLiveObj->getStackChips(), array('size'=>7, 'maxlength'=>7, 'id'=>'eventLiveStackChips')) ?>
			<div class="text">fichas</div>
		</section>

		<section>
			<label>Rebuys permitidos</label>
			<?php echo input_tag('allowedRebuys', $eventLiveObj->getAllowedRebuys(), array('size'=>1, 'maxlength'=>2, 'disabled'=>$eventLiveObj->getIsIlimitedRebuys(), 'id'=>'eventLiveAllowedRebuys')) ?>
			<?php echo checkbox_tag('ilimitedRebuys', true, $eventLiveObj->getIsIlimitedRebuys(), array('onclick'=>'handleIsIlimitedRebuys(this.checked)', 'id'=>'eventLiveIsIlimitedRebuys')) ?>
			<label for="eventLiveIsIlimitedRebuys" class="checkbox">ilimitados</label>
		</section>

		<section>
			<label>Add-ons permitidos</label>
			<?php echo input_tag('allowedAddons', $eventLiveObj->getAllowedAddons(), array('size'=>1, 'maxlength'=>2, 'id'=>'eventLiveAllowedAddons')) ?>
		</section>

		<section class="textarea" style="height: 570px">
			<label>Informações</label>
			<?php echo textarea_tag('description', $eventLiveObj->getDescription(false), array('style'=>'width: 80%; height: 550px', 'id'=>'eventLiveDescription')) ?>
		</section>

		<section class="textarea" style="height: 160px">
			<label>Observações</label>
			<?php echo textarea_tag('comments', $eventLiveObj->getComments(), array('style'=>'width: 80%; height: 150px', 'id'=>'eventLiveComments')) ?>
		</section>
	</div>
</div>
<?php include_partial('home/include/formFooter', array('prefix'=>'eventLive')) ?>