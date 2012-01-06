<?php
	$projectId = $faqObj->getId();
	$displayField  = ($readOnly?'none':'block');

	echo get_partial('faq/tabs', array('faqObj'=>$faqObj, 'readOnly'=>$readOnly));
?>