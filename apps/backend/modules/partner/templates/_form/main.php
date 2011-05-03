<?php
	$displayField = ($readOnly?'none':'block');
	$displayDiv   = ($readOnly?'block':'none');
?>
<div class="defaultForm">

	<div class="row">
	  <div class="label">Nome</div>
	  <div id="partnerPartnerNameFieldDiv" style="display: <?php echo $displayField ?>" class="field"><?php echo input_tag('partnerName', $partnerObj->getPartnerName(), array('size'=>35, 'id'=>'partnerPartnerName')) ?></div>
	  <div id="partnerPartnerNameRoDiv" style="display: <?php echo $displayDiv ?>" class="text"><?php echo $partnerObj->getPartnerName() ?></div>
	</div>
	<div class="row">
	  <div class="label">Url</div>
	  <div id="partnerExternalUrlFieldDiv" style="display: <?php echo $displayField ?>" class="field"><?php echo input_tag('externalUrl', $partnerObj->getExternalUrl(), array('size'=>35, 'id'=>'partnerExternalUrl')) ?></div>
	  <div id="partnerExternalUrlRoDiv" style="display: <?php echo $displayDiv ?>" class="text"><?php echo $partnerObj->getExternalUrl() ?></div>
	</div>
	
</div>