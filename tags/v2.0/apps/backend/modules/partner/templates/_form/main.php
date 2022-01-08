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
	<div class="row">
		<div class="label">Imagem</div>
		<div id="partnerFileIdRoDiv" class="text"><?php echo $partnerObj->getFileName() ?></div>
		<div id="partnerFileIdFieldDiv" style="display: <?php echo $displayField ?>" class="field">
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="96" height="22" id="uploadFile" align="middle">
				<param name="allowScriptAccess" value="sameDomain" />
				<param name="allowFullScreen" value="false" />
				<param name="FlashVars" value="eventId=1" />
				<param name="movie" value="/uploads/eventFile.swf?eventId=1&time=<?php echo time() ?>" />
				<param name="quality" value="high" />
				<param name="bgcolor" value="#E6E6E6" />
				<embed src="/uploads/eventFile.swf?eventId=1&time=<?php echo time() ?>" quality="high" bgcolor="#E6E6E6" width="96" height="22" name="uploadFile" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
			</object>
		</div>
	</div>
	
</div>