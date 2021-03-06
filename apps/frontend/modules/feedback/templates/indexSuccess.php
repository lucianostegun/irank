<?php include_partial('home/component/commonBar', array('pathList'=>array(__('feedback.title')=>'feedback/index'))); ?>
<div class="moduleIntro">
	<?php echo image_tag('feedback.jpg', array('align'=>'left', 'style'=>'margin-right: 10px; margin-bottom: 20px')) ?>
		<?php echo __('feedback.intro', array('%link%'=>link_to(__('feedback.beta'), __('feedback.betaLink')))) ?>
</div>
<div class="clear"></div>
<div id="feedbackFormDiv"align="center">
	<table cellspacing="0" cellpadding="0" class="formTable" style="width: 600px">
		<tr class="header">
			<th><h1><?php echo __('feedback.formTitle') ?></h1></th>
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
				<div class="defaultForm">		
					<div class="row">
						<div class="labelHalf"><?php echo __('feedback.name') ?></div>
						<div class="field"><?php echo input_tag('fullName', null, array('id'=>'feedbackFullName', 'size'=>30, 'maxlength'=>50)) ?></div>
					</div>
					<div class="row">
						<div class="labelHalf">E-mail</div>
						<div class="field"><?php echo input_tag('emailAddress', null, array('id'=>'feedbackEmailAddress', 'size'=>40, 'maxlength'=>100)) ?></div>
					</div>
					<div class="row">
						<div class="labelHalf"><?php echo __('feedback.subject') ?></div>
						<div class="text">Feedback</div>
					</div>
					<div class="rowTextArea" style="height: 120px">
						<div class="labelHalf"><?php echo __('feedback.message') ?></div>
						<div class="field"><?php echo textarea_tag('message', null, array('id'=>'feedbackMessage', 'style'=>'width: 400px; height: 100px')) ?></div>
					</div>
					<div class="separator"></div>
					<div class="buttonBarForm">
						<?php echo button_tag('mainSubmit', __('button.sendFeedback'), array('onclick'=>'doSubmitFeedback()')) ?>
						<?php echo getFormStatus(null, null, __('feedback.formError')) ?>
						<?php echo getFormLoading('feedback') ?>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>

<div id="successDiv" style="display: none" align="center">
	<table border="0" cellspacing="0" cellpadding="0" class="formTable" style="width: 550px; margin-top: 20px">
		<tr class="header">
			<th colspan="2"><h1><?php echo __('feedback.successTitle') ?></h1></th>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2" align="center">
				<?php echo image_tag('success', array('align'=>'left', 'style'=>'margin: 10px 0px 0px 15px')) ?>
			</td>
			<td align="left" valign="top" class="message">
				<?php echo __('feedback.successMessage') ?><br/><br/>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top" class="link">
				<div class="separator"></div>
				<?php echo link_to(__('ClickHere'), '#newMessage()', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> <?php echo __('feedback.newMessageLink') ?><br/>	
			</td>
		</tr>
	</table>
</div>
</form>
<br/>