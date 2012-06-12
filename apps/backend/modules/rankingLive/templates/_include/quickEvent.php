<?php
	$isAdmin = MyTools::getUser()->hasCredential('iRankAdmin');
	$clubId  = $sf_user->getAttribute('clubId');
	
	if( $clubId )
		echo input_hidden_tag('quickEventLiveClubId', $clubId);
		
	$allowedRebuysSatellite = $rankingLiveObj->getAllowedRebuysSatellite();
?>

<table width="100%" class="form">
	<tr>
		<td rowspan="10" id="quickEventCalendar" style="vertical-align: top; width: 380px">
			<?php include_partial('rankingLive/include/eventCalendar') ?>
		</td>
		<td>
			<div class="formRow">
				<label>Título do evento</label>
				<div class="formRight">
					<?php echo input_tag('eventName', null, array('size'=>50, 'id'=>'rankingLiveQuickEventLiveEventName')) ?>
					<div class="formNote error" id="rankingLiveFormErrorQuickEventLiveEventName"></div>
				</div>
				<div class="clear"></div>
			</div>
			<?php if( !$clubId ): ?>
			<div class="formRow">
				<label>Clube</label>
				<div class="formRight">
					<?php echo select_tag('quickEventLiveClubId', Club::getOptionsForSelect(), array('id'=>'rankingLiveQuickEventLiveClubId')) ?>
					<div class="formNote error" id="rankingLiveFormErrorQuickEventLiveClubId"></div>
				</div>
				<div class="clear"></div>
			</div>
			<?php endif; ?>
			<br/>
			<h5>Satélite</h5>
			<hr/>
			<br/>
			
			<div class="formRow">
				<label>Hora</label>
				<div class="formRight">
					<?php echo input_tag('startTimeSatellite', $rankingLiveObj->getStartTimeSatellite('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'onblur'=>'replicateStartTime(this.value)', 'id'=>'rankingLiveStartTimeSatellite')) ?>
					<div class="formNote error" id="rankingLiveFormErrorQuickEventLiveStartTimeSatellite"></div>
				</div>
				<div class="clear"></div>
			</div>
		
			<div class="formRow">
				<label>Buy-in</label>
				<div class="formRight">
					<span class="multi"><?php echo input_tag('buyinSatellite', Util::formatFloat($rankingLiveObj->getBuyinSatellite(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'disabled'=>$rankingLiveObj->getIsFreeroll(), 'id'=>'rankingLiveBuyinSatellite')) ?></span>
					<span class="multi"><label class="text">+</label></span>
					<span class="multi"><?php echo input_tag('entranceFeeSatellite', Util::formatFloat($rankingLiveObj->getEntranceFeeSatellite(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'id'=>'rankingLiveEntranceFeeSatellite')) ?></span>
					<span class="multi"><?php echo checkbox_tag('isFreerollSatellite', true, $rankingLiveObj->getIsFreerollSatellite(), array('onclick'=>'handleIsFreerollSatellite(this.checked)', 'id'=>'rankingLiveIsFreerollSatellite')) ?></span>
					<span class="multi"><label for="rankingLiveIsFreeroll">Freeroll</label></span>
					<div class="clear"></div>
					<div class="formNote error" id="rankingLiveFormErrorQuickEventLiveBuyinSatellite"></div>
					<div class="formNote">Buyin + Taxa de entrada</div>
				</div>
				<div class="clear"></div>
			</div>
		
			<div class="formRow">
				<label>Vagas</label>
				<div class="formRight">
					<?php echo input_tag('guaranteedPrizeSatellite', $rankingLiveObj->getGuaranteedPrizeSatellite(), array('size'=>3, 'maxlength'=>3, 'class'=>'textR', 'id'=>'rankingLiveGuaranteedPrizeSatellite')) ?>
					<div class="formNote error" id="rankingLiveFormErrorQuickEventLiveGuaranteedPrizeSatellite"></div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow"> 
				<label>Duração dos blinds</label>
				<div class="formRight">
					<?php echo input_tag('blindTimeSatellite', $rankingLiveObj->getBlindTimeSatellite('H:i'), array('size'=>5, 'maxlength'=>5, 'id'=>'rankingLiveBlindTimeSatellite')) ?>
					<div class="formNote error" id="rankingLiveFormErrorQuickEventLiveBlindTimeSatellite"></div>
					<span class="formNote">Formato: hh:mm ou 00min</span>
				</div>
				<div class="clear"></div>
			</div>
		
			<div class="formRow">
				<label>Stack inicial</label>
				<div class="formRight">
					<?php echo input_tag('stackChipsSatellite', $rankingLiveObj->getStackChipsSatellite(true), array('size'=>7, 'maxlength'=>7, 'id'=>'rankingLiveStackChipsSatellite')) ?>
					<div class="formNote error" id="rankingLiveFormErrorQuickEventLiveStackChipsSatellite"></div>
					<span class="formNote">Formato: 00000 ou 0K</span>
				</div>
				<div class="clear"></div>
			</div>
		
			<div class="formRow">
				<label>Rebuys permitidos</label>
				<div class="formRight">
					<span class="multi"><?php echo input_tag('allowedRebuysSatellite', ($allowedRebuysSatellite?$allowedRebuysSatellite:0), array('size'=>1, 'maxlength'=>2, 'disabled'=>$rankingLiveObj->getIsIlimitedRebuys(), 'id'=>'rankingLiveAllowedRebuysSatellite')) ?></span>
					<span class="multi"><?php echo checkbox_tag('isIlimitedRebuysSatellite', true, $rankingLiveObj->getIsIlimitedRebuysSatellite(), array('onclick'=>'handleIsIlimitedRebuysSatellite(this.checked)', 'id'=>'rankingLiveIsIlimitedRebuysSatellite')) ?></span>
					<span class="multi"><label for="rankingLiveIsIlimitedRebuysSatellite" class="checkbox">ilimitados</label></span>
					<div class="clear"></div>
					<div class="formNote error" id="rankingLiveFormErrorQuickEventLiveAllowedRebuysSatellite"></div>
				</div>
				<div class="clear"></div>
			</div>
		
			<div class="formRow">
				<label>Add-ons permitidos</label>
				<div class="formRight">
					<?php echo input_tag('allowedAddonsSatellite', $rankingLiveObj->getAllowedAddonsSatellite(), array('size'=>1, 'maxlength'=>2, 'id'=>'rankingLiveAllowedAddonsSatellite')) ?>
					<div class="formNote error" id="rankingLiveFormErrorQuickEventLiveAllowedAddonsSatellite"></div>
				</div>
				<div class="clear"></div>
			</div>
		
			<div class="formRow">
				<label>Nº de mesas</label>
				<div class="formRight">
					<?php echo input_tag('tablesNumberSatellite', $rankingLiveObj->getTablesNumberSatellite(), array('size'=>1, 'maxlength'=>2, 'id'=>'rankingLiveTablesNumberSatellite')) ?>
					<div class="formNote error" id="rankingLiveFormErrorQuickEventLiveTablesNumberSatellite"></div>
				</div>
				<div class="clear"></div>
			</div>
			
		</td>
	</tr>
</table>