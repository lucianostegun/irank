	<div class="formRow">
		<label>Hora</label>
		<div class="formRight"><?php echo input_tag('defaultStartTime', $rankingLiveObj->getDefaultStartTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'id'=>'rankingLiveDefaultStartTime')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Buy-in padrão</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('defaultBuyin', Util::formatFloat($rankingLiveObj->getDefaultBuyin(), true), array('size'=>8, 'maxlength'=>8, 'id'=>'rankingLiveDefaultBuyin')) ?></span>
			<span class="multi"><?php echo checkbox_tag('defaultIsFreeroll', true, $rankingLiveObj->getDefaultIsFreeroll(), array('onclick'=>'handleIsFreeroll(this.checked)', 'id'=>'rankingLiveDefaultIsFreeroll')) ?></span>
			<span class="multi"><label for="rankingLiveDefaultIsFreeroll">Freeroll</label></span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Taxa entrada padrão</label>
		<div class="formRight"><?php echo input_tag('defaultEntranceFee', Util::formatFloat($rankingLiveObj->getDefaultEntranceFee(), true), array('size'=>8, 'maxlength'=>8, 'id'=>'rankingLiveDefaultEntranceFee')) ?></div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Duração dos blinds</label>
		<div class="formRight">
			<?php echo input_tag('defaultBlindTime', $rankingLiveObj->getDefaultBlindTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'id'=>'rankingLiveDefaultBlindTime')) ?>
			<span class="formNote">Formato: hh:mm</span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Stack inicial</label>
		<div class="formRight">
			<?php echo input_tag('defaultStackChips', $rankingLiveObj->getDefaultStackChips(true), array('size'=>7, 'maxlength'=>7, 'id'=>'rankingLiveDefaultStackChips')) ?>
			<span class="formNote">Formato: 00000 ou 0K</span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Rebuys permitidos</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('defaultAllowedRebuys', $rankingLiveObj->getDefaultAllowedRebuys(), array('size'=>1, 'maxlength'=>2, 'disabled'=>$rankingLiveObj->getDefaultIsIlimitedRebuys(), 'id'=>'rankingLiveDefaultAllowedRebuys')) ?></span>
			<span class="multi"><?php echo checkbox_tag('defaultIsIlimitedRebuys', true, $rankingLiveObj->getDefaultIsIlimitedRebuys(), array('onclick'=>'handleIsIlimitedRebuys(this.checked)', 'id'=>'rankingLiveDefaultIsIlimitedRebuys')) ?></span>
			<span class="multi"><label for="rankingLiveDefaultIsIlimitedRebuys" class="checkbox">ilimitados</label></span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Add-ons permitidos</label>
		<div class="formRight"><?php echo input_tag('defaultAllowedAddons', $rankingLiveObj->getDefaultAllowedAddons(), array('size'=>1, 'maxlength'=>2, 'id'=>'rankingLiveDefaultAllowedAddons')) ?></div>
		<div class="clear"></div>
	</div>