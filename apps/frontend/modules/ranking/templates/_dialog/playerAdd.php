<?php
	echo form_remote_tag(array(
		'url'=>'ranking/savePlayer',
		'success'=>'handleSuccessRankingPlayer( request.responseText )',
		'failure'=>'handleFailureRankingPlayer( request.responseText )',
		'encoding'=>'utf8',
		'loading'=>'disableButton("rankingPlayerSubmit"); showIndicator("rankingPlayer")'
		), array( 'id'=>'rankingPlayerForm' ));
	
	echo input_hidden_tag('peopleId', null, array('id'=>'rankingPlayerPeopleId'));
	echo input_hidden_tag('rankingId', $rankingId, array('id'=>'rankingPlayerRankingId'));
	echo input_hidden_tag('eventId', null, array('id'=>'rankingPlayerEventId'));
?>
	<table width="100%" height="<?php echo $windowHeight-17 ?>" cellspacing="1" cellpadding="0" class="windowForm">
		<tr>
			<td valign="top">
				<div class="row">
					<div class="labelHalf" id="rankingPlayerFirstNameLabel"><?php echo __('FirstName') ?></div>
					<div class="field"><?php echo input_tag('firstName', null, array('size'=>20, 'maxlength'=>25, 'class'=>'required', 'id'=>'rankingPlayerFirstName')) ?></div>
				</div>
				<div class="row">
					<div class="labelHalf" id="rankingPlayerLastNameLabel"><?php echo __('LastName') ?></div>
					<div class="field"><?php echo input_tag('lastName', null, array('size'=>20, 'maxlength'=>25, 'placeholder'=>'opcional', 'id'=>'rankingPlayerLastName')) ?></div>
				</div>
				<div class="row">
					<div class="labelHalf" id="rankingPlayerEmailAddressLabel">E-mail</div>
					<div class="field"><?php echo input_tag('emailAddress', null, array('size'=>25, 'maxlength'=>150, 'placeholder'=>'opcional', 'id'=>'rankingPlayerEmailAddress')) ?></div>
				</div>
			</td>
		</tr>
	</table>
	<div class="windowButtonBar" id="rankingPlayerAddButtonBar">
		<?php
			echo button_tag('rankingPlayerCancel', __('button.cancel'), array('onclick'=>'windowRankingPlayerAddHide()'));
			echo button_tag('rankingPlayerSubmit', __('button.save'), array('onclick'=>'doSubmitRankingPlayer()'));
			echo getFormWindowLoading('rankingPlayer');
			echo getFormStatus('rankingPlayer');
		?>
	</div>
</form>