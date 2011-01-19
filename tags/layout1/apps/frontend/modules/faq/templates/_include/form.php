<div id="faqFormDiv" style="width: 500px; margin-left: 100px; padding: 10 0 10 0">
	<?php
		echo form_remote_tag(array(
			'url'=>'faq/send',
			'success'=>'handleSuccessFaq( request.responseText, true )',
			'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "faqForm", "faq", false, "faq" )',
			'encoding'=>'utf8',
			'loading'=>'showIndicator()'
			), array( 'id'=>'faqForm' ));
	?>
	<table width="100%" cellspacing="1" cellpadding="0" class="defaultForm">
		<tr>
			<td valign="top">
				<div class="rowTextArea">
					<div class="label">Digite sua dúvida</div>
					<div class="field">
						<?php echo textarea_tag('question', null, array('id'=>'faqQuestion', 'rows'=>5, 'cols'=>200)) ?><br/>
						Máx. 140 caracteres
					</div>
				</div>
			</td>
		</tr>
	</table>
	<div class="buttonBarForm" style="border: 0px">
		<?php echo button_tag('mainSubmit', 'Enviar minha dúvida', array('onclick'=>'doSubmitFaq()')) ?>
		<?php echo getFormStatus(null, null, 'Erro ao enviar a dúvida') ?>
		<?php echo getFormLoading('faq') ?>
	</div>
</div>