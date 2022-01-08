<?php include_partial('home/component/commonBar', array('pathList'=>array(__('friendInvite.title')=>'friendInvite/index'))); ?>
<div class="moduleIntro">
	<?php echo __('friendInvite.intro') ?>
</div>
<hr class="separator"/>
<div class="textC">
	<table cellspacing="0" cellpadding="0" class="formTable" style="margin-left: 20px; width: 750px">
		<tr class="header">
	  		<th><h1><?php echo __('friendInvite.formTitle') ?></h1></th>
	  	</tr>
	  	<tr>
	  		<td>
	  			<div class="defaultForm">
					<?php
						echo form_remote_tag(array(
							'url'=>'friendInvite/sendInvite',
							'success'=>'handleSuccessFriendInvite( request.responseText )',
							'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "friendInviteForm", "friendInvite", false, "friendInvite" )',
							'encoding'=>'utf8',
							'loading'=>'showIndicator()'
							), array( 'id'=>'friendInviteForm' ));
					?>			
					<div class="row">
						<div class="label"><?php echo __('friendInvite.yourName') ?></div>
						<div class="field"><?php echo input_tag('peopleName', $peopleName, array('class'=>'required', 'id'=>'friendInvitePeopleName')) ?></div>
					</div>
					<div class="row">
						<div class="label"><?php echo __('friendInvite.yourEmail') ?></div>
						<div class="field"><?php echo input_tag('emailAddress', $emailAddress, array('size'=>35, 'maxlength'=>150, 'class'=>'required', 'id'=>'friendInviteEmailAddress')) ?></div>
					</div>
					
					<br/>
					<blockquote><?php echo __('friendInvite.instructions') ?></blockquote><br/>
					<?php for($i=1; $i <= 10; $i++): ?>
					<div class="row">
						<div class="labelHalf"><?php echo __('friendInvite.friendName') ?></div>
						<div class="field"><?php echo input_tag('friendName'.$i, null, array('size'=>15, 'autocomplete'=>'off', 'id'=>'friendInviteFriendName'.$i)) ?></div>
						<div class="labelHalf">E-mail</div>
						<div class="field"><?php echo input_tag('emailAddress'.$i, null, array('size'=>25, 'autocomplete'=>'off', 'id'=>'friendInviteEmailAddress'.$i)) ?></div>
						<div class="image" id="friendInviteImage<?php echo $i ?>Div"></div>
						<div class="text flex" id="friendInviteStatus<?php echo $i ?>Div"></div>
					</div>
				    <?php endfor; ?>
					<div class="separator"></div>
					<div class="buttonBarForm">
						<?php echo button_tag('mainSubmit', __('button.inviteFriend'), array('onclick'=>'doSubmitFriendInvite()')); ?>
						<?php echo button_tag('resetForm', __('button.resetForm'), array('onclick'=>'resetFriendInviteForm()')); ?>
						<?php echo getFormLoading('friendInvite') ?>
						<?php echo getFormStatus(null, null, __('friendInvite.inviteError')); ?>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
</form>