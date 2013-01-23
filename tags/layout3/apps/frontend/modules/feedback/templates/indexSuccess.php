<?php include_partial('home/component/commonBar', array('pathList'=>array(__('feedback.title')=>'feedback/index'))); ?>
<?php echo image_tag('feedback', array('class'=>'logo')) ?>
<div class="moduleIntro image">
	Após 18 meses de desenvolvimento o <b>iRank</b> não está mais em versão <b><u><a href="http://pt.wikipedia.org/wiki/Vers%C3%A3o_beta">beta</a></u></b>.<br/>
	Mas sua avaliação é muito importante para que possamos corrigir falhas e adicionar melhorias em todas as áreas do site.<br/><br/>
	Pedimos que sempre que possível você entre em contato para nos enviar sugestões ou nos informar sobre um possível erro, falha ou bug que tenha encontrado no site.
</div>
<hr class="separator"/>
<div id="feedbackFormDiv"align="center">
	<table cellspacing="0" cellpadding="0" class="formTable" style="width: 600px">
		<tr class="header">
			<th><h1><?php echo __('feedback.formTitle') ?></h1></th>
		</tr>
		<tr>
			<td valign="top">
			<?php
				$peopleObj = People::getCurrentPeople();
				
				echo form_remote_tag(array(
					'url'=>'feedback/send',
					'success'=>'handleSuccessFeedback( request.responseText, true )',
					'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "feedbackForm", "feedback", false, "feedback" )',
					'encoding'=>'utf8',
					'loading'=>'showIndicator()'
					), array( 'id'=>'feedbackForm' ));
					
					echo input_hidden_tag('emailAddress', $peopleObj->getEmailAddress());
					echo input_hidden_tag('fullName', $peopleObj->getName());
			?>
				<div class="defaultForm">		
					<div class="row">
						<div class="labelHalf"><?php echo __('feedback.name') ?></div>
						<div class="text"><?php echo $peopleObj->getName() ?></div>
					</div>
					<div class="row">
						<div class="labelHalf">E-mail</div>
						<div class="text"><?php echo $peopleObj->getEmailAddress() ?></div>
					</div>
					<div class="row">
						<div class="labelHalf"><?php echo __('feedback.subject') ?></div>
						<div class="text">Feedback</div>
					</div>
					<div class="rowTextArea" style="height: 120px">
						<div class="labelHalf"><?php echo __('feedback.message') ?></div>
						<div class="field"><?php echo textarea_tag('message', null, array('id'=>'feedbackMessage', 'style'=>'width: 440px; height: 100px')) ?></div>
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