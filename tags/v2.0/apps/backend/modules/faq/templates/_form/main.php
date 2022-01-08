<?php
	$displayField = ($readOnly?'none':'block');
	$displayDiv   = ($readOnly?'block':'none');
?>
<div class="defaultForm">

	<div class="row">
	  <div class="label">Dúvida</div>
	  <div id="faqQuestionFieldDiv" style="display: <?php echo $displayField ?>" class="field"><?php echo input_tag( 'question', $faqObj->getQuestion(), array( 'size'=>70, 'id'=>'faqQuestion' )) ?></div>
	  <div id="faqQuestionRoDiv" style="display: <?php echo $displayDiv ?>" class="text"><?php echo $faqObj->getQuestion() ?></div>
	</div>
	<br/>
	<?php include_partial('faq/include/i18n', array('faqId'=>$faqObj->getId())) ?>
	
</div>