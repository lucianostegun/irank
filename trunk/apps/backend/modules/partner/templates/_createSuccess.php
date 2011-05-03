<?php
	$projectId = $partnerObj->getId();
	$displayField  = ($readOnly?'none':'block');

	echo get_partial('partner/tabs', array('partnerObj'=>$partnerObj, 'readOnly'=>$readOnly));
?>