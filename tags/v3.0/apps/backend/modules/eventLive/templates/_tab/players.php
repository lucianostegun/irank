<?php
	$players        = $eventLiveObj->getPlayers();
	$savedResult    = $eventLiveObj->getSavedResult();
	$enrollmentMode = $eventLiveObj->getEnrollmentMode();
?>
<div class="textL mt15" id="eventLiveEnrollmentModeDiv">
	<?php echo link_to(image_tag('backend/icons/light/check', array('class'=>'icon '.($enrollmentMode=='enrollment'?'':'hidden'), 'id'=>'eventLiveEnrollmentModeEnrollmentImage')).'<span>Modo inscrição</span>', '#toggleEventLiveMode("enrollment")', array('class'=>'button ml5 mr5 '.($enrollmentMode=='enrollment'?'blackB':'basic'), 'id'=>'eventLiveEnrollmentModeEnrollmentButton')) ?>
	<?php echo link_to(image_tag('backend/icons/light/check', array('class'=>'icon '.($enrollmentMode=='confirmation'?'':'hidden'), 'id'=>'eventLiveEnrollmentModeConfirmationImage')).'<span>Modo confirmação</span>', '#toggleEventLiveMode("confirmation")', array('class'=>'button ml5 mr5 '.($enrollmentMode=='confirmation'?'blackB':'basic'), 'id'=>'eventLiveEnrollmentModeConfirmationButton')) ?>
	<?php echo link_to(image_tag('backend/icons/light/check', array('class'=>'icon '.($enrollmentMode=='elimination'?'':'hidden'), 'id'=>'eventLiveEnrollmentModeEliminationImage')).'<span>Modo eliminação</span>', '#toggleEventLiveMode("elimination")', array('class'=>'button ml5 mr5 '.($enrollmentMode=='elimination'?'blackB':'basic'), 'id'=>'eventLiveEnrollmentModeEliminationButton')) ?>
	<?php echo link_to(image_tag('backend/icons/light/cut', array('class'=>'icon', 'id'=>'eventLiveCutUnconfirmed')).'<span>Remover não confirmados</span>', '#cutUnconfirmedPlayers()', array('class'=>'button redB mt10', 'style'=>'float: right', 'id'=>'eventLiveCutUnconfirmedButton')) ?>
</div>
<form onsubmit="eliminatePlayer(); return false;" id="eventLivePlayersForm">
<div class="widget form">
	<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
		<thead>
		    <tr id="playerIncluderRow">
				<th colspan="6" class="textL" style="height: 50px; vertical-align: middle">
					<?php if( !$savedResult ): ?>
					<label style="ml15 mr15">Inclusão de jogador</label>
						<?php echo input_autocomplete_tag('peopleName', null, 'eventLive/autoComplete?instanceName=players&eventLiveId='.$eventLiveObj->getId(), 'doSelectEventLivePlayer', array('maxlength'=>200, 'style'=>'width: 55%; margin-left: 10px; font-size: 14px; font-weight: bold; color: #303030', 'placeholder'=>'Digite o nome do jogador', 'id'=>'eventLivePeopleName')) ?>
						<span class="<?php echo ($enrollmentMode=='elimination'?'':'hidden') ?>" id="eventLivePlayerEliminationFields">
							<label class="ml15 mr15">Posição: </label>
							<?php echo input_tag('eventPosition', null, array('size'=>2, 'maxlength'=>3, 'style'=>'; font-size: 14px; font-weight: bold; color: #303030', 'id'=>'eventLiveEventPosition')) ?>
							<?php echo submit_tag('confirmar', array('class'=>'button redB ml15', 'style'=>'position: relative; top: -2px')); ?>
						</span>
					<?php endif; ?>
				</th> 
			</tr>
			<tr> 
				<td>Nome</td>
				<td>E-mail</td>
				<td style="width: 150px">Inscrição</td>
				<td style="width: 100px">Status</td>
				<?php if( !$savedResult ): ?>
				<td style="width: 20px" class="playerRemoveColumn"></td>
				<?php endif; ?>
				<td style="width: 20px" class="playerEditColumn"></td>
			</tr>
		</thead>
		<tbody id="eventLivePlayerIdTbody"> 
			<?php include_partial('eventLive/include/players', array('eventLiveObj'=>$eventLiveObj, 'savedResult'=>$savedResult)) ?>
		</tbody>
	</table>
</div>
</form>