<?php
	$isAdmin = MyTools::getUser()->hasCredential('iRankAdmin');
	$clubId  = $sf_user->getAttribute('clubId');
	
	if( $clubId )
		echo input_hidden_tag('quickEventLiveClubId', $clubId)
?>
<table width="100%" class="form">
	<tr>
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
		</td>
	</tr>
	<tr>
		<td id="quickEventCalendar"><?php include_partial('rankingLive/include/eventCalendar') ?></td>
	</tr>
</table>