<?php
	echo form_remote_tag(array(
		'url'=>'faq/send',
		'success'=>'handleSuccessFaq( request.responseText, true )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "faqForm", "faq", false, "faq" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'faqForm' ));
?>
<table border="0" cellspacing="0" cellpadding="0" class="defaultForm">
	<tr>
		<td valign="top">
			<div class="rowTextArea">
				<div class="label"><?php echo __('faq.typeYourQuestion') ?></div>
				<div class="field">
					<?php echo textarea_tag('question', null, array('id'=>'faqQuestion', 'rows'=>5, 'cols'=>200)) ?><br/>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<div class="row">
				<div class="label"></div>
				<div class="field">
					<?php echo __('faq.max140Chars') ?>
				</div>
			</div>
		</td>
	</tr>
</table>