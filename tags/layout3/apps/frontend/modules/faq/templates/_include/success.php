<div id="faqSuccessDiv" align="center">
	<table width="500" border="0" cellspacing="0" cellpadding="0" class="gridTableFlex">
	  <tr class="header">
		<th><?php echo __('faq.questionSent') ?></th>
	  </tr>
	  <tr>
	    <td align="left" valign="top" style="padding:15px 23px 16px 20px; color: #333333">
		<?php echo image_tag('success', array('align'=>'left', 'style'=>'margin: 0px 15px 15px 15px')) ?>
		<?php echo __('faq.successMessage', array('%link%'=>link_to(__('ClickHere'), '#showQuestionForm()'))) ?>
		</td>
	  </tr>
	</table>
</div>