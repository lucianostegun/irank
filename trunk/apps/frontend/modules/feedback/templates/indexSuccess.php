<div class="commonBar"><span><?php echo __('feedback.title') ?></span></div>
<div class="innerContent">
	<?php echo image_tag('feedback.jpg', array('align'=>'left', 'style'=>'margin-right: 10px; margin-bottom: 20px')) ?>
		<?php echo __('feedback.intro', array('%link%'=>link_to(__('feedback.beta'), __('feedback.betaLink')))) ?>
		<br/><br/
</div>

<div id="feedbackFormDiv">
	<table width="100%" cellspacing="1" cellpadding="2" class="gridTable">
		<tr class="header">
			<th><?php echo __('feedback.formTitle') ?></th>
		</tr>
		<tr>
			<td valign="top">

			<?php
				echo form_remote_tag(array(
					'url'=>'feedback/send',
					'success'=>'handleSuccessFeedback( request.responseText, true )',
					'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "feedbackForm", "feedback", false, "feedback" )',
					'encoding'=>'utf8',
					'loading'=>'showIndicator()'
					), array( 'id'=>'feedbackForm' ));
			?>		
				<table width="100%" cellspacing="0" cellpadding="0" class="defaultForm">
					<tr>
						<td valign="top">
			
							<div class="row">
								<div class="label"><?php echo __('feedback.name') ?></div>
								<div class="field"><?php echo input_tag('fullName', null, array('id'=>'feedbackFullName', 'size'=>30, 'maxlength'=>50)) ?></div>
							</div>
							<div class="row">
								<div class="label">E-mail</div>
								<div class="field"><?php echo input_tag('emailAddress', null, array('id'=>'feedbackEmailAddress', 'size'=>40, 'maxlength'=>100)) ?></div>
							</div>
							</div>
							<div class="row">
								<div class="label"><?php echo __('feedback.subject') ?></div>
								<div class="field">Feedback</div>
							</div>
							<div class="rowTextArea" style="height: 120px">
								<div class="label"><?php echo __('feedback.message') ?></div>
								<div class="field"><?php echo textarea_tag('message', null, array('id'=>'feedbackMessage', 'style'=>'width: 450px; height: 100px')) ?></div>
							</div>
			
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<div class="buttonBarForm">
		<?php echo button_tag('mainSubmit', __('button.sendFeedback'), array('onclick'=>'doSubmitFeedback()')) ?>
		<?php echo getFormStatus(null, null, __('feedback.formError')) ?>
		<?php echo getFormLoading('feedback') ?>
	</div>
</div>

<div id="successDiv" style="display: none" align="center">
	<table width="500" border="0" cellspacing="0" cellpadding="3" class="gridTableFlex">
		<tr class="header">
			<th colspan="2"><?php echo __('feedback.successTitle') ?></th>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2" align="center">
				<?php echo image_tag('success', array('align'=>'left', 'style'=>'margin: 10px 0px 0px 15px')) ?>
			</td>
			<td align="left" valign="top">
				<?php echo __('feedback.successMessage') ?><br/><br/>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<?php echo link_to(__('ClickHere'), '#newMessage()', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> <?php echo __('feedback.newMessageLink') ?><br/>	
			</td>
		</tr>
	</table>
</div>
</form>
<br/>