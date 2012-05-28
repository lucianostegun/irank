<?php
	echo form_remote_tag(array(
		'url'=>'cashTable/save',
		'success'=>'handleSuccessCashTable(response)',
		'failure'=>'handleFailureCashTable(response.responseText)',
		'loading'=>'showIndicator()',
		),
		array('class'=>'form', 'id'=>'cashTableForm'));

//	echo form_tag('cashTable/save', array('class'=>'form', 'id'=>'cashTableForm'));
	
	$cashTableId = $cashTableObj->getId();
	$isNew       = $cashTableObj->getIsNew();
	$clubId      = $cashTableObj->getClubId();
	$readOnly    = $cashTableObj->isOpen();
	
	$clubId |= $sf_user->getAttribute('clubId');
	
	echo input_hidden_tag('cashTableId', $cashTableId);
	echo input_hidden_tag('tableStatus', $cashTableObj->getTableStatus(), array('id'=>'cashTableTableStatus'));
	
	$iRankAdmin  = $sf_user->hasCredential('iRankAdmin');
	$userAdminId = $sf_user->getAttribute('userAdminId');
	
	if(!$isNew || !$iRankAdmin)
		echo input_hidden_tag('clubId', $clubId, array('id'=>'cashTableClubId'));
	
	$fieldClass    = ($readOnly?'hidden':'');
	$readOnlyClass = ($readOnly?'':'hidden');
?>
	<?php if( $iRankAdmin ): ?>
	<div class="formRow">
		<label>Clube</label>
		<div class="formRight <?php echo $fieldClass ?>">
			<?php if( $isNew ): ?>
			<?php echo select_tag('clubId', Club::getOptionsForSelect($clubId), array('id'=>'cashTableClubId')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="cashTableFormErrorClubId"></div>
			<?php else: ?>
			<label><?php echo $cashTableObj->getClub()->toString() ?></label>
			<?php endif; ?>
		</div>
		<div class="formRight <?php echo $readOnlyClass ?>">
			<label><?php echo $cashTableObj->getClub()->toString() ?></label>
		</div>
		<div class="clear"></div>
	</div>
	<?php endif; ?>
	
	<div class="formRow">
		<label>Nome da mesa</label>
		<div class="formRight <?php echo $fieldClass ?>">
			<?php echo input_tag('cashTableName', $cashTableObj->getCashTableName(), array('size'=>35, 'maxlength'=>50, 'id'=>'cashTableCashTableName')) ?>
			<div class="formNote error" id="cashTableFormErrorCashTableName"></div>
		</div>
		<div class="formRight <?php echo $readOnlyClass ?>">
			<label><?php echo $cashTableObj->getCashTableName() ?></label>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Assentos disponíveis</label>
		<div class="formRight <?php echo $fieldClass ?>">
			<?php echo input_tag('seats', $cashTableObj->getSeats(), array('size'=>3, 'maxlength'=>2, 'id'=>'cashTableSeats')) ?>
			<div class="formNote error" id="cashTableFormErrorSeats"></div>
		</div>
		<div class="formRight <?php echo $readOnlyClass ?>">
			<label><?php echo $cashTableObj->getSeats() ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Modalidade</label>
		<div class="formRight">
			<?php echo select_tag('gameTypeId', VirtualTable::getOptionsForSelect('gameType', $cashTableObj->getGameTypeId()), array('id'=>'cashTableGameTypeId')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="cashTableFormErrorGameTypeId"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Situação</label>
		<div class="formRight">
			<label><?php echo $cashTableObj->getTableStatus(true) ?></label>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Jogadores</label>
		<div class="formRight">
			<label><?php echo $cashTableObj->getPlayers() ?></label>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Valor atual</label>
		<div class="formRight">
			<label><?php echo Util::formatFloat($cashTableObj->getCurrentValue(), true) ?></label>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Buy-in mínimo</label>
		<div class="formRight <?php echo $fieldClass ?>">
			<span class="multi"><?php echo input_tag('buyin', Util::formatFloat($cashTableObj->getBuyin(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'id'=>'cashTableBuyin')) ?></span>
			<span class="multi"><label class="text">+</label></span>
			<span class="multi"><?php echo input_tag('entranceFee', Util::formatFloat($cashTableObj->getEntranceFee(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'id'=>'cashTableEntranceFee')) ?></span>
			<div class="clear"></div>
			<div class="formNote error" id="cashTableFormErrorBuyin"></div>
			<div class="formNote">Buyin + Taxa de entrada</div>
		</div>
		<div class="formRight <?php echo $readOnlyClass ?>">
			<label><?php echo Util::formatFloat($cashTableObj->getBuyin(), true) ?></label>
			<label>+</label>
			<label><?php echo Util::formatFloat($cashTableObj->getEntranceFee(), true) ?>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Observações</label>
		<div class="formRight <?php echo $fieldClass ?>">
			<?php echo textarea_tag('comments', $cashTableObj->getComments(), array('style'=>'width: 80%; height: 250px', 'id'=>'cashTableComments')) ?>
			<div class="formNote error" id="clubFormErrorComments"></div>
		</div>
		<div class="formRight <?php echo $fieldClass ?>">
			<label><?php echo $cashTableObj->getComments(true) ?>
		</div>
		<div class="clear"></div>
	</div>
</form>