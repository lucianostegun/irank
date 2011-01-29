<div class="commonBar"><span><?php echo __('faq.title') ?></span></div>
<div class="innerContent">
	<?php echo __('faq.intro') ?>
	<br/><br/>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  </tr>
  <tr id="sendQuestionTr">
	<td align="left" valign="top" style="padding: 0px 23px 16px 20px;">
		<?php echo button_tag('sendMyQuestion', __('button.sendMyQuestion'), array('onclick'=>'showQuestionForm()')) ?>
    </td>
  </tr>
</table>
<div id="faqFormDiv">
	<table width="100%" border="0" cellspacing="1" cellpadding="2" class="gridTable">
	  <tr class="header">
	  	<th><?php echo __('faq.questionForme') ?></th>
	  </tr>
	  <tr>
	  	<td>	
			<?php include_partial('faq/include/form'); ?>
		</td>
	  </tr>
	</table>
	<div class="buttonBarForm">
		<?php echo button_tag('mainSubmit', __('button.sendMyQuestion'), array('onclick'=>'doSubmitFaq()')) ?>
		<?php echo getFormStatus(null, null, __('faq.formError')) ?>
		<?php echo getFormLoading('faq') ?>
	</div>
</div>
<?php include_partial('faq/include/success'); ?>
<br/><br/>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" style="padding: 15px 23px 16px 20px; border-top:#999999 2px solid;">

		<table width="95%" cellspacing="1" cellpadding="0" class="faqTable">
		<?php
			foreach(Faq::getList() as $faqObj):
				
				$faqId = $faqObj->getId();
		?>
		  <tr>
			<th class="question" onclick="toggleFaq(<?php echo $faqId ?>)"><?php echo $faqObj->getQuestion() ?></th>
		  </tr>
		  <tr>
			<td class="answer" id="faqAnswer<?php echo $faqId ?>" style="display: none">
				<?php echo $faqObj->getAnswer() ?>
			</td>
		  </tr>
		  <tr>
			<td height="7"></td>
		  </tr>
		<?php endforeach; ?>
		</table>
    	
	</td>
  </tr>
</table>