<?php
	echo form_remote_tag(array(
		'url'=>'ranking/saveMember',
		'success'=>'handleSuccessRankingMember( request.responseText )',
		'failure'=>'enableButton("rankingMemberSubmit"); handleFormFieldError( request.responseText, "rankingMemberForm", "rankingMember", false, "rankingMember" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator("rankingMember")'
		), array( 'id'=>'rankingMemberForm' ));
	
	echo input_hidden_tag('peopleId', null, array('id'=>'rankingMemberPeopleId'));
	echo input_hidden_tag('rankingId', $rankingId);
?>
	<table width="100%" height="<?php echo $windowHeight-9 ?>" cellspacing="1" cellpadding="0" class="windowForm">
		<tr>
			<td valign="top">
				<div class="row">
					<div class="halfLabel" id="rankingMemberFirstNameLabel">Nome</div>
					<div class="field"><?php echo input_tag('firstName', null, array('size'=>20, 'maxlength'=>25, 'class'=>'required', 'id'=>'rankingMemberFirstName')) ?></div>
				</div>
				<div class="row">
					<div class="halfLabel" id="rankingMemberLastNameLabel">Sobrenome</div>
					<div class="field"><?php echo input_tag('lastName', null, array('size'=>20, 'maxlength'=>25, 'id'=>'rankingMemberLastName')) ?></div>
				</div>
				<div class="row">
					<div class="halfLabel" id="rankingMemberEmailAddressLabel">E-mail</div>
					<div class="field"><?php echo input_tag('emailAddress', null, array('size'=>25, 'maxlength'=>150, 'class'=>'required', 'id'=>'rankingMemberEmailAddress')) ?></div>
				</div>
			</td>
		</tr>
	</table>
	<div class="buttonBarForm">
		<?php echo button_tag('rankingMemberSubmit', 'Gravar alterações', array('onclick'=>'doSubmitRankingMember()')) ?>
		<?php echo button_tag('rankingMemberCancel', 'Cancelar', array('onclick'=>'windowRankingMemberAddHide()')) ?>
		<?php echo getFormLoading('rankingMember') ?>
		<?php echo getFormStatus('rankingMember') ?>
	</div>
</form>